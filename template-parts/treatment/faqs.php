<?php

/**
 * Get FAQs based on the current treatment slug.
 *
 * Example:
 * Treatment: Orthodontics
 * Slug: orthodontics
 *
 * FAQ Type:
 * faq_types -> orthodontics
 */

$treatment_slug = get_post_field('post_name', get_the_ID());

$faqs = [];

if ($treatment_slug) {

    $faq_query = new WP_Query([
        'post_type'      => 'faq',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',

        'tax_query'      => [
            [
                'taxonomy' => 'faq_types',
                'field'    => 'slug',
                'terms'    => $treatment_slug,
            ],
        ],
    ]);

    if ($faq_query->have_posts()) {

        while ($faq_query->have_posts()) {
            $faq_query->the_post();

            $faqs[] = [
                'question' => get_the_title(),
                'answer'   => apply_filters('the_content', get_the_content()),
            ];
        }

        wp_reset_postdata();
    }
}

?>

<section class="bg-[#f5f5f5] py-16 sm:py-20">
    <div class="mx-auto max-w-[1240px] px-5">

        <!-- Heading -->
        <div class="mb-7 text-center">
            <h2 class="md:text-5xl text-3xl   text-coff_black tracking-tight">
                Frequently Asked Questions
            </h2>

            <p class="mt-4 text-lg text-coff_black leading-relaxed">
                Looking for more information about Ilam Din Dental? You can find it here.
            </p>
        </div>


        <!-- FAQ Container -->
        <div class="mx-auto max-w-[1040px]">

            <div class="grid gap-0 lg:grid-cols-[513px_1fr]">

                <!-- LEFT -->
                <div class="relative z-10">

                    <!-- Search -->
                    <div class="mb-3 flex h-[45px] items-center bg-white px-4">
                        <svg
                            class="mr-3 h-[17px] w-[17px] shrink-0 text-coff_black"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            viewBox="0 0 24 24"
                        >
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="m20 20-4-4"></path>
                        </svg>

                        <input
                            id="faqSearch"
                            type="text"
                            placeholder="Search something you wonder"
                            class="w-full bg-transparent text-sm text-coff_black outline-none placeholder:text-[#b6b6b6]"
                        >
                    </div>


                    <!-- FAQ List -->
                    <div
                        id="faqList"
                        class="overflow-hidden rounded-b-[14px] bg-white"
                    >

                        <?php foreach ($faqs as $index => $faq): ?>

                            <button
                                type="button"
                                class="faq-item group flex min-h-[57px] w-full items-center gap-3 px-3 text-left transition-colors duration-200
                                <?= $index === 0 ? 'bg-gray-200' : 'bg-white hover:bg-gray-200' ?>"
                                data-index="<?= $index ?>"
                                data-question="<?= htmlspecialchars(strtolower($faq['question'])) ?>"
                                data-answer="<?= htmlspecialchars($faq['answer']) ?>"
                            >

                                <!-- Dot -->
                                <span
                                    class="faq-dot flex h-[18px] w-[18px] shrink-0 rounded-full 
                                    <?= $index === 0 ? 'bg-gray-400' : 'bg-gray-300' ?>"
                                ></span>

                                <!-- Question -->
                                <span class="flex-1 text-xl  leading-5 text-coff_black">
                                    <?= htmlspecialchars($faq['question']) ?>
                                </span>

                                <!-- Arrow -->
                                <svg
                                    class="faq-arrow h-5 w-5 shrink-0 text-coffGreen transition-transform duration-200"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>

                            </button>

                        <?php endforeach; ?>

                    </div>


                    <!-- Bottom CTA -->
                    <div class="mt-3">
                        <a
                            href="<?php echo esc_url(home_url('/contact-us')); ?>"
                            class="text-[13px]  text-secondary transition hover:text-primary"
                        >
                            Ready to transform your smile? Schedule your consultation today!
                        </a>
                    </div>

                </div>


                <!-- RIGHT ANSWER -->
                <div
                    id="faqAnswer"
                    class="min-h-[490px] rounded-[14px] bg-gray-200 px-8 py-8 lg:-ml-[34px] lg:pl-[72px]"
                >

                    <div class="max-w-[310px]">

                        <h3
                            id="answerTitle"
                            class="text-lg text-coff_black"
                        >
                            Here is your answer;
                        </h3>

                        <div
                            id="answerText"
                            class="mt-5 md:text-xl text-lg leading-[21px] text-secondaryLight"
                        >
                            <?= wp_kses_post($faqs[0]['answer']) ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>