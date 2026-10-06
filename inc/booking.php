<?php
/**
 * Consultation bookings: post type storage, availability and double booking guard.
 *
 * One booking = one `hale_booking` post. The widget shows a single clinic
 * calendar, so a slot is one appointment: as soon as a booking exists for that
 * date + time the slot is blocked for everybody, until an admin cancels it.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Appointment slots offered by the booking widget.
 */
function hale_booking_get_slot_schedule()
{
    return [
        'Morning' => [
            '09:00',
            '09:15',
            '09:30',
            '09:45',
            '10:00',
            '10:15',
            '10:30',
            '10:45',
            '11:00',
            '11:15',
            '11:30',
            '11:45',
        ],
        'Afternoon' => [
            '12:00',
            '12:15',
            '12:30',
            '12:45',
            '13:15',
        ],
    ];
}

/**
 * All configured slot times, flattened.
 */
function hale_booking_get_all_slots()
{
    $slots = [];

    foreach (hale_booking_get_slot_schedule() as $group) {
        foreach ($group as $slot) {
            $slots[] = $slot;
        }
    }

    return $slots;
}

/**
 * Bookings post type - admin only, never publicly queryable.
 */
function hale_register_booking_post_type()
{
    $labels = [
        'name'               => esc_html__('Bookings', 'hale-dental'),
        'singular_name'      => esc_html__('Booking', 'hale-dental'),
        'menu_name'          => esc_html__('Bookings', 'hale-dental'),
        'add_new'            => esc_html__('Add Booking', 'hale-dental'),
        'add_new_item'       => esc_html__('Add New Booking', 'hale-dental'),
        'edit_item'          => esc_html__('Edit Booking', 'hale-dental'),
        'new_item'           => esc_html__('New Booking', 'hale-dental'),
        'view_item'          => esc_html__('View Booking', 'hale-dental'),
        'search_items'       => esc_html__('Search Bookings', 'hale-dental'),
        'not_found'          => esc_html__('No bookings found.', 'hale-dental'),
        'not_found_in_trash' => esc_html__('No bookings found in Trash.', 'hale-dental'),
        'all_items'          => esc_html__('All Bookings', 'hale-dental'),
    ];

    $args = [
        'labels'              => $labels,
        'description'         => esc_html__('Consultation requests made through the website booking widget.', 'hale-dental'),
        'public'              => false,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_rest'        => false,
        'exclude_from_search' => true,
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => false,
        'hierarchical'        => false,
        'menu_position'       => 26,
        'menu_icon'           => 'dashicons-calendar-alt',
        'delete_with_user'    => false,
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
        'supports'            => ['title'],
    ];

    register_post_type('hale_booking', $args);
}
add_action('init', 'hale_register_booking_post_type');

/**
 * Every active (not cancelled) booking inside a set of dates.
 */
function hale_booking_get_taken_slots_for_dates($dates)
{
    global $wpdb;

    $clean = [];

    foreach ((array) $dates as $date) {
        $date = sanitize_text_field($date);

        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) && !in_array($date, $clean, true)) {
            $clean[] = $date;
        }
    }

    if (empty($clean)) {
        return [];
    }

    $placeholders = implode(',', array_fill(0, count($clean), '%s'));

    $rows = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT date_meta.meta_value AS booking_date,
                    time_meta.meta_value AS booking_time,
                    consultant_meta.meta_value AS booking_consultant
             FROM {$wpdb->posts} p
             INNER JOIN {$wpdb->postmeta} date_meta
                     ON date_meta.post_id = p.ID AND date_meta.meta_key = '_hale_date'
             INNER JOIN {$wpdb->postmeta} time_meta
                     ON time_meta.post_id = p.ID AND time_meta.meta_key = '_hale_time'
             INNER JOIN {$wpdb->postmeta} consultant_meta
                     ON consultant_meta.post_id = p.ID AND consultant_meta.meta_key = '_hale_consultant'
             LEFT JOIN {$wpdb->postmeta} status_meta
                     ON status_meta.post_id = p.ID AND status_meta.meta_key = '_hale_status'
             WHERE p.post_type = 'hale_booking'
               AND p.post_status != 'trash'
               AND date_meta.meta_value IN (" . $placeholders . ")
               AND (status_meta.meta_value IS NULL OR status_meta.meta_value != 'cancelled')",
            $clean
        ),
        ARRAY_A
    );

    $taken = [];

    foreach ((array) $rows as $row) {
        $date = trim((string) $row['booking_date']);
        $time = trim((string) $row['booking_time']);

        if ($time === '') {
            continue;
        }

        if (!isset($taken[$date])) {
            $taken[$date] = [];
        }

        if (!in_array($time, $taken[$date], true)) {
            $taken[$date][] = $time;
        }
    }

    return $taken;
}

/**
 * Taken slot times for a single date.
 */
function hale_booking_get_taken_slots($date)
{
    $taken = hale_booking_get_taken_slots_for_dates([$date]);

    return isset($taken[$date]) ? $taken[$date] : [];
}

/**
 * Is this slot already booked? Cancelled bookings release the slot.
 */
function hale_booking_slot_conflict($date, $time, $consultant = '', $exclude_id = 0)
{
    global $wpdb;

    $time       = trim((string) $time);
    $consultant = trim((string) $consultant);

    if ($time === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', sanitize_text_field($date))) {
        return false;
    }

    $booking_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT p.ID
             FROM {$wpdb->posts} p
             INNER JOIN {$wpdb->postmeta} date_meta
                     ON date_meta.post_id = p.ID AND date_meta.meta_key = '_hale_date'
             INNER JOIN {$wpdb->postmeta} time_meta
                     ON time_meta.post_id = p.ID AND time_meta.meta_key = '_hale_time'
             LEFT JOIN {$wpdb->postmeta} status_meta
                     ON status_meta.post_id = p.ID AND status_meta.meta_key = '_hale_status'
             WHERE p.post_type = 'hale_booking'
               AND p.post_status != 'trash'
               AND date_meta.meta_value = %s
               AND time_meta.meta_value = %s
               AND (status_meta.meta_value IS NULL OR status_meta.meta_value != 'cancelled')
               AND p.ID != %d
             LIMIT 1",
            sanitize_text_field($date),
            $time,
            (int) $exclude_id
        )
    );

    return $booking_id ? (int) $booking_id : false;
}

/**
 * Insert a booking post with all its meta.
 */
function hale_booking_create($data)
{
    $title = sprintf('%s - %s at %s', $data['name'], $data['date_label'], $data['time']);

    $booking_id = wp_insert_post([
        'post_type'   => 'hale_booking',
        'post_status' => 'publish',
        'post_title'  => $title,
    ], true);

    if (is_wp_error($booking_id) || !$booking_id) {
        return 0;
    }

    foreach ($data['meta'] as $key => $value) {
        update_post_meta($booking_id, $key, $value);
    }

    return (int) $booking_id;
}

/**
 * Availability feed used by the booking widget.
 */
function hale_booking_slots_handler()
{
    if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'hale_booking_nonce')) {
        wp_send_json_error('Your session expired. Please refresh the page and try again.');
    }

    $date = isset($_POST['date']) ? sanitize_text_field(wp_unslash($_POST['date'])) : '';

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        wp_send_json_error('Invalid date.');
    }

    wp_send_json_success([
        'date'   => $date,
        'taken'  => hale_booking_get_taken_slots($date),
    ]);
}
add_action('wp_ajax_nopriv_hale_booking_slots', 'hale_booking_slots_handler');
add_action('wp_ajax_hale_booking_slots', 'hale_booking_slots_handler');

/**
 * Booking request handler: stores the booking and emails the admin.
 */
function hale_booking_submit_handler()
{
    if (!isset($_POST['action']) || $_POST['action'] !== 'hale_booking_submit') {
        wp_send_json_error('Invalid request');
    }

    if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'hale_booking_nonce')) {
        wp_send_json_error('Your session expired. Please refresh the page and try again.');
    }

    // Honeypot
    if (!empty($_POST['website'])) {
        wp_send_json_success('Thank you - our team will confirm your appointment shortly.');
    }

    $fullname   = isset($_POST['fullname']) ? sanitize_text_field(wp_unslash($_POST['fullname'])) : '';
    $email      = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $phone      = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
    $message    = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';
    $consultant = isset($_POST['consultant']) ? sanitize_text_field(wp_unslash($_POST['consultant'])) : '';
    $date       = isset($_POST['date']) ? sanitize_text_field(wp_unslash($_POST['date'])) : '';
    $date_label = isset($_POST['date_label']) ? sanitize_text_field(wp_unslash($_POST['date_label'])) : '';
    $time       = isset($_POST['time']) ? sanitize_text_field(wp_unslash($_POST['time'])) : '';

    if (empty($fullname) || !is_email($email) || empty($phone)) {
        wp_send_json_error('Please fill in your name, email and phone number.');
    }

    if (empty($date) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        wp_send_json_error('Please choose an appointment date.');
    }

    $today_value = current_time('Y-m-d');
    $max_date    = date('Y-m-d', strtotime($today_value . ' +90 days'));

    if ($date < $today_value) {
        wp_send_json_error('That appointment date has already passed. Please pick another date.');
    }

    if ($date > $max_date) {
        wp_send_json_error('Bookings can only be made within the next 90 days.');
    }

    if (empty($time) || !in_array($time, hale_booking_get_all_slots(), true)) {
        wp_send_json_error('Please choose a valid appointment time.');
    }

    if (empty($date_label)) {
        $date_label = date_i18l('l j F Y', strtotime($date));
    }

    // Slot already taken?
    if (hale_booking_slot_conflict($date, $time, $consultant)) {
        wp_send_json_error('Sorry, that time has just been taken. Please choose another slot.');
    }

    $booking_id = hale_booking_create([
        'name'       => $fullname,
        'date_label' => $date_label,
        'time'       => $time,
        'meta'       => [
            '_hale_name'       => $fullname,
            '_hale_email'      => $email,
            '_hale_phone'      => $phone,
            '_hale_message'    => $message,
            '_hale_consultant' => $consultant,
            '_hale_date'       => $date,
            '_hale_time'       => $time,
            '_hale_status'     => 'pending',
            '_hale_source'     => esc_url_raw(wp_get_referer()),
        ],
    ]);

    if (!$booking_id) {
        wp_send_json_error('We could not save your booking. Please try again or contact us directly.');
    }

    // Second pass closes the window where two visitors submit the same slot at once.
    if (hale_booking_slot_conflict($date, $time, $consultant, $booking_id)) {
        wp_delete_post($booking_id, true);

        wp_send_json_error('Sorry, that time has just been taken. Please choose another slot.');
    }

    $to      = get_option('admin_email');
    $subject = sprintf('New consultation booking: %s on %s at %s', $fullname, $date_label, $time);

    $body = sprintf(
        "Consultant: %s\nDate: %s\nTime: %s\n\nName: %s\nEmail: %s\nPhone / WhatsApp: %s\n\nMessage:\n%s\n\nBooking reference: #%d",
        $consultant ? $consultant : '-',
        $date_label,
        $time,
        $fullname,
        $email,
        $phone,
        $message ? $message : '-',
        $booking_id
    );

    $headers = ['Reply-To: ' . $email];

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(sprintf(
            'Thank you %s - your consultation on %s at %s has been requested. We will confirm it shortly.',
            $fullname,
            $date_label,
            $time
        ));
    }

    wp_send_json_error('Your booking was saved but our confirmation email could not be sent. Please call us to confirm.');
}
add_action('wp_ajax_nopriv_hale_booking_submit', 'hale_booking_submit_handler');
add_action('wp_ajax_hale_booking_submit', 'hale_booking_submit_handler');

/*
|--------------------------------------------------------------------------
| Admin: columns
|--------------------------------------------------------------------------
*/

add_filter('manage_hale_booking_posts_columns', 'hale_booking_admin_columns');

function hale_booking_admin_columns($columns)
{
    return [
        'cb'              => isset($columns['cb']) ? $columns['cb'] : '',
        'title'           => esc_html__('Booking', 'hale-dental'),
        'hale_date'       => esc_html__('Date & time', 'hale-dental'),
        'hale_consultant' => esc_html__('Consultant', 'hale-dental'),
        'hale_customer'   => esc_html__('Customer', 'hale-dental'),
        'hale_status'     => esc_html__('Status', 'hale-dental'),
        'date'            => esc_html__('Received', 'hale-dental'),
    ];
}

add_action('manage_hale_booking_posts_custom_column', 'hale_booking_admin_column', 10, 2);

function hale_booking_admin_column($column, $booking_id)
{
    if ($column === 'hale_date') {
        $date = get_post_meta($booking_id, '_hale_date', true);
        $time = get_post_meta($booking_id, '_hale_time', true);

        echo $date ? esc_html(trim($date . ' ' . $time)) : '&mdash;';

        return;
    }

    if ($column === 'hale_consultant') {
        $consultant = get_post_meta($booking_id, '_hale_consultant', true);

        echo $consultant ? esc_html($consultant) : '&mdash;';

        return;
    }

    if ($column === 'hale_customer') {
        $name  = get_post_meta($booking_id, '_hale_name', true);
        $email = get_post_meta($booking_id, '_hale_email', true);
        $phone = get_post_meta($booking_id, '_hale_phone', true);

        echo '<strong>' . esc_html($name) . '</strong><br>';
        echo '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a><br>';
        echo esc_html($phone);

        return;
    }

    if ($column === 'hale_status') {
        $status = get_post_meta($booking_id, '_hale_status', true);
        $status = $status ? $status : 'pending';

        $colours = [
            'pending'   => '#b45309',
            'confirmed' => '#047857',
            'cancelled' => '#b91c1c',
        ];

        printf(
            '<span style="color:%s;font-weight:600;">%s</span>',
            esc_attr(isset($colours[$status]) ? $colours[$status] : '#333333'),
            esc_html(ucfirst($status))
        );
    }
}

/*
|--------------------------------------------------------------------------
| Admin: status filter + appointment date sorting
|--------------------------------------------------------------------------
*/

add_filter('manage_hale_booking_posts_sortable_columns', 'hale_booking_sortable_columns');

function hale_booking_sortable_columns($columns)
{
    $columns['hale_date'] = 'hale_date';

    return $columns;
}

add_action('restrict_manage_posts', 'hale_booking_admin_filters');

function hale_booking_admin_filters($post_type)
{
    if ($post_type !== 'hale_booking') {
        return;
    }

    $status = isset($_GET['hale_status']) ? sanitize_key($_GET['hale_status']) : '';
    $labels = [
        ''          => esc_html__('All statuses', 'hale-dental'),
        'pending'   => esc_html__('Pending', 'hale-dental'),
        'confirmed' => esc_html__('Confirmed', 'hale-dental'),
        'cancelled' => esc_html__('Cancelled', 'hale-dental'),
    ];

    echo '<select name="hale_status">';

    foreach ($labels as $key => $label) {
        printf(
            '<option value="%s"%s>%s</option>',
            esc_attr($key),
            selected($key, $status, false),
            esc_html($label)
        );
    }

    echo '</select>';
}

add_action('pre_get_posts', 'hale_booking_admin_query');

function hale_booking_admin_query($query)
{
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->get('post_type') !== 'hale_booking') {
        return;
    }

    $status = isset($_GET['hale_status']) ? sanitize_key($_GET['hale_status']) : '';

    if ($status) {
        $meta_query   = (array) $query->get('meta_query');
        $meta_query[] = [
            'key'     => '_hale_status',
            'value'   => $status,
            'compare' => '=',
        ];

        $query->set('meta_query', $meta_query);
    }

    $orderby = $query->get('orderby');

    // Show the earliest appointment first unless the user sorted the table.
    if (empty($orderby) || $orderby === 'hale_date') {
        $query->set('meta_key', '_hale_date');
        $query->set('orderby', 'meta_value');

        if (empty($orderby)) {
            $query->set('order', 'ASC');
        }
    }
}

/*
|--------------------------------------------------------------------------
| Admin: status change from the list table
|--------------------------------------------------------------------------
*/

add_filter('post_row_actions', 'hale_booking_row_actions', 10, 2);

function hale_booking_row_actions($actions, $post)
{
    if (!$post || $post->post_type !== 'hale_booking') {
        return $actions;
    }

    $status = get_post_meta($post->ID, '_hale_status', true);
    $status = $status ? $status : 'pending';

    if ($status !== 'confirmed') {
        $actions['hale_confirm'] = sprintf(
            '<a href="%s">%s</a>',
            esc_url(wp_nonce_url(
                admin_url('admin.php?page=hale-booking-status&booking=' . $post->ID . '&status=confirmed'),
                'hale_booking_status_' . $post->ID
            )),
            esc_html__('Confirm', 'hale-dental')
        );
    }

    if ($status !== 'cancelled') {
        $actions['hale_cancel'] = sprintf(
            '<a href="%s" onclick="return confirm(\'%s\');">%s</a>',
            esc_url(wp_nonce_url(
                admin_url('admin.php?page=hale-booking-status&booking=' . $post->ID . '&status=cancelled'),
                'hale_booking_status_' . $post->ID
            )),
            esc_js(esc_html__('Cancel this booking and free the slot?', 'hale-dental')),
            esc_html__('Cancel', 'hale-dental')
        );
    }

    return $actions;
}

add_action('admin_menu', 'hale_booking_status_page');

function hale_booking_status_page()
{
    add_submenu_page(
        'edit.php?post_type=hale_booking',
        esc_html__('Booking status', 'hale-dental'),
        esc_html__('Booking status', 'hale-dental'),
        'edit_posts',
        'hale-booking-status',
        'hale_booking_status_page_render'
    );
}

function hale_booking_status_page_render()
{
    $booking_id = isset($_GET['booking']) ? absint($_GET['booking']) : 0;
    $status     = isset($_GET['status']) ? sanitize_key($_GET['status']) : '';

    // Opened directly from the menu - just show the list.
    if (!$booking_id && $status === '') {
        wp_safe_redirect(admin_url('edit.php?post_type=hale_booking'));

        exit;
    }

    if (!$booking_id || !in_array($status, ['pending', 'confirmed', 'cancelled'], true)) {
        wp_die(esc_html__('Invalid booking request.', 'hale-dental'));
    }

    check_admin_referer('hale_booking_status_' . $booking_id);

    if (!current_user_can('edit_post', $booking_id)) {
        wp_die(esc_html__('You are not allowed to edit bookings.', 'hale-dental'));
    }

    update_post_meta($booking_id, '_hale_status', $status);

    $redirect = admin_url('edit.php?post_type=hale_booking&hale_booking_notice=' . $status);

    wp_safe_redirect($redirect);

    exit;
}

add_action('admin_notices', 'hale_booking_admin_notice');

function hale_booking_admin_notice()
{
    if (!isset($_GET['hale_booking_notice']) || !isset($_GET['post_type']) || $_GET['post_type'] !== 'hale_booking') {
        return;
    }

    $status  = sanitize_key($_GET['hale_booking_notice']);
    $allowed = ['pending' => 'marked as pending', 'confirmed' => 'confirmed', 'cancelled' => 'cancelled - the slot is free again'];

    if (!isset($allowed[$status])) {
        return;
    }

    printf(
        '<div class="notice notice-success is-dismissible"><p>%s</p></div>',
        esc_html(sprintf('Booking %s.', $allowed[$status]))
    );
}

/*
|--------------------------------------------------------------------------
| Admin: details meta box
|--------------------------------------------------------------------------
*/

add_action('add_meta_boxes', 'hale_booking_add_meta_box');

function hale_booking_add_meta_box()
{
    add_meta_box(
        'hale_booking_details',
        esc_html__('Booking details', 'hale-dental'),
        'hale_booking_render_meta_box',
        'hale_booking',
        'normal',
        'high'
    );
}

function hale_booking_render_meta_box($post)
{
    wp_nonce_field('hale_booking_save_meta', 'hale_booking_meta_nonce');

    $fields = [
        esc_html__('Date', 'hale-dental')      => get_post_meta($post->ID, '_hale_date', true),
        esc_html__('Time', 'hale-dental')      => get_post_meta($post->ID, '_hale_time', true),
        esc_html__('Consultant', 'hale-dental') => get_post_meta($post->ID, '_hale_consultant', true),
        esc_html__('Name', 'hale-dental')      => get_post_meta($post->ID, '_hale_name', true),
        esc_html__('Email', 'hale-dental')     => get_post_meta($post->ID, '_hale_email', true),
        esc_html__('Phone', 'hale-dental')     => get_post_meta($post->ID, '_hale_phone', true),
        esc_html__('Page', 'hale-dental')      => get_post_meta($post->ID, '_hale_source', true),
    ];

    echo '<table class="widefat striped" style="border:0;">';

    foreach ($fields as $label => $value) {
        printf(
            '<tr><th style="width:160px;">%s</th><td>%s</td></tr>',
            esc_html($label),
            esc_html($value ? $value : '-')
        );
    }

    echo '</table>';

    $message = get_post_meta($post->ID, '_hale_message', true);

    if ($message) {
        printf(
            '<p style="margin-top:12px;"><strong>%s</strong><br>%s</p>',
            esc_html__('Message', 'hale-dental'),
            nl2br(esc_html($message))
        );
    }

    $status = get_post_meta($post->ID, '_hale_status', true);
    $status = $status ? $status : 'pending';

    echo '<p style="margin-top:16px;"><label for="hale_booking_status" style="display:block;font-weight:600;margin-bottom:4px;">'
        . esc_html__('Status', 'hale-dental') . '</label>';

    echo '<select id="hale_booking_status" name="hale_booking_status">';

    foreach (['pending', 'confirmed', 'cancelled'] as $option) {
        printf(
            '<option value="%s" %s>%s</option>',
            esc_attr($option),
            selected($option, $status, false),
            esc_html(ucfirst($option))
        );
    }

    echo '</select></p>';

    echo '<p class="description">' . esc_html__('Cancelled bookings free the slot up for new requests.', 'hale-dental') . '</p>';
}

add_action('save_post_hale_booking', 'hale_booking_save_meta_box', 10, 2);

function hale_booking_save_meta_box($post_id, $post)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!isset($_POST['hale_booking_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['hale_booking_meta_nonce'])), 'hale_booking_save_meta')) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (!isset($_POST['hale_booking_status'])) {
        return;
    }

    $status = sanitize_key(wp_unslash($_POST['hale_booking_status']));

    if (!in_array($status, ['pending', 'confirmed', 'cancelled'], true)) {
        return;
    }

    update_post_meta($post_id, '_hale_status', $status);
}
