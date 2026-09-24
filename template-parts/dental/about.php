<?php
$stats = [
    [
        'title' => '25,000+ Smiles Transformed',
        'description' => 'Proven results, from a single missing tooth to full-arch reconstructions.',
        'icon' => '<circle cx="32" cy="32" r="21"></circle><path d="M11 32h42M32 11c7 6.4 7 35.6 0 42M32 11c-7 6.4-7 35.6 0 42M15.5 20.5c9.6 4.4 23.4 4.4 33 0M15.5 43.5c9.6-4.4 23.4-4.4 33 0"></path>',
    ],
    [
        'title' => '30+ Dental Specialists',
        'description' => 'Implant, aesthetic and restorative dentists working as one team.',
        'icon' => '<path d="M32 11l17 6.6v12.8c0 10.4-6.9 18.4-17 21.6-10.1-3.2-17-11.2-17-21.6V17.6z"></path>',
    ],
    [
        'title' => '360° Patient Care',
        'description' => 'Consultation, treatment, recovery and aftercare coordinated under one roof.',
        'icon' => '<circle cx="32" cy="24" r="9"></circle><path d="M14 53c0-9.4 8-15 18-15s18 5.6 18 15"></path>',
    ],
    [
        'title' => '15 Years Written Guarantee',
        'description' => 'Long-term support on eligible implant and restorative treatments.',
        'icon' => '<circle cx="32" cy="32" r="21"></circle><path d="M39 24.5c-1.8-1.8-4.3-2.9-7-2.9-5.5 0-10 4.7-10 10.4s4.5 10.4 10 10.4c2.7 0 5.2-1.1 7-2.9M20 29.5h13M20 34.5h11"></path>',
    ],
];
?>

<section class="relative overflow-hidden bg-[#FAFAFA]">

    <div class="container mx-auto px-4 ">
        <div aria-hidden="true" class="absolute inset-0 left-[44%] hidden lg:block">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/clinic.png" alt=""
                loading="lazy" decoding="async" class="h-full w-full object-cover"><span
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
                <div
                    class="mb-4 flex items-center gap-3.5 text-[clamp(0.74rem,0.85vw,0.86rem)] font-semibold uppercase tracking-[0.2em] text-coff_black">
                    <span aria-hidden="true" class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen"></span>About Ilam Din
                    Dental
                </div>
                <h2
                    class="font-serif text-[clamp(2rem,3vw,3.2rem)] leading-[1.12] font-bold tracking-[-0.02em] text-coff_black">
                    A Multidisciplinary Dental Clinic in the Heart of Istanbul.</h2>
                <p class="mt-5 max-w-[52ch] text-[17px] leading-[1.62] text-secondaryLight">Ilam Din Dental brings every
                    dental specialty under one roof — implants, veneers, orthodontics, restorative and aesthetic
                    dentistry. Cross-disciplinary dentist teams, multilingual coordination and internationally
                    recognised safety standards carry each patient from remote consultation and treatment planning
                    through to recovery and aftercare.</p>
                <div class="mt-8 grid gap-4 sm:grid-cols-2">

                    <?php foreach ($stats as $stat): ?>

                        <div
                            class="rounded-2xl border border-coff_black/10 bg-white p-5 shadow-[0_6px_16px_rgba(17,17,17,0.05)]">
                            <div class="mb-3 text-coffGreen"><svg width="34" height="34" viewBox="0 0 64 64"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" aria-hidden="true">
                                    <?php echo $stat['icon']; ?>
                                </svg></div>
                            <h3
                                class="font-serif text-[17px] leading-[1.25] font-semibold tracking-[-0.01em] text-coff_black">
                                <?php echo esc_html($stat['title']); ?></h3>
                            <div
                                class="space-y-3 [&amp;_a]:underline [&amp;_a]:underline-offset-2 mt-1 text-[13px] leading-[1.4] text-secondaryLight/90">
                                <p><?php echo esc_html($stat['description']); ?></p>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>