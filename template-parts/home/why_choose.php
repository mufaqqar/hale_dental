<?php
$why_choose = get_field('why_choose');

if ($why_choose):

    $section_title = $why_choose['title'] ?? '';
    $section_description = $why_choose['description'] ?? '';
    $services = $why_choose['list'] ?? [];
    ?>
    <section class="w-full bg-[#f5f5f5] py-[60px] md:py-[70px]">
        <div class="mx-auto w-full max-w-[1100px] px-5">
            <?php if ($section_title || $section_description): ?>
                <div class="mx-auto mb-[28px] max-w-[900px] text-center">
                    <?php if ($section_title): ?>
                        <h2 class="m-0 font-sans text-3xl tracking-tight text-coff_black md:text-5xl">
                            <?php echo esc_html($section_title); ?>
                        </h2>
                    <?php endif; ?>
                    <?php if ($section_description): ?>
                        <div class="mx-auto mt-[20px] max-w-[850px] font-sans text-lg leading-relaxed text-coff_black">
                            <?php echo wp_kses_post($section_description); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($services)): ?>
                <div id="services" class="overflow-hidden rounded-[14px] bg-white">
                    <?php foreach ($services as $index => $service): ?>
                        <?php
                        $title = $service['title'] ?? '';
                        $description = $service['description'] ?? '';
                        $image = $service['image'] ?? '';
                        $image_url = '';
                        if (is_array($image)) {
                            $image_url = $image['url'] ?? '';
                        } elseif (is_numeric($image)) {
                            $image_url = wp_get_attachment_image_url(
                                (int) $image,
                                'full'
                            );
                        } elseif (is_string($image)) {
                            $image_url = $image;
                        }
                        $is_active = ($index === 0);
                        ?>
                        <div class="service-item relative border-b border-[#dedede] last:border-b-0" data-service-item>
                            <button type="button"
                                class="service-button relative flex min-h-[61px] w-full items-center justify-between overflow-hidden px-[18px] py-[16px] text-left md:min-h-[61px]"
                                data-service-button aria-expanded="<?php echo $is_active ? 'true' : 'false'; ?>">
                                <div class="service-bg absolute inset-0 z-0 bg-cover bg-center bg-no-repeat transition-opacity duration-300 <?php echo $is_active ? 'opacity-100' : 'opacity-0'; ?>"
                                    <?php if ($image_url): ?> style="
                                        background-image:
                                        linear-gradient(
                                            rgba(0, 0, 0, 0.48),
                                            rgba(0, 0, 0, 0.48)
                                        ),
                                        url('<?php echo esc_url($image_url); ?>');
                                    " <?php endif; ?>></div>
                                <div class="relative z-10 pr-5">
                                    <?php if ($title): ?>
                                        <h3
                                            class="service-title m-0 font-sans text-[16px] leading-[1.25] transition-colors duration-300 md:text-[17px] <?php echo $is_active ? 'text-white' : 'text-[#333]'; ?>">
                                            <?php echo esc_html($title); ?>
                                        </h3>
                                    <?php endif; ?>
                                    <?php if ($description): ?>
                                        <div
                                            class="service-answer overflow-hidden transition-all duration-[400ms] ease-in-out <?php echo $is_active ? 'max-h-[100px] opacity-100' : 'max-h-0 opacity-0'; ?>">
                                            <div
                                                class="m-0 max-w-[600px] pt-[14px] font-sans text-[13px] leading-[1.45] text-white md:text-[15px]">
                                                <?php echo wp_kses_post($description); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <span
                                    class="service-icon relative z-10 flex h-[20px] w-[20px] shrink-0 items-center justify-center font-sans text-[20px] font-normal leading-none transition-all duration-300 <?php echo $is_active ? 'text-white' : 'text-black'; ?>">
                                    <?php echo $is_active ? '−' : '+'; ?>
                                </span>
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>