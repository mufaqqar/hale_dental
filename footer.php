</div>
</div>
<footer class="bg-primary pt-16 rounded-t-[32px]">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-[1.4fr_1fr_1fr_1fr_1.2fr] md:grid-cols-2 grid-cols-1 gap-10">
            <div>
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/dental-logo.png"
                        alt="Ilam Din Dental - Dental Clinic in Istanbul" class="w-56 mb-8">
                </a>

            </div>
            <div>
                <h5 class="text-lg   text-white mb-6">
                    Treatments
                </h5>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_treatments',
                    'menu_class' => 'space-y-4 list-none m-0 p-0',
                    'container' => false,
                    'fallback_cb' => false,
                    'depth' => 1,
                ]);
                ?>
            </div>
            <div>
                <h5 class="text-lg   text-white mb-6">
                    Quick Links
                </h5>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_quick',
                    'menu_class' => 'space-y-4 list-none m-0 p-0',
                    'container' => false,
                    'fallback_cb' => false,
                    'depth' => 1,
                ]);
                ?>
            </div>
            <div>
                <h5 class="text-lg   text-white mb-6">
                    Get in Touch
                </h5>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_contact',
                    'menu_class' => 'space-y-4 list-none m-0 p-0',
                    'container' => false,
                    'fallback_cb' => false,
                    'depth' => 1,
                ]);
                ?>
            </div>
            <div>
                <h5 class="text-lg   text-white mb-6">
                    Connect With Us
                </h5>
                <div class="flex gap-5 text-3xl mb-10">
                    <a href="#" class="text-white hover:text-secondary">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-white hover:text-secondary">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-white hover:text-secondary">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    <a href="#" class="text-white hover:text-secondary">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="text-white hover:text-secondary">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
                <h5 class="text-lg   text-white mb-5">
                    Subscribe to our newsletter
                </h5>
                <form class="hale-newsletter-form mb-6 space-y-2">
                    <input type="email" name="email" required placeholder="Your email address"
                        class="w-full rounded-full px-5 py-3 text-[14px] text-coff_black outline-none">
                    <button
                        class="w-full bg-white hover:bg-black hover:text-white text-secondary py-4 rounded-full transition  ">
                        Sign up
                    </button>
                    <p class="hale-form-msg hidden text-[12px]" role="status" aria-live="polite"></p>
                </form>
                <p class="text-sm text-white mb-6">
                    You can unsubscribe at any time.
                </p>
            </div>
        </div>
        <div class="border-t border-white/20 py-6">
            <div class="flex lg:flex-row flex-col justify-between items-center gap-5">
                <p class="text-white">
                    Made by Ilamdin Dental
                </p>
                <div class="">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'privacy_menu',
                        'menu_class' => 'flex flex-wrap justify-center gap-7',
                        'container' => false,
                        'fallback_cb' => false,
                        'depth' => 1,
                    ]);
                    ?>
                </div>
                <p class="text-white">
                    © 2026 Ilam Din Dental
                </p>
            </div>
        </div>
    </div>
</footer>
<button id="openQuotePopup" class="qoute_btn">
    <span>Get Consultation</span>
</button>
<div id="quotePopup" class="fixed inset-0 w-full bg-transparent flex flex-col items-end justify-center z-50 
     translate-x-full opacity-0 pointer-events-none transition-all duration-500 ease-in-out">
    <?php get_template_part('template-parts/main-popup'); ?>
</div>

<?php wp_footer(); ?>
</body>

</html>