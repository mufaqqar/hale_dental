<?php
$steps = [
    [
        "id" => 1,
        "title" => "Place Your Order",
        "description" => "Place your order online quickly and easily, share your requirements, receive a fast quote, and start your packaging project confidently."
    ],
    [
        "id" => 2,
        "title" => "Artwork Creation",
        "description" => "Our expert team creates custom packaging designs, provides mockups for approval, and ensures your branding looks professional and impactful."
    ],
    [
        "id" => 3,
        "title" => "Production",
        "description" => "Review final details, approve artwork and specifications, confirm pricing, and give production approval before we begin manufacturing your packaging."
    ],
    [
        "id" => 4,
        "title" => "Fast Doorstep Delivery",
        "description" => "Your finished packaging is carefully produced, securely packed, and delivered on time across the UK with reliable tracking."
    ],
];
?>

<section
    class='md:py-14 py-10 relative bg-center bg-no-repeat bg-cover before:content-[""] before:absolute before:w-full before:bg-[#191919]  before:h-full before:top-0'>
    <div class="container mx-auto px-4 relative z-10 flex md:flex-row flex-col gap-7">
        <div class="md:w-1/2 w-full">
            <div
                class="bg-white/5 backdrop-blur-[10px] h-full max-w-[546px] mx-auto rounded-2xl md:px-14 md:py-8 p-8 md:gap-12 gap-12 flex flex-col">
                <?php foreach ($steps as $index => $step): ?>
                    <div class="step">
                        <span
                            class="before_line <?php echo ($index === count($steps) - 1) ? 'before:content-none' : 'before:content-[""] '; ?>">
                            <?php echo '0' . esc_html($step['id']); ?>
                        </span>

                        <div>
                            <h4 class="">
                                <?php echo esc_html($step['title']); ?>
                            </h4>
                            <p class="text-sm font-light text-white">
                                <?php echo esc_html($step['description']); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="md:w-1/2 w-full">
            <h4 class="text-xl font-semibold text-white mb-4 flex items-center gap-3 sm:justify-start justify-center">
                <span> Stronger Protection. </span>
                <span class="block border-b-2 border-white max-w-[61px] w-full"></span>
            </h4>
            <h2 class="md:text-4xl text-2xl font-bold text-white mb-8 sm:text-left text-center">
                Smarter Branding. Guaranteed Impact.
            </h2>
            <form id="contact-form" class="grid gap-4 mt-5 bg-white/5 backdrop-blur-[10px] md:p-8 p-6 rounded-[20px]">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <input type="text" name="fullname" id="fullname" class="hale_input" placeholder="Full Name">
                        <span class="error-message"></span>
                    </div>

                    <div class="form-group">
                        <input type="tel" name="phone" id="phone" class="hale_input" placeholder="Your Contact">
                        <span class="error-message"></span>
                    </div>

                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="hale_input" placeholder="Email Address">
                        <span class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <select name="product" id="product" class="hale_input">
                            <option value="">Select Product</option>
                            <?php
                            $products = get_posts([
                                'post_type' => 'product',
                                'posts_per_page' => -1
                            ]);

                            foreach ($products as $post):

                                setup_postdata($post);

                                ?>

                                <option value="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </option>

                            <?php endforeach;
                            wp_reset_postdata(); ?>

                        </select>

                        <span class="error-message"></span>

                    </div>

                </div>

                <div class="form-group">

                    <textarea name="message" id="message" rows="5" class="hale_input !rounded-[19px] !min-h-[170px] md:pt-2"
                        placeholder="Write Your Message"></textarea>

                    <span class="error-message"></span>

                </div>

                <div class="flex items-center gap-3">

                    <input type="checkbox" id="acceptance" name="acceptance">

                    <label for="acceptance" class="text-white">

                        I agree that my data is collected and stored.

                    </label>

                </div>

                <span class="error-message acceptance-error"></span>

                <button class="form_btn" type="submit">

                    Submit

                </button>

            </form>
        </div>
    </div>
</section>