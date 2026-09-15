<section class="relative min-h-screen w-full overflow-hidden"
    style="background: linear-gradient(91deg, rgb(0, 70, 80) 0%, rgba(0, 70, 80, 0) 236%);">
    <div class="absolute inset-0 z-0 overflow-hidden">
        <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline preload="auto"
            aria-hidden="true"
            poster="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hero-poster.jpg">
            <source src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/videos/video.mp4" type="video/mp4">
        </video>
        <div class="absolute inset-0 z-[1]"
            style="background: linear-gradient(91deg, rgb(0, 70, 80) 0%, rgba(0, 70, 80, 0) 236%), radial-gradient(66.49% 105.16% at 70.36% 47.07%, rgba(0, 70, 80, 0) 0%, rgba(0, 70, 80, 0.2) 100%); filter: brightness(0.5);">
        </div>
    </div>
    <div class="absolute inset-0 z-[2] flex items-center justify-center text-white">
        <div class="container mx-auto w-full mt-32 flex md:flex-row flex-col gap-6 items-center py-10">
            <div class="md:w-1/2 w-full">
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
                <div class="lg:mt-12">
                    <a class="inline-block rounded-[48px] px-[25px] py-[13px] text-[18px] leading-[1.5]  text-white transition hover:opacity-80 max-[768px]:px-[15px] max-[768px]:py-[10px] max-[768px]:text-sm placeholder:text-white"
                        href="/free-consultation/"
                        style="background: linear-gradient(197.05deg, var(--primary) -42.06%, var(--secondary) 136.49%);">Book
                        Book free consultation</a>
                </div>
            </div>
            <div class="md:w-1/2 w-full">
                <!-- =========================
                    CONSULTATION FORM
                ========================= -->
                <div class="w-full max-w-[505px] rounded-[24px] bg-secondary px-8 py-8 shadow-2xl md:px-8 md:py-8">

                    <form action="#" method="POST" class="w-full">

                        <!-- Name -->
                        <div class="mb-3">
                            <input type="text" name="name" placeholder="Name Surname"
                                class="h-[55px] w-full rounded-full border border-white/30 bg-transparent px-6 text-sm placeholder:text-white text-white outline-none focus:border-white/60"
                                required>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <div
                                class="flex h-[55px] w-full items-center rounded-full border border-white/30 bg-transparent px-6">

                                <!-- Pakistan Flag -->
                                <span class="mr-2 flex items-center gap-1 text-sm placeholder:text-white text-white">
                                    <span class="text-[17px]">🇵🇰</span>
                                    <span>+92</span>
                                </span>

                                <input type="tel" name="phone" placeholder=""
                                    class="h-full min-w-0 flex-1 bg-transparent text-sm placeholder:text-white text-white outline-none"
                                    required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <input type="email" name="email" placeholder="E-mail"
                                class="h-[55px] w-full rounded-full border border-white/30 bg-transparent px-6 text-sm placeholder:text-white text-white outline-none focus:border-white/60"
                                required>
                        </div>

                        <!-- Treatment -->
                        <div class="mb-3">
                            <select name="treatment"
                                class="h-[55px] w-full appearance-none rounded-full border border-white/30 bg-transparent px-6 text-sm placeholder:text-white font-medium text-white outline-none focus:border-white/60"
                                required>
                                <option value="Rhinoplasty" selected class="bg-secondary">
                                    Rhinoplasty
                                </option>
                                <option value="Hair Transplant" class="bg-secondary">
                                    Hair Transplant
                                </option>
                                <option value="Dentistry" class="bg-secondary">
                                    Dentistry
                                </option>
                                <option value="Breast Surgery" class="bg-secondary">
                                    Breast Surgery
                                </option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div class="mb-4">
                            <input type="text" name="topic" placeholder="Please specify the topic:"
                                class="h-[55px] w-full rounded-full border border-white/30 bg-transparent px-6 text-sm placeholder:text-white text-white outline-none focus:border-white/60">
                        </div>

                        <!-- Consent -->
                        <div class="mb-5 flex items-start gap-3">

                            <input id="consent" type="checkbox" name="consent" required
                                class="mt-[2px] h-[14px] w-[14px] shrink-0 cursor-pointer accent-primary">

                            <label for="consent" class="cursor-pointer text-xs italic leading-[1.35] text-white/90">
                                I agree to receive treatment information, special offers, and follow-up
                                communications from Natural Clinic via email and other digital channels.
                                I understand I can unsubscribe at any time.
                            </label>

                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="h-[53px] w-full rounded-full bg-primary hover:bg-white hover:text-primary hover:border-primary px-6 text-base text-white transition-all duration-300 hover:shadow-lg">
                            Apply now
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>