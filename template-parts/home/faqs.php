<?php

$faqs = [
    [
        'question' => 'How much can I save on dental treatment?',
        'answer' => 'Patients typically save 50-70% compared to dental costs in the UK, US, and Europe. Our pricing remains competitive while using premium materials and working with specialist dentists, making high-quality care more accessible.'
    ],
    [
        'question' => 'How do I get a treatment plan?',
        'answer' => 'Simply book a consultation with our dental team. After assessing your needs, our specialists will create a personalised treatment plan based on your goals and requirements.'
    ],
    [
        'question' => 'What’s included in your dental packages?',
        'answer' => 'Our dental packages can include consultations, treatment, premium materials, specialist dental care, and aftercare. The exact package depends on your individual treatment plan.'
    ],
    [
        'question' => 'How does your quality compare to UK or US dental clinics?',
        'answer' => 'We work with experienced specialist dentists and use high-quality materials and modern dental technology to provide treatment comparable to leading international clinics.'
    ],
    [
        'question' => 'Will I receive aftercare when I return home?',
        'answer' => 'Yes. We provide detailed aftercare guidance and remain available to support you after your treatment. We can also coordinate with your local dentist where appropriate.'
    ],
    [
        'question' => 'Is the consultation really free?',
        'answer' => 'Yes. Your initial consultation is completely free and allows our team to understand your needs and discuss the most suitable treatment options.'
    ],
    [
        'question' => 'How do I book my treatment?',
        'answer' => 'You can book your treatment by contacting our team and arranging your consultation. Once your treatment plan is confirmed, we will help you schedule your appointment.'
    ],
];

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
                            class="mr-3 h-[17px] w-[17px] shrink-0 text-[#333]"
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
                            class="w-full bg-transparent text-sm text-[#222] outline-none placeholder:text-[#b6b6b6]"
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
                                <?= $index === 0 ? 'bg-amber-50' : 'bg-white hover:bg-amber-50' ?>"
                                data-index="<?= $index ?>"
                                data-question="<?= htmlspecialchars(strtolower($faq['question'])) ?>"
                                data-answer="<?= htmlspecialchars($faq['answer']) ?>"
                            >

                                <!-- Dot -->
                                <span
                                    class="faq-dot flex h-[18px] w-[18px] shrink-0 rounded-full
                                    <?= $index === 0 ? 'bg-amber-200' : 'bg-amber-100' ?>"
                                ></span>

                                <!-- Question -->
                                <span class="flex-1 text-xl  leading-5 text-[#171717]">
                                    <?= htmlspecialchars($faq['question']) ?>
                                </span>

                                <!-- Arrow -->
                                <svg
                                    class="faq-arrow h-5 w-5 shrink-0 text-[#73a0ff] transition-transform duration-200"
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
                            href="#consultation"
                            class="text-[13px]  text-secondary transition hover:text-primary"
                        >
                            Ready to transform your smile? Schedule your consultation today!
                        </a>
                    </div>

                </div>


                <!-- RIGHT ANSWER -->
                <div
                    id="faqAnswer"
                    class="min-h-[490px] rounded-[14px] bg-amber-50 px-8 py-8 lg:-ml-[34px] lg:pl-[72px]"
                >

                    <div class="max-w-[310px]">

                        <h3
                            id="answerTitle"
                            class="text-lg text-black"
                        >
                            Here is your answer;
                        </h3>

                        <p
                            id="answerText"
                            class="mt-5 md:text-xl text-lg leading-[21px] text-secondaryLight"
                        >
                            <?= htmlspecialchars($faqs[0]['answer']) ?>
                        </p>

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>