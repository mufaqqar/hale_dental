<?php
$whyus = get_field('whyus');

if (!$whyus) {
    return;
}

$whyus_subtitle    = $whyus['subtitle'] ?? '';
$whyus_title       = $whyus['title'] ?? '';
$whyus_description = $whyus['description'] ?? '';
$whyus_cards       = $whyus['card'] ?? [];
?>

<section class="overflow-hidden bg-[#FAFAFA] py-14 md:py-20">
    <div class="container mx-auto px-4">
<div class="mx-auto max-w-[820px] text-center">
    <?php if ($whyus_subtitle): ?>
        <div
            class="mb-4 flex items-center justify-center gap-[clamp(12px,1.4vw,20px)] text-[clamp(0.74rem,0.85vw,0.86rem)] font-semibold uppercase tracking-[0.2em] text-coff_black">
            <span aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span><?php
            echo esc_html($whyus_subtitle); ?><span
                aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span>
        </div>
    <?php endif; ?>
    <?php if ($whyus_title): ?>
        <h2
            class="mx-auto max-w-[26ch] font-serif text-[clamp(1.9rem,3.6vw,3.5rem)] leading-[1.1] font-bold tracking-[-0.03em] text-coff_black">
            <?php echo esc_html($whyus_title); ?></h2>
    <?php endif; ?>
    <?php if ($whyus_description): ?>
        <div class="mt-5 mx-auto max-w-[56ch] text-[17px] leading-[1.55] text-secondaryLight [&amp;_p]:m-0">
            <?php echo wp_kses_post($whyus_description); ?></div>
    <?php endif; ?>
</div>
<?php if ($whyus_cards): ?>
    <div class="mt-8 grid gap-7 sm:grid-cols-2 lg:grid-cols-3 md:mt-12">

        <?php
        foreach ($whyus_cards as $card):
            $card_title       = $card['title'] ?? '';
            $card_description = $card['description'] ?? '';
            $card_image       = $card['image'] ?? '';

            $card_image_url = '';
            if (is_array($card_image)) {
                $card_image_url = $card_image['url'] ?? '';
            } elseif (is_numeric($card_image)) {
                $card_image_url = wp_get_attachment_image_url((int) $card_image, 'full');
            } elseif (is_string($card_image)) {
                $card_image_url = $card_image;
            }
            ?>

            <article
                class="flex flex-col rounded-[20px] border border-coff_black/10 bg-white p-4 pb-7 shadow-[0_4px_14px_rgba(17,17,17,0.04)]">
                <figure class="relative m-0 mb-10">
                    <?php if ($card_image_url): ?>
                        <img src="<?php echo esc_url($card_image_url); ?>"
                            alt="<?php echo esc_attr($card_title); ?>" loading="lazy" decoding="async"
                            class="aspect-[784/417] w-full rounded-[15px] object-cover">
                    <?php endif; ?>
                </figure>
                <?php if ($card_title): ?>
                    <h3
                        class="mb-2 px-1 font-serif text-[clamp(1.05rem,1.25vw,1.25rem)] leading-[1.28] font-semibold tracking-[-0.012em] text-coff_black">
                        <?php echo esc_html($card_title); ?></h3>
                <?php endif; ?>
                <?php if ($card_description): ?>
                    <div
                        class="m-0 max-w-[36ch] px-1 text-[15px] leading-[1.58] text-secondaryLight [&amp;_p]:m-0">
                        <?php echo wp_kses_post($card_description); ?></div>
                <?php endif; ?>
            </article>

        <?php endforeach; ?>

    </div>
<?php endif; ?>
    </div>
</section>