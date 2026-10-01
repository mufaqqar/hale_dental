<?php
$doctors = get_field('doctors_detail');

if (!empty($doctors) && is_array($doctors)) :
?>

<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6">

        <div
            class="mb-6 flex items-center justify-center gap-[clamp(12px,1.4vw,20px)] text-[clamp(0.72rem,0.82vw,0.84rem)] font-semibold uppercase tracking-[0.22em] text-coff_black md:mb-8">

            <span
                aria-hidden="true"
                class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen">
            </span>

            Meet the Implant Dentists Who Will Treat You

            <span
                aria-hidden="true"
                class="h-px w-[clamp(24px,3vw,52px)] bg-coffGreen">
            </span>

        </div>


        <!-- DOCTOR TABS -->
        <div class="relative mb-10">

            <div
                id="doctor-tabs"
                class="flex items-start justify-center gap-5 sm:gap-7 lg:gap-8 pb-4">

                <?php foreach ($doctors as $index => $doctor) : ?>

                    <?php
                    $image = $doctor['image'] ?? '';

                    if (is_array($image)) {
                        $image_url = $image['url'] ?? '';
                        $image_alt = $image['alt'] ?? ($doctor['title'] ?? '');
                    } elseif (is_numeric($image)) {
                        $image_url = wp_get_attachment_image_url($image, 'full');
                        $image_alt = get_post_meta(
                            $image,
                            '_wp_attachment_image_alt',
                            true
                        );
                    } else {
                        $image_url = $image;
                        $image_alt = $doctor['title'] ?? '';
                    }
                    ?>

                    <button
                        type="button"
                        class="doctor-tab group shrink-0 flex flex-col items-center w-[82px] sm:w-[90px]"
                        data-doctor="<?php echo esc_attr($index); ?>">

                        <div class="
                            doctor-tab-image
                            relative
                            w-[68px] h-[68px]
                            sm:w-[76px] sm:h-[76px]
                            rounded-full
                            overflow-hidden
                            bg-[#f1eeee]
                            border-2
                            border-transparent
                            transition-all
                            duration-300
                            group-hover:border-[var(--coffGreen)]
                            group-hover:scale-[1.03]
                        ">

                            <?php if ($image_url) : ?>

                                <img
                                    src="<?php echo esc_url($image_url); ?>"
                                    alt="<?php echo esc_attr($image_alt); ?>"
                                    class="absolute inset-0 w-full h-full object-cover object-top">

                            <?php endif; ?>

                        </div>


                        <span class="
                            mt-2
                            text-[9px]
                            sm:text-[10px]
                            leading-[12px]
                            tracking-[0.04em]
                            text-center
                            uppercase
                            text-[var(--secondary)]
                            min-h-[24px]
                        ">
                            <?php echo esc_html($doctor['title'] ?? ''); ?>
                        </span>

                    </button>

                <?php endforeach; ?>

            </div>

        </div>


        <!-- DOCTOR CONTENT -->
        <div class="
            doctor-content-wrapper
            relative
            overflow-hidden
            rounded-[24px]
            border
            border-coff_black/10
            bg-white
            shadow-[0_4px_20px_rgba(0,0,0,0.03)]
        ">

            <?php foreach ($doctors as $index => $doctor) : ?>

                <?php
                $image = $doctor['image'] ?? '';

                if (is_array($image)) {
                    $image_url = $image['url'] ?? '';
                    $image_alt = $image['alt'] ?? ($doctor['title'] ?? '');
                } elseif (is_numeric($image)) {
                    $image_url = wp_get_attachment_image_url($image, 'full');
                    $image_alt = get_post_meta(
                        $image,
                        '_wp_attachment_image_alt',
                        true
                    );
                } else {
                    $image_url = $image;
                    $image_alt = $doctor['title'] ?? '';
                }
                ?>

                <div
                    class="
                        doctor-content
                        <?php echo $index === 0 ? 'block' : 'hidden'; ?>
                    "
                    data-content="<?php echo esc_attr($index); ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-[373px_1fr]">

                        <!-- IMAGE -->
                        <div class="
                            relative
                            min-h-[420px]
                            lg:min-h-[560px]
                            bg-[#f4f6f8]
                            overflow-hidden
                        ">

                            <?php if ($image_url) : ?>

                                <img
                                    src="<?php echo esc_url($image_url); ?>"
                                    alt="<?php echo esc_attr($image_alt); ?>"
                                    class="
                                        absolute
                                        inset-0
                                        w-full
                                        h-full
                                        object-contain
                                        object-bottom
                                    ">

                            <?php endif; ?>

                        </div>


                        <!-- INFORMATION -->
                        <div class="px-6 py-8 sm:px-8 lg:px-10 lg:py-9">

                            <!-- Name -->
                            <h2 class="
                                font-serif
                                text-[30px]
                                sm:text-[34px]
                                lg:text-[30px]
                                xl:text-[32px]
                                leading-tight
                                text-[var(--primary)]
                                font-normal
                            ">
                                <?php echo esc_html($doctor['title'] ?? ''); ?>
                            </h2>


                            <!-- Subtitle -->
                            <?php if (!empty($doctor['subtitle'])) : ?>

                                <div class="
                                    mt-3
                                    text-[13px]
                                    font-medium
                                    tracking-[0.14em]
                                    text-coffGreen
                                ">
                                    <?php echo esc_html($doctor['subtitle']); ?>
                                </div>

                            <?php endif; ?>


                            <!-- Description -->
                            <?php if (!empty($doctor['description'])) : ?>

                                <div class="
                                    mt-6
                                    max-w-[700px]
                                    text-[15px]
                                    sm:text-[16px]
                                    leading-[1.65]
                                    text-[var(--secondaryLight)]
                                ">
                                    <?php echo wp_kses_post($doctor['description']); ?>
                                </div>

                            <?php endif; ?>


                            <!-- Bottom Information -->
                            <div class="
                                mt-10
                                grid
                                grid-cols-1
                                md:grid-cols-[1fr_220px]
                                gap-8
                            ">

                                <!-- Stats -->
                                <div class="
                                    grid
                                    grid-cols-2
                                    gap-6
                                    border-t
                                    border-coff_black/10
                                    pt-5
                                ">

                                    <!-- Experience -->
                                    <div>

                                        <div class="
                                            font-serif
                                            text-[28px]
                                            sm:text-[30px]
                                            leading-none
                                            text-[var(--primary)]
                                        ">
                                            <?php echo esc_html($doctor['experience'] ?? ''); ?>+
                                        </div>

                                        <div class="
                                            mt-3
                                            text-[10px]
                                            tracking-[0.12em]
                                            font-medium
                                            uppercase
                                            text-[var(--coffBlack)]
                                        ">
                                            Years Experience
                                        </div>

                                    </div>


                                    <!-- Treatments -->
                                    <div>

                                        <div class="
                                            font-serif
                                            text-[28px]
                                            sm:text-[30px]
                                            leading-none
                                            text-[var(--primary)]
                                        ">
                                            <?php echo esc_html($doctor['treatmentsdone'] ?? ''); ?>+
                                        </div>

                                        <div class="
                                            mt-3
                                            text-[10px]
                                            tracking-[0.12em]
                                            font-medium
                                            uppercase
                                            text-[var(--coffBlack)]
                                        ">
                                            Treatments
                                        </div>

                                    </div>

                                </div>


                                <!-- Certificates -->
                                <div class="
                                    border-l
                                    border-coff_black/10
                                    pl-6
                                ">

                                    <h3 class="
                                        font-serif
                                        text-[16px]
                                        text-[var(--primary)]
                                        mb-4
                                    ">
                                        Certificates
                                    </h3>

                                    <div class="
                                        certificate-content
                                        text-[13px]
                                        leading-[1.5]
                                        text-[var(--secondaryLight)]
                                    ">
                                        <?php
                                        echo wp_kses_post(
                                            $doctor['certificates'] ?? ''
                                        );
                                        ?>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>
</section>

<?php endif; ?>