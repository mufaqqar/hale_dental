<section class="py-16 bg-[#F8F5F0]">
    <div class="container mx-auto px-4">

        <div class="flex items-center justify-between mb-10">

            <div>
                <span class="text-secondary uppercase tracking-[4px] text-sm font-semibold">
                    Loved by 500+ brands worldwide
                </span>

                <h2 class="text-4xl font-bold text-coff_black mt-2">
                    Customer Stories
                </h2>
            </div>

            <a href="#"
                class="border border-secondary text-secondary hover:bg-secondary hover:text-white transition-all duration-300 rounded-full px-7 py-3 font-medium">
                View All Stories
            </a>

        </div>

        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">

            <!-- Card -->

            <article class="group bg-white overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">

                <div class="overflow-hidden">

                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post1.jpg"
                        class="w-full h-60 object-cover group-hover:scale-110 transition duration-500" alt="">

                </div>

                <div class="p-6">
                    <ul class="flex gap-1 items-center text-sm">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <li class="text-[#FFAE00]"><i class="fa-solid fa-star"></i></li>
                        <?php endfor; ?>
                    </ul>
                    <h3 class="text-lg font-semibold text-coff_black mb-3 group-hover:text-secondary transition">

                        Choosing the Perfect Coffee Packaging

                    </h3>

                    <p class="text-gray-600 leading-7 mb-6">

                        Learn how different packaging materials preserve freshness,
                        aroma and shelf life for specialty coffee.

                    </p>
                </div>

            </article>

            <!-- Card -->

            <article class="group bg-white overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">

                <div class="overflow-hidden">

                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post2.jpg"
                        class="w-full h-60 object-cover group-hover:scale-110 transition duration-500" alt="">

                </div>

                <div class="p-6">
                    <ul class="flex gap-1 items-center text-sm">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <li class="text-[#FFAE00]"><i class="fa-solid fa-star"></i></li>
                        <?php endfor; ?>
                    </ul>
                    <h3 class="text-lg font-semibold text-coff_black mb-3 group-hover:text-secondary transition">

                        Why Freshly Roasted Beans Matter

                    </h3>

                    <p class="text-gray-600 leading-7 mb-6">

                        Discover how roast dates influence flavour,
                        aroma and the overall coffee experience.

                    </p>
                </div>

            </article>

            <!-- Card -->

            <article class="group bg-white overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">

                <div class="overflow-hidden">

                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post3.jpg"
                        class="w-full h-60 object-cover group-hover:scale-110 transition duration-500" alt="">

                </div>

                <div class="p-6">
                    <ul class="flex gap-1 items-center text-sm">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <li class="text-[#FFAE00]"><i class="fa-solid fa-star"></i></li>
                        <?php endfor; ?>
                    </ul>
                    <h3 class="text-lg font-semibold text-coff_black mb-3 group-hover:text-secondary transition">

                        Sustainable Packaging for Coffee Brands

                    </h3>

                    <p class="text-gray-600 leading-7 mb-6">

                        Explore eco-friendly packaging solutions that
                        keep coffee fresh while reducing environmental impact.

                    </p>
                </div>

            </article>

        </div>

    </div>
</section>