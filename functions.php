<?php

function hale_coffee_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('responsive-embeds');
    add_theme_support('custom-logo');

    register_nav_menus([
        'primary' => __('Primary Menu', 'hale-coffee'),
        'footer' => __('Footer Menu', 'hale-coffee'),
    ]);
}
add_action('after_setup_theme', 'hale_coffee_setup');

function hale_dental_append_site_title( $title ) {
    if ( is_front_page() ) {
        return $title;
    }
    return $title . ' — Ilam Din Dental';
}
add_filter( 'document_title', 'hale_dental_append_site_title', 20 );

function hale_coffee_enqueue_assets()
{

    // Cal Sans font
    wp_enqueue_style(
        'cal-sans',
        'https://fonts.googleapis.com/css2?family=Cal+Sans:wght@400;500;600;700;800&display=swap',
        [],
        null
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css',
        [],
        '6.7.2'
    );
    wp_enqueue_style(
        'slick-css',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        [],
        '1.8.1'
    );

    wp_enqueue_style(
        'slick-theme',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css',
        ['slick-css'],
        '1.8.1'
    );

    wp_enqueue_script(
        'slick-js',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        ['jquery'],
        '1.8.1',
        true
    );
    wp_enqueue_script(
        'hale-sliders',
        get_template_directory_uri() . '/assets/js/sliders.js',
        ['jquery', 'slick-js'],
        wp_get_theme()->get('Version'),
        true
    );
     wp_enqueue_script(
        'hale-tabs',
        get_template_directory_uri() . '/assets/js/coffe-tabs.js',
        ['jquery', 'slick-js'],
        wp_get_theme()->get('Version'),
        true
    );

    // Theme stylesheet
    wp_enqueue_style(
        'hale-coffee-style',
        get_template_directory_uri() . '/assets/css/style.css',
        ['font-awesome'],
        filemtime( get_template_directory() . '/assets/css/style.css' )
    );

    // Mega Menu CSS
    wp_enqueue_style(
        'hale-mega-menu',
        get_template_directory_uri() . '/assets/css/mega-menu.css',
        ['hale-coffee-style'],
        filemtime( get_template_directory() . '/assets/css/mega-menu.css' )
    );

    // Navigation JS for mega menu & mobile toggle
    wp_enqueue_script(
        'hale-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        [],
        filemtime( get_template_directory() . '/assets/js/navigation.js' ),
        true
    );

    wp_localize_script('hale-tabs', 'haleCf', array(
        'ajaxUrl'     => admin_url('admin-ajax.php'),
        'templateUri' => get_template_directory_uri(),
    ));
}
add_action('wp_enqueue_scripts', 'hale_coffee_enqueue_assets');

/**
 * Quote / contact form handler.
 */
function hale_contact_submit_handler()
{
    if (!isset($_POST['action']) || $_POST['action'] !== 'hale_contact_submit') {
        wp_send_json_error('Invalid request');
    }

    $fullname = isset($_POST['fullname']) ? sanitize_text_field(wp_unslash($_POST['fullname'])) : '';
    $phone    = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
    $email    = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $product  = isset($_POST['product']) ? sanitize_text_field(wp_unslash($_POST['product'])) : '';
    $message  = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

    if (empty($fullname) || empty($phone) || !is_email($email) || empty($message)) {
        wp_send_json_error('Please fill in all required fields.');
    }

    $to = get_option('admin_email');
    $subject = sprintf('New quote request from %s', $fullname);
    $body = sprintf(
        "Name: %s\nPhone: %s\nEmail: %s\nProduct: %s\n\nMessage:\n%s",
        $fullname,
        $phone,
        $email,
        $product,
        $message
    );
    $headers = array('Reply-To: ' . $email);

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success('Message sent');
    }

    wp_send_json_error('Could not send your message. Please try again later.');
}
add_action('wp_ajax_nopriv_hale_contact_submit', 'hale_contact_submit_handler');
add_action('wp_ajax_hale_contact_submit', 'hale_contact_submit_handler');

/**
 * Mega Menu Support
 */

// Add Mega Menu checkbox to menu items in WP Admin
add_action('wp_nav_menu_item_custom_fields', 'hale_mega_menu_field', 10, 5);
function hale_mega_menu_field($item_id, $item, $depth, $args, $id)
{
    if ($depth > 0) {
        return;
    }
    $checked = get_post_meta($item_id, '_menu_item_mega', true) ? 'checked="checked"' : '';
?>
    <p class="field-mega description description-wide">
        <label for="edit-menu-item-mega-<?php echo $item_id; ?>">
            <input type="checkbox" id="edit-menu-item-mega-<?php echo $item_id; ?>" name="menu-item-mega[<?php echo $item_id; ?>]" value="1" <?php echo $checked; ?> />
            <?php _e('Enable Mega Menu', 'hale-coffee'); ?>
        </label>
    </p>
<?php
}

// Save mega menu checkbox value
add_action('wp_update_nav_menu_item', 'hale_mega_menu_save', 10, 3);
function hale_mega_menu_save($menu_id, $menu_item_db_id, $args)
{
    $value = isset($_POST['menu-item-mega'][$menu_item_db_id]) ? 1 : 0;
    update_post_meta($menu_item_db_id, '_menu_item_mega', $value);
}

// Custom Mega Menu Walker
class Hale_Mega_Walker extends Walker_Nav_Menu
{
    private $current_is_mega = false;
    private $skipping_children = false;
    private $panel_rendered = false;

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        if ($depth === 0 && isset($args->theme_location) && $args->theme_location === 'primary') {
            $this->current_is_mega = (bool) get_post_meta($item->ID, '_menu_item_mega', true);
            $this->skipping_children = false;
            $this->panel_rendered = false;
        }

        if ($this->skipping_children && $depth > 0) {
            return;
        }

        $output_before = strlen($output);
        parent::start_el($output, $item, $depth, $args, $id);

        if ($depth === 0) {
            $item_html = substr($output, $output_before);
            $has_children = in_array('menu-item-has-children', (array) $item->classes, true);

            if ($this->current_is_mega) {
                $item_html = str_replace('class="menu-item', 'class="menu-item menu-item-mega', $item_html);
            }

            if ($this->current_is_mega || $has_children) {
                $item_html = str_replace(
                    '</a>',
                    '<span class="hale-menu-indicator"><i class="fa-solid fa-chevron-down"></i></span></a>',
                    $item_html
                );
            }

            $output = substr_replace($output, $item_html, $output_before);
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        if ($this->skipping_children && $depth > 0) {
            return;
        }

        if ($depth === 0 && $this->current_is_mega && ! $this->panel_rendered) {
            $output .= $this->render_treatments_panel();
        }

        $this->skipping_children = false;
        parent::end_el($output, $item, $depth, $args);
    }

    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        if ($depth === 0 && $this->current_is_mega && isset($args->theme_location) && $args->theme_location === 'primary') {
            $this->skipping_children = true;
            $this->panel_rendered = true;
            $output .= $this->render_treatments_panel();
            return;
        }
        parent::start_lvl($output, $depth, $args);
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        if ($depth === 0 && $this->current_is_mega) {
            return;
        }
        parent::end_lvl($output, $depth, $args);
    }

    /**
     * Render the dynamic Treatments mega menu panel.
     */
    private function render_treatments_panel()
    {
        $treatments = get_posts(array(
            'post_type'      => 'treatments',
            'posts_per_page' => 12,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'no_found_rows'  => true,
        ));

        if (empty($treatments)) {
            return '';
        }

        $html = '<div class="mega-panel mega-treatments-panel">';
        $html .= '<div class="mega-panel-header">Treatments</div>';
        $html .= '<div class="mega-treatments-grid">';

        foreach ($treatments as $treatment) {
            $id    = (int) $treatment->ID;
            $title = get_the_title($id);
            $url   = get_permalink($id);
            $thumb = get_the_post_thumbnail($id, array(72, 72), array(
                'class'   => 'mega-treat-thumb',
                'loading' => 'lazy',
                'alt'     => esc_attr($title),
            ));

            if (empty($thumb)) {
                $thumb = '<span class="mega-treat-thumb mega-treat-placeholder"></span>';
            }

            if (has_excerpt($id)) {
                $description = get_the_excerpt($id);
            } else {
                $description = wp_trim_words(get_post_field('post_content', $id), 24);
            }
            $description = wp_trim_words($description, 16, '…');

            $html .= '<a href="' . esc_url($url) . '" class="mega-treat-item" title="' . esc_attr($title) . '">';
            $html .= $thumb;
            $html .= '<span class="mega-treat-info">';
            $html .= '<span class="mega-treat-title">' . esc_html($title) . '</span>';
            $html .= '<span class="mega-treat-desc">' . esc_html($description) . '</span>';
            $html .= '</span>';
            $html .= '</a>';
        }

        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}



function cptui_register_my_cpts_treatments() {

	/**
	 * Post Type: Treatments.
	 */

	$labels = [
		"name" => esc_html__( "Treatments", "hale-dental" ),
		"singular_name" => esc_html__( "Treatment", "hale-dental" ),
	];

	$args = [
		"label" => esc_html__( "Treatments", "hale-dental" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "treatments", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "page-attributes" ],
		"show_in_graphql" => false,
	];

	register_post_type( "treatments", $args );
}

add_action( 'init', 'cptui_register_my_cpts_treatments' );


function cptui_register_my_taxes_treatment_types() {

	/**
	 * Taxonomy: Treatment Types.
	 */

	$labels = [
		"name" => esc_html__( "Treatment Types", "hale-dental" ),
		"singular_name" => esc_html__( "Treatment Type", "hale-dental" ),
	];

	
	$args = [
		"label" => esc_html__( "Treatment Types", "hale-dental" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'treatment_types', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "treatment_types",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "treatment_types", [ "treatments" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_treatment_types' );


/**
 * Parse post content: extract H2s, generate TOC, wrap sections.
 *
 * @return array{toc: string, content: string}
 */
function hale_generate_toc_from_content( $raw_content ) {
    if ( empty( $raw_content ) ) {
        return [ 'toc' => '', 'content' => '' ];
    }

    $doc = new DOMDocument( '1.0', 'UTF-8' );
    $doc->preserveWhiteSpace = true;
    $doc->formatOutput     = false;

    // Suppress warnings from malformed HTML
    libxml_use_internal_errors( true );
    $doc->loadHTML( '<!DOCTYPE html><html><head><meta charset="utf-8"></head><body>' . $raw_content . '</body></html>' );
    libxml_clear_errors();

    $body     = $doc->getElementsByTagName( 'body' )->item( 0 );
    $children = $body->childNodes;

    $toc_items  = [];
    $output_doc = new DOMDocument( '1.0', 'UTF-8' );
    $output_doc->preserveWhiteSpace = true;
    $output_body = $output_doc->createElement( 'body' );

    $current_section = null;
    $current_wrapper = null;
    $h2_count        = 0;

    $slugify = function ( $text ) {
        $text = strtolower( $text );
        $text = preg_replace( '/[^a-z0-9\s-]/', '', $text );
        $text = preg_replace( '/[\s-]+/', '-', $text );
        $text = trim( $text, '-' );
        return $text;
    };

    foreach ( $children as $child ) {
        // Import node into output doc
        $imported = $output_doc->importNode( $child, true );

        // Check if this is an H2
        $is_h2 = false;
        if ( $child->nodeType === XML_ELEMENT_NODE && strtoupper( $child->nodeName ) === 'H2' ) {
            $is_h2 = true;
        }

        if ( $is_h2 ) {
            $h2_count++;
            $heading_text = trim( $child->textContent );
            $slug         = $slugify( $heading_text );
            if ( empty( $slug ) ) {
                $slug = 'section-' . $h2_count;
            }

            // Build TOC item
            $toc_items[] = [
                'slug'  => $slug,
                'text'  => $heading_text,
                'count' => $h2_count,
            ];

            // Close previous section if open
            if ( $current_wrapper ) {
                $output_body->appendChild( $current_wrapper );
            }

            // Start new section
            $current_section = $output_doc->createElement( 'section' );
            $current_section->setAttribute( 'id', $slug );
            $current_section->setAttribute( 'class', 'scroll-mt-28 mt-10' );
            $current_wrapper = $current_section;

            $current_section->appendChild( $imported );
        } elseif ( $current_wrapper ) {
            // Append to current section
            $current_wrapper->appendChild( $imported );
        } else {
            // Before any H2 — append directly to body (intro content)
            $output_body->appendChild( $imported );
        }
    }

    // Close last section
    if ( $current_wrapper ) {
        $output_body->appendChild( $current_wrapper );
    }

    // Build TOC HTML
    $toc_html = '';
    if ( ! empty( $toc_items ) ) {
        $toc_html .= '<h3 class="mb-4 text-[18px] font-semibold text-coff_black">Article Sections</h3>';
        $toc_html .= '<nav class="overflow-y-auto pr-2"><ul class="space-y-0">';

        foreach ( $toc_items as $item ) {
            $is_first   = ( $item['count'] === 1 );
            $link_class = $is_first
                ? 'section-link relative block border-l-2 border-primary px-2.5 py-1.5 text-[14px] leading-[1.4] text-primary'
                : 'section-link relative block border-l-2 border-transparent px-2.5 py-1.5 text-[14px] leading-[1.4] text-coff_black transition hover:text-primary';

            $toc_html .= '<li>';
            $toc_html .= '<a href="#' . esc_attr( $item['slug'] ) . '" class="' . esc_attr( $link_class ) . '">';
            $toc_html .= esc_html( $item['text'] );
            $toc_html .= '</a>';
            $toc_html .= '</li>';
        }

        $toc_html .= '</ul></nav>';
    }

    // Extract inner HTML of body
    $final_content = '';
    foreach ( $output_body->childNodes as $node ) {
        $final_content .= $output_doc->saveHTML( $node );
    }

    return [
        'toc'     => $toc_html,
        'content' => $final_content,
    ];
}


/* ==========================================================================
   SEO FUNCTIONS
   ========================================================================== */

/**
 * Remove noindex/nofollow from WordPress.
 * This overrides the WP Reading Settings "Discourage search engines" option
 * so it never affects the front-end output.
 */
function hale_dental_remove_noindex( $robots ) {
    if ( is_admin() ) {
        return $robots;
    }

    unset( $robots['noindex'] );
    unset( $robots['nofollow'] );

    return $robots;
}
add_filter( 'wp_robots', 'hale_dental_remove_noindex', 999 );

/**
 * Explicit index directive as a safety net so the front-end is always
 * crawlable regardless of any SEO plugin or caching layer state.
 */
function hale_dental_allow_indexing() {
    if ( is_admin() ) {
        return;
    }
    echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />' . "\n";
}
add_action( 'wp_head', 'hale_dental_allow_indexing', 1 );

/**
 * Custom title tag for the homepage.
 */
function hale_dental_home_title( $title ) {
    if ( is_front_page() && is_home() ) {
        $title = 'Ilam Din Dental | Premium Dental Clinic in Istanbul, Turkey';
    }
    return $title;
}
add_filter( 'document_title', 'hale_dental_home_title' );

/**
 * Add meta description to wp_head.
 */
function hale_dental_meta_description() {
    $description = '';

    if ( is_front_page() ) {
        $description = 'Ilam Din Dental — Premium dental clinic in Istanbul, Turkey. Hollywood smile, dental implants, veneers & teeth whitening. Book your free consultation today.';
    } elseif ( is_page() ) {
        $description = wp_trim_words( get_the_excerpt(), 30, '' );
    } elseif ( is_single() ) {
        $description = wp_trim_words( get_the_excerpt(), 30, '' );
    }

    if ( ! empty( $description ) ) {
        echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'hale_dental_meta_description', 2 );

/**
 * Add Open Graph meta tags for social sharing.
 */
function hale_dental_opengraph_tags() {
    $title       = get_the_title() ? get_the_title() : 'Ilam Din Dental';
    $description = '';

    if ( is_front_page() ) {
        $description = 'Ilam Din Dental — Premium dental clinic in Istanbul, Turkey. Hollywood smile, dental implants, veneers & teeth whitening.';
    } elseif ( is_page() || is_single() ) {
        $description = wp_trim_words( get_the_excerpt(), 30, '' );
    }

    if ( empty( $description ) ) {
        $description = 'Premium dental clinic in Istanbul, Turkey. Hollywood smile, dental implants, veneers & teeth whitening.';
    }

    $og_image = get_template_directory_uri() . '/assets/images/logo.png';
    $url      = home_url( $_SERVER['REQUEST_URI'] );

    echo '<meta property="og:type" content="website" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $description ) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $url ) . '" />' . "\n";
    echo '<meta property="og:site_name" content="Ilam Din Dental" />' . "\n";
    echo '<meta property="og:image" content="' . esc_url( $og_image ) . '" />' . "\n";
    echo '<meta property="og:locale" content="en_US" />' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '" />' . "\n";
}
add_action( 'wp_head', 'hale_dental_opengraph_tags', 3 );

/**
 * Add Schema.org LocalBusiness / Dentist structured data.
 */
function hale_dental_schema_markup() {
    if ( ! is_front_page() ) {
        return;
    }

    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Dentist',
        'name'        => 'Ilam Din Dental',
        'description' => 'Premium dental clinic in Istanbul, Turkey offering Hollywood smile, dental implants, veneers, teeth whitening and more.',
        'url'         => home_url( '/' ),
        'logo'        => get_template_directory_uri() . '/assets/images/logo.png',
        'image'       => get_template_directory_uri() . '/assets/images/about.webp',
        'telephone'   => '+90-XXX-XXX-XXXX',
        'address'     => [
            '@type'           => 'PostalAddress',
            'addressLocality' => 'Istanbul',
            'addressCountry'  => 'TR',
        ],
        'geo' => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => '41.0082',
            'longitude' => '28.9784',
        ],
        'openingHoursSpecification' => [
            '@type'       => 'OpeningHoursSpecification',
            'dayOfWeek'   => [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ],
            'opens'       => '09:00',
            'closes'      => '18:00',
        ],
        'priceRange' => '$$',
        'aggregateRating' => [
            '@type'       => 'AggregateRating',
            'ratingValue' => '4.9',
            'reviewCount' => '500',
        ],
    ];

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}
add_action( 'wp_head', 'hale_dental_schema_markup', 5 );