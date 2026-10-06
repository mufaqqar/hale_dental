<?php
$home_info = get_field('about');

if (!empty($home_info)):

    $title = $home_info['title'] ?? '';
    $subtitle = $home_info['subtitle'] ?? '';
    $description = $home_info['description'] ?? '';
    $image = $home_info['image'] ?? '';

    $image_url = '';
    if (is_array($image)) {
        $image_url = $image['url'] ?? '';
    } elseif (is_numeric($image)) {
        $image_url = wp_get_attachment_image_url((int) $image, 'full') ?: '';
    } elseif (is_string($image)) {
        $image_url = $image;
    }

    if ($image_url && !preg_match('#^(https?:)?//#', $image_url)) {
        $image_url = get_template_directory_uri() . '/' . ltrim($image_url, '/');
    }
    ?>

    <section class="relative overflow-hidden w-full bg-[#FAFAFA] py-16">
        <div aria-hidden="true" class="absolute inset-0 left-[44%] hidden lg:block">
            <?php if ($image_url): ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title ?: 'Dental clinic'); ?>" loading="lazy" decoding="async"
                    class="h-full w-full object-cover">
            <?php endif; ?>
            <span
                class="absolute inset-0 bg-[linear-gradient(90deg,#FAFAFA_0%,rgba(250,250,250,0.75)_8%,rgba(250,250,250,0.45)_16%,rgba(250,250,250,0.2)_26%,rgba(250,250,250,0.06)_36%,transparent_46%)]"></span><span
                class="absolute inset-x-0 bottom-0 h-[22%] bg-[linear-gradient(180deg,transparent_0%,rgba(250,250,250,0.5)_70%,#FAFAFA_100%)]"></span>
        </div>
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


           
        </div>
    </section>

<?php endif; ?>