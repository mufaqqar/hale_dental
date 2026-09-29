<?php
$section = get_field('section_with_box_icons');

if ($section) :

    $heading     = $section['heading'] ?? '';
    $description = $section['description'] ?? '';
    $icon_boxes  = $section['icon_box'] ?? [];
?>

<section class="py-16">
    <div class="container mx-auto px-4 flex md:flex-row flex-col gap-6 items-center">

        <!-- Left Content -->
        <div class="md:w-1/2 w-full">

            <?php if ($heading) : ?>
                <h2 class="md:text-5xl text-3xl text-coff_black tracking-tight">
                    <?php echo esc_html($heading); ?>
                </h2>
            <?php endif; ?>

            <?php if ($description) : ?>
                <div class="text-lg text-coff_black leading-relaxed max-w-xl mt-4">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>

        </div>


        <!-- Icon Boxes -->
        <?php if ($icon_boxes) : ?>

            <div class="md:w-1/2 w-full grid grid-cols-2 gap-4">

                <?php foreach ($icon_boxes as $box) :

                    $icon        = $box['icon'] ?? '';
                    $title       = $box['title'] ?? '';
                    $box_content = $box['description'] ?? '';

                ?>

                    <div class="rounded-2xl border border-primary/10 bg-amber-50 p-5 md:p-6">

                        <?php if ($icon) : ?>
                            <div class="mb-4">

                                <?php
                                /*
                                 * If icon is an ACF Image field
                                 */
                                if (is_array($icon) && !empty($icon['url'])) :
                                ?>

                                    <img
                                        src="<?php echo esc_url($icon['url']); ?>"
                                        alt="<?php echo esc_attr($icon['alt'] ?: $title); ?>"
                                        class="h-9 w-9 object-contain"
                                    >

                                <?php
                                elseif (is_numeric($icon)) :
                                    echo wp_get_attachment_image(
                                        $icon,
                                        'thumbnail',
                                        false,
                                        [
                                            'class' => 'h-9 w-9 object-contain',
                                            'alt'   => $title,
                                        ]
                                    );

                                else :
                                    echo wp_kses_post($icon);
                                endif;
                                ?>

                            </div>
                        <?php endif; ?>


                        <?php if ($title) : ?>
                            <h4 class="text-base text-primary md:text-lg">
                                <?php echo esc_html($title); ?>
                            </h4>
                        <?php endif; ?>


                        <?php if ($box_content) : ?>
                            <div class="mt-1 text-sm text-secondaryLight">
                                <?php echo wp_kses_post($box_content); ?>
                            </div>
                        <?php endif; ?>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>
</section>

<?php endif; ?>