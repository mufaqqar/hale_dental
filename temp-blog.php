<?php
/** Template Name: Blog */
get_header(); ?>
<section class='pt-14'>
    <div class='container mx-auto px-4'>
        <div>
            <h1 class='md:text-[51px] md:leading-normal text-3xl font-bold text-title_Clr text-center mb-4'>
                Blogs
            </h1>
            <p class='text-xl font-normal text-title_Clr text-center max-w-[820px] mx-auto'>
                Choose a packaging style for your custom boxes, start designing with us, and get your boxes with the
                most advanced printing techniques.
            </p>
        </div>
    </div>
</section>
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 grid-cols-1 md:gap-[30px] gap-7">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => -1
            );

            $query = new WP_Query($args);

            if ($query->have_posts()):
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="shadow-[-1px_3px_10px_0px_rgba(0,0,0,0.06)] border border-[#E5E5E5]">
                        <div class="h-[264px]">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium_large', [
                                        'class' => 'w-full h-full object-cover object-center'
                                    ]); ?>
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/480x264" alt="<?php the_title(); ?>"
                                        class="w-full h-full object-cover object-center">
                                <?php endif; ?>
                            </a>
                        </div>

                        <!-- Content -->
                        <div class="md:p-7 p-5">
                            <!-- Category -->
                            <p class="text-sm font-semibold text-secondary/80 bg-[#F1F5F9] px-2 py-1 rounded-lg w-fit">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo esc_html($categories[0]->name);
                                }
                                ?>
                            </p>
                            <!-- Title -->
                            <h4>
                                <a href="<?php the_permalink(); ?>"
                                    class="md:text-xl text-lg font-bold text-black inline-flex my-5">
                                    <?php the_title(); ?>
                                </a>
                            </h4>

                            <!-- Read More -->
                            <p>
                                <a href="<?php the_permalink(); ?>"
                                    class="text-base font-normal text-secondary inline-flex items-center gap-3">
                                    Read More
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em"
                                        fill="currentColor">
                                        <path
                                            d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z">
                                        </path>
                                    </svg>
                                </a>
                            </p>

                        </div>

                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p class="text-xl font-normal text-title_Clr text-center max-w-[820px] mx-auto md:col-span-3">No posts found</p>';
            endif;
            ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>