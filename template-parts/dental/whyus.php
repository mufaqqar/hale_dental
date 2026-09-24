<?php
$reasons = [
    [
        'image' => '1.png',
        'title' => 'Unmatched Implant Volume',
        'text' => 'High case volume means single-tooth placement, grafting and aesthetic-zone work are refined at scale.',
    ],
    [
        'image' => '2.png',
        'title' => 'Technology Parity',
        'text' => 'CBCT scanning, a guided surgical stent and a CAD/CAM crown are standard for one implant, not premium extras.',
    ],
    [
        'image' => '3.png',
        'title' => 'A Genuine Cost Difference',
        'text' => 'Lower operating costs can reduce treatment prices without requiring lower-grade implant systems.',
    ],
    [
        'image' => '4.png',
        'title' => 'Direct Flights to Istanbul',
        'text' => 'Istanbul is connected to hundreds of international destinations, making treatment travel easier to plan.',
    ],
    [
        'image' => '5.png',
        'title' => 'English-Speaking Care',
        'text' => 'International patient teams coordinate communication, treatment planning and aftercare in multiple languages.',
    ],
    [
        'image' => '6.png',
        'title' => 'Written Guarantees',
        'text' => 'Reputable dental implant clinics provide clear documentation and written coverage for eligible treatments.',
    ],
];
?>

<section class="overflow-hidden bg-[#FAFAFA] py-14 md:py-20">
    <div class="container mx-auto px-4">
        <div class="mx-auto max-w-[820px] text-center">
            <div
                class="mb-4 flex items-center justify-center gap-[clamp(12px,1.4vw,20px)] text-[clamp(0.74rem,0.85vw,0.86rem)] font-semibold uppercase tracking-[0.2em] text-coff_black">
                <span aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span>Why Turkey<span
                    aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span>
            </div>
            <h2
                class="mx-auto max-w-[26ch] font-serif text-[clamp(1.9rem,3.6vw,3.5rem)] leading-[1.1] font-bold tracking-[-0.03em] text-coff_black">
                Is It Worth Flying to Turkey for One Implant?</h2>
            <p class="mt-5 mx-auto max-w-[56ch] text-[17px] leading-[1.55] text-secondaryLight">It is a fair question
                when
                only one tooth is missing. The answer is that a single implant here is
                the same Swiss or Swedish system, placed under the same CBCT-guided protocol, by a team that does this
                every day — and the difference in price is large enough to cover the flight several times over,
                with hotel, transfers and interpreter already in the figure.</p>
        </div>
        <div class="mt-8 grid gap-7 sm:grid-cols-2 lg:grid-cols-3 md:mt-12">

            <?php foreach ($reasons as $key => $reason): ?>

                <article
                    class="flex flex-col rounded-[20px] border border-coff_black/10 bg-white p-4 pb-7 shadow-[0_4px_14px_rgba(17,17,17,0.04)]">
                    <figure class="relative m-0 mb-10"><img
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/whyus/<?php echo esc_attr($reason['image']); ?>"
                            alt="<?php echo esc_attr($reason['title']); ?>" loading="lazy" decoding="async"
                            class="aspect-[784/417] w-full rounded-[15px] object-cover"></figure>
                    <h3
                        class="mb-2 px-1 font-serif text-[clamp(1.05rem,1.25vw,1.25rem)] leading-[1.28] font-semibold tracking-[-0.012em] text-coff_black">
                        <?php echo esc_html($reason['title']); ?></h3>
                    <p class="m-0 max-w-[36ch] px-1 text-[15px] leading-[1.58] text-secondaryLight">
                        <?php echo esc_html($reason['text']); ?></p>
                </article>

            <?php endforeach; ?>

        </div>
    </div>
</section>