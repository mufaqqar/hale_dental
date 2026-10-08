<?php
$banner_info = get_field('banner_info');

$banner_title = $banner_info['title'] ?? '';
$banner_content = $banner_info['content'] ?? '';
$banner_link = $banner_info['link'] ?? '';
$banner_video = $banner_info['video'] ?? '';

/**
 * Hero video: a self-hosted file keeps the player chrome (YouTube logo,
 * captions, music title) off the page. Resolved in this order:
 * 1. "video" field inside the existing ACF "banner_info" group
 * 2. assets/videos/video.mp4 shipped with the theme
 */
if (is_array($banner_video)) {
    $banner_video = $banner_video['url'] ?? '';
}

if (empty($banner_video)) {
    $local_video = get_template_directory() . '/assets/videos/video.mp4';
    if (file_exists($local_video)) {
        $banner_video = get_template_directory_uri() . '/assets/videos/video.mp4';
    }
}

$local_poster = get_template_directory() . '/assets/images/heroimage.png';
$banner_poster = file_exists($local_poster)
    ? get_template_directory_uri() . '/assets/images/heroimage.png'
    : '';
?>

<section class="relative min-h-[750px] h-full w-full overflow-hidden ">

    <!-- Background Video -->
    <div class="hero-media absolute inset-0 z-0 overflow-hidden">

        <?php if ($banner_video): ?>

            <iframe class="hero-video"
                src="https://www.youtube.com/embed/a4HdkGehk5A?autoplay=1&mute=1&loop=1&playlist=a4HdkGehk5A&controls=0&playsinline=1&rel=0"
                title="Hero video" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
            </iframe>
        <?php elseif ($banner_poster): ?>
            <img class="hero-video" src="<?php echo esc_url($banner_poster); ?>" alt="" aria-hidden="true" width="1920"
                height="1080" fetchpriority="high">
        <?php endif; ?>

        <!-- Overlay -->
        <div class="absolute inset-0 z-[1] bg-secondary opacity-[0.78]">
        </div>

    </div>

    <!-- Content -->
    <div class="absolute inset-0 z-[2] flex items-center justify-center px-6 text-center text-white">

        <div class="mx-auto mt-32 w-full max-w-5xl">

            <div>

                <?php if ($banner_title): ?>
                    <h1 class="text-3xl md:text-5xl">
                        <?php echo esc_html($banner_title); ?>
                    </h1>
                <?php endif; ?>

                <?php if ($banner_content): ?>
                    <p class="mt-4 text-sm md:text-lg">
                        <?php echo esc_html($banner_content); ?>
                    </p>
                <?php endif; ?>

            </div>

            <?php if ($banner_link): ?>
                <div class="mt-8 lg:mt-12">

                    <a href="<?php echo esc_url($banner_link); ?>"
                        class="inline-block rounded-[48px] px-[25px] py-[13px] text-[18px] leading-[1.5] text-white transition hover:opacity-80 max-[768px]:px-[15px] max-[768px]:py-[10px] max-[768px]:text-[14px]"
                        style="background: linear-gradient(197.05deg, var(--primary) -42.06%, var(--secondary) 136.49%);">
                        Book free consultation
                    </a>

                </div>
            <?php endif; ?>

        </div>

    </div>

</section>