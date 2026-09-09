<section class="w-full bg-[#f5f5f5] py-[60px] md:py-[70px]">

    <div class="mx-auto w-full max-w-[1100px] px-5">

        <!-- =========================================
             SECTION HEADER
        ========================================== -->
        <div class="mx-auto mb-[28px] max-w-[900px] text-center">

            <h2
                class="m-0 font-sans md:text-5xl text-3xl   text-coff_black tracking-tight"
            >
                Why Choose Dentakay?
            </h2>

            <p
                class="mx-auto mt-[20px] max-w-[850px] font-sans text-lg text-coff_black leading-relaxed"
            >
                We focus on delivering high-quality dental care with a process that's
                transparent, reliable, and built around your needs. Here's what makes us
                different:
            </p>

        </div>


        <!-- =========================================
             services WRAPPER
        ========================================== -->
        <div
            id="services"
            class="overflow-hidden rounded-[14px] bg-white"
        >

            <?php

            $services = [

                [
                    'title'   => 'Precision with Modern Technology',
                    'content' => 'Our modern tech-monitored approach gives you the natural-looking smile you dreamed of.',
                    'image'   => 'images/service1.webp',
                ],

                [
                    'title'   => 'Trusted by Patients Worldwide',
                    'content' => 'Patients from around the world trust our experienced dental teams to provide high-quality treatment and beautiful, natural-looking results.',
                    'image'   => 'images/service1.webp',
                ],

                [
                    'title'   => 'Specialists for Every Treatment',
                    'content' => 'Our experienced specialists provide dedicated expertise across cosmetic, restorative, and advanced dental treatments.',
                    'image'   => 'images/service1.webp',
                ],

                [
                    'title'   => 'Dedicated Aftercare',
                    'content' => 'Our support does not end when your treatment is complete. We provide dedicated aftercare to help you throughout your smile journey.',
                    'image'   => 'images/service1.webp',
                ],

                [
                    'title'   => 'Smile Guarantee',
                    'content' => 'We are committed to delivering high-quality dental treatment and helping you achieve a smile you can feel confident about.',
                    'image'   => 'images/service1.webp',
                ],

            ];


            foreach ($services as $index => $service):

                $image_url = get_template_directory_uri() . '/assets/' . $service['image'];

                $is_active = ($index === 0);

            ?>

                <!-- =========================================
                     service ITEM
                ========================================== -->
                <div
                    class="service-item relative border-b border-[#dedede] last:border-b-0"
                    data-service-item
                >

                    <!-- =====================================
                         service BUTTON
                    ====================================== -->
                    <button
                        type="button"
                        class="service-button relative flex min-h-[61px] w-full items-center justify-between overflow-hidden px-[18px] py-[16px] text-left md:min-h-[61px]"
                        data-service-button
                        aria-expanded="<?php echo $is_active ? 'true' : 'false'; ?>"
                    >

                        <!-- =================================
                             BACKGROUND IMAGE
                        ================================== -->
                        <div
                            class="service-bg absolute inset-0 z-0 <?php echo $is_active ? 'opacity-100' : 'opacity-0'; ?>"
                            style="
                                background-image:
                                linear-gradient(
                                    rgba(0, 0, 0, 0.48),
                                    rgba(0, 0, 0, 0.48)
                                ),
                                url('<?php echo esc_url($image_url); ?>');
                            "
                        ></div>


                        <!-- =================================
                             service CONTENT
                        ================================== -->
                        <div class="relative z-10 pr-5">

                            <h3
                                class="service-title m-0 font-sans text-[16px]   leading-[1.25] transition-colors duration-300 md:text-[17px] <?php echo $is_active ? 'text-white' : 'text-[#333]'; ?>"
                            >
                                <?php echo esc_html($service['title']); ?>
                            </h3>


                            <!-- =================================
                                 DESCRIPTION
                            ================================== -->
                            <div
                                class="service-answer overflow-hidden transition-all duration-[400ms] ease-in-out <?php echo $is_active ? 'max-h-[100px] opacity-100' : 'max-h-0 opacity-0'; ?>"
                            >

                                <p
                                    class="m-0 max-w-[600px] pt-[14px] font-sans text-[13px] font-medium leading-[1.45] text-white md:text-[15px]"
                                >
                                    <?php echo esc_html($service['content']); ?>
                                </p>

                            </div>

                        </div>


                        <!-- =================================
                             ICON
                        ================================== -->
                        <span
                            class="service-icon relative z-10 flex h-[20px] w-[20px] shrink-0 items-center justify-center font-sans text-[20px] font-normal leading-none text-black transition-transform duration-300"
                        >
                            <?php echo $is_active ? '−' : '+'; ?>
                        </span>

                    </button>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>