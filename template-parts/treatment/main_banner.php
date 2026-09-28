<section class="relative min-h-[750px] h-full w-full overflow-hidden ">
    <div class="absolute inset-0 z-0 overflow-hidden">
        <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline preload="auto"
            aria-hidden="true"
            poster="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hero-poster.jpg">
            <source src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/videos/video.mp4" type="video/mp4">
        </video>
        <div class="absolute inset-0 z-[1] bg-secondary opacity-[0.78]">
        </div>
    </div>
    <div class="relative z-10 w-full">
        <div class="container mx-auto px-4  grid
                grid-cols-1
                lg:grid-cols-[minmax(0,1fr)_480px]
                gap-10
                lg:gap-12
                items-center pt-40 pb-12 h-full">
            <div class="text-white sm:text-left text-center">
                <h1 class="md:text-5xl text-3xl">
                    Awarded Rhinoplasty
                    <br>
                    (Nose Job) in Turkey
                </h1>
                <p class="md:text-lg text-sm mt-4">
                    Natural Clinic ensures a refined rhinoplasty in Turkey in our
                    dazzling private clinic. You choose among the best surgeons,
                    receiving the latest technology, expert anesthesiologists and
                    private nurses at your hospital and hotel.
                </p>
                <div class="lg:mt-12 mt-10 md:ml-0 md:mr-auto mx-auto w-fit">
                    <a class="inline-flex rounded-[48px] px-[25px] py-[13px] text-lg bg-secondary hover:bg-primary  text-white transition hover:opacity-80"
                        href="/free-consultation/">Book
                        Book free consultation</a>
                </div>
            </div>
            <div class="">
                <!-- =========================
                    CONSULTATION FORM
                ========================= -->
                <div class="
                    w-full
                    md:ml-auto
                    md:mr-0
                    rounded-[24px]
                    border
                    border-white/30
                    bg-secondary/75
                    backdrop-blur-[14px]
                    shadow-[0_15px_50px_rgba(0,0,0,0.20)]
                    p-5
                    sm:p-7
                    lg:p-7
                ">

                    <form action="" method="post" class="space-y-3">

                        <!-- Name -->
                        <div>
                            <label for="implant-name" class="sr-only">
                                Name Surname
                            </label>

                            <input id="implant-name" type="text" name="name" placeholder="Name Surname" required class="
                                w-full
                                h-[50px]
                                rounded-full
                                border
                                border-white/20
                                bg-white/10
                                px-5
                                text-[13px]
                                text-white
                                placeholder:text-white/55
                                outline-none
                                transition-all
                                duration-300
                                focus:border-white/50
                                focus:bg-white/15
                            ">
                        </div>


                        <!-- Phone -->
                        <div class="relative">

                            <label for="implant-phone" class="sr-only">
                                Phone
                            </label>

                            <div class="
                                flex
                                items-center
                                w-full
                                h-[50px]
                                rounded-full
                                border
                                border-white/20
                                bg-white/10
                                overflow-hidden
                                focus-within:border-white/50
                            ">

                                <div class="
                                    flex
                                    items-center
                                    gap-2
                                    pl-5
                                    pr-2
                                    shrink-0
                                    text-[13px]
                                    text-white
                                ">
                                    <span class="text-[17px]">🇵🇰</span>
                                    <span>+92</span>
                                </div>

                                <input id="implant-phone" type="tel" name="phone" placeholder="Phone number" required
                                    class="
                                    flex-1
                                    h-full
                                    bg-transparent
                                    border-0
                                    outline-none
                                    px-2
                                    pr-5
                                    text-[13px]
                                    text-white
                                    placeholder:text-white/55
                                ">

                            </div>

                        </div>


                        <!-- Email -->
                        <div>

                            <label for="implant-email" class="sr-only">
                                E-mail
                            </label>

                            <input id="implant-email" type="email" name="email" placeholder="E-mail" required class="
                                w-full
                                h-[50px]
                                rounded-full
                                border
                                border-white/20
                                bg-white/10
                                px-5
                                text-[13px]
                                text-white
                                placeholder:text-white/55
                                outline-none
                                transition-all
                                duration-300
                                focus:border-white/50
                                focus:bg-white/15
                            ">

                        </div>


                        <!-- Service -->
                        <div>

                            <label for="implant-service" class="sr-only">
                                Select Service
                            </label>

                            <div class="relative">

                                <select id="implant-service" name="service" required class="
                                    appearance-none
                                    w-full
                                    h-[50px]
                                    rounded-full
                                    border
                                    border-white/20
                                    bg-white/20
                                    px-5
                                    pr-12
                                    text-[13px]
                                    text-white/60
                                    outline-none
                                    focus:border-white/50
                                ">
                                    <option value="" selected disabled>
                                        Select Service
                                    </option>

                                    <option value="single-implant">
                                        Single Dental Implant
                                    </option>

                                    <option value="all-on-4">
                                        All-on-4 Dental Implants
                                    </option>

                                    <option value="all-on-6">
                                        All-on-6 Dental Implants
                                    </option>

                                    <option value="veneers">
                                        Dental Veneers
                                    </option>

                                    <option value="crowns">
                                        Dental Crowns
                                    </option>

                                </select>

                                <!-- Arrow -->
                                <svg class="
                                    pointer-events-none
                                    absolute
                                    right-5
                                    top-1/2
                                    -translate-y-1/2
                                    w-4
                                    h-4
                                    text-white/60
                                " viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>

                            </div>

                        </div>


                        <!-- Message -->
                        <div>

                            <label for="implant-message" class="sr-only">
                                Please specify the topic
                            </label>

                            <input id="implant-message" type="text" name="message"
                                placeholder="Please specify the topic..." class="
                                w-full
                                h-[50px]
                                rounded-full
                                border
                                border-white/20
                                bg-white/10
                                px-5
                                text-[13px]
                                text-white
                                placeholder:text-white/55
                                outline-none
                                transition-all
                                duration-300
                                focus:border-white/50
                                focus:bg-white/15
                            ">

                        </div>


                        <!-- Consent -->
                        <div class="
                            flex
                            items-start
                            gap-2
                            pt-2
                        ">

                            <input id="implant-consent" type="checkbox" name="consent" required class="
                                mt-[3px]
                                shrink-0
                                w-[13px]
                                h-[13px]
                                accent-coffGreen
                                cursor-pointer
                            ">

                            <label for="implant-consent" class="
                                text-[9px]
                                sm:text-[10px]
                                leading-[1.35]
                                italic
                                text-white/75
                                cursor-pointer
                            ">
                                I agree to receive treatment information, special
                                offers, and follow-up communications from Ilam Din
                                Dental via email and other digital channels. I
                                understand I can unsubscribe at any time.
                            </label>

                        </div>


                        <!-- Submit -->
                        <button type="submit" class="
                            w-full
                            h-[48px]
                            mt-2
                            rounded-full
                            bg-coffGreen
                            hover:bg-[#3459c9]
                            text-white
                            text-[14px]
                            font-semibold
                            transition-all
                            duration-300
                            shadow-[0_5px_20px_rgba(0,0,0,0.12)]
                            hover:shadow-[0_8px_25px_rgba(0,0,0,0.20)]
                        ">
                            Apply now
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>