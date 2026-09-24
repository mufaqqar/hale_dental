<?php
$highlights = [
    'You are never left with a visible gap',
    'Gum contour shaped by the healing abutment',
    'Shade matched to the tooth beside it',
];
?>

<section class="overflow-hidden bg-[#FAFAFA] py-14 md:py-20">
    <div class="container mx-auto px-4">
        <div
            class="mb-4 flex items-center justify-center gap-[clamp(12px,1.4vw,20px)] text-[clamp(0.74rem,0.85vw,0.86rem)] font-semibold uppercase tracking-[0.2em] text-coff_black">
            <span aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span>One Missing
            Tooth<span aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span>
        </div>
        <h2
            class="mx-auto max-w-[40ch] text-center font-serif text-[clamp(2rem,3vw,3.2rem)] leading-[1.12] font-bold tracking-[-0.02em] text-coff_black">
            One Missing Tooth, One Implant</h2>
        <p class="mx-auto mt-5 max-w-[64ch] text-center text-[17px] leading-[1.62] text-secondaryLight">One procedure,
            several
            routes. Which one applies depends on the tooth, the bone beneath it and what is left in the socket — read
            on
            a CBCT scan, not from a photograph. You know which before you travel.</p>
        <div class="mt-8 md:mt-11">
            <div
                class="overflow-hidden rounded-[30px] bg-secondary text-white shadow-[0_24px_60px_rgba(17,17,17,0.2)]">
                <div class="grid md:grid-cols-[0.42fr_0.58fr]">
                    <div
                        class="relative min-h-56 bg-secondary md:min-h-[clamp(280px,32vw,500px)] md:[clip-path:polygon(0_0,100%_0,68%_100%,0_100%)]">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/singledentalImplant.webp"
                            alt="Single-Dental-Implant" loading="lazy" decoding="async" aria-hidden="false"
                            class="absolute inset-0 h-full w-full object-cover transition-opacity duration-500 opacity-100">
                    </div>
                    <div class="px-6 py-6 md:px-9 md:py-8">
                        <p class="mb-3 text-[11px] font-semibold uppercase tracking-[0.18em] text-coffGreen">Smile line
                        </p>
                        <h3
                            class="font-serif text-[clamp(1.5rem,2.5vw,2.4rem)] leading-[1.1] font-medium tracking-[-0.024em] text-white">
                            Single Tooth Implant</h3>
                        <div class="mt-4 text-[16px] leading-[1.56] text-white/80 [&amp;_p]:m-0">
                            <p>The hardest single implant to get right is the one people can see. Shade, gum line and
                                the way the crown emerges from the tissue matter as much as the post, so the whole
                                result is designed against your own adjacent tooth before anything is prepared.</p>
                        </div>
                        <div class="mt-6 grid grid-cols-2 gap-x-7">
                            <div>
                                <div
                                    class="mb-1.5 text-[10px] font-semibold uppercase tracking-[0.16em] text-coffGreen">
                                    Best suited for</div>
                                <p class="m-0 text-sm leading-normal text-white/80">One missing incisor
                                    or canine with an intact gum line.</p>
                            </div>
                            <div class="border-l border-white/15 pl-7">
                                <div
                                    class="mb-1.5 text-[10px] font-semibold uppercase tracking-[0.16em] text-coffGreen">
                                    Typical timeline</div>
                                <p class="m-0 text-sm leading-normal text-white/80">3–6 months
                                    integration, with a temporary tooth in place throughout.</p>
                            </div>
                        </div>
                        <ul class="m-0 mt-6 list-none space-y-1.5 p-0">

                            <?php foreach ($highlights as $highlight): ?>

                                <li
                                    class="flex items-center gap-3.5 text-[15px] leading-snug text-white/90">
                                    <span aria-hidden="true"
                                        class="h-[1.5px] w-5 shrink-0 rounded bg-coffGreen"></span><?php echo esc_html($highlight); ?>
                                </li>

                            <?php endforeach; ?>

                        </ul>
                        <div class="mt-7 flex flex-wrap items-center gap-x-6 gap-y-3"><a
                                href="<?php echo esc_url(home_url('/contact/')); ?>"
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