<?php
$transformations = get_field('transformations');

if ($transformations):

    $transformations_title = $transformations['title'] ?? '';
    $transformation_cards = $transformations['transformation_card'] ?? '';
    ?>

    <section class="-full bg-[#f5f5f5] py-12">

        <!-- Section Title -->
        <div class="container mx-auto px-4 text-center mt-[82px] mb-[22px]">

            <?php if ($transformations_title): ?>
                <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                    <?php echo esc_html($transformations_title); ?>
                </h2>
            <?php endif; ?>

        </div>

        <!-- Transformation Slider -->
        <?php if ($transformation_cards): ?>

            <div class="container relative mx-auto px-4">

                <!-- Previous Button -->
                <button type="button"
                    class="transformation-prev absolute left-0 top-1/2 z-30 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-md"
                    aria-label="Previous">
                    <svg class="h-4 w-4 text-[#4d7cff]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                </button>

                <!-- Slick Slider -->
                <div id="transformation-slider" class="transformation-slider">

                    <?php foreach ($transformation_cards as $card):

                        $card_image = $card['image'] ?? '';
                        $card_title = $card['title'] ?? '';
                        $card_content = $card['content'] ?? '';
                        $card_link = $card['link'] ?? '';

                        ?>

                        <div class="px-2">

                            <div
                                class="relative w-full h-[300px] sm:h-[300px] lg:h-[450px] overflow-hidden rounded-[30px] bg-[#d9dde0]">

                                <!-- Image -->
                                <?php if ($card_image): ?>

                                    <?php
                                    if (is_array($card_image)) {
                                        $image_url = $card_image['url'] ?? '';
                                        $image_alt = $card_image['alt'] ?? $card_title;
                                    } else {
                                        $image_url = $card_image;
                                        $image_alt = $card_title;
                                    }
                                    ?>

                                    <?php if ($image_url): ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>"
                                            class="absolute inset-0 w-full h-full object-cover object-center">
                                    <?php endif; ?>

                                <?php endif; ?>


                                <!-- Glass Card -->
                                <div
                                    class="absolute left-3 right-3 !bottom-3 flex flex-col items-center justify-center rounded-[27px] border border-white/50 bg-black/30 backdrop-blur-[14px] shadow-[0_12px_35px_rgba(0,0,0,0.18)] px-5 py-5">

                                    <?php if ($card_title): ?>
                                        <h3 class="text-lg text-white text-center">
                                            <?php echo esc_html($card_title); ?>
                                        </h3>
                                    <?php endif; ?>


                                    <?php if ($card_content): ?>
                                        <div class="text-sm !text-white/90 text-center">
                                            <?php echo apply_filters('the_content', $card_content); ?>
                                        </div>
                                    <?php endif; ?>


                                    <?php if ($card_link): ?>
                                        <a href="<?php echo esc_url($card_link); ?>" class="mt-3 btn-consult">
                                            See Details
                                        </a>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

                <!-- Next Button -->
                <button type="button"
                    class="transformation-next absolute right-0 top-1/2 z-30 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-md"
                    aria-label="Next">
                    <svg class="h-4 w-4 text-[#4d7cff]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 18l6-6-6-6" />
                    </svg>
                </button>

            </div>

        <?php endif; ?>


        <!-- Bottom Text -->
        <p class="text-center mt-4 text-xl text-secondaryLight">
            Tell us what treatments you're looking for. We'll build you a bespoke package.
        </p>

    </section>

<?php endif; ?>