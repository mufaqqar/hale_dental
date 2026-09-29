<?php
$home_info = get_field('about');

if (!empty($home_info)):

    $title = $home_info['title'] ?? '';
    $subtitle = $home_info['subtitle'] ?? '';
    $description = $home_info['description'] ?? '';
    ?>

    <section class="w-full bg-[#FAFAFA] py-16">
        <div class="container mx-auto px-4 flex flex-col lg:flex-row items-center gap-12 lg:gap-20">

            <!-- Content -->
            <div class="flex-1 space-y-6">

                <?php if (!empty($title)): ?>
                    <div class="flex items-center gap-3">
                        <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                            <?php echo esc_html($title); ?>
                        </h2>

                        <div class="min-h-2 w-16 bg-primary"></div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($subtitle)): ?>
                    <h2 class="md:text-4xl text-2xl   text-[#1A1A1A] leading-tight">
                        <?php echo esc_html($subtitle); ?>
                    </h2>

                <?php endif; ?>

                <?php if (!empty($description)): ?>
                    <div class="text-lg text-coff_black leading-relaxed max-w-xl">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>


                <a href="<?php echo esc_url(home_url('/about-us')); ?>"
                    class="inline-flex items-center gap-2 bg-coff_black text-white px-8 py-4 rounded-full hover:bg-primary transition-colors duration-300">

                    More About Us

                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">

                        <line x1="7" y1="17" x2="17" y2="7"></line>
                        <polyline points="7 7 17 7 17 17"></polyline>

                    </svg>
                </a>

            </div>


            <!-- Image -->
            <div class="flex-1 w-full relative">
                <div class="relative">

                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/face/4.webp'); ?>"
                        alt="<?php echo esc_attr($title ?: 'Dental clinic'); ?>" class="w-full object-cover">

                </div>
            </div>

        </div>
    </section>

<?php endif; ?>