<section class="relative w-full overflow-hidden bg-[#b6a19a]">
    <div class="relative mx-auto flex min-h-[198px] max-w-[1350px] items-center">

        <!-- Left: Heading -->
        <div class="relative z-20 w-[280px] shrink-0 pl-[8%]">
            <h2 class="font-serif text-[42px] leading-[1.35] text-white">
                Free<br>
                Consultation
            </h2>
        </div>


        <!-- Center: Description -->
        <div class="relative z-20 w-[280px] shrink-0">
            <p class="font-sans text-[17px] leading-[1.9] text-white">
                Are you ready to<br>

                <strong class="font-semibold">
                    start your journey
                </strong>

                <br>
                to perfection today?
            </p>
        </div>


        <!-- Clock / Background Image -->
        <div class="absolute left-[50%] top-1/2 z-10 -translate-x-[15%] -translate-y-1/2">
            <img
                src="<?php echo get_template_directory_uri(); ?>/assets/images/consultation-clock.png"
                alt="Consultation"
                class="w-[285px] max-w-none"
            >
        </div>


        <!-- Right Button -->
        <div class="relative z-30 ml-auto pr-[8%]">
            <a
                href="<?php echo esc_url(home_url('/contact/')); ?>"
                class="inline-flex min-w-[146px] items-center justify-center rounded-full border border-white/80 px-7 py-4 text-[16px] font-medium text-white transition-all duration-300 hover:bg-white hover:text-[#675b57]"
            >
                Book now!
            </a>
        </div>

    </div>
</section>