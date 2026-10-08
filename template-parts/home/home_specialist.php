<?php

$consultants = [
    [
        'name' => 'Auto-assign consultant',
        'description' => 'Any available consultant will be assigned',
        'image' => 'review.webp',
    ],
    [
        'name' => 'Dr.Shahad',
        'description' => '',
        'image' => 'review.webp',
    ],
    [
        'name' => 'DrLamis',
        'description' => '',
        'image' => 'review.webp',
    ],
];

$today = new DateTime('today');
$dayNames = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
$monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

$slot_schedule  = hale_booking_get_slot_schedule();
$morningSlots   = $slot_schedule['Morning'];
$afternoonSlots = $slot_schedule['Afternoon'];

$booking_days = 7;

$dates = [];
for ($i = 0; $i < $booking_days; $i++) {
    $date = (clone $today)->modify("+$i days");
    $dates[] = [
        'value'    => $date->format('Y-m-d'),
        'day'      => $date->format('j'),
        'name'     => $dayNames[(int) $date->format('w')],
        'label'    => sprintf('%s %s, %s', $dayNames[(int) $date->format('w')], $date->format('j'), $date->format('Y')),
        'is_today' => $i === 0,
    ];
}

$current_month = sprintf('%s, %s', $monthNames[(int) $today->format('n')], $today->format('Y'));

$timezone_label = 'Africa/Accra - GMT (+00:00)';
$lead_minutes   = 60;
$cutoff         = (clone $today)->modify("+{$lead_minutes} minutes");
$today_value    = $today->format('Y-m-d');

// Slots already taken by another visitor (single query for the whole week).
$booked_by_date = hale_booking_get_taken_slots_for_dates(array_column($dates, 'value'));

$slot_is_open = function ($slot, $date_value) use ($today_value, $cutoff, $booked_by_date) {
    if ($date_value === $today_value && (new DateTime($date_value . ' ' . $slot)) < $cutoff) {
        return false;
    }

    if (in_array($slot, isset($booked_by_date[$date_value]) ? $booked_by_date[$date_value] : [], true)) {
        return false;
    }

    return true;
};

// Server side availability for the day shown first.
$morning_available   = array_values(array_filter($morningSlots, function ($slot) use ($slot_is_open, $today_value) {
    return $slot_is_open($slot, $today_value);
}));
$afternoon_available = array_values(array_filter($afternoonSlots, function ($slot) use ($slot_is_open, $today_value) {
    return $slot_is_open($slot, $today_value);
}));

$default_consultant = 'DrLamis';

?>

<section class="py-16">
    <div class="mx-auto max-w-[1110px] px-7">

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.45fr_1fr]">


            <!-- =========================================================
                 LEFT SIDE
            ========================================================== -->

            <div class="flex flex-col">

                <!-- Hero image -->
                <div class="overflow-hidden rounded-[15px] h-full">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/specialist.jpeg"
                        alt="Dental specialist" class="h-full w-full object-cover">
                </div>


                <!-- Heading -->
                <h2 class="mt-2 text-2xl text-black">
                    Book A 1-to-1 Consultation With a Specialist
                </h2>


                <!-- Description -->
                <p class="mt-7 max-w-[620px] text-base text-black">
                    Speak directly with an expert, discuss your treatment options,
                    and get a clear plan – no obligation.
                </p>


                <!-- CTA -->
                <a href="<?php echo esc_url(home_url('/appointment')); ?>"
                    class="mt-9 inline-flex w-fit items-center gap-3 text-sm  text-secondary underline underline-offset-2 transition hover:text-primary">
                    Choose a time that works for you and take the first step toward
                    your new smile.

                    <svg class="h-[17px] w-[17px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6">
                        <path d="M5 19 19 5" />
                        <path d="M8 5h11v11" />
                    </svg>
                </a>

            </div>


            <!-- =========================================================
                 RIGHT SIDE - BOOKING
            ========================================================== -->

            <div id="booking"
                class="booking-widget relative border-t border-[#e8e8e8] pt-4"
                data-default-consultant="<?= esc_attr($default_consultant) ?>"
                data-today="<?= esc_attr($today->format('Y-m-d')) ?>"
                data-lead-minutes="<?= (int) $lead_minutes ?>">

                <!-- Appointment header -->
                <div class="flex items-center justify-between gap-3 border-b border-[#e8e8e8] pb-4">

                    <div class="flex min-w-0 items-center text-sm">

                        <span class="text-coff_black">
                            Your appointment will be booked with
                        </span>

                        <button id="selectedConsultantText" type="button"
                            class="ml-1 truncate text-secondary hover:underline">
                            <?= esc_html($default_consultant) ?>
                        </button>

                        <button id="changeConsultant" type="button"
                            class="ml-2 shrink-0 text-secondary hover:underline">
                            Change
                        </button>

                    </div>

                    <span id="bookingStepLabel" class="shrink-0 text-[10px] uppercase tracking-[0.08em] text-[#999]">
                        Step 1 of 2
                    </span>

                </div>


                <!-- =====================================================
                     CONSULTANT DROPDOWN
                ====================================================== -->

                <div id="consultantDropdown"
                    class="absolute right-[8px] top-[25px] z-30 hidden w-[258px] bg-white shadow-[0_2px_12px_rgba(0,0,0,0.22)]">

                    <div class="py-2">

                        <?php foreach ($consultants as $index => $consultant): ?>

                            <button type="button"
                                class="consultant-option flex w-full items-center gap-3 px-5 py-3 text-left hover:bg-[#f7f7f7]"
                                data-name="<?= esc_attr($consultant['name']) ?>" data-index="<?= $index ?>">

                                <!-- Avatar -->
                                <div class="h-7 w-7 shrink-0 overflow-hidden rounded-full bg-[#f0dce3]">
                                    <img src="<?= get_template_directory_uri() ?>/assets/images/<?= esc_attr($consultant['image']) ?>"
                                        alt="<?= esc_attr($consultant['name']) ?> - Dental Consultant"
                                        class="h-full w-full object-cover" onerror="this.style.display='none'">
                                </div>

                                <div class="min-w-0 flex-1">

                                    <div class="text-[11px] text-[#222]">
                                        <?= esc_html($consultant['name']) ?>
                                    </div>

                                    <?php if ($consultant['description']): ?>
                                        <div class="mt-1 text-[9px] text-[#777]">
                                            <?= esc_html($consultant['description']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <span class="consultant-check hidden text-[19px] text-[#5bd7c5]">
                                    ✓
                                </span>

                            </button>

                        <?php endforeach; ?>

                    </div>

                </div>


                <!-- =====================================================
                     STEP 1 - PICK A DATE AND TIME
                ====================================================== -->

                <div id="bookingStepOne">

                    <!-- Timezone -->
                    <div class="mt-[18px]">

                        <div
                            class="flex h-[32px] w-full items-center justify-between rounded-[2px] border border-[#ddd] bg-[#fafafa] px-2 text-[10px] text-[#222]">
                            <span>
                                <?= esc_html($timezone_label) ?>
                            </span>

                            <svg class="h-3 w-3 text-[#aaa]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path d="m6 9 6 6 6-6" />
                            </svg>

                        </div>

                    </div>


                    <!-- Month -->
                    <div class="mt-4 flex items-center justify-center">

                        <div class="flex items-center gap-1 text-[12px] text-black">
                            <?= esc_html($current_month) ?>
                        </div>

                    </div>


                    <!-- Dates -->
                    <div class="mt-4 flex items-center gap-[5px]">

                        <?php foreach ($dates as $date): ?>

                            <button type="button" data-date="<?= esc_attr($date['value']) ?>"
                                data-label="<?= esc_attr($date['label']) ?>" aria-pressed="false"
                                class="date-button group flex h-[45px] flex-1 flex-col items-center justify-center rounded-[5px] border border-[#f0f0f0] bg-white shadow-[0_1px_5px_rgba(0,0,0,0.05)] transition hover:border-secondary
                                <?= $date['is_today'] ? 'active-date !border-secondary !bg-secondary' : '' ?>">

                                <span
                                    class="date-number text-[12px] leading-4 <?= $date['is_today'] ? 'text-white' : 'text-[#999]' ?>">
                                    <?= esc_html($date['day']) ?>
                                </span>

                                <span
                                    class="date-name text-[8px] leading-3 <?= $date['is_today'] ? 'text-white' : 'text-[#aaa]' ?>">
                                    <?= esc_html($date['name']) ?>
                                </span>

                            </button>

                        <?php endforeach; ?>

                    </div>


                    <!-- =====================================================
                         TIME SLOTS
                    ====================================================== -->

                    <div id="slotsContainer" class="pb-1">

                        <!-- Morning -->
                        <div id="morningGroup" class="mt-9 <?= empty($morning_available) ? 'hidden' : '' ?>">

                            <div class="relative mb-5 flex items-center">

                                <div class="h-px flex-1 bg-[#e6e6e6]"></div>

                                <span class="bg-white px-3 text-[10px] text-[#777]">
                                    Morning
                                </span>

                                <div class="h-px flex-1 bg-[#e6e6e6]"></div>

                            </div>


                            <div class="grid grid-cols-5 gap-x-[7px] gap-y-[6px]">

                                <?php foreach ($morningSlots as $slot): ?>

                                    <?php
                                    $slot_open = in_array($slot, $morning_available, true);
                                    $slot_booked = !$slot_open && in_array($slot, isset($booked_by_date[$today_value]) ? $booked_by_date[$today_value] : [], true);
                                    ?>

                                    <button type="button" <?= $slot_open ? '' : 'disabled' ?>
                                        <?= $slot_booked ? 'title="Already booked"' : '' ?>
                                        <?= $slot_booked ? 'data-booked="1"' : '' ?>
                                        class="time-slot h-[28px] rounded-[3px] border text-[9px] transition
                                        <?= $slot_open ? 'border-secondary bg-white text-secondary hover:bg-secondary hover:text-white' : 'cursor-not-allowed border-[#e6e6e6] bg-white text-[#c4c4c4] line-through' ?>"
                                        data-time="<?= esc_attr($slot) ?>">
                                        <?= esc_html($slot) ?>
                                    </button>

                                <?php endforeach; ?>

                            </div>

                        </div>


                        <!-- Afternoon -->
                        <div id="afternoonGroup" class="mt-8 <?= empty($afternoon_available) ? 'hidden' : '' ?>">

                            <div class="relative mb-5 flex items-center">

                                <div class="h-px flex-1 bg-[#e6e6e6]"></div>

                                <span class="bg-white px-3 text-[10px] text-[#777]">
                                    Afternoon
                                </span>

                                <div class="h-px flex-1 bg-[#e6e6e6]"></div>

                            </div>

                            <div class="grid grid-cols-5 gap-x-[7px]">

                                <?php foreach ($afternoonSlots as $slot): ?>

                                    <?php
                                    $slot_open = in_array($slot, $afternoon_available, true);
                                    $slot_booked = !$slot_open && in_array($slot, isset($booked_by_date[$today_value]) ? $booked_by_date[$today_value] : [], true);
                                    ?>

                                    <button type="button" <?= $slot_open ? '' : 'disabled' ?>
                                        <?= $slot_booked ? 'title="Already booked"' : '' ?>
                                        <?= $slot_booked ? 'data-booked="1"' : '' ?>
                                        class="time-slot h-[28px] rounded-[3px] border text-[9px] transition
                                        <?= $slot_open ? 'border-secondary bg-white text-secondary hover:bg-secondary hover:text-white' : 'cursor-not-allowed border-[#e6e6e6] bg-white text-[#c4c4c4] line-through' ?>"
                                        data-time="<?= esc_attr($slot) ?>">
                                        <?= esc_html($slot) ?>
                                    </button>

                                <?php endforeach; ?>

                            </div>

                        </div>

                    </div>


                    <!-- No slots -->
                    <div id="noSlots"
                        class="mt-6 hidden min-h-[160px] flex-col items-center justify-center gap-1 bg-[#f3f3f3] py-10 text-center">
                        <span class="text-[12px] text-[#4f4f4f]">
                            No slots available for this day
                        </span>
                        <span class="text-[10px] text-[#8a8a8a]">
                            Please pick another date.
                        </span>
                    </div>


                    <!-- Step 1 feedback (e.g. slot taken while the form was open) -->
                    <p id="bookingStepOneMsg" class="mt-3 hidden text-[11px] text-red-500"></p>

                    <!-- Continue (enabled once a time is chosen) -->
                    <button id="bookingContinue" type="button" disabled
                        class="mt-6 h-[44px] w-full rounded-[3px] bg-secondary text-[12px] text-white opacity-40 transition">
                        Continue
                    </button>

                </div>


                <!-- =====================================================
                     STEP 2 - YOUR DETAILS
                ====================================================== -->

                <div id="bookingStepTwo" class="hidden">

                    <!-- Summary -->
                    <div class="mt-5 border border-[#eee] bg-[#fafafa] px-4 py-3">

                        <div class="flex items-start justify-between gap-3">

                            <div class="min-w-0">

                                <div class="text-[9px] uppercase tracking-[0.08em] text-[#999]">
                                    Your appointment
                                </div>

                                <div id="bookingSummary" class="mt-1 text-[12px] text-black">
                                    --
                                </div>

                                <div id="bookingSummaryConsultant" class="mt-0.5 text-[10px] text-[#777]">
                                    --
                                </div>

                            </div>

                            <button id="bookingEdit" type="button"
                                class="shrink-0 text-[10px] text-secondary underline underline-offset-2 hover:text-black">
                                Change
                            </button>

                        </div>

                    </div>


                    <form id="bookingForm" class="mt-5" novalidate>

                        <p class="mb-4 text-[11px] text-[#555]">
                            Almost done – tell us how to reach you.
                        </p>

                        <div class="space-y-3">

                            <div>
                                <label for="bookingName" class="mb-1 block text-[10px] text-[#555]">Full name *</label>
                                <input id="bookingName" name="fullname" type="text" required autocomplete="name"
                                    class="h-[38px] w-full rounded-[3px] border border-[#ddd] bg-white px-3 text-[12px] text-black outline-none transition focus:border-secondary">
                                <span class="booking-error hidden text-[10px] text-red-500">Please enter your name.</span>
                            </div>

                            <div>
                                <label for="bookingEmail" class="mb-1 block text-[10px] text-[#555]">Email *</label>
                                <input id="bookingEmail" name="email" type="email" required autocomplete="email"
                                    class="h-[38px] w-full rounded-[3px] border border-[#ddd] bg-white px-3 text-[12px] text-black outline-none transition focus:border-secondary">
                                <span class="booking-error hidden text-[10px] text-red-500">Please enter a valid email.</span>
                            </div>

                            <div>
                                <label for="bookingPhone" class="mb-1 block text-[10px] text-[#555]">Phone / WhatsApp *</label>
                                <input id="bookingPhone" name="phone" type="tel" required autocomplete="tel"
                                    class="h-[38px] w-full rounded-[3px] border border-[#ddd] bg-white px-3 text-[12px] text-black outline-none transition focus:border-secondary">
                                <span class="booking-error hidden text-[10px] text-red-500">Please enter your phone number.</span>
                            </div>

                            <div>
                                <label for="bookingMessage" class="mb-1 block text-[10px] text-[#555]">Short message</label>
                                <textarea id="bookingMessage" name="message" rows="3" maxlength="1000"
                                    placeholder="Anything we should know before your consultation?"
                                    class="w-full resize-none rounded-[3px] border border-[#ddd] bg-white px-3 py-2 text-[12px] text-black outline-none transition focus:border-secondary"></textarea>
                            </div>

                        </div>

                        <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

                        <button id="bookingSubmit" type="submit"
                            class="mt-5 h-[44px] w-full rounded-[3px] bg-secondary text-[12px] text-white transition hover:bg-black">
                            Confirm booking
                        </button>

                        <p id="bookingFormMsg" class="mt-3 hidden text-[11px]"></p>

                        <p class="mt-3 text-[9px] leading-4 text-[#8a8a8a]">
                            We will confirm your appointment by phone or email. No payment is required now.
                        </p>

                    </form>

                </div>


                <!-- =====================================================
                     SUCCESS
                ====================================================== -->

                <div id="bookingSuccess" class="hidden py-10 text-center">

                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#e8f7f4]">
                        <svg class="h-6 w-6 text-[#5bd7c5]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="m4 12 5 5L20 6" />
                        </svg>
                    </div>

                    <h3 class="mt-4 text-[15px] text-black">
                        Request received
                    </h3>

                    <p id="bookingSuccessMsg" class="mx-auto mt-2 max-w-[300px] text-[11px] leading-5 text-[#666]">
                        Thank you – our team will confirm your appointment shortly.
                    </p>

                    <button id="bookingRestart" type="button"
                        class="mt-5 text-[11px] text-secondary underline underline-offset-2 hover:text-black">
                        Book another appointment
                    </button>

                </div>

            </div>

        </div>

    </div>
</section>

