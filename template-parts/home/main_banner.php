<?php
$banner_info = get_field('banner_info');

$banner_title   = $banner_info['title'] ?? '';
$banner_content = $banner_info['content'] ?? '';
$banner_link    = $banner_info['link'] ?? '';
?>

<section class="relative min-h-screen w-full overflow-hidden">

    <!-- Background Video -->
    <div class="absolute inset-0 z-0 overflow-hidden">

        <iframe
            class="absolute inset-0 h-full w-full object-cover pointer-events-none"
            src="https://www.youtube-nocookie.com/embed/a4HdkGehk5A?autoplay=1&mute=1&loop=1&playlist=a4HdkGehk5A&playsinline=1&controls=0&rel=0"
            title="Hero Video"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen>
        </iframe>

        <!-- Overlay -->
        <div
            class="absolute inset-0 z-[1]"
            style="background: linear-gradient(91deg, rgb(1, 3, 17, 1) 0%, rgba(0, 70, 80, 0) 236%), radial-gradient(66.49% 105.16% at 70.36% 47.07%, rgba(0, 70, 80, 0) 0%, rgba(0, 70, 80, 0.2) 100%); filter: brightness(0.5);">
        </div>

    </div>

    <!-- Content -->
    <div class="absolute inset-0 z-[2] flex items-center justify-center px-6 text-center text-white">

        <div class="mx-auto mt-32 w-full max-w-5xl">

            <div>

                <?php if ($banner_title) : ?>
                    <h1 class="text-3xl md:text-5xl">
                        <?php echo esc_html($banner_title); ?>
                    </h1>
                <?php endif; ?>

                <?php if ($banner_content) : ?>
                    <p class="mt-4 text-sm md:text-lg">
                        <?php echo esc_html($banner_content); ?>
                    </p>
                <?php endif; ?>

            </div>

            <?php if ($banner_link) : ?>
                <div class="mt-8 lg:mt-12">

                    <a
                        href="<?php echo esc_url($banner_link); ?>"
                        class="inline-block rounded-[48px] px-[25px] py-[13px] text-[18px] leading-[1.5] text-white transition hover:opacity-80 max-[768px]:px-[15px] max-[768px]:py-[10px] max-[768px]:text-[14px]"
                        style="background: linear-gradient(197.05deg, var(--primary) -42.06%, var(--secondary) 136.49%);">
                        Book free consultation
                    </a>

                </div>
            <?php endif; ?>

        </div>

    </div>

</section>