<section class="relative w-full overflow-hidden bg-[#b6a19a]">
    <div class="max-w-[1116px] mx-auto px-4 flex min-h-[430px] flex-col items-center pt-10 pb-4 text-center md:min-h-0 md:grid md:h-[198px] md:grid-cols-4 md:items-center md:gap-4 md:px-0 md:py-0 md:text-left">

        <!-- Left: Heading -->
            <h2 class="font-serif text-[42px] leading-[1.35] text-white">
                Free<br>
                Consultation
            </h2>
        <!-- Center: Description -->
            <p class="font-sans text-[17px] leading-[1.9] text-white">
                Are you ready to<br>

                <strong class=" ">
                    start your journey
                </strong>

                <br>
                to perfection today?
            </p>
        <!-- Clock / Background Image -->
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/clock.webp" alt="Consultation"
            class="hidden h-[200px] w-auto max-w-none md:block md:-ml-[60px]">


        <!-- Right Button -->
        <div class="relative z-30 ml-auto pr-[8%]">
            <a href="<?php echo esc_url(home_url('/contact/')); ?>"
                class="inline-flex min-w-[146px] items-center justify-center rounded-full border border-white/80 px-7 py-4 text-[16px]  text-white transition-all duration-300 hover:bg-white hover:text-[#675b57]">
                Book now!
            </a>
        </div>

    </div>
</section>