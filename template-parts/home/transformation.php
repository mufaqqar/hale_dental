<?php
$transformations = get_field('transformations');

if ($transformations) :

    $transformations_title = $transformations['title'] ?? '';
    $transformation_cards = $transformations['transformation_card'] ?? '';
?>

<section class="w-full bg-[#f5f5f5] py-12">

    <!-- Section Title -->
    <div class="container mx-auto px-4 text-center mt-[82px] mb-[22px]">

        <?php if ($transformations_title) : ?>
            <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                <?php echo esc_html($transformations_title); ?>
            </h2>
        <?php endif; ?>

    </div>


    <!-- Transformation Cards -->
    <?php if ($transformation_cards) : ?>

        <div class="container mx-auto px-4 grid md:grid-cols-3 grid-cols-1 gap-5">

            <?php foreach ($transformation_cards as $card) :

                $card_image   = $card['image'] ?? '';
                $card_title   = $card['title'] ?? '';
                $card_content = $card['content'] ?? '';
                $card_link    = $card['link'] ?? '';

            ?>

                <div
                    class="relative w-full h-[300px] sm:h-[300px] lg:h-[450px] overflow-hidden rounded-[30px] bg-[#d9dde0]">

                    <!-- Image -->
                    <?php if ($card_image) : ?>

                        <?php
                        // If ACF image field returns an array
                        if (is_array($card_image)) {
                            $image_url = $card_image['url'] ?? '';
                            $image_alt = $card_image['alt'] ?? $card_title;
                        } else {
                            // If ACF image field returns URL
                            $image_url = $card_image;
                            $image_alt = $card_title;
                        }
                        ?>

                        <?php if ($image_url) : ?>
                            <img
                                src="<?php echo esc_url($image_url); ?>"
                                alt="<?php echo esc_attr($image_alt); ?>"
                                class="absolute inset-0 w-full h-full object-cover object-center">
                        <?php endif; ?>

                    <?php endif; ?>


                    <!-- Glass Card -->
                    <div
                        class="absolute left-3 right-3 !bottom-3 flex flex-col items-center justify-center rounded-[27px] border border-white/50 bg-white/10 backdrop-blur-[14px] shadow-[0_12px_35px_rgba(0,0,0,0.18)] px-5 py-5">

                        <?php if ($card_title) : ?>
                            <h3 class="text-lg text-coff_black text-center">
                                <?php echo esc_html($card_title); ?>
                            </h3>
                        <?php endif; ?>


                        <?php if ($card_content) : ?>
                            <div class="text-sm text-secondaryLight text-center">
                                <?php echo apply_filters('the_content', $card_content); ?>
                            </div>
                        <?php endif; ?>


                        <?php if ($card_link) : ?>
                            <a
                                href="<?php echo esc_url($card_link); ?>"
                                class="mt-3 btn-consult">
                                See Details
                            </a>
                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>


    <!-- Bottom Text -->
    <p class="text-center mt-4 text-xl text-secondaryLight">
        Tell us what treatments you're looking for. We'll build you a bespoke package.
    </p>

</section>

<?php endif; ?>