</div>
</div>
<footer class="bg-primary pt-16 rounded-t-[32px]">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-[1.4fr_1fr_1fr_1fr_1.2fr] md:grid-cols-2 grid-cols-1 gap-10">
            <div>
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png"
                        alt="Ilam Din Dental - Dental Clinic in Istanbul" class="w-56 mb-8">
                </a>

            </div>
            <div>
                <h5 class="text-lg   text-white mb-6">
                    Treatments
                </h5>
                <ul class="space-y-4">
                    <li><a href="#/" class="text-white hover:text-secondary transition">Hollywood Smile</a></li>
                    <li><a href="#/" class="text-white hover:text-secondary transition">Dental Implants</a></li>
                    <li><a href="#/" class="text-white hover:text-secondary transition">Dental Crowns</a></li>
                    <li><a href="#/" class="text-white hover:text-secondary transition">Veneers</a></li>
                    <li><a href="#/" class="text-white hover:text-secondary transition">Teeth Whitening</a></li>
                    <li><a href="#/" class="text-white hover:text-secondary transition">Root Canal</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-lg   text-white mb-6">
                    Quick Links
                </h5>
                <ul class="space-y-4">
                    <li><a href="#/" class="text-white hover:text-secondary transition">About Us</a></li>
                    <li><a href="#/" class="text-white hover:text-secondary transition">Blog</a></li>
                    <li><a href="#/" class="text-white hover:text-secondary transition">Treatments</a></li>
                    <li><a href="#/" class="text-white hover:text-secondary transition">Before & After</a></li>
                    <li><a href="#/" class="text-white hover:text-secondary transition">Free Consultation</a></li>
                    <li><a href="#/" class="text-white hover:text-secondary transition">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-lg   text-white mb-6">
                    Get in Touch
                </h5>
                <ul class="space-y-4">
                    <li><a href="#" class="text-white hover:text-secondary transition">Contact Us</a></li>
                    <li><a href="#" class="text-white hover:text-secondary transition">Get a Quote</a></li>
                    <li><a href="#" class="text-white hover:text-secondary transition">Book Consultation</a></li>
                    <li><a href="#" class="text-white hover:text-secondary transition">Patient Care</a></li>
                    <li><a href="#" class="text-white hover:text-secondary transition">Aftercare Support</a></li>
                    <li><a href="#" class="text-white hover:text-secondary transition">How To Order</a></li>
                </ul>
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
                <form class="mb-6">
                    <button
                        class="w-full bg-white hover:bg-black hover:text-white text-secondary py-4 rounded-full transition  ">
                        Sign up
                    </button>
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
                <div class="flex flex-wrap justify-center gap-7">
                    <a href="#" class="text-white hover:text-secondary transition">
                        Cookies Policy
                    </a>
                    <a href="#" class="text-white hover:text-secondary transition">
                        Privacy Policy
                    </a>
                    <a href="#" class="text-white hover:text-secondary transition">
                        Shipping Policy
                    </a>
                    <a href="#" class="text-white hover:text-secondary transition">
                        Returns & Refunds
                    </a>
                    <a href="#" class="text-white hover:text-secondary transition">
                        Sitemap
                    </a>
                </div>
                <p class="text-white">
                    © 2026 Ilam Din Dental
                </p>
            </div>
        </div>
    </div>
</footer>
<button id="openQuotePopup"
    class="right-5 !py-5 opacity-100 pointer-events-auto sm:block hidden fixed top-1/2 -translate-y-1/2 h-[365px] bg-black/30 text-white backdrop-blur-[30px] text-2xl rounded-[19px] z-[999] [writing-mode:vertical-rl] transition-all duration-500 ease-in-out">
    <span>Get a Quote</span>
</button>
<div id="quotePopup" class="fixed inset-0 w-full bg-transparent flex flex-col items-end justify-center z-50 
     translate-x-full opacity-0 pointer-events-none transition-all duration-500 ease-in-out">
    <?php get_template_part('template-parts/main-popup'); ?>
</div>

<?php wp_footer(); ?>
</body>

</html>