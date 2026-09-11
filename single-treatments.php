<?php
/**
 * Template Name: Single Treatment
 * Template Post Type: treatments
 */

get_header();

// Parse content: extract H2s, build TOC, wrap sections in <section> tags.
$raw_content = get_the_content();
$parsed = hale_generate_toc_from_content($raw_content);
$toc_html = $parsed['toc'];
$article_html = $parsed['content'];
?>

<section class="bg-[#f5f5f5] pt-32 px-4 sm:px-6 lg:px-8 pb-16">
    <div class="mx-auto max-w-[1250px] rounded-[28px] bg-white p-4 sm:p-5">

        <!-- Hero -->
        <div class="relative min-h-[370px] overflow-hidden rounded-[18px] bg-[#f7f7f7]">

            <div
                class="absolute right-[18%] top-[-80px] h-[300px] w-[300px] rounded-full bg-secondaryLight opacity-80 blur-[90px]">
            </div>

            <div
                class="relative z-10 mx-auto flex min-h-[370px] w-full max-w-[900px] flex-col items-center justify-center px-4 text-center">

                <h1 class="text-3xl tracking-[-1.5px] text-coff_black sm:text-4xl md:text-5xl">
                    <?php the_title(); ?>
                </h1>

                <?php if (has_excerpt()): ?>
                    <p class="mt-5 text-center text-[18px] leading-[1.7] text-coff_black">
                        <?php the_excerpt(); ?>
                    </p>
                <?php endif; ?>

            </div>
        </div>
    </div>


    <!-- Main Article Area -->
    <div class="container mx-auto px-4 flex flex-col gap-10 lg:flex-row lg:gap-8 mt-10">


        <!-- =========================
                 LEFT SIDEBAR — Table of Contents
            ========================== -->
        <aside class="md:w-1/5 w-full">
            <div class="top-28">
                <?php if (!empty($toc_html)): ?>
                    <?php echo $toc_html; ?>
                <?php endif; ?>
            </div>
        </aside>


        <!-- =========================
                 CENTER ARTICLE
            ========================== -->
        <main class="md:w-3/5 w-full">
            <article>
                <?php echo $article_html; ?>
            </article>
        </main>


        <!-- =========================
                 RIGHT CONSULTATION FORM
            ========================== -->
        <aside class="md:w-1/5 w-full">

            <div class="sticky top-28 rounded-[14px] bg-[#f8f8f8] p-3.5 shadow-sm">

                <!-- Print Button -->
                <button type="button" onclick="window.print()"
                    class="mb-3 flex w-full items-center gap-2 rounded-[9px] bg-white px-3 py-3 text-left text-[18px] font-medium text-coff_black transition hover:bg-[#f1f1f1]">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-12 0h12v4H6v-4z" />

                    </svg>

                    Print this document

                </button>


                <!-- Form Card -->
                <div class="rounded-[12px] bg-white p-3">

                    <h3 class="text-[17px] font-semibold leading-[1.25] text-coff_black">
                        Get a Free Initial Consultation
                    </h3>


                    <form class="mt-4 space-y-3">

                        <!-- Full Name -->
                        <div>

                            <label for="full-name" class="mb-1.5 block text-[13px] font-medium text-coff_black">
                                Full Name
                            </label>

                            <input id="full-name" type="text" name="full_name" placeholder="Name and Surname"
                                class="h-[38px] w-full rounded-[8px] border border-transparent  px-3 text-[12px] text-coff_black outline-none transition focus:border-primary">

                        </div>


                        <!-- Phone -->
                        <div>

                            <label for="phone" class="mb-1.5 block text-[13px] font-medium text-coff_black">
                                Phone Number
                            </label>

                            <div class="flex h-[38px] items-center rounded-[8px] bg-[#f6f6f6] px-2">

                                <span class="mr-2 text-[12px]">
                                    🇵🇰
                                </span>

                                <span class="mr-1 text-[11px] text-coff_black">
                                    +92
                                </span>

                                <input id="phone" type="tel" name="phone" placeholder="301 2345678"
                                    class="w-full bg-transparent text-[12px] text-coff_black outline-none">

                            </div>

                        </div>


                        <!-- Email -->
                        <div>

                            <label for="email" class="mb-1.5 block text-[13px] font-medium text-coff_black">
                                E-Mail
                            </label>

                            <input id="email" type="email" name="email" placeholder="dentakay@dentakay.com"
                                class="h-[38px] w-full rounded-[8px] border border-transparent bg-[#f6f6f6] px-3 text-[12px] text-coff_black outline-none transition focus:border-primary">

                        </div>


                        <!-- Consent -->
                        <div class="space-y-2 pt-1">

                            <label class="flex gap-2 text-[11px] leading-[1.45] text-coff_black">

                                <input type="checkbox" name="marketing_consent"
                                    class="mt-0.5 h-3 w-3 shrink-0 accent-primary">

                                <span>
                                    I consent to receive marketing communications from Dentakay
                                    and its affiliates by call, SMS, email, WhatsApp or similar channels.
                                </span>

                            </label>


                            <label class="flex gap-2 text-[11px] leading-[1.45] text-coff_black">

                                <input type="checkbox" name="privacy_policy" required
                                    class="mt-0.5 h-3 w-3 shrink-0 accent-primary">

                                <span>
                                    I have read the
                                    <a href="#" class="font-medium text-primary underline">
                                        Privacy Policy
                                    </a>
                                    and agree to the processing of my personal data.
                                </span>

                            </label>

                        </div>


                        <!-- Submit -->
                        <button type="submit"
                            class="mt-2 h-[38px] w-full rounded-[8px] bg-primary px-3 text-[13px] font-semibold text-white transition hover:opacity-90">

                            Book Online Consultation

                        </button>

                    </form>

                </div>

            </div>

        </aside>

    </div>


    <!-- =========================
     FAQ SECTION
========================= -->

    <section class="px-4 sm:px-6 lg:px-8 py-16">

        <div
            class="relative mx-auto max-w-[1250px] overflow-hidden rounded-[14px] bg-gradient-to-br from-coff_black via-coffGreen to-coffLightGreen px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

            <!-- Background Circle -->
            <div
                class="pointer-events-none absolute -right-[80px] top-[45px] h-[480px] w-[480px] rounded-full border-[55px] border-white/10">
            </div>

            <div
                class="pointer-events-none absolute -right-[25px] top-[110px] h-[350px] w-[350px] rounded-full border-[40px] border-white/5">
            </div>


            <!-- FAQ Header -->
            <div class="relative z-10 mx-auto max-w-[700px] text-center">

                <span class="block text-[22px] leading-none text-coff_black">
                    Frequently Asked Questions
                </span>

                <h2 class="mt-1 text-[20px] font-semibold leading-[1.2] text-coff_black sm:text-[28px]">
                    <?php the_title(); ?>
                </h2>


                <!-- Search -->
                <div class="relative mt-7">

                    <div class="flex items-center border-b border-white/70 pb-2">

                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4 shrink-0 text-coff_black"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35m1.35-5.15a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0Z" />

                        </svg>

                        <input type="text" id="faq-search" placeholder="Search something you wonder"
                            class="w-full bg-transparent text-[14px] text-coff_black placeholder:text-white/80 outline-none">

                    </div>

                </div>

            </div>


            <!-- FAQ List -->
            <div id="faq-list" class="relative z-10 mt-4 space-y-4">

                <!-- FAQ 1 -->
                <div class="faq-item rounded-[10px] bg-white/10 backdrop-blur-sm transition">

                    <button type="button"
                        class="faq-question flex w-full items-center justify-between gap-4 px-4 py-4 text-left sm:px-5"
                        aria-expanded="false">

                        <span class="text-[16px] font-semibold leading-[1.4] text-coff_black">
                            How long does the dental implant process take?
                        </span>

                        <span
                            class="faq-icon flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-coff_black text-[16px] font-light leading-none text-coff_black">
                            +
                        </span>

                    </button>

                    <div class="faq-answer hidden px-4 pb-4 sm:px-5">
                        <p class="text-[15px] leading-[1.6] text-white/80">
                            The dental implant process can vary depending on the individual
                            treatment plan, healing period, and any additional procedures required.
                        </p>
                    </div>

                </div>


                <!-- FAQ 2 -->
                <div class="faq-item rounded-[10px] bg-white/10 backdrop-blur-sm transition">

                    <button type="button"
                        class="faq-question flex w-full items-center justify-between gap-4 px-4 py-4 text-left sm:px-5"
                        aria-expanded="false">

                        <span class="text-[16px] font-semibold leading-[1.4] text-coff_black">
                            What happens if I don't have enough bone for implants?
                        </span>

                        <span
                            class="faq-icon flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-coff_black text-[16px] font-light leading-none text-coff_black">
                            +
                        </span>

                    </button>

                    <div class="faq-answer hidden px-4 pb-4 sm:px-5">
                        <p class="text-[15px] leading-[1.6] text-white/80">
                            A dental professional can evaluate your jawbone and determine
                            whether additional treatment may be appropriate before implant placement.
                        </p>
                    </div>

                </div>


                <!-- FAQ 3 -->
                <div class="faq-item rounded-[10px] bg-white/10 backdrop-blur-sm transition">

                    <button type="button"
                        class="faq-question flex w-full items-center justify-between gap-4 px-4 py-4 text-left sm:px-5"
                        aria-expanded="false">

                        <span class="text-[16px] font-semibold leading-[1.4] text-coff_black">
                            Are dental implants suitable for people with medical conditions?
                        </span>

                        <span
                            class="faq-icon flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-coff_black text-[16px] font-light leading-none text-coff_black">
                            +
                        </span>

                    </button>

                    <div class="faq-answer hidden px-4 pb-4 sm:px-5">
                        <p class="text-[15px] leading-[1.6] text-white/80">
                            Suitability depends on the individual's circumstances.
                            A qualified dental professional should review your medical and dental history.
                        </p>
                    </div>

                </div>


                <!-- FAQ 4 -->
                <div class="faq-item rounded-[10px] bg-white/10 backdrop-blur-sm transition">

                    <button type="button"
                        class="faq-question flex w-full items-center justify-between gap-4 px-4 py-4 text-left sm:px-5"
                        aria-expanded="false">

                        <span class="text-[16px] font-semibold leading-[1.4] text-coff_black">
                            How should I care for my dental implants to ensure they last?
                        </span>

                        <span
                            class="faq-icon flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-coff_black text-[16px] font-light leading-none text-coff_black">
                            +
                        </span>

                    </button>

                    <div class="faq-answer hidden px-4 pb-4 sm:px-5">
                        <p class="text-[15px] leading-[1.6] text-white/80">
                            Good oral hygiene, regular dental checkups, and following
                            your dental professional's care instructions are important for long-term maintenance.
                        </p>
                    </div>

                </div>


                <!-- FAQ 5 -->
                <div class="faq-item rounded-[10px] bg-white/10 backdrop-blur-sm transition">

                    <button type="button"
                        class="faq-question flex w-full items-center justify-between gap-4 px-4 py-4 text-left sm:px-5"
                        aria-expanded="false">

                        <span class="text-[16px] font-semibold leading-[1.4] text-coff_black">
                            Can dental implants replace all of my teeth and how does it work?
                        </span>

                        <span
                            class="faq-icon flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-coff_black text-[16px] font-light leading-none text-coff_black">
                            +
                        </span>

                    </button>

                    <div class="faq-answer hidden px-4 pb-4 sm:px-5">
                        <p class="text-[15px] leading-[1.6] text-white/80">
                            Dental implants can be used in treatment plans for patients
                            who have lost multiple or all of their teeth. The appropriate
                            approach depends on the individual's dental needs.
                        </p>
                    </div>

                </div>


                <!-- FAQ 6 -->
                <div class="faq-item rounded-[10px] bg-white/10 backdrop-blur-sm transition">

                    <button type="button"
                        class="faq-question flex w-full items-center justify-between gap-4 px-4 py-4 text-left sm:px-5"
                        aria-expanded="false">

                        <span class="text-[16px] font-semibold leading-[1.4] text-coff_black">
                            What is the success rate of dental implants?
                        </span>

                        <span
                            class="faq-icon flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-coff_black text-[16px] font-light leading-none text-coff_black">
                            +
                        </span>

                    </button>

                    <div class="faq-answer hidden px-4 pb-4 sm:px-5">
                        <p class="text-[15px] leading-[1.6] text-white/80">
                            Implant outcomes can vary based on factors such as oral health,
                            treatment planning, healing, and long-term maintenance.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- FAQ JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const faqItems = document.querySelectorAll('.faq-item');
            const searchInput = document.getElementById('faq-search');

            /*
            |--------------------------------------------------------------------------
            | FAQ Accordion
            |--------------------------------------------------------------------------
            */

            faqItems.forEach(function (item) {

                const question = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');
                const icon = item.querySelector('.faq-icon');

                question.addEventListener('click', function () {

                    const isOpen = question.getAttribute('aria-expanded') === 'true';

                    // Close all FAQs
                    faqItems.forEach(function (otherItem) {

                        const otherQuestion = otherItem.querySelector('.faq-question');
                        const otherAnswer = otherItem.querySelector('.faq-answer');
                        const otherIcon = otherItem.querySelector('.faq-icon');

                        otherQuestion.setAttribute('aria-expanded', 'false');
                        otherAnswer.classList.add('hidden');

                        otherIcon.textContent = '+';

                    });


                    // Open clicked FAQ
                    if (!isOpen) {

                        question.setAttribute('aria-expanded', 'true');
                        answer.classList.remove('hidden');

                        icon.textContent = '\u2212';

                    }

                });

            });


            /*
            |--------------------------------------------------------------------------
            | FAQ Search
            |--------------------------------------------------------------------------
            */

            if (searchInput) {

                searchInput.addEventListener('input', function () {

                    const searchValue = this.value.toLowerCase().trim();

                    faqItems.forEach(function (item) {

                        const questionText = item
                            .querySelector('.faq-question span')
                            .textContent
                            .toLowerCase();

                        if (questionText.includes(searchValue)) {

                            item.classList.remove('hidden');

                        } else {

                            item.classList.add('hidden');

                        }

                    });

                });

            }

        });
    </script>

</section>


<!-- Active Section Script (Dynamic Scroll-Spy) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const sections = document.querySelectorAll('article section[id]');
        const links = document.querySelectorAll('.section-link');

        if (!sections.length || !links.length) return;

        const observer = new IntersectionObserver(
            (entries) => {

                entries.forEach((entry) => {

                    if (entry.isIntersecting) {

                        links.forEach((link) => {

                            link.classList.remove(
                                'border-primary',
                                'text-primary'
                            );

                            link.classList.add(
                                'border-transparent',
                                'text-coff_black'
                            );

                        });

                        const activeLink = document.querySelector(
                            '.section-link[href="#' + entry.target.id + '"]'
                        );

                        if (activeLink) {

                            activeLink.classList.remove(
                                'border-transparent',
                                'text-coff_black'
                            );

                            activeLink.classList.add(
                                'border-primary',
                                'text-primary'
                            );

                        }

                    }

                });

            }, {
            rootMargin: '-20% 0px -65% 0px',
            threshold: 0
        }
        );

        sections.forEach((section) => observer.observe(section));

    });
</script>


<!-- Print CSS -->
<style>
    @media print {

        header,
        footer,
        aside,
        .no-print {
            display: none !important;
        }

        body {
            background: #fff !important;
        }

        section {
            padding-top: 20px !important;
        }

        article {
            max-width: 100% !important;
        }

    }
</style>


<?php get_footer(); ?>