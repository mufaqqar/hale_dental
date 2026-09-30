<?php
$free_qoute = get_field('free_qoute');

if (!$free_qoute) {
    return;
}

$quote_subtitle    = $free_qoute['subtitle'] ?? '';
$quote_title       = $free_qoute['title'] ?? '';
$quote_description = $free_qoute['description'] ?? '';

$quote_cta = $free_qoute['cta'] ?? [];

$cta_title       = $quote_cta['title'] ?? '';
$cta_description = $quote_cta['description'] ?? '';
$cta_best_suited = $quote_cta['best_suited'] ?? '';
$cta_timeline    = $quote_cta['typical_timeline'] ?? '';
$cta_bottom_desc = $quote_cta['bootom_desc'] ?? '';
$cta_bgimage     = $quote_cta['bgimage'] ?? '';

$cta_bgimage_url = '';
if (is_array($cta_bgimage)) {
    $cta_bgimage_url = $cta_bgimage['url'] ?? '';
} elseif (is_numeric($cta_bgimage)) {
    $cta_bgimage_url = wp_get_attachment_image_url((int) $cta_bgimage, 'full');
} elseif (is_string($cta_bgimage)) {
    $cta_bgimage_url = $cta_bgimage;
}

/**
 * "best_suited" and "typical_timeline" are WYSIWYG fields that hold a label on
 * the first line and the body copy underneath it, so split the two out before
 * rendering them in their separately styled blocks.
 */
$split_label = function ($content) {
    $lines = array_values(array_filter(
        array_map('trim', preg_split('/\r\n|\r|\n/', wp_strip_all_tags((string) $content))),
        'strlen'
    ));

    return [
        'label' => $lines[0] ?? '',
        'text'  => trim(implode(' ', array_slice($lines, 1))),
    ];
};

$best_suited = $split_label($cta_best_suited);
$timeline    = $split_label($cta_timeline);

$highlights = array_values(array_filter(
    array_map('trim', preg_split('/\r\n|\r|\n/', wp_strip_all_tags((string) $cta_bottom_desc))),
    'strlen'
));
?>

<section class="overflow-hidden bg-[#FAFAFA] py-14 md:py-20">
    <div class="container mx-auto px-4">
        <?php if ($quote_subtitle): ?>
            <div
                class="mb-4 flex items-center justify-center gap-[clamp(12px,1.4vw,20px)] text-[clamp(0.74rem,0.85vw,0.86rem)] font-semibold uppercase tracking-[0.2em] text-coff_black">
                <span aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span><?php
                echo esc_html($quote_subtitle); ?><span
                    aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span>
            </div>
        <?php endif; ?>
        <?php if ($quote_title): ?>
            <h2
                class="mx-auto max-w-[40ch] text-center font-serif text-[clamp(2rem,3vw,3.2rem)] leading-[1.12] font-bold tracking-[-0.02em] text-coff_black">
                <?php echo esc_html($quote_title); ?></h2>
        <?php endif; ?>
        <?php if ($quote_description): ?>
            <div
                class="mx-auto mt-5 max-w-[64ch] text-center text-[17px] leading-[1.62] text-secondaryLight [&amp;_p]:m-0">
                <?php echo wp_kses_post($quote_description); ?></div>
        <?php endif; ?>
        <div class="mt-8 md:mt-11">
            <div
                class="overflow-hidden rounded-[30px] bg-secondary text-white shadow-[0_24px_60px_rgba(17,17,17,0.2)]">
                <div class="grid md:grid-cols-[0.42fr_0.58fr]">
                    <div
                        class="relative min-h-56 bg-secondary md:min-h-[clamp(280px,32vw,500px)] md:[clip-path:polygon(0_0,100%_0,68%_100%,0_100%)]">
                        <?php if ($cta_bgimage_url): ?>
                            <img src="<?php echo esc_url($cta_bgimage_url); ?>" alt="" loading="lazy" decoding="async"
                                aria-hidden="true"
                                class="absolute inset-0 h-full w-full object-cover transition-opacity duration-500 opacity-100">
                        <?php endif; ?>
                    </div>
                    <div class="px-6 py-6 md:px-9 md:py-8">
                        <p class="mb-3 text-[11px] font-semibold uppercase tracking-[0.18em] text-coffGreen">Smile line
                        </p>
                        <?php if ($cta_title): ?>
                            <h3
                                class="font-serif text-[clamp(1.5rem,2.5vw,2.4rem)] leading-[1.1] font-medium tracking-[-0.024em] text-white">
                                <?php echo esc_html($cta_title); ?></h3>
                        <?php endif; ?>
                        <?php if ($cta_description): ?>
                            <div class="mt-4 text-[16px] leading-[1.56] text-white/80 [&amp;_p]:m-0">
                                <?php echo wp_kses_post($cta_description); ?></div>
                        <?php endif; ?>
                        <?php if ($best_suited['label'] || $best_suited['text'] || $timeline['label'] || $timeline['text']): ?>
                            <div class="mt-6 grid grid-cols-2 gap-x-7">

                                <?php if ($best_suited['label'] || $best_suited['text']): ?>
                                    <div>
                                        <?php if ($best_suited['label']): ?>
                                            <div
                                                class="mb-1.5 text-[10px] font-semibold uppercase tracking-[0.16em] text-coffGreen">
                                                <?php echo esc_html($best_suited['label']); ?></div>
                                        <?php endif; ?>
                                        <?php if ($best_suited['text']): ?>
                                            <p class="m-0 text-sm leading-normal text-white/80">
                                                <?php echo esc_html($best_suited['text']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($timeline['label'] || $timeline['text']): ?>
                                    <div class="border-l border-white/15 pl-7">
                                        <?php if ($timeline['label']): ?>
                                            <div
                                                class="mb-1.5 text-[10px] font-semibold uppercase tracking-[0.16em] text-coffGreen">
                                                <?php echo esc_html($timeline['label']); ?></div>
                                        <?php endif; ?>
                                        <?php if ($timeline['text']): ?>
                                            <p class="m-0 text-sm leading-normal text-white/80">
                                                <?php echo esc_html($timeline['text']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                        <?php if ($highlights): ?>
                            <ul class="m-0 mt-6 list-none space-y-1.5 p-0">

                                <?php foreach ($highlights as $highlight): ?>

                                    <li
                                        class="flex items-center gap-3.5 text-[15px] leading-snug text-white/90">
                                        <span aria-hidden="true"
                                            class="h-[1.5px] w-5 shrink-0 rounded bg-coffGreen"></span><?php
                                        echo esc_html($highlight); ?>
                                    </li>

                                <?php endforeach; ?>

                            </ul>
                        <?php endif; ?>
                        <div class="mt-7 flex flex-wrap items-center gap-x-6 gap-y-3"><a
                                href="<?php echo esc_url(home_url('/contact-us')); ?>"
                                class="inline-flex items-center gap-2.5 rounded-full bg-coffGreen px-6 py-3 text-sm font-semibold whitespace-nowrap text-white shadow-[0_8px_20px_rgba(74,125,255,0.28)] transition hover:-translate-y-0.5 hover:brightness-110">Get
                                My Free Quote<svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.9" stroke-linecap="round"
                                    stroke-linejoin="round" aria-hidden="true">
                                    <path d="M5 12h13M13 6l6 6-6 6"></path>
                                </svg></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>