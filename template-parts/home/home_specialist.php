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

$dates = [
    ['day' => '7',  'name' => 'MON', 'available' => true],
    ['day' => '8',  'name' => 'TUE', 'available' => true],
    ['day' => '9',  'name' => 'WED', 'available' => true],
    ['day' => '10', 'name' => 'THU', 'available' => true],
    ['day' => '11', 'name' => 'FRI', 'available' => true],
    ['day' => '12', 'name' => 'SAT', 'available' => true],
    ['day' => '13', 'name' => 'SUN', 'available' => true],
];

$morningSlots = [
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
];

$afternoonSlots = [
    '12:00',
    '12:15',
    '12:30',
    '12:45',
    '13:15',
];

?>

<section class="min-h-screen bg-white py-6">
    <div class="mx-auto max-w-[1110px] px-7">

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.45fr_1fr]">


            <!-- =========================================================
                 LEFT SIDE
            ========================================================== -->

            <div class="flex flex-col justify-center pt-16 lg:pt-20">

                <!-- Hero image -->
                <div class="overflow-hidden rounded-[15px]">
                    <img
                        src="<?= get_template_directory_uri() ?>/assets/images/consultation.webp"
                        alt="Dental consultation"
                        class="h-[231px] w-full object-cover"
                    >
                </div>


                <!-- Heading -->
                <h1
                    class="mt-2 text-[29px] font-bold leading-[1.15] tracking-[-1.5px] text-black"
                >
                    Book A 1-to-1 Consultation With a Specialist
                </h1>


                <!-- Description -->
                <p
                    class="mt-7 max-w-[620px] text-[15px]   leading-[21px] text-black"
                >
                    Speak directly with an expert, discuss your treatment options,
                    and get a clear plan – no obligation.
                </p>


                <!-- CTA -->
                <a
                    href="#booking"
                    class="mt-9 inline-flex w-fit items-center gap-3 text-[14px] font-medium text-[#4380ff] underline underline-offset-2 transition hover:text-[#2165ed]"
                >
                    Choose a time that works for you and take the first step toward
                    your new smile.

                    <svg
                        class="h-[17px] w-[17px]"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.6"
                    >
                        <path d="M5 19 19 5"/>
                        <path d="M8 5h11v11"/>
                    </svg>
                </a>

            </div>


            <!-- =========================================================
                 RIGHT SIDE - BOOKING
            ========================================================== -->

            <div
                id="booking"
                class="relative min-h-[575px] border-t border-[#e8e8e8] pt-4"
            >

                <!-- Appointment header -->
                <div class="border-b border-[#e8e8e8] pb-4">

                    <div class="flex items-center text-[10px]">

                        <span class="font-medium text-[#111]">
                            Your appointment will be booked with
                        </span>

                        <button
                            id="selectedConsultantText"
                            type="button"
                            class="ml-1 text-[#5d65a7] hover:underline"
                        >
                            DrLamis
                        </button>

                        <button
                            id="changeConsultant"
                            type="button"
                            class="ml-2 text-[#5265bd] hover:underline"
                        >
                            Change
                        </button>

                    </div>

                </div>


                <!-- =====================================================
                     CONSULTANT DROPDOWN
                ====================================================== -->

                <div
                    id="consultantDropdown"
                    class="absolute right-[8px] top-[25px] z-30 hidden w-[258px] bg-white shadow-[0_2px_12px_rgba(0,0,0,0.22)]"
                >

                    <div class="py-2">

                        <?php foreach ($consultants as $index => $consultant): ?>

                            <button
                                type="button"
                                class="consultant-option flex w-full items-center gap-3 px-5 py-3 text-left hover:bg-[#f7f7f7]"
                                data-name="<?= htmlspecialchars($consultant['name']) ?>"
                                data-index="<?= $index ?>"
                            >

                                <!-- Avatar -->
                                <div class="h-7 w-7 shrink-0 overflow-hidden rounded-full bg-[#f0dce3]">
                                    <img
                                        src="<?= get_template_directory_uri() ?>/assets/images/<?= $consultant['image'] ?>"
                                        alt=""
                                        class="h-full w-full object-cover"
                                        onerror="this.style.display='none'"
                                    >
                                </div>

                                <div class="min-w-0 flex-1">

                                    <div class="text-[11px] font-medium text-[#222]">
                                        <?= htmlspecialchars($consultant['name']) ?>
                                    </div>

                                    <?php if ($consultant['description']): ?>
                                        <div class="mt-1 text-[9px] text-[#777]">
                                            <?= htmlspecialchars($consultant['description']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <span
                                    class="consultant-check hidden text-[19px] text-[#5bd7c5]"
                                >
                                    ✓
                                </span>

                            </button>

                        <?php endforeach; ?>

                    </div>

                </div>


                <!-- Timezone -->
                <div class="mt-[18px]">

                    <button
                        type="button"
                        class="flex h-[32px] w-full items-center justify-between rounded-[2px] border border-[#ddd] bg-white px-2 text-[10px] text-[#222]"
                    >
                        <span>
                            Africa/Accra - GMT (+00:00)
                        </span>

                        <svg
                            class="h-3 w-3 text-[#999]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path d="m6 9 6 6 6-6"/>
                        </svg>

                    </button>

                </div>


                <!-- Month -->
                <div class="mt-4 flex items-center justify-center">

                    <button
                        type="button"
                        class="absolute left-0 mt-1 text-[18px] text-[#bbb] hover:text-black"
                    >
                        ‹
                    </button>

                    <button
                        type="button"
                        class="flex items-center gap-1 text-[12px] font-medium text-black"
                    >
                        September, 2026

                        <svg
                            class="h-3 w-3"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path d="m7 10 5 5 5-5H7Z"/>
                        </svg>
                    </button>

                    <button
                        type="button"
                        class="absolute right-0 mt-1 text-[18px] text-[#111]"
                    >
                        ›
                    </button>

                </div>


                <!-- Dates -->
                <div class="mt-4 flex items-center gap-[5px]">

                    <?php foreach ($dates as $index => $date): ?>

                        <button
                            type="button"
                            data-date="<?= $date['day'] ?>"
                            class="date-button group flex h-[45px] flex-1 flex-col items-center justify-center rounded-[5px] border border-[#f0f0f0] bg-white shadow-[0_1px_5px_rgba(0,0,0,0.05)] transition
                            <?= $index === 4 ? 'active-date !border-[#574e8c] !bg-[#574e8c] !text-white' : '' ?>"
                        >

                            <span
                                class="date-number text-[12px] leading-4
                                <?= $index === 2 ? 'text-[#ff3c66]' : 'text-[#999]' ?>"
                            >
                                <?= $date['day'] ?>
                            </span>

                            <span
                                class="date-name text-[8px] leading-3
                                <?= $index === 4 ? 'text-white' : 'text-[#aaa]' ?>"
                            >
                                <?= $date['name'] ?>
                            </span>

                        </button>

                    <?php endforeach; ?>

                </div>


                <!-- =====================================================
                     TIME SLOTS
                ====================================================== -->

                <div id="slotsContainer">

                    <!-- Morning -->
                    <div class="mt-9">

                        <div class="relative mb-5 flex items-center">

                            <div class="h-px flex-1 bg-[#e6e6e6]"></div>

                            <span class="bg-white px-3 text-[10px] text-[#777]">
                                Morning
                            </span>

                            <div class="h-px flex-1 bg-[#e6e6e6]"></div>

                        </div>


                        <div class="grid grid-cols-5 gap-x-[7px] gap-y-[6px]">

                            <?php foreach ($morningSlots as $slot): ?>

                                <button
                                    type="button"
                                    class="time-slot h-[28px] rounded-[3px] border border-[#4c4290] bg-white text-[9px] text-[#423b85] transition hover:bg-[#4c4290] hover:text-white"
                                    data-time="<?= $slot ?>"
                                >
                                    <?= $slot ?>
                                </button>

                            <?php endforeach; ?>

                        </div>

                    </div>


                    <!-- Afternoon -->
                    <div class="mt-8">

                        <div class="relative mb-5 flex items-center">

                            <div class="h-px flex-1 bg-[#e6e6e6]"></div>

                            <span class="bg-white px-3 text-[10px] text-[#777]">
                                Afternoon
                            </span>

                            <div class="h-px flex-1 bg-[#e6e6e6]"></div>

                        </div>


                        <div class="grid grid-cols-5 gap-x-[7px]">

                            <?php foreach ($afternoonSlots as $slot): ?>

                                <button
                                    type="button"
                                    class="time-slot h-[28px] rounded-[3px] border border-[#4c4290] bg-white text-[9px] text-[#423b85] transition hover:bg-[#4c4290] hover:text-white"
                                    data-time="<?= $slot ?>"
                                >
                                    <?= $slot ?>
                                </button>

                            <?php endforeach; ?>

                        </div>

                    </div>

                </div>


                <!-- No slots -->
                <div
                    id="noSlots"
                    class="absolute inset-0 hidden items-center justify-center bg-[#f3f3f3]"
                >
                    <span class="mt-10 text-[12px] text-[#4f4f4f]">
                        No slots available
                    </span>
                </div>

            </div>

        </div>

    </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const dropdown = document.getElementById('consultantDropdown');
    const changeButton = document.getElementById('changeConsultant');
    const consultantText = document.getElementById('selectedConsultantText');

    const options = document.querySelectorAll('.consultant-option');
    const checks = document.querySelectorAll('.consultant-check');

    const dateButtons = document.querySelectorAll('.date-button');
    const slotsContainer = document.getElementById('slotsContainer');
    const noSlots = document.getElementById('noSlots');

    let selectedConsultant = 'DrLamis';
    let selectedDate = '11';
    let selectedTime = null;


    /*
    |--------------------------------------------------------------------------
    | Consultant dropdown
    |--------------------------------------------------------------------------
    */

    function openDropdown() {
        dropdown.classList.remove('hidden');
    }

    function closeDropdown() {
        dropdown.classList.add('hidden');
    }

    changeButton.addEventListener('click', function (e) {

        e.stopPropagation();

        if (dropdown.classList.contains('hidden')) {
            openDropdown();
        } else {
            closeDropdown();
        }

    });


    consultantText.addEventListener('click', function (e) {

        e.stopPropagation();

        openDropdown();

    });


    /*
    |--------------------------------------------------------------------------
    | Select consultant
    |--------------------------------------------------------------------------
    */

    options.forEach(option => {

        option.addEventListener('click', function () {

            selectedConsultant = this.dataset.name;

            consultantText.textContent = selectedConsultant;

            // Remove all checks
            checks.forEach(check => {
                check.classList.add('hidden');
            });

            // Show selected check
            const selectedCheck = this.querySelector('.consultant-check');

            if (selectedCheck) {
                selectedCheck.classList.remove('hidden');
            }

            closeDropdown();

            showSlots();

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Date selection
    |--------------------------------------------------------------------------
    */

    dateButtons.forEach(button => {

        button.addEventListener('click', function () {

            dateButtons.forEach(date => {

                date.classList.remove(
                    'active-date',
                    '!border-[#574e8c]',
                    '!bg-[#574e8c]',
                    '!text-white'
                );

                date.classList.add('bg-white');

                const number = date.querySelector('.date-number');
                const name = date.querySelector('.date-name');

                number.classList.remove('text-white', 'text-[#ff3c66]');
                name.classList.remove('text-white');

                number.classList.add('text-[#999]');
                name.classList.add('text-[#aaa]');

            });


            // Activate clicked date
            this.classList.remove('bg-white');

            this.classList.add(
                'active-date',
                '!border-[#574e8c]',
                '!bg-[#574e8c]'
            );

            const number = this.querySelector('.date-number');
            const name = this.querySelector('.date-name');

            number.classList.remove('text-[#999]');
            name.classList.remove('text-[#aaa]');

            number.classList.add('text-white');
            name.classList.add('text-white');

            selectedDate = this.dataset.date;

            showSlots();

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Time selection
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.time-slot').forEach(slot => {

        slot.addEventListener('click', function () {

            document.querySelectorAll('.time-slot').forEach(item => {

                item.classList.remove(
                    'bg-[#4c4290]',
                    'text-white'
                );

                item.classList.add('bg-white');

            });

            this.classList.remove('bg-white');

            this.classList.add(
                'bg-[#4c4290]',
                'text-white'
            );

            selectedTime = this.dataset.time;

            console.log({
                consultant: selectedConsultant,
                date: selectedDate,
                time: selectedTime
            });

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Availability states
    |--------------------------------------------------------------------------
    */

    function showSlots() {

        slotsContainer.classList.remove('hidden');

        noSlots.classList.remove('flex');
        noSlots.classList.add('hidden');

    }


    function showNoSlots() {

        slotsContainer.classList.add('hidden');

        noSlots.classList.remove('hidden');
        noSlots.classList.add('flex');

    }


    /*
    |--------------------------------------------------------------------------
    | Close dropdown when clicking outside
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function (event) {

        if (
            !dropdown.contains(event.target) &&
            event.target !== changeButton &&
            event.target !== consultantText
        ) {
            closeDropdown();
        }

    });


    /*
    |--------------------------------------------------------------------------
    | Default selected consultant
    |--------------------------------------------------------------------------
    */

    options.forEach(option => {

        if (option.dataset.name === 'DrLamis') {

            const check = option.querySelector('.consultant-check');

            if (check) {
                check.classList.remove('hidden');
            }

        }

    });

});
</script>
