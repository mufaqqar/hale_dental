<?php
$theme_uri = get_template_directory_uri();
$treatments_archive = get_post_type_archive_link('treatments');

$stats = [
    [
        'value' => '100,000+',
        'label' => 'Happy Patients',
        'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M22 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" />',
    ],
    [
        'value' => '80+',
        'label' => 'Countries Served',
        'icon' => '<circle cx="12" cy="12" r="9" /><path d="M3 12h18" /><path d="M12 3a14 14 0 0 1 0 18" /><path d="M12 3a14 14 0 0 0 0 18" />',
    ],
    [
        'value' => '15 Years',
        'label' => 'Written Guarantee',
        'icon' => '<circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 2" />',
    ],
    [
        'value' => '4.6',
        'label' => 'Google Rating',
        'icon' => '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-2.9-5.6 2.9 1.1-6.2L3 9.6l6.2-.9L12 3Z" />',
    ],
];
?>

<section
    class="relative flex min-h-[calc(100svh-36px)] flex-col overflow-hidden bg-secondary pt-[90px] text-white md:pt-32">

    <!-- =========================
         BACKGROUND IMAGE
    ========================== -->
    <div class="absolute inset-0">

        <img src="<?php echo esc_url($theme_uri . '/assets/images/heroimage.png'); ?>" alt="" class="
                absolute
                inset-0
                w-full
                h-full
                object-cover
                object-center
            ">

        <!-- Dark teal overlay -->
        <div class="
                absolute
                inset-0
                bg-secondary
                opacity-[0.78]
            "></div>

        <!-- Left-to-right gradient -->
        <div class="
                absolute
                inset-0
                bg-gradient-to-r
                from-[var(--primary)]/95
                via-[var(--secondary)]/80
                to-transparent
            "></div>

        <!-- Bottom fade -->
        <div class="absolute inset-x-0 bottom-0 h-20 bg-[linear-gradient(180deg,transparent_0%,rgba(255,255,255,0.18)_45%,rgba(255,255,255,0.4)_72%,rgba(255,255,255,0.7)_93%,#ffffff_100%)]"></div>

    </div>


    <!-- =========================
         CONTENT
    ========================== -->
    <div class="
            relative
            z-10
            w-full
            max-w-[1200px]
            mx-auto
            px-5
            sm:px-8
            lg:px-10
            py-12
            lg:py-14
        ">

        <div class="
                grid
                grid-cols-1
                lg:grid-cols-[minmax(0,1fr)_480px]
                gap-10
                lg:gap-12
                items-center
            ">

            <!-- =========================
                 LEFT CONTENT
            ========================== -->
            <div class="text-white">

                <!-- Breadcrumb -->
                <div class="
                        flex
                        flex-wrap
                        items-center
                        gap-x-2
                        gap-y-1
                        mb-8
                        text-[11px]
                        sm:text-[12px]
                        text-white/65
                    ">

                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors">
                        Home
                    </a>

                    <span class="text-white/30">/</span>

                    <a href="<?php echo esc_url($treatments_archive); ?>" class="hover:text-white transition-colors">
                        Dental Treatments
                    </a>

                    <span class="text-white/30">/</span>

                    <span class="text-white/80">Dental Implants</span>

                    <span class="text-white/30">/</span>

                    <span class="text-white">
                        Single Dental Implant
                    </span>

                </div>


                <!-- Badge -->
                <div class="
                        inline-flex
                        items-center
                        rounded-full
                        border
                        border-white/50
                        px-4
                        py-2
                        text-[9px]
                        sm:text-[10px]
                        font-semibold
                        tracking-[0.13em]
                        uppercase
                        text-white
                        mb-7
                    ">
                    SINGLE IMPLANT IN ISTANBUL
                    <span class="mx-2 opacity-50">•</span>
                    FROM €230
                </div>


                <!-- Heading -->
                <h1 class="
                        max-w-[700px]
                        font-serif
                        font-normal
                        text-[38px]
                        sm:text-[48px]
                        lg:text-[50px]
                        xl:text-[54px]
                        leading-[1.05]
                        tracking-[-0.02em]
                        text-white
                    ">
                    Single Dental Implant in Turkey
                </h1>


                <!-- Subheading -->
                <h2 class="
                        mt-5
                        font-serif
                        font-normal
                        text-[21px]
                        sm:text-[24px]
                        lg:text-[22px]
                        leading-[1.3]
                        text-white/90
                    ">
                    One Missing Tooth, Replaced at the Root
                </h2>


                <!-- Description -->
                <p class="
                        mt-10
                        max-w-[670px]
                        text-[15px]
                        sm:text-[16px]
                        leading-[1.6]
                        text-white/80
                    ">
                    A single implant replaces the root and the tooth without
                    shaving down the healthy teeth beside it, unlike a bridge.
                    The Swiss option is <strong class="text-white">€230</strong>,
                    and Osstem, Hiossen, Nobel or Straumann are available up to
                    €900. Placement is planned on a CBCT scan and usually takes
                    under an hour.
                </p>


                <!-- CTA -->
                <div class="mt-8">

                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="
                            inline-flex
                            items-center
                            justify-center
                            min-h-[48px]
                            px-6
                            sm:px-7
                            rounded-full
                            bg-white/85
                            hover:bg-white
                            text-[15px]
                            font-medium
                            text-[var(--secondary)]
                            transition-all
                            duration-300
                            shadow-[0_5px_20px_rgba(0,0,0,0.08)]
                        ">
                        See What a Single Implant Costs
                    </a>

                </div>


                <!-- =========================
                     STATS
                ========================== -->
                <div class="
                        mt-10
                        grid
                        grid-cols-2
                        sm:grid-cols-4
                        gap-x-5
                        gap-y-6
                        max-w-[650px]
                    ">

                    <?php foreach ($stats as $stat): ?>

                        <div class="flex items-center gap-3">

                            <div class="
                                    shrink-0
                                    w-[32px]
                                    h-[32px]
                                    rounded-full
                                    border
                                    border-white/30
                                    flex
                                    items-center
                                    justify-center
                                ">
                                <svg class="w-[15px] h-[15px] text-white/80" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5">
                                    <?php echo $stat['icon']; ?>
                                </svg>
                            </div>

                            <div>
                                <div class="text-[14px] font-semibold text-white">
                                    <?php echo esc_html($stat['value']); ?>
                                </div>

                                <div class="text-[10px] text-white/65">
                                    <?php echo esc_html($stat['label']); ?>
                                </div>
                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>


            <!-- =========================
                 RIGHT FORM
            ========================== -->
            <div class="
                    w-full
                    max-w-[480px]
                    lg:ml-auto
                    rounded-[24px]
                    border
                    border-white/30
                    bg-secondary/75
                    backdrop-blur-[14px]
                    shadow-[0_15px_50px_rgba(0,0,0,0.20)]
                    p-5
                    sm:p-7
                    lg:p-7
                ">

                <form action="" method="post" class="space-y-3">

                    <!-- Name -->
                    <div>
                        <label for="implant-name" class="sr-only">
                            Name Surname
                        </label>

                        <input id="implant-name" type="text" name="name" placeholder="Name Surname" required class="
                                w-full
                                h-[50px]
                                rounded-full
                                border
                                border-white/20
                                bg-white/10
                                px-5
                                text-[13px]
                                text-white
                                placeholder:text-white/55
                                outline-none
                                transition-all
                                duration-300
                                focus:border-white/50
                                focus:bg-white/15
                            ">
                    </div>


                    <!-- Phone -->
                    <div class="relative">

                        <label for="implant-phone" class="sr-only">
                            Phone
                        </label>

                        <div class="
                                flex
                                items-center
                                w-full
                                h-[50px]
                                rounded-full
                                border
                                border-white/20
                                bg-white/10
                                overflow-hidden
                                focus-within:border-white/50
                            ">

                            <div class="
                                    flex
                                    items-center
                                    gap-2
                                    pl-5
                                    pr-2
                                    shrink-0
                                    text-[13px]
                                    text-white
                                ">
                                <span class="text-[17px]">🇵🇰</span>
                                <span>+92</span>
                            </div>

                            <input id="implant-phone" type="tel" name="phone" placeholder="Phone number" required class="
                                    flex-1
                                    h-full
                                    bg-transparent
                                    border-0
                                    outline-none
                                    px-2
                                    pr-5
                                    text-[13px]
                                    text-white
                                    placeholder:text-white/55
                                ">

                        </div>

                    </div>


                    <!-- Email -->
                    <div>

                        <label for="implant-email" class="sr-only">
                            E-mail
                        </label>

                        <input id="implant-email" type="email" name="email" placeholder="E-mail" required class="
                                w-full
                                h-[50px]
                                rounded-full
                                border
                                border-white/20
                                bg-white/10
                                px-5
                                text-[13px]
                                text-white
                                placeholder:text-white/55
                                outline-none
                                transition-all
                                duration-300
                                focus:border-white/50
                                focus:bg-white/15
                            ">

                    </div>


                    <!-- Service -->
                    <div>

                        <label for="implant-service" class="sr-only">
                            Select Service
                        </label>

                        <div class="relative">

                            <select id="implant-service" name="service" required class="
                                    appearance-none
                                    w-full
                                    h-[50px]
                                    rounded-full
                                    border
                                    border-white/20
                                    bg-white/20
                                    px-5
                                    pr-12
                                    text-[13px]
                                    text-white/60
                                    outline-none
                                    focus:border-white/50
                                ">
                                <option value="" selected disabled>
                                    Select Service
                                </option>

                                <option value="single-implant">
                                    Single Dental Implant
                                </option>

                                <option value="all-on-4">
                                    All-on-4 Dental Implants
                                </option>

                                <option value="all-on-6">
                                    All-on-6 Dental Implants
                                </option>

                                <option value="veneers">
                                    Dental Veneers
                                </option>

                                <option value="crowns">
                                    Dental Crowns
                                </option>

                            </select>

                            <!-- Arrow -->
                            <svg class="
                                    pointer-events-none
                                    absolute
                                    right-5
                                    top-1/2
                                    -translate-y-1/2
                                    w-4
                                    h-4
                                    text-white/60
                                " viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="m6 9 6 6 6-6" />
                            </svg>

                        </div>

                    </div>


                    <!-- Message -->
                    <div>

                        <label for="implant-message" class="sr-only">
                            Please specify the topic
                        </label>

                        <input id="implant-message" type="text" name="message" placeholder="Please specify the topic..."
                            class="
                                w-full
                                h-[50px]
                                rounded-full
                                border
                                border-white/20
                                bg-white/10
                                px-5
                                text-[13px]
                                text-white
                                placeholder:text-white/55
                                outline-none
                                transition-all
                                duration-300
                                focus:border-white/50
                                focus:bg-white/15
                            ">

                    </div>


                    <!-- Consent -->
                    <div class="
                            flex
                            items-start
                            gap-2
                            pt-2
                        ">

                        <input id="implant-consent" type="checkbox" name="consent" required class="
                                mt-[3px]
                                shrink-0
                                w-[13px]
                                h-[13px]
                                accent-coffGreen
                                cursor-pointer
                            ">

                        <label for="implant-consent" class="
                                text-[9px]
                                sm:text-[10px]
                                leading-[1.35]
                                italic
                                text-white/75
                                cursor-pointer
                            ">
                            I agree to receive treatment information, special
                            offers, and follow-up communications from Ilam Din
                            Dental via email and other digital channels. I
                            understand I can unsubscribe at any time.
                        </label>

                    </div>


                    <!-- Submit -->
                    <button type="submit" class="
                            w-full
                            h-[48px]
                            mt-2
                            rounded-full
                            bg-coffGreen
                            hover:bg-[#3459c9]
                            text-white
                            text-[14px]
                            font-semibold
                            transition-all
                            duration-300
                            shadow-[0_5px_20px_rgba(0,0,0,0.12)]
                            hover:shadow-[0_8px_25px_rgba(0,0,0,0.20)]
                        ">
                        Apply now
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>