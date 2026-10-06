<?php
$about = get_field('about');

if (!$about) {
    return;
}

$about_subtitle = $about['subtitle'] ?? '';
$about_title = $about['title'] ?? '';
$about_description = $about['description'] ?? '';
$about_image = $about['image'] ?? '';
$about_icon_box = $about['icon_box'] ?? [];

$about_image_url = '';
if (is_array($about_image)) {
    $about_image_url = $about_image['url'] ?? '';
} elseif (is_numeric($about_image)) {
    $about_image_url = wp_get_attachment_image_url((int) $about_image, 'full');
} elseif (is_string($about_image)) {
    $about_image_url = $about_image;
}

/**
 * The ACF "icon" field is an icon_picker, so it may resolve to an image, an
 * attachment ID, a dashicon class or raw SVG markup. Normalise all four into
 * a single markup string.
 */
$render_icon = function ($icon) {
    if (is_array($icon) && !empty($icon['url'])) {
        return '<img src="' . esc_url($icon['url']) . '" alt="" class="h-8 w-8 object-contain">';
    }

    if (is_numeric($icon)) {
        return wp_get_attachment_image((int) $icon, 'thumbnail', false, [
            'class' => 'h-8 w-8 object-contain',
            'alt' => '',
        ]);
    }

    if (!is_string($icon) || '' === trim($icon)) {
        return '';
    }

    if (strpos($icon, '<svg') === 0) {
        return $icon;
    }

    if (strpos($icon, 'dashicons') === 0) {
        return '<span class="' . esc_attr($icon) . ' text-[30px] leading-none"></span>';
    }

    return '<svg width="34" height="34" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.5" '
        . 'stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $icon . '</svg>';
};

$fallback_icons = [
    '<circle cx="32" cy="32" r="21"></circle><path d="M11 32h42M32 11c7 6.4 7 35.6 0 42M32 11c-7 6.4-7 35.6 0 42M15.5 20.5c9.6 4.4 23.4 4.4 33 0M15.5 43.5c9.6-4.4 23.4-4.4 33 0"></path>',
    '<path d="M32 11l17 6.6v12.8c0 10.4-6.9 18.4-17 21.6-10.1-3.2-17-11.2-17-21.6V17.6z"></path>',
    '<circle cx="32" cy="24" r="9"></circle><path d="M14 53c0-9.4 8-15 18-15s18 5.6 18 15"></path>',
    '<circle cx="32" cy="32" r="21"></circle><path d="M39 24.5c-1.8-1.8-4.3-2.9-7-2.9-5.5 0-10 4.7-10 10.4s4.5 10.4 10 10.4c2.7 0 5.2-1.1 7-2.9M20 29.5h13M20 34.5h11"></path>',
];
?>

<section class="relative overflow-hidden bg-[#FAFAFA]">

    <div class="container mx-auto px-4 ">
        <div aria-hidden="true" class="absolute inset-0 left-[44%] hidden lg:block">
            <?php if ($about_image_url): ?>
                <img src="<?php echo esc_url($about_image_url); ?>" alt="" loading="lazy" decoding="async"
                    class="h-full w-full object-cover">
            <?php endif; ?>
            <span
                class="absolute inset-0 bg-[linear-gradient(90deg,#FAFAFA_0%,rgba(250,250,250,0.75)_8%,rgba(250,250,250,0.45)_16%,rgba(250,250,250,0.2)_26%,rgba(250,250,250,0.06)_36%,transparent_46%)]"></span><span
                class="absolute inset-x-0 bottom-0 h-[22%] bg-[linear-gradient(180deg,transparent_0%,rgba(250,250,250,0.5)_70%,#FAFAFA_100%)]"></span>
        </div>
        <span
            class="absolute top-6 right-6 z-10 hidden items-center gap-2 rounded-full bg-[rgba(250,250,250,0.92)] px-[18px] py-2.5 text-[13px] font-semibold text-coff_black shadow-[0_8px_22px_rgba(17,17,17,0.12)] backdrop-blur-sm lg:inline-flex"><svg
                width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 21s7-6.5 7-12a7 7 0 10-14 0c0 5.5 7 12 7 12z"></path>
                <circle cx="12" cy="9" r="2.4"></circle>
            </svg>Ilam Din Dental, Istanbul</span>
        <div class="container relative z-10 py-14 md:py-20">
            <div class="lg:max-w-[46%]">
                <?php if ($about_subtitle): ?>
                    <div
                        class="mb-4 flex items-center gap-3.5 text-[clamp(0.74rem,0.85vw,0.86rem)] font-semibold uppercase tracking-[0.2em] text-coff_black">
                        <span aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span><?php
                        echo esc_html($about_subtitle); ?>
                    </div>
                <?php endif; ?>
                <?php if ($about_title): ?>
                    <h2
                        class="font-serif text-[clamp(2rem,3vw,3.2rem)] leading-[1.12] font-bold tracking-[-0.02em] text-coff_black">
                        <?php echo esc_html($about_title); ?>
                    </h2>
                <?php endif; ?>
                <?php if ($about_description): ?>
                    <div class="mt-5 max-w-[52ch] text-[17px] leading-[1.62] text-secondaryLight [&amp;_p]:m-0">
                        <?php echo wp_kses_post($about_description); ?>
                    </div>
                <?php endif; ?>
                <?php if ($about_icon_box): ?>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2">

                        <?php foreach ($about_icon_box as $key => $box):
                            $box_title = $box['title'] ?? '';
                            $box_description = $box['description'] ?? '';
                            $box_icon = $render_icon($box['icon'] ?? '');

                            if ('' === $box_icon) {
                                $box_icon = $render_icon($fallback_icons[$key % count($fallback_icons)]);
                            }
                            ?>

                            <div
                                class="rounded-2xl border border-coff_black/10 bg-white p-5 shadow-[0_6px_16px_rgba(17,17,17,0.05)]">
                                <?php if ($box_icon): ?>
                                    <div class="mb-3 text-coffGreen"><?php echo $box_icon; ?></div>
                                <?php endif; ?>
                                <?php if ($box_title): ?>
                                    <h3
                                        class="font-serif text-[17px] leading-[1.25] font-semibold tracking-[-0.01em] text-coff_black">
                                        <?php echo esc_html($box_title); ?>
                                    </h3>
                                <?php endif; ?>
                                <?php if ($box_description): ?>
                                    <div
                                        class="space-y-3 [&amp;_a]:underline [&amp;_a]:underline-offset-2 mt-1 text-[13px] leading-[1.4] text-secondaryLight/90">
                                        <?php echo wp_kses_post($box_description); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>