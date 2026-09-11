<?php
$testimonials = [

    [
        'name'     => 'JOEL T.',
        'service'  => 'Dental Veneers',
        'category' => 'laminate-veneers',
        'image'    => get_template_directory_uri() . '/assets/images/review.webp',
        'video'    => 'https://player.vimeo.com/video/1093632222?h=a29d604463&dnt=1',
    ],

    [
        'name'     => 'EYMAN H.',
        'service'  => 'Dental Veneers',
        'category' => 'laminate-veneers',
        'image'    => get_template_directory_uri() . '/assets/images/review.webp',
        'video'    => 'https://player.vimeo.com/video/1093632222?h=a29d604463&dnt=1',
    ],

    [
        'name'     => 'ANDA I.',
        'service'  => 'Dental Veneers',
        'category' => 'laminate-veneers',
        'image'    => get_template_directory_uri() . '/assets/images/review.webp',
        'video'    => 'https://player.vimeo.com/video/1093632222?h=a29d604463&dnt=1',
    ],

    [
        'name'     => 'LIZA N.',
        'service'  => 'Dental Veneers',
        'category' => 'laminate-veneers',
        'image'    => get_template_directory_uri() . '/assets/images/review.webp',
        'video'    => 'https://player.vimeo.com/video/1093632222?h=a29d604463&dnt=1',
    ],

    // Dental Implants
    [
        'name'     => 'JOHN D.',
        'service'  => 'Dental Implants',
        'category' => 'dental-implants',
        'image'    => get_template_directory_uri() . '/assets/images/review.webp',
        'video'    => 'https://player.vimeo.com/video/1093632222?h=a29d604463&dnt=1',
    ],

    // Dental Crowns
    [
        'name'     => 'SARAH M.',
        'service'  => 'Dental Crowns',
        'category' => 'dental-crowns',
        'image'    => get_template_directory_uri() . '/assets/images/review.webp',
        'video'    => 'https://player.vimeo.com/video/1093632222?h=a29d604463&dnt=1',
    ],

    // Whitening
    [
        'name'     => 'DAVID K.',
        'service'  => 'Whitening',
        'category' => 'whitening',
        'image'    => get_template_directory_uri() . '/assets/images/review.webp',
        'video'    => 'https://player.vimeo.com/video/1093632222?h=a29d604463&dnt=1',
    ],
];
?>

<section class="bg-[#f7f7f7] py-10">

    <div class="mx-auto max-w-[1000px] px-5">

        <!-- Heading -->
        <div class="text-center">

            <h2 class="md:text-5xl text-3xl   text-coff_black tracking-tight">
                Real, Life-Changing Transformations
            </h2>

            <p class="mx-auto mt-5 max-w-[900px] text-lg text-coff_black leading-relaxed">
                Experience the impact of expert care through the voices of our patients.
                Watch real testimonials from those who trusted Ilam Din Dental for their smile makeover.
            </p>

        </div>


        <!-- Tabs -->
        <div class="mt-5 flex flex-wrap justify-center gap-2">

            <?php
            $tabs = [
                'all'              => 'All Services',
                'dental-implants'  => 'Dental Implants',
                'dental-crowns'    => 'Dental Crowns',
                'laminate-veneers' => 'Laminate Veneers',
                'whitening'        => 'Whitening',
            ];
            ?>

            <?php foreach ($tabs as $slug => $label) : ?>

                <button
                    type="button"
                    class="testimonial-tab <?php echo $slug === 'all' ? 'is-active' : ''; ?> rounded-full border px-3 py-1.5 text-[12px]"
                    data-tab="<?php echo esc_attr($slug); ?>"
                >
                    <?php echo esc_html($label); ?>
                </button>

            <?php endforeach; ?>

        </div>


        <!-- =====================================
             SLICK SLIDER
        ====================================== -->

        <div class="relative mt-6">

            <!-- Previous Arrow -->
            <button
                type="button"
                class="testimonial-prev absolute left-[-16px] top-1/2 z-30 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-md"
                aria-label="Previous"
            >
                <svg
                    class="h-4 w-4 text-[#4d7cff]"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </button>


            <!-- Slick -->
            <div id="testimonial-slider" class="testimonial-slider">

                <?php foreach ($testimonials as $testimonial) : ?>

                    <div
                        class="testimonial-slide px-[7px]"
                        data-category="<?php echo esc_attr($testimonial['category']); ?>"
                    >

                        <div class="testimonial-card group relative aspect-[0.68] overflow-hidden rounded-[10px] bg-[#ddd]">

                            <!-- Video -->
                            <video
                                class="testimonial-video absolute inset-0 h-full w-full object-cover"
                                preload="metadata"
                                playsinline
                            >
                                <source
                                    src="<?php echo esc_url($testimonial['video']); ?>"
                                    type="video/mp4"
                                >
                            </video>


                            <!-- Poster image -->
                            <img
                                src="<?php echo esc_url($testimonial['image']); ?>"
                                alt="<?php echo esc_attr($testimonial['name']); ?>"
                                class="testimonial-image absolute inset-0 h-full w-full object-cover"
                            >


                            <!-- Top gradient -->
                            <div class="absolute inset-x-0 top-0 z-10 h-24 bg-gradient-to-b from-black/20 to-transparent"></div>


                            <!-- Name -->
                            <div class="absolute left-3 top-3 z-20">

                                <h3 class="text-[14px] font-bold leading-none text-black">
                                    <?php echo esc_html($testimonial['name']); ?>
                                </h3>

                                <p class="mt-1 text-[10px]  text-black">
                                    <?php echo esc_html($testimonial['service']); ?>
                                </p>

                            </div>


                            <!-- Play -->
                            <button
                                type="button"
                                class="testimonial-play absolute right-3 top-3 z-30 flex h-8 w-8 items-center justify-center rounded-full bg-white/80 backdrop-blur-sm transition hover:scale-110 hover:bg-white"
                                aria-label="Play testimonial"
                            >
                                <svg
                                    class="ml-0.5 h-3.5 w-3.5 text-[#4d7cff]"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                >
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </button>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>


            <!-- Next Arrow -->
            <button
                type="button"
                class="testimonial-next absolute right-[-16px] top-1/2 z-30 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-md"
                aria-label="Next"
            >
                <svg
                    class="h-4 w-4 text-[#4d7cff]"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </button>

        </div>


        <!-- CTA -->
        <div class="mt-5 flex justify-center">

            <a
                href="<?php echo esc_url(home_url('/contact/')); ?>"
                class="rounded-full bg-[#4d7cff] px-7 py-3 text-[13px]   text-white"
            >
                Get Quote Now
            </a>

        </div>

    </div>

</section>