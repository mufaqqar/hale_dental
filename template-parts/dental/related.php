<?php
$treatments_archive = get_post_type_archive_link('treatments');

$related_treatments = get_posts([
    'post_type'      => 'treatments',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'no_found_rows'  => true,
]);
?>

<section class="relative overflow-hidden bg-[#FAFAFA] py-14 md:py-20">
    <div class="container relative z-10">
        <div class="text-center">
            <div
                class="mb-4 flex items-center justify-center gap-[clamp(12px,1.4vw,20px)] text-[clamp(0.72rem,0.82vw,0.84rem)] font-semibold uppercase tracking-[0.2em] text-coff_black">
                <span aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span>Keep
                Exploring<span aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span>
            </div>
            <h2
                class="mx-auto font-serif text-[clamp(1.9rem,3.3vw,3.2rem)] leading-[1.1] font-bold tracking-[-0.03em] text-coff_black">
                Every Stage of Your Implant, Explained</h2>
            <p class="mx-auto mt-4 max-w-[52ch] text-[17px] leading-[1.55] text-secondaryLight">Each stage has its own
                guide,
                from the first consultation to the crown that
                finishes the case. Read as much as you like — or skip it and let a surgeon tell you which stages
                actually apply to you.</p>

            <?php if ($treatments_archive || ! empty($related_treatments)): ?>

                <div class="mx-auto mt-8 flex max-w-[1160px] flex-wrap justify-center gap-3">

                    <?php if ($treatments_archive): ?>

                        <a href="<?php echo esc_url($treatments_archive); ?>"
                            class="group inline-flex items-center gap-3 rounded-2xl border border-coff_black/10 bg-white px-5 py-3.5 font-serif text-[16px] font-semibold tracking-[-0.01em] text-coff_black shadow-[0_4px_14px_rgba(17,17,17,0.04)] transition hover:-translate-y-0.5 hover:border-coffGreen/45 hover:shadow-[0_10px_24px_rgba(74,125,255,0.18)]">All
                            Dental Implant Options<svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                aria-hidden="true"
                                class="text-coffGreen transition-transform duration-300 group-hover:translate-x-1">
                                <path d="M5 12h13M13 6l6 6-6 6"></path>
                            </svg></a>

                    <?php endif; ?>

                    <?php foreach ($related_treatments as $treatment): ?>

                        <a href="<?php echo esc_url(get_permalink($treatment)); ?>"
                            class="group inline-flex items-center gap-3 rounded-2xl border border-coff_black/10 bg-white px-5 py-3.5 font-serif text-[16px] font-semibold tracking-[-0.01em] text-coff_black shadow-[0_4px_14px_rgba(17,17,17,0.04)] transition hover:-translate-y-0.5 hover:border-coffGreen/45 hover:shadow-[0_10px_24px_rgba(74,125,255,0.18)]"><?php echo esc_html(get_the_title($treatment)); ?><svg
                                width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"
                                class="text-coffGreen transition-transform duration-300 group-hover:translate-x-1">
                                <path d="M5 12h13M13 6l6 6-6 6"></path>
                            </svg></a>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>
        <div class="mx-auto mt-12 max-w-[880px] md:mt-14">
            <div
                class="relative rounded-[20px] border border-coffGreen/20 bg-secondary px-7 py-9 text-center shadow-[0_18px_44px_rgba(17,17,17,0.1)] md:px-12 md:py-10">
                <p
                    class="mb-4 flex items-center justify-center gap-2 text-[11px] font-bold uppercase tracking-[0.2em] text-coffGreen">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 2.6l1.7 4.9 4.9 1.7-4.9 1.7L12 15.8l-1.7-4.9L5.4 9.2l4.9-1.7z"></path>
                        <path d="M18.6 15l.8 2.3 2.3.8-2.3.8-.8 2.3-.8-2.3-2.3-.8 2.3-.8z" opacity="0.7"></path>
                    </svg>Personalised Care, Just for You
                </p>
                <h3
                    class="mx-auto m-0 max-w-[22ch] font-serif text-[clamp(1.5rem,2.2vw,2.1rem)] leading-[1.15] font-bold tracking-[-0.02em] text-white">
                    Get Your Single Implant Plan — Free, in 24 Hours</h3>
                <p class="mx-auto mt-4 mb-0 max-w-[58ch] text-[15px] leading-[1.6] text-white/75">Send a few photos of
                    your teeth, plus any X-ray you already have. An implant surgeon reviews your
                    case and replies with a realistic, itemised plan — how many implants you need, which system will be
                    used, what it costs with hotel and transfers included, and how many days you'll be in Istanbul.
                    No obligation, no pressure, no cost.</p><a href="<?php echo esc_url(home_url('/contact/')); ?>"
                    class="nc-shine group mt-8 inline-flex items-center gap-3 rounded-full bg-coffGreen py-2 pr-2 pl-8 text-[16px] font-semibold whitespace-nowrap text-white ring-1 ring-white/60 shadow-[0_12px_32px_rgba(74,125,255,0.45)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[0_18px_44px_rgba(74,125,255,0.6)] hover:brightness-110"><span
                        class="relative z-10">Get My Free Implant Plan</span><span
                        class="relative z-10 grid size-11 shrink-0 place-items-center rounded-full bg-white text-coffGreen shadow-[0_2px_8px_rgba(17,17,17,0.14)] transition-transform duration-300 group-hover:translate-x-0.5"><svg
                            width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h13M13 6l6 6-6 6"></path>
                        </svg></span></a>
            </div>
        </div>
    </div>
</section>