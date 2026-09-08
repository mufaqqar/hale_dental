<section class="relative w-full overflow-hidden bg-[#00515a] py-7 md:py-8">

    <!-- =========================
         SECTION HEADER
    ========================== -->
    <div class="relative z-10 mx-auto w-full max-w-[900px] px-4 text-center">

        <!-- Small heading -->
        <h2 class="m-0 font-serif text-[32px] font-bold leading-[1.1] text-[#f3a895] md:text-[38px]">
            Your Transformation Journey
        </h2>

        <!-- Main heading -->
        <h3 class="m-0 mt-1 font-serif text-[30px] font-normal leading-[1.1] text-white md:text-[38px]">
            Before &amp; After in Turkey
        </h3>

        <!-- Description -->
        <p class="mx-auto mt-5 max-w-[600px] text-[13px] leading-[1.8] text-white/90 md:text-[14px]">
            For the price of one tooth in your country, get your entire mouth treated at Dental Centre
            Turkey Natural Clinic! Solve dental issues for good with implants.
        </p>


        <!-- =========================
             TABS
        ========================== -->
        <div class="journey-tabs mx-auto mt-4 flex h-[52px] w-fit max-w-full items-center rounded-full border border-white/20 bg-[#075b63] px-2"
            role="tablist">

            <!-- Face Aesthetic -->
            <button type="button"
                class="journey-tab active relative h-full min-w-[125px] px-5 text-[13px] font-semibold text-[#f3a895] transition-all duration-300"
                data-tab="face" role="tab" aria-selected="true">
                Face Aesthetic
            </button>

            <!-- Divider -->
            <span class="h-5 w-px bg-white/20"></span>

            <!-- Hair -->
            <button type="button"
                class="journey-tab relative h-full min-w-[125px] px-5 text-[13px] font-normal text-white/40 transition-all duration-300"
                data-tab="hair" role="tab" aria-selected="false">
                Hair Treatments
            </button>

            <!-- Divider -->
            <span class="h-5 w-px bg-white/20"></span>

            <!-- Dentistry -->
            <button type="button"
                class="journey-tab relative h-full min-w-[105px] px-5 text-[13px] font-normal text-white/40 transition-all duration-300"
                data-tab="dentistry" role="tab" aria-selected="false">
                Dentistry
            </button>

        </div>

    </div>


    <!-- =========================
         SLIDER
    ========================== -->
    <div class="journey-slider relative mt-6 h-[300px] w-full md:mt-7 md:h-[315px]">

        <!-- Slider track -->
        <div id="journeyTrack"
            class="absolute left-1/2 top-0 flex h-full -translate-x-1/2 items-center gap-[14px] transition-transform duration-500 ease-out">

            <!-- =================================
                 SLIDE 1
            ================================== -->
            <div class="journey-slide shrink-0 overflow-hidden rounded-[17px] transition-all duration-500"
                data-category="face">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/journey/face-1.jpg"
                    alt="Face transformation" class="h-full w-full object-cover">
            </div>

            <!-- =================================
                 SLIDE 2
            ================================== -->
            <div class="journey-slide shrink-0 overflow-hidden rounded-[17px] transition-all duration-500"
                data-category="face">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/journey/face-2.jpg"
                    alt="Face transformation" class="h-full w-full object-cover">
            </div>

            <!-- =================================
               SLIDE 3
            ================================== -->
            <div class="journey-slide shrink-0 overflow-hidden rounded-[18px] border border-white/5 transition-all duration-500"
                data-category="face">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/journey/face-main.jpg"
                    alt="Before and after face transformation" class="h-full w-full object-cover">
            </div>

            <!-- =================================
                 SLIDE 4
            ================================== -->
            <div class="journey-slide journey-slide-active shrink-0 overflow-hidden rounded-[17px] transition-all duration-500"
                data-category="face">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/journey/face-3.jpg"
                    alt="Face transformation" class="h-full w-full object-cover">
            </div>

            <!-- =================================
                 SLIDE 5
            ================================== -->
            <div class="journey-slide shrink-0 overflow-hidden rounded-[17px] transition-all duration-500"
                data-category="face">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/journey/face-4.jpg"
                    alt="Face transformation" class="h-full w-full object-cover">
            </div>

            <!-- =================================
                 SLIDE 6
            ================================== -->
            <div class="journey-slide shrink-0 overflow-hidden rounded-[17px] transition-all duration-500"
                data-category="face">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/journey/face-5.jpg"
                    alt="Face transformation" class="h-full w-full object-cover">
            </div>
            <!-- =================================
                 SLIDE 7
            ================================== -->
            <div class="journey-slide shrink-0 overflow-hidden rounded-[17px] transition-all duration-500"
                data-category="face">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/journey/face-5.jpg"
                    alt="Face transformation" class="h-full w-full object-cover">
            </div>

        </div>


        <!-- =========================
             LEFT ARROW
        ========================== -->
        <button type="button" id="journeyPrev"
            class="absolute left-[calc(50%-340px)] top-1/2 z-20 flex h-[38px] w-[38px] -translate-y-1/2 items-center justify-center rounded-full border border-white/30 bg-white/10 text-white backdrop-blur-sm transition-all duration-300 hover:bg-white/20"
            aria-label="Previous">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M15 18l-6-6 6-6" />
            </svg>
        </button>


        <!-- =========================
             RIGHT ARROW
        ========================== -->
        <button type="button" id="journeyNext"
            class="absolute right-[calc(50%-340px)] top-1/2 z-20 flex h-[38px] w-[38px] -translate-y-1/2 items-center justify-center rounded-full border border-white/30 bg-white/10 text-white backdrop-blur-sm transition-all duration-300 hover:bg-white/20"
            aria-label="Next">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M9 18l6-6-6-6" />
            </svg>
        </button>

    </div>

</section>