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

<section class="bg-[linear-gradient(170deg,#d9d9d945_0%,#FFFFFF_100%)] py-16">
    <div class="container mx-auto px-4">
        <div class="grid gap-10 lg:grid-cols-2">
            <div>
                <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                    Best <span class="">Rhinoplasty Surgeon</span> <!-- -->in Turkey</h2>
                <p class="mt-5 text-base text-secondaryLight">There are many high-quality plastic surgeons
                    specialized in rhinoplasty in the country, which makes it hard to single out the best rhinoplasty
                    surgeon in Turkey.</p>
                <p class="mt-4 text-base text-secondaryLight">Furthermore, each surgeon has its own style and
                    technique. Our advice is to check results and go for the one you like most. It’s also important to
                    verify your surgeon’s diplomas and associations. Rather than trusting online banners, contact the
                    associations directly.</p>
            </div>
            <div>
                <p class="text-base text-secondaryLight">Here is a list of the best associations your Turkish
                    plastic surgeon should be a member of:</p>
                <ul class="mt-4 list-disc space-y-2 pl-5 text-base  text-secondary">
                    <li>Aesthetic Plastic Surgery Society (EPCD)</li>
                    <li>American Academy of Cosmetic Surgery (AACS)</li>
                    <li>International Society of Aesthetic and Plastic Surgery (ISAPS)</li>
                    <li>The European Board of Plastic and Reconstructive Surgery (EBOPRAS)</li>
                    <li>The European Society of Plastic, Reconstructive and Aesthetic Surgery</li>
                    <li>Turkish Plastic Reconstructive and Aesthetic Surgery Association (TPRCD)</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="bg-primary py-16 geo-hide-price">
    <div class="container mx-auto px-4">
        <div class="grid items-center gap-10 lg:grid-cols-12">
            <div class="lg:col-span-6">
                <h2 class="text-center font-serif text-[28px] leading-[1.2]   text-white md:text-[52px] lg:text-left">
                    <span class="">Rhinoplasty Cost Turkey:</span><br>How Much is the All-Inclusive
                    Package?
                </h2>
                <p class="mt-5 text-base  text-white/75">There is no direct answer to how much is a nose
                    job in Turkey. There are hundreds of clinics, hospitals and surgeons in Istanbul, and they range
                    from standard to world-class, charging just a few thousand or tens of thousands. Establishing the
                    exact cost of rhinoplasty in Turkey requires consultation for the technique and surgery type on top
                    of the surgeon and hospital. But let’s give you some approximate numbers. The average price for a
                    nose job in Turkey varies from £2,300 to £3,500.</p>
            </div>
            <div class="lg:col-span-6">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image-434.webp"
                    alt="Rhinoplasty all-inclusive package" class="w-full rounded-[18px] object-cover" />
            </div>
        </div>
        <p class="mt-8 text-base text-white">This includes:</p>
        <ul class="mt-3 grid gap-2 text-base  text-white/85 md:grid-cols-2">
            <li class="flex items-start gap-2">
                <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5" class="mt-0.5 h-4 w-4 shrink-0"
                    aria-hidden="true">
                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>The complete anesthetic procedure, pre-op tests and evaluations</span>
            </li>
            <li class="flex items-start gap-2">
                <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5" class="mt-0.5 h-4 w-4 shrink-0"
                    aria-hidden="true">
                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>Surgery in a modern private facility</span>
            </li>
            <li class="flex items-start gap-2">
                <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5" class="mt-0.5 h-4 w-4 shrink-0"
                    aria-hidden="true">
                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>The whole hospitalization and overnight</span>
            </li>
            <li class="flex items-start gap-2">
                <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5" class="mt-0.5 h-4 w-4 shrink-0"
                    aria-hidden="true">
                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>All post-operative care, painkillers and medication</span>
            </li>
            <li class="flex items-start gap-2">
                <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5" class="mt-0.5 h-4 w-4 shrink-0"
                    aria-hidden="true">
                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>Hotel accommodation during your entire stay in Istanbul</span>
            </li>
            <li class="flex items-start gap-2">
                <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5" class="mt-0.5 h-4 w-4 shrink-0"
                    aria-hidden="true">
                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>All transfers and inner-city rides</span>
            </li>
            <li class="flex items-start gap-2">
                <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5" class="mt-0.5 h-4 w-4 shrink-0"
                    aria-hidden="true">
                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>Daily check-ups by nurses at the hospital and hotel room</span>
            </li>
            <li class="flex items-start gap-2">
                <svg viewBox="0 0 24 24" fill="none" stroke="#268ca1" stroke-width="2.5" class="mt-0.5 h-4 w-4 shrink-0"
                    aria-hidden="true">
                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>12-month follow-up</span>
            </li>
        </ul>
    </div>
</section>
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
<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="grid items-center gap-10 lg:grid-cols-12">
            <div class="flex justify-center lg:col-span-5"><img
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/Group-1171275957.webp"
                    alt="Before a nose job in Turkey" class="w-full max-w-[420px] object-contain"></div>
            <div class="lg:col-span-7">
                <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                    What to Think About <br><span class="">Before a Nose Job in Turkey?</span>
                </h2>
                <p class="mt-5 text-base text-secondaryLight">If you’re thinking of getting a nose job in
                    Turkey, you might want to check if your clinic complies with ISO standards and is certified by the
                    Turkish Ministry of Health.</p>
                <p class="mt-4 text-base text-secondaryLight">All independent clinics and hospitals providing
                    plastic surgery in Turkey must be certified by the Ministry of Health.</p>
                <p class="mt-4 text-base text-secondaryLight">Furthermore, you might want to check if your
                    surgeons are members of important surgical associations such as ISAPS and EBOPRAS.</p>
            </div>
        </div>
    </div>
</section>
<section class="bg-[linear-gradient(170deg,#FFFDF1_0%,#FFFFFF_100%)] py-16">
    <div class="container mx-auto px-4">
        <div class="grid items-start gap-10 lg:grid-cols-2">
            <div>
                <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                    How to Succeed <br><span class="">Post-Op Recovery</span></h2>
                <p class="mt-5 text-base text-secondaryLight">The first week post-op is crucial in determining
                    results. For this reason, it is important you strictly follow all your surgeon’s instructions.</p>
                <p class="mt-3 text-base text-secondaryLight">Below, you will find a brief guide to use as
                    general considerations. This focuses on the most important instructions for the first days after
                    surgery:</p>
                <ul class="mt-4 space-y-2 text-base y">
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Take at least 1 week off work</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Use ice and cold badges to reduce swelling</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Take all prescribed medication</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Sleep with your head up for the first 3-4 days</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Do gentle exercises as instructed by your surgeon</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Avoid scratching or touching the surgical area</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Avoid spicy food</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Avoid smoking and drinking alcohol</span>
                    </li>
                </ul>
                <p class="mt-4 text-base text-secondaryLight">Regarding showering: You may shower from the
                    second day without wetting the nasal plaster or bands inside your nose.</p>
                <p class="mt-3 text-base text-secondaryLight">Regarding massages: Lymphatic massages on the face
                    are highly recommended for reducing edema and accelerating healing. Gentle massages for the first 6
                    months post-op reportedly help reshaping and settling the nose.</p>
            </div>
            <div class="flex flex-col gap-4">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image-435-1.webp" alt=""
                    class="w-full rounded-[20px] object-cover">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image-436-1.webp" alt=""
                    class="w-full rounded-[20px] object-cover">
            </div>
        </div>
    </div>
</section>
<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="grid items-center gap-10 lg:grid-cols-2">
            <div>
                <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                    Important <br><span class="">Aftercare Instructions</span></h2>
                <p class="mt-5 text-base text-secondaryLight">Rhinoplasty is an important procedure that
                    requires time and care for recovery. Other than the above-mentioned instructions, here are a set of
                    aftercare bullet points for the longer-term recovery:</p>
                <ul class="mt-4 space-y-2 text-base y">
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Avoid sports for at least 1 month</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Avoid high-intensity training for 3 months</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Follow a nutritious diet</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Drink plenty of water</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>If you have to sneeze, do it with your mouth open</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Do not blow your nose for 2 weeks after surgery</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Avoid heat, saunas, hot showers and sun exposure for at least 1 month. Use 50-factor
                            sun creams for at least 2 months</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Do not wear any kind of glasses for 2 months after surgery. Contact lenses can be
                            worn after the 3rd day</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg viewBox="0 0 24 24" fill="#268ca1" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" fill="#268ca1" opacity="0.15"></rect>
                            <rect x="7" y="11" width="10" height="2.5" rx="1.25" fill="#268ca1"></rect>
                        </svg>
                        <span>Do not drive on the first week after surgery</span>
                    </li>
                </ul>
            </div>
            <div class="flex justify-center"><img
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/image-447.webp"
                    alt="Rhinoplasty aftercare" class="w-full rounded-[24px] object-cover"></div>
        </div>
    </div>
</section>
<?php get_template_part('template-parts/treatment/faqs'); ?>
<?php get_footer(); ?>