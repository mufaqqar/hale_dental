<?php
/** Template Name: Contact */
get_header(); ?>

<section class="bg-[#f5f5f5] pt-32 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-[1250px] rounded-[28px] bg-white p-4 sm:p-5">
        <div class="relative min-h-[370px] overflow-hidden rounded-[18px] bg-[#f7f7f7]">
            <div
                class="absolute right-[18%] top-[-80px] h-[300px] w-[300px] rounded-full bg-[#dce5ff] opacity-80 blur-[90px]">
            </div>
            <div class="relative z-10 flex min-h-[370px] flex-col items-center justify-center">
                <h1 class=" text-center text-3xl tracking-[-1.5px] text-coff_black sm:text-4xl md:text-5xl">
                    Contact Us
                </h1>

            </div>
        </div>
    </div>
</section>



<main class="contact-page bg-[#f5f5f5]">

    <!-- =====================================
         CONTACT MAIN SECTION
    ====================================== -->
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <!-- =================================
                 LEFT SIDE
            ================================== -->
            <div>
                <!-- Heading -->
                <h1 class="text-2xl sm:text-[32px] text-coff_black mb-5">
                    Contact with Ilam Din Dental
                </h1>
                <!-- Description -->
                <div class="text-lg text-secondaryLight">

                    <p class="mb-3">
                        Your dental health is an integral part of your overall health
                        and we are here to provide you with the best service with our
                        expert team! In our clinic, we offer comfortable, reliable
                        and effective solutions for your oral and dental health by
                        using modern technology at the highest level.
                    </p>

                    <p class="mb-3">
                        Ethics has been established to enable the secure and
                        confidential reporting of situations that are considered to
                        be contrary to our company's ethical values, business
                        principles, and applicable legislation. All reports are
                        evaluated within the framework of confidentiality and are
                        reviewed only by authorized persons. To contact the Ethics
                        Line:
                        <a href="mailto:ethic@dentakay.com" class="text-primary hover:underline">
                            ethic@dentakay.com
                        </a>
                    </p>

                </div>

                <!-- Contact Details -->
                <div class="space-y-3 mb-5">

                    <div class="flex items-center gap-3 text-[14px] text-coff_black">

                        <span class="text-primary">
                            ✉
                        </span>

                        <a href="mailto:info@dentakay.com" class="hover:text-secondary">
                            info@dentakay.com
                        </a>
                    </div>
                    <div class="flex items-center gap-3 text-[11px] text-coff_black">

                        <span class="text-primary">
                            ☎
                        </span>

                        <a href="tel:+905415008008" class="hover:text-secondary">
                            +90 541 500 80 08
                        </a>
                    </div>
                </div>
            </div>

            <!-- =================================
                 RIGHT SIDE - FORM
            ================================== -->
            <div>
                <div class="bg-white rounded-xl p-4 sm:p-5
                            shadow-sm">
                    <!-- Form Heading -->
                    <div class="text-center mb-4">
                        <h2 class="text-[32px]">
                            Fill Out the Form Now and Get a
                            Free Initial Consultation
                        </h2>

                        <p class="text-sm mt-2">
                            We are dedicated to transforming smiles with
                            precision, care, and excellence.
                        </p>
                    </div>

                    <form action="#" method="post" class="space-y-2.5">
                        <!-- Name + Phone -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="full_name" class="block text-sm text-coff_black mb-1">
                                    Full Name
                                </label>

                                <input type="text" id="full_name" name="full_name" placeholder="Name and Surname"
                                    required class="w-full h-[38px]
                                           bg-[#fafafa]
                                           border border-transparent
                                           rounded-lg px-3
                                           text-[12px]
                                           outline-none">

                            </div>

                            <div>

                                <label for="phone" class="block text-sm text-coff_black mb-1">
                                    Phone Number
                                </label>

                                <div class="relative">

                                    <span class="absolute left-3 top-1/2
                                               -translate-y-1/2
                                               text-[9px]">
                                        🇹🇷
                                    </span>

                                    <input type="tel" id="phone" name="phone" placeholder="+90  301 2345678" required
                                        class="w-full h-[38px]
                                               bg-[#fafafa]
                                               border border-transparent
                                               rounded-lg pl-9 pr-3
                                               text-[12px]
                                               outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div>

                            <label for="email" class="block text-sm text-coff_black mb-1">
                                E-mail
                            </label>

                            <input type="email" id="email" name="email" placeholder="yourname@surname.com" required
                                class="w-full h-[38px]
                                       bg-[#fafafa]
                                       border border-transparent
                                       rounded-lg px-3
                                       text-[12px]
                                       outline-non">

                        </div>


                        <!-- Description -->
                        <div>

                            <label for="description" class="block text-sm text-coff_black mb-1">
                                Description
                            </label>

                            <textarea id="description" name="description" rows="4"
                                placeholder="Write something you wonder" class="w-full bg-[#fafafa]
                                       border border-transparent
                                       rounded-lg px-3 py-3
                                       text-[12px]
                                        outline-none"></textarea>

                        </div>


                        <!-- Consent 1 -->
                        <div class="flex gap-2 items-start">

                            <input type="checkbox" id="consent" name="consent" required class="mt-[2px] w-3 h-3">

                            <label for="consent" class="text-xs leading-4 ">
                                I consent to receive marketing communications
                                from Ilam Din Dental and its affiliates by call,
                                SMS, email, WhatsApp or similar channels.
                                My data is managed responsibly. Read our
                                Privacy Policy for help on opting out.
                                See our Terms and Conditions.
                            </label>

                        </div>


                        <!-- Consent 2 -->
                        <div class="flex gap-2 items-start">

                            <input type="checkbox" id="privacy" name="privacy" required class="mt-[2px] w-3 h-3
                                       ">

                            <label for="privacy" class="text-[12px] leading-4 ">
                                I have read the
                                <a href="#privacy" class="text-primary">
                                    Privacy Policy
                                </a>
                                under the applicable Personal Data Protection
                                Law and expressly consent to my personal data
                                being processed as stated there.
                            </label>

                        </div>


                        <!-- Submit -->
                        <button type="submit" class="w-full h-[36px]
                                   rounded-lg
                                   bg-gradient-to-r
                                   from-[#4169e1]
                                   to-[#29499f]
                                   text-white
                                   text-[11px]
                                   font-bold
                                   hover:opacity-90
                                   transition">
                            Contact Me
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================
         GOOGLE MAP SECTION
    ====================================== -->
    <section class="w-full mt-2">

        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 pb-8">

            <div class="bg-white rounded-xl overflow-hidden
                        shadow-sm border border-gray-100">

                <!-- Map Heading -->
                <div class="px-5 py-4">

                    <h2 class="text-lg sm:text-xl text-coff_black">
                        Find Us
                    </h2>

                    <p class="text-[10px] sm:text-[11px] text-secondaryLight mt-1">
                        Visit Ilam Din Dental and our dental care team.
                    </p>

                </div>


                <!-- Google Map -->
                <div class="w-full h-[300px] sm:h-[380px] lg:h-[450px]">

                    <iframe src="https://www.google.com/maps?q=Ilam%20Din%20Dental%20Clinic%20Istanbul%20Turkey&output=embed"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" title="Ilam Din Dental Location"></iframe>

                </div>

            </div>

        </div>

    </section>
</main>


<?php get_footer(); ?>