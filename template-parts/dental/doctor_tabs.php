<?php
$doctors = [
    [
        'name' => 'Dt. Ömer Reşat Gültek',
        'short_name' => 'DT. GÜLTEK',
        'specialty' => 'IMPLANT DENTISTRY',
        'image' => get_template_directory_uri() . '/assets/images/doctors/1.webp',
        'bio' => 'Born in Bandırma in 1995, Dr Ömer Reşat Gültek studied at İnegöl Mediha Hayri Çelik Science High School before turning to dentistry — and he still thinks like a materials scientist. Which ceramic, which technique, which protocol for this particular tooth; those are the questions he takes seriously, and they are why his root canal treatments hold. What patients mention, though, is the manner. He explains as he works, he does not rush, and a single filling gets the same attention as a full arch.',
        'experience' => '5+',
        'treatments' => '1,000+',
        'certificates' => [
            '2022 TDB ACADEMY — Bruxism and its Treatment',
            '2022 TDB ACADEMY — Treatment of Teeth',
        ],
    ],

    [
        'name' => 'Dt. Özaydın',
        'short_name' => 'DT. ÖZAYDIN',
        'specialty' => 'DENTISTRY',
        'image' => get_template_directory_uri() . '/assets/images/doctors/2.webp',
        'bio' => 'With a patient-focused approach and years of experience, Dt. Özaydın provides carefully planned dental treatments with attention to detail and long-term results.',
        'experience' => '8+',
        'treatments' => '2,000+',
        'certificates' => [
            '2022 TDB ACADEMY — Advanced Dentistry',
            '2023 Dental Excellence Certificate',
        ],
    ],

    [
        'name' => 'Dt. Karakaya',
        'short_name' => 'DT. KARAKAYA',
        'specialty' => 'AESTHETIC DENTISTRY',
        'image' => get_template_directory_uri() . '/assets/images/doctors/3.webp',
        'bio' => 'Focused on aesthetic dentistry and natural-looking results, Dt. Karakaya combines modern techniques with a personalized treatment approach.',
        'experience' => '7+',
        'treatments' => '1,500+',
        'certificates' => [
            'Aesthetic Dentistry Certificate',
            'Advanced Smile Design',
        ],
    ],
];
?>

<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6">
        <div
            class="mb-6 flex items-center justify-center gap-[clamp(12px,1.4vw,20px)] text-[clamp(0.72rem,0.82vw,0.84rem)] font-semibold uppercase tracking-[0.22em] text-coff_black md:mb-8">
            <span aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span>Meet the Implant
            Dentists Who Will Treat You<span aria-hidden="true"
                class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span></div>
        <!-- =========================
             DOCTOR TABS
        ========================== -->
        <div class="relative mb-10">
            <div id="doctor-tabs"
                class="flex items-start justify-center gap-5 sm:gap-7 lg:gap-8 pb-4">

                <?php foreach ($doctors as $index => $doctor): ?>

                    <button type="button" class="doctor-tab group shrink-0 flex flex-col items-center w-[82px] sm:w-[90px]"
                        data-doctor="<?php echo esc_attr($index); ?>">

                        <!-- Doctor Circle -->
                        <div class="
                                doctor-tab-image
                                relative
                                w-[68px] h-[68px]
                                sm:w-[76px] sm:h-[76px]
                                rounded-full
                                overflow-hidden
                                bg-[#f1eeee]
                                border-2
                                border-transparent
                                transition-all
                                duration-300
                                group-hover:border-[var(--coffGreen)]
                                group-hover:scale-[1.03]
                            ">

                            <img src="<?php echo esc_url($doctor['image']); ?>"
                                alt="<?php echo esc_attr($doctor['name']); ?>"
                                class="absolute inset-0 w-full h-full object-cover object-top">

                        </div>

                        <!-- Doctor Name -->
                        <span class="
                                mt-2
                                text-[9px]
                                sm:text-[10px]
                                leading-[12px]
                                tracking-[0.04em]
                                text-center
                                uppercase
                                text-[var(--secondary)]
                                min-h-[24px]
                            ">
                            <?php echo esc_html($doctor['short_name']); ?>
                        </span>

                    </button>

                <?php endforeach; ?>

            </div>

        </div>


        <!-- =========================
             DOCTOR CONTENT
        ========================== -->
        <div class="
                doctor-content-wrapper
                relative
                overflow-hidden
                rounded-[24px]
                border
                border-coff_black/10
                bg-white
                shadow-[0_4px_20px_rgba(0,0,0,0.03)]
            ">

            <?php foreach ($doctors as $index => $doctor): ?>

                <div class="
                        doctor-content
                        <?php echo $index === 0 ? 'block' : 'hidden'; ?>
                    " data-content="<?php echo esc_attr($index); ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-[373px_1fr]">

                        <!-- =====================
                             IMAGE
                        ====================== -->
                        <div class="
                                relative
                                min-h-[420px]
                                lg:min-h-[560px]
                                bg-[#f4f6f8]
                                overflow-hidden
                            ">

                            <img src="<?php echo esc_url($doctor['image']); ?>"
                                alt="<?php echo esc_attr($doctor['name']); ?>" class="
                                    absolute
                                    inset-0
                                    w-full
                                    h-full
                                    object-contain
                                    object-bottom
                                ">

                        </div>


                        <!-- =====================
                             INFORMATION
                        ====================== -->
                        <div class="px-6 py-8 sm:px-8 lg:px-10 lg:py-9">

                            <!-- Name -->
                            <h2 class="
                                    font-serif
                                    text-[30px]
                                    sm:text-[34px]
                                    lg:text-[30px]
                                    xl:text-[32px]
                                    leading-tight
                                    text-[var(--primary)]
                                    font-normal
                                ">
                                <?php echo esc_html($doctor['name']); ?>
                            </h2>


                            <!-- Specialty -->
                            <div class="
                                    mt-3
                                    text-[13px]
                                    font-medium
                                    tracking-[0.14em]
                                    text-coffGreen
                                ">
                                <?php echo esc_html($doctor['specialty']); ?>
                            </div>


                            <!-- Bio -->
                            <p class="
                                    mt-6
                                    max-w-[700px]
                                    text-[15px]
                                    sm:text-[16px]
                                    leading-[1.65]
                                    text-[var(--secondaryLight)]
                                ">
                                <?php echo esc_html($doctor['bio']); ?>
                            </p>


                            <!-- Bottom Information -->
                            <div class="
                                    mt-10
                                    grid
                                    grid-cols-1
                                    md:grid-cols-[1fr_220px]
                                    gap-8
                                ">

                                <!-- Stats -->
                                <div class="
                                        grid
                                        grid-cols-2
                                        gap-6
                                        border-t
                                        border-coff_black/10
                                        pt-5
                                    ">

                                    <!-- Experience -->
                                    <div>
                                        <div class="
                                                font-serif
                                                text-[28px]
                                                sm:text-[30px]
                                                leading-none
                                                text-[var(--primary)]
                                            ">
                                            <?php echo esc_html($doctor['experience']); ?>
                                        </div>

                                        <div class="
                                                mt-3
                                                text-[10px]
                                                tracking-[0.12em]
                                                font-medium
                                                uppercase
                                                text-[var(--coffBlack)]
                                            ">
                                            Years Experience
                                        </div>
                                    </div>


                                    <!-- Treatments -->
                                    <div>
                                        <div class="
                                                font-serif
                                                text-[28px]
                                                sm:text-[30px]
                                                leading-none
                                                text-[var(--primary)]
                                            ">
                                            <?php echo esc_html($doctor['treatments']); ?>
                                        </div>

                                        <div class="
                                                mt-3
                                                text-[10px]
                                                tracking-[0.12em]
                                                font-medium
                                                uppercase
                                                text-[var(--coffBlack)]
                                            ">
                                            Treatments
                                        </div>
                                    </div>

                                </div>


                                <!-- Certificates -->
                                <div class="
                                        border-l
                                        border-coff_black/10
                                        pl-6
                                    ">

                                    <h3 class="
                                            font-serif
                                            text-[16px]
                                            text-[var(--primary)]
                                            mb-4
                                        ">
                                        Certificates
                                    </h3>

                                    <ul class="space-y-3">

                                        <?php foreach ($doctor['certificates'] as $certificate): ?>

                                            <li class="
                                                    relative
                                                    pl-4
                                                    text-[13px]
                                                    leading-[1.5]
                                                    text-[var(--secondaryLight)]
                                                ">

                                                <span class="
                                                        absolute
                                                        left-0
                                                        top-[7px]
                                                        w-[5px]
                                                        h-[5px]
                                                        rounded-full
                                                        bg-coffGreen
                                                    ">
                                                </span>

                                                <?php echo esc_html($certificate); ?>

                                            </li>

                                        <?php endforeach; ?>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<!-- =========================
     TABS JAVASCRIPT
========================== -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const tabs = document.querySelectorAll('.doctor-tab');
        const contents = document.querySelectorAll('.doctor-content');

        function activateDoctor(index) {

            tabs.forEach((tab, tabIndex) => {

                const image = tab.querySelector('.doctor-tab-image');

                if (tabIndex === index) {

                    image.classList.remove('border-transparent');
                    image.classList.add(
                        'border-[var(--coffGreen)]',
                        'scale-[1.03]'
                    );

                } else {

                    image.classList.remove(
                        'border-[var(--coffGreen)]',
                        'scale-[1.03]'
                    );

                    image.classList.add('border-transparent');
                }
            });


            contents.forEach((content, contentIndex) => {

                if (contentIndex === index) {
                    content.classList.remove('hidden');
                    content.classList.add('block');
                } else {
                    content.classList.remove('block');
                    content.classList.add('hidden');
                }

            });
        }


        tabs.forEach((tab, index) => {

            tab.addEventListener('click', function () {
                activateDoctor(index);
            });

        });


        // First doctor active
        activateDoctor(0);

    });
</script>


<style>
    /* Hide scrollbar while keeping horizontal scrolling */
    /* .scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
} */
</style>