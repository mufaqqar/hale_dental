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

            <a href="<?php echo esc_url(get_post_type_archive_link('treatments') ?: home_url('/')); ?>"
                class="mt-4 inline-flex h-[43px] items-center justify-center rounded-full border border-[#dedede] px-5 text-[11px]   text-black transition duration-300 hover:bg-black hover:text-white">
                See More Smiles
            </a>
        </div>
    </div>

    <div class=" mx-auto px-4 grid md:grid-cols-4 grid-cols-1 gap-4">
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
        ];

        foreach ($smiles as $index => $smile):

            $before_url = get_template_directory_uri() . '/assets/' . $smile['before'];
            $after_url = get_template_directory_uri() . '/assets/' . $smile['after'];

            ?>

            <div class="">

                <div class="smile-card relative h-[287px] w-full overflow-hidden rounded-[40px] bg-gray-200 select-none"
                    data-before-after>

                    <!-- =========================
             AFTER IMAGE
                ========================== -->
                    <img src="<?php echo esc_url($after_url); ?>" alt="After smile transformation"
                        class="absolute inset-0 h-full w-full object-cover" draggable="false">


                    <!-- =========================
             BEFORE IMAGE
                ========================== -->
                    <div class="before-image absolute inset-0 overflow-hidden" style="clip-path: inset(0 50% 0 0);">
                        <img src="<?php echo esc_url($before_url); ?>" alt="Before smile transformation"
                            class="absolute inset-0 h-full w-full object-cover" draggable="false">
                    </div>


                    <!-- =========================
             DIVIDER
                ========================== -->
                    <div
                        class="slider-line pointer-events-none absolute left-1/2 top-0 z-20 h-full w-[2px] -translate-x-1/2 bg-coffGreen">
                    </div>


                    <!-- =========================
             HANDLE
                ========================== -->
                    <div
                        class="slider-handle absolute left-1/2 top-1/2 z-30 flex h-[45px] w-[45px] -translate-x-1/2 -translate-y-1/2 cursor-ew-resize items-center justify-center rounded-full border border-coffGreen bg-coffGreen text-white shadow-sm">
                        <span class="text-[25px] leading-none">‹›</span>
                    </div>


                    <!-- =========================
             BEFORE LABEL
                ========================== -->
                    <span
                        class="pointer-events-none absolute left-[16px] top-1/2 z-30 -translate-y-1/2 rounded-[3px] bg-black/60 px-[10px] py-[7px] text-[10px] text-white">
                        Before
                    </span>


                    <!-- =========================
             AFTER LABEL
                ========================== -->
                    <span
                        class="pointer-events-none absolute right-[16px] top-1/2 z-30 -translate-y-1/2 rounded-[3px] bg-black/60 px-[10px] py-[7px] text-[10px] text-white">
                        After
                    </span>

                </div>

            </div>

        <?php endforeach; ?>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        document.querySelectorAll('[data-before-after]').forEach((slider) => {

            const before = slider.querySelector('.before-image');
            const line = slider.querySelector('.slider-line');
            const handle = slider.querySelector('.slider-handle');

            let dragging = false;


            /*
            |--------------------------------------------------------------------------
            | UPDATE SLIDER
            |--------------------------------------------------------------------------
            */

            const moveSlider = (clientX) => {

                const rect = slider.getBoundingClientRect();

                let percentage =
                    ((clientX - rect.left) / rect.width) * 100;

                // Limit between 0 and 100
                percentage = Math.max(
                    0,
                    Math.min(100, percentage)
                );


                // Clip BEFORE image
                before.style.clipPath =
                    `inset(0 ${100 - percentage}% 0 0)`;


                // Move divider
                line.style.left = `${percentage}%`;


                // Move handle
                handle.style.left = `${percentage}%`;

            };


            /*
            |--------------------------------------------------------------------------
            | MOUSE DOWN
            |--------------------------------------------------------------------------
            */

            slider.addEventListener('mousedown', (event) => {

                dragging = true;

                moveSlider(event.clientX);

            });


            /*
            |--------------------------------------------------------------------------
            | MOUSE MOVE
            |--------------------------------------------------------------------------
            */

            window.addEventListener('mousemove', (event) => {

                if (!dragging) {
                    return;
                }

                moveSlider(event.clientX);

            });


            /*
            |--------------------------------------------------------------------------
            | MOUSE UP
            |--------------------------------------------------------------------------
            */

            window.addEventListener('mouseup', () => {

                dragging = false;

            });


            /*
            |--------------------------------------------------------------------------
            | TOUCH START
            |--------------------------------------------------------------------------
            */

            slider.addEventListener(
                'touchstart',
                (event) => {

                    dragging = true;

                    moveSlider(
                        event.touches[0].clientX
                    );

                },
                {
                    passive: true
                }
            );


            /*
            |--------------------------------------------------------------------------
            | TOUCH MOVE
            |--------------------------------------------------------------------------
            */

            slider.addEventListener(
                'touchmove',
                (event) => {

                    if (!dragging) {
                        return;
                    }

                    moveSlider(
                        event.touches[0].clientX
                    );

                },
                {
                    passive: true
                }
            );


            /*
            |--------------------------------------------------------------------------
            | TOUCH END
            |--------------------------------------------------------------------------
            */

            slider.addEventListener(
                'touchend',
                () => {

                    dragging = false;

                }
            );


            /*
            |--------------------------------------------------------------------------
            | CLICK
            |--------------------------------------------------------------------------
            */

            slider.addEventListener('click', (event) => {

                moveSlider(event.clientX);

            });

        });

    });
</script>