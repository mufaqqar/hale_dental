<?php
/**
 * Template Name: Single Treatment
 * Template Post Type: treatments
 */

get_header();

// Parse content: extract H2s, build TOC, wrap sections in <section> tags.
$raw_content = get_the_content();
$parsed = hale_generate_toc_from_content($raw_content);
$toc_html = $parsed['toc'];
$article_html = $parsed['content'];
?>

<?php get_template_part('template-parts/treatment/main_banner'); ?>
<?php get_template_part('template-parts/treatment/about'); ?>
<?php get_template_part('template-parts/home/cta'); ?>
<?php get_template_part('template-parts/home/customerstory'); ?>
<?php
/*
 * Video Section
 */
$video_section = get_field('video_section');

if ($video_section):

    $video_title = $video_section['title'] ?? '';
    $video_description = $video_section['description'] ?? '';
    $video_url = $video_section['videourl'] ?? '';

    ?>

    <section class="bg-primary py-16">
        <div class="container mx-auto px-4 flex md:flex-row flex-col gap-6 items-center">

            <!-- Video -->
            <?php if ($video_url): ?>

                <div class="md:w-1/2 w-full">
                    <div class="relative w-full overflow-hidden rounded-xl aspect-video">

                        <?php
                        /*
                         * Convert normal YouTube URLs into embed URLs.
                         *
                         * Example:
                         * https://www.youtube.com/watch?v=vUHfclgd5qE
                         *
                         * becomes:
                         * https://www.youtube.com/embed/vUHfclgd5qE
                         */
                        $embed_url = $video_url;

                        if (strpos($video_url, 'youtube.com/watch') !== false) {

                            $youtube_id = '';

                            parse_str(
                                parse_url($video_url, PHP_URL_QUERY) ?? '',
                                $youtube_params
                            );

                            if (!empty($youtube_params['v'])) {
                                $youtube_id = $youtube_params['v'];
                            }

                            if ($youtube_id) {
                                $embed_url = 'https://www.youtube.com/embed/' . $youtube_id;
                            }

                        } elseif (strpos($video_url, 'youtu.be/') !== false) {

                            $youtube_id = trim(
                                parse_url($video_url, PHP_URL_PATH),
                                '/'
                            );

                            if ($youtube_id) {
                                $embed_url = 'https://www.youtube.com/embed/' . $youtube_id;
                            }
                        }
                        ?>

                        <iframe class="absolute inset-0 h-full w-full" src="<?php echo esc_url($embed_url); ?>"
                            title="<?php echo esc_attr($video_title ?: 'Video'); ?>" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>

                    </div>
                </div>

            <?php endif; ?>


            <!-- Content -->
            <div class="md:w-1/2 w-full">

                <?php if ($video_title): ?>
                    <h2 class="md:text-5xl text-3xl text-white tracking-tight">
                        <?php echo esc_html($video_title); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($video_description): ?>
                    <div class="text-lg text-white leading-relaxed max-w-xl mt-4">
                        <?php echo wp_kses_post($video_description); ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </section>

<?php endif; ?>


<?php
/*
 * Sniffing Section
 */
$sniffing_section = get_field('sniffing_section');

if ($sniffing_section):

    $sniffing_title = $sniffing_section['title'] ?? '';
    $sniffing_description = $sniffing_section['description'] ?? '';
    $sniffing_image = $sniffing_section['image'] ?? '';
    $sniffing_cards = $sniffing_section['card'] ?? [];

    ?>

    <section class="bg-white py-16">

        <div class="container mx-auto px-4">

            <!-- Top Content -->
            <div class="grid items-center gap-10 lg:grid-cols-12">

                <?php if ($sniffing_image): ?>

                    <div class="hidden lg:col-span-4 lg:block">

                        <img src="<?php echo esc_url($sniffing_image); ?>" alt="<?php echo esc_attr($sniffing_title); ?>"
                            class="w-full rounded-[20px] object-cover" />

                    </div>

                <?php endif; ?>


                <div class="<?php echo $sniffing_image ? 'lg:col-span-8' : 'lg:col-span-12'; ?>">

                    <?php if ($sniffing_title): ?>

                        <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                            <?php echo nl2br(esc_html($sniffing_title)); ?>
                        </h2>

                    <?php endif; ?>


                    <?php if ($sniffing_description): ?>

                        <div class="mt-5 text-base text-secondaryLight">
                            <?php echo wp_kses_post($sniffing_description); ?>
                        </div>

                    <?php endif; ?>

                </div>

            </div>


            <!-- Cards -->
            <?php if (!empty($sniffing_cards)): ?>

                <div class="mt-8 grid gap-6 md:grid-cols-2">

                    <?php foreach ($sniffing_cards as $card):

                        $card_title = $card['title'] ?? '';
                        $card_subtitle = $card['subtitle'] ?? '';
                        $card_description = $card['description'] ?? '';

                        ?>

                        <div class="rounded-2xl border border-secondary/10 bg-amber-50 p-6 md:p-8">

                            <?php if ($card_title): ?>

                                <h4 class="text-xl text-coff_black mb-3">
                                    <?php echo esc_html($card_title); ?>
                                </h4>

                            <?php endif; ?>


                            <?php if ($card_subtitle): ?>

                                <h5 class="text-sm">
                                    <?php echo esc_html($card_subtitle); ?>
                                </h5>

                            <?php endif; ?>


                            <?php if ($card_description): ?>

                                <div class="mt-3 text-base text-secondaryLight">
                                    <?php echo wp_kses_post($card_description); ?>
                                </div>

                            <?php endif; ?>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </section>

<?php endif; ?>
<?php get_template_part('template-parts/home/cta'); ?>

<?php
$suitable_section = get_field('suitable_section');

if (!empty($suitable_section)):

    $title = $suitable_section['title'] ?? '';
    $description = $suitable_section['description'] ?? '';
    $image = $suitable_section['image'] ?? '';
    $benefits = $suitable_section['benefits'] ?? '';
    $losses = $suitable_section['losses'] ?? '';

    // Handle ACF image field whether it returns Array, URL, or ID
    $image_url = '';

    if (is_array($image)) {
        $image_url = $image['url'] ?? '';
    } elseif (is_numeric($image)) {
        $image_url = wp_get_attachment_image_url($image, 'full');
    } elseif (is_string($image)) {
        $image_url = $image;
    }
    ?>

    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid items-center gap-10 lg:grid-cols-12">

                <!-- Content -->
                <div class="lg:col-span-7">

                    <?php if (!empty($title)): ?>
                        <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                            <?php echo esc_html($title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($description)): ?>
                        <div class="mt-5 text-base text-secondaryLight">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php endif; ?>


                    <!-- Benefits -->
                    <?php if (!empty($benefits)): ?>
                        <div class="mt-5 rounded-[16px] border border-secondary bg-white p-5">

                            <div class="acf-benefits text-base yLight">
                                <?php echo wp_kses_post($benefits); ?>
                            </div>

                        </div>
                    <?php endif; ?>


                    <!-- Losses / Contraindications -->
                    <?php if (!empty($losses)): ?>
                        <div class="mt-4 rounded-[16px] border border-primary/10 bg-white p-5">

                            <div class="acf-losses text-base yLight">
                                <?php echo wp_kses_post($losses); ?>
                            </div>

                        </div>
                    <?php endif; ?>

                </div>


                <!-- Image -->
                <?php if (!empty($image_url)): ?>
                    <div class="flex justify-center lg:col-span-5">
                        <img src="<?php echo esc_url($image_url); ?>"
                            alt="<?php echo esc_attr($title ?: 'Suitable candidate'); ?>"
                            class="w-full max-w-[428px] rounded-[24px] object-cover">
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

<?php endif; ?>
<?php
$surgeon_section = get_field('surgeon_section');

if (!empty($surgeon_section)):

    $title = $surgeon_section['title'] ?? '';
    $description = $surgeon_section['description'] ?? '';
    $associationslist = $surgeon_section['associationslist'] ?? '';
    ?>

    <section class="bg-[linear-gradient(170deg,#d9d9d945_0%,#FFFFFF_100%)] py-16">
        <div class="container mx-auto px-4">
            <div class="grid gap-10 lg:grid-cols-2">

                <!-- Left Content -->
                <div>
                    <?php if (!empty($title)): ?>
                        <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                            <?php echo esc_html($title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($description)): ?>
                        <div class="mt-5 text-base text-secondaryLight">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right Content -->
                <div>
                    <?php if (!empty($associationslist)): ?>
                        <div class="text-base text-secondaryLight">
                            <?php echo wp_kses_post($associationslist); ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

<?php endif; ?>
<?php
$treatment_cost = get_field('treatment_cost');

if (!empty($treatment_cost)):

    $title = $treatment_cost['title'] ?? '';
    $description = $treatment_cost['description'] ?? '';
    $image = $treatment_cost['image'] ?? '';
    $includes = $treatment_cost['includes'] ?? '';

    // Handle ACF image field regardless of return format
    $image_url = '';
    $image_alt = '';

    if (is_array($image)) {
        $image_url = $image['url'] ?? '';
        $image_alt = $image['alt'] ?? '';
    } elseif (is_numeric($image)) {
        $image_url = wp_get_attachment_image_url($image, 'full');
        $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
    } elseif (is_string($image)) {
        $image_url = $image;
    }

    // Fallback alt text
    if (empty($image_alt)) {
        $image_alt = !empty($title) ? wp_strip_all_tags($title) : 'Treatment cost';
    }
    ?>

    <section class="bg-primary py-16 geo-hide-price">
        <div class="container mx-auto px-4">

            <div class="grid items-center gap-10 lg:grid-cols-12">

                <!-- Left Content -->
                <div class="lg:col-span-6">

                    <?php if (!empty($title)): ?>
                        <h2 class="text-center font-serif text-[28px] leading-[1.2] text-white md:text-[52px] lg:text-left">
                            <?php echo esc_html($title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($description)): ?>
                        <div class="mt-5 text-base text-white/75
                                [&_p]:mb-4
                                [&_p:last-child]:mb-0">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php endif; ?>

                </div>

                <!-- Image -->
                <div class="lg:col-span-6">

                    <?php if (!empty($image_url)): ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>"
                            class="w-full rounded-[18px] object-cover" />
                    <?php endif; ?>

                </div>

            </div>

            <!-- Includes -->
            <?php if (!empty($includes)): ?>
                <div class="mt-8 text-base text-white
                        [&_p]:mb-4
                        [&_p:last-child]:mb-0
                        [&_ul]:mt-3
                        [&_ul]:grid
                        [&_ul]:gap-2
                        [&_ul]:text-base
                        [&_ul]:text-white/85
                        [&_ul]:md:grid-cols-2
                        [&_li]:flex
                        [&_li]:items-start
                        [&_li]:gap-2
                        [&_li]:before:mt-0.5
                        [&_li]:before:h-4
                        [&_li]:before:w-4
                        [&_li]:before:shrink-0
                        [&_li]:before:content-['✓']
                        [&_li]:before:text-[#268ca1]
                        [&_li]:before:font-bold">

                    <?php echo wp_kses_post($includes); ?>

                </div>
            <?php endif; ?>

        </div>
    </section>

<?php endif; ?>
<section class="bg-[linear-gradient(180deg,#f3f3f3_0%,#ffffff_100%)] py-16">
    <div class="container mx-auto px-4">
        <div class="mx-auto max-w-3xl text-center">
            <h2 class="font-serif text-[28px] leading-[1.2]   text-secondary md:text-[52px]"><span class="">Rhinoplasty
                    Packages</span> <!-- -->in Turkey</h2>
            <p class="mt-5 text-base text-secondaryLight">Most Turkish clinics offer all-inclusive travel
                packages, so there are no hidden costs. However, consider that rhinoplasty shouldn’t be done on a
                budget. It is a serious procedure that will greatly affect your life. When it comes to healthcare,
                quality should always be greatly prioritized. If you want to receive a complete medical travel plan,
                with the all-inclusive nose job cost in Turkey.</p>
        </div>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="relative rounded-[20px] border p-6 border-primary/10 bg-white">
                <h3 class="font-serif text-xl   text-secondary">Free - Rider</h3>
                <div class="mt-1 text-base  text-secondaryLight">Package</div>
                <ul class="mt-5 space-y-3">
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Nose Surgery</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>All Pre-Op Tests and Evaluations</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Private Nurse at the Hospital</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>All Aftercare and Medication</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>12-Month Follow-Up</span>
                    </li>
                    <li class="flex items-start gap-2 text-[14px] text-[#9aa3a3]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#9aa3a3" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round"></path>
                        </svg>
                        <span>Hotel Accommodation</span>
                    </li>
                    <li class="flex items-start gap-2 text-[14px] text-[#9aa3a3]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#9aa3a3" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round"></path>
                        </svg>
                        <span>Transportation</span>
                    </li>
                    <li class="flex items-start gap-2 text-[14px] text-[#9aa3a3]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#9aa3a3" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round"></path>
                        </svg>
                        <span>Sightseeing</span>
                    </li>
                </ul><a href="#hero-zone" class="mt-8 inline-flex w-full btn-consult justify-center">Book
                    Appointment</a>
            </div>
            <div
                class="relative rounded-[20px] border p-6 border-secondary bg-secondary shadow-[0_20px_50px_rgba(0,0,0,0.2)]">
                <h3 class="font-serif text-xl   text-white">Touristic</h3>
                <div class="mt-1 text-base  text-secondary">Package</div>
                <ul class="mt-5 space-y-3">
                    <li class="flex items-start gap-2 text-[14px] text-white/90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Nose Surgery</span>
                    </li>
                    <li class="flex items-start gap-2 text-[14px] text-white/90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>All Pre-Op Tests and Evaluations</span>
                    </li>
                    <li class="flex items-start gap-2 text-[14px] text-white/90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Private Nurse at the Hospital + Home</span>
                    </li>
                    <li class="flex items-start gap-2 text-[14px] text-white/90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>All Aftercare and Medication</span>
                    </li>
                    <li class="flex items-start gap-2 text-[14px] text-white/90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>12-Month Follow-Up</span>
                    </li>
                    <li class="flex items-start gap-2 text-[14px] text-white/90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Hotel Accommodation</span>
                    </li>
                    <li class="flex items-start gap-2 text-[14px] text-white/90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Private Transportation</span>
                    </li>
                    <li class="flex items-start gap-2 text-[14px] text-white/90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Sightseeing</span>
                    </li>
                </ul><a href="#hero-zone" class="mt-8 inline-flex w-full btn-consult justify-center">Book
                    Appointment</a>
            </div>
            <div class="relative rounded-[20px] border p-6 border-primary/10 bg-white">
                <h3 class="font-serif text-xl   text-secondary">VIP</h3>
                <div class="mt-1 text-base  text-secondaryLight">Package</div>
                <ul class="mt-5 space-y-3">
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Nose Surgery with Our Best Surgeon</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>All Pre-Op Tests and Evaluations</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>All Aftercare and Medication</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>12-Month Follow-Up</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Exclusive 5 Stars Accommodation</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Deluxe Private Transportation</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Unlimited Sightseeing</span>
                    </li>
                </ul><a href="#hero-zone" class="mt-8 inline-flex w-full btn-consult justify-center">Book
                    Appointment</a>
            </div>
            <div class="relative rounded-[20px] border p-6 border-primary/10 bg-white">
                <h3 class="font-serif text-xl   text-secondary">Standard</h3>
                <div class="mt-1 text-base  text-secondaryLight">Package</div>
                <ul class="mt-5 space-y-3">
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Nose Surgery</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>All Pre-Op Tests and Evaluations</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Private Nurse at the Hospital</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>All Aftercare and Medication</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>12-Month Follow-Up</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Hotel Accommodation</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-secondaryLight">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Transportation</span>
                    </li>
                    <li class="flex items-start gap-2 text-[14px] text-[#9aa3a3]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#9aa3a3" stroke-width="2.5"
                            class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true">
                            <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round"></path>
                        </svg>
                        <span>Sightseeing</span>
                    </li>
                </ul><a href="#hero-zone" class="mt-8 inline-flex w-full btn-consult justify-center">Book
                    Appointment</a>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('template-parts/home/cta'); ?>
<?php
$think_about = get_field('think_about');

if ($think_about):
    $title = $think_about['title'] ?? '';
    $description = $think_about['description'] ?? '';
    $image = $think_about['image'] ?? '';
    ?>

    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid items-center gap-10 lg:grid-cols-12">

                <div class="flex justify-center lg:col-span-5">
                    <?php if ($image): ?>
                        <img src="<?php echo esc_url($image['url'] ?? $image); ?>"
                            alt="<?php echo esc_attr($image['alt'] ?? $title); ?>" class="w-full max-w-[420px] object-contain">
                    <?php endif; ?>
                </div>

                <div class="lg:col-span-7">

                    <?php if ($title): ?>
                        <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                            <?php echo wp_kses_post($title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($description): ?>
                        <div class="mt-5 text-base text-secondaryLight">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </section>

<?php endif; ?>
<?php
$recovery_section = get_field('recovery_section');

if ($recovery_section):
    $title = $recovery_section['title'] ?? '';
    $description = $recovery_section['description'] ?? '';
    $images = $recovery_section['images'] ?? [];
    ?>

    <section class="bg-[linear-gradient(170deg,#FFFDF1_0%,#FFFFFF_100%)] py-16">
        <div class="container mx-auto px-4">
            <div class="grid items-start gap-10 lg:grid-cols-2">

                <!-- Content -->
                <div>

                    <?php if ($title): ?>
                        <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                            <?php echo wp_kses_post($title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($description): ?>
                        <div class="mt-5 text-base text-secondaryLight">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php endif; ?>

                </div>

                <!-- Gallery -->
                <?php if (!empty($images)): ?>
                    <div class="flex flex-col gap-4">

                        <?php foreach ($images as $image): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: $title); ?>"
                                class="w-full rounded-[20px] object-cover">
                        <?php endforeach; ?>

                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

<?php endif; ?>

<?php
$instructions_section = get_field('instructions_section');

if ($instructions_section):

    $title = $instructions_section['title'] ?? '';
    $description = $instructions_section['description'] ?? '';
    $image = $instructions_section['images'] ?? '';
    ?>

    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid items-center gap-10 lg:grid-cols-2">

                <!-- Content -->
                <div>

                    <?php if ($title): ?>
                        <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                            <?php echo wp_kses_post($title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($description): ?>
                        <div class="mt-5 text-base text-secondaryLight">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php endif; ?>

                </div>

                <!-- Image -->
                <?php if ($image): ?>
                    <div class="flex justify-center">
                        <img src="<?php echo esc_url($image['url'] ?? $image); ?>"
                            alt="<?php echo esc_attr($image['alt'] ?? $title); ?>" class="w-full rounded-[24px] object-cover">
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

<?php endif; ?>

<?php get_template_part('template-parts/treatment/faqs'); ?>
<?php get_footer(); ?>