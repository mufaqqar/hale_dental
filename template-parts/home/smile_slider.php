<section class="w-full overflow-hidden bg-white py-10 md:py-14">
    <div class="container mx-auto px-4 mb-12 grid grid-cols-1 gap-8 md:grid-cols-2 md:gap-16">

        <div>
            <h2 class="md:text-5xl text-3xl   text-coff_black tracking-tight">
                New Smiles.<br>
                New Lives.
            </h2>
        </div>
        <div class="max-w-[430px] md:ml-auto">
            <p class="text-lg text-coff_black leading-relaxed max-w-xl">
                From a single veneer to a complete smile transformation
                Ilam Din Dental offers the full spectrum of cosmetic and
                restorative dental treatments for international patients.
            </p>

            <a href="#"
                class="mt-4 inline-flex h-[43px] items-center justify-center rounded-full border border-[#dedede] px-5 text-[11px]   text-black transition duration-300 hover:bg-black hover:text-white">
                See More Smiles
            </a>
        </div>

    </div>

    <div class="relative w-full">

        <div class="grid md:grid-cols-4 grid-cols-1 gap-5">

            <?php
            $smiles = [
                [
                    'before' => 'images/smile/before1.webp',
                    'after' => 'images/smile/after1.webp',
                ],
                [
                    'before' => 'images/smile/before1.webp',
                    'after' => 'images/smile/after1.webp',
                ],
                [
                    'before' => 'images/smile/before1.webp',
                    'after' => 'images/smile/after1.webp',
                ],
                [
                    'before' => 'images/smile/before1.webp',
                    'after' => 'images/smile/after1.webp',
                ],
                [
                    'before' => 'images/smile/before1.webp',
                    'after' => 'images/smile/after1.webp',
                ],
                [
                    'before' => 'images/smile/before1.webp',
                    'after' => 'images/smile/after1.webp',
                ],
                [
                    'before' => 'images/smile/before1.webp',
                    'after' => 'images/smile/after1.webp',
                ],
            ];

            foreach ($smiles as $index => $smile):

                $before_url = get_template_directory_uri() . '/assets/' . $smile['before'];
                $after_url = get_template_directory_uri() . '/assets/' . $smile['after'];

                ?>

                <div class="px-[12px]">

                    <div class="smile-card group relative h-[287px] w-full overflow-hidden rounded-[40px] bg-gray-200"
                        data-before-after>

                        <!-- =========================
             BEFORE IMAGE
        ========================== -->
                        <div class="absolute inset-0">

                            <img src="<?php echo esc_url($before_url); ?>" alt="Before smile transformation"
                                class="h-full w-full object-cover" draggable="false" />

                        </div>


                        <!-- =========================
             AFTER IMAGE
             Width controlled by slider
        ========================== -->
                        <div class="absolute inset-y-0 left-0 overflow-hidden" data-after-wrapper style="width: 50%;">

                            <img src="<?php echo esc_url($after_url); ?>" alt="After smile transformation"
                                class="absolute left-0 top-0 h-full w-full max-w-none object-cover" draggable="false"
                                data-after-image />

                        </div>


                        <!-- =========================
             CENTER DIVIDER
        ========================== -->
                        <div class="absolute top-0 z-20 h-full w-[2px] -translate-x-1/2 bg-[#d8b06a] cursor-ew-resize"
                            style="left: 50%;" data-divider></div>


                        <!-- =========================
             CENTER BUTTON
        ========================== -->
                        <button type="button" aria-label="Drag to compare before and after"
                            class="absolute top-1/2 z-30 flex h-[45px] w-[45px] -translate-x-1/2 -translate-y-1/2 cursor-ew-resize items-center justify-center rounded-full border border-[#d8b06a] bg-[#c6a45f] text-white shadow-sm"
                            style="left: 50%;" data-handle>
                            <span class="text-2xl leading-none">
                                ‹›
                            </span>
                        </button>


                        <!-- =========================
             BEFORE LABEL
        ========================== -->
                        <span
                            class="pointer-events-none absolute left-[16px] top-1/2 z-30 -translate-y-1/2 rounded-[3px] bg-black/60 px-[10px] py-[7px] text-[10px] text-white backdrop-blur-[2px]">
                            Before
                        </span>


                        <!-- =========================
             AFTER LABEL
        ========================== -->
                        <span
                            class="pointer-events-none absolute right-[16px] top-1/2 z-30 -translate-y-1/2 rounded-[3px] bg-black/60 px-[10px] py-[7px] text-[10px] text-white backdrop-blur-[2px]">
                            After
                        </span>

                    </div>

                </div>
            <?php endforeach; ?>

        </div>
    </div>

</section>