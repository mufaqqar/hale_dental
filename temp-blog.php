<?php
/**
 * Template Name: Blog
 */

get_header();
?>


<!-- =========================
     BLOG HERO
========================= -->
<section class="bg-[#f5f5f5] pt-32 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-[1250px] rounded-[28px] bg-white p-4 sm:p-5">

        <div class="relative min-h-[370px] overflow-hidden rounded-[18px] bg-[#f7f7f7]">

            <div class="absolute right-[18%] top-[-80px] h-[300px] w-[300px] rounded-full bg-[#dce5ff] opacity-80 blur-[90px]"></div>

            <div class="relative z-10 flex min-h-[370px] flex-col items-center justify-center">

                <h1 class="text-center text-4xl font-bold tracking-[-1.5px] text-black sm:text-5xl">
                    Blog
                </h1>

            </div>

        </div>

    </div>
</section>


<!-- =========================
     BLOG LISTING
========================= -->
<section class="bg-[#f5f5f5] py-10 md:py-14">

    <div class="mx-auto max-w-[1250px] px-4 ">

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[minmax(0,1fr)_310px]">


            <!-- =========================
                 LEFT SIDE BLOG POSTS
            ========================== -->
            <div class="space-y-5">

                <?php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                $args = array(
                    'post_type'      => 'post',
                    'post_status'    => 'publish',
                    'posts_per_page' => 10,
                    'paged'          => $paged,
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) :

                    while ($query->have_posts()) :
                        $query->the_post();

                        $categories = get_the_category();

                        $category_name = !empty($categories)
                            ? $categories[0]->name
                            : 'Dental Treatments';

                        $excerpt = get_the_excerpt();

                        if (empty($excerpt)) {
                            $excerpt = wp_trim_words(
                                wp_strip_all_tags(get_the_content()),
                                22,
                                '...'
                            );
                        }
                ?>


                    <!-- BLOG CARD -->
                    <article class="rounded-[22px] border border-[#e8e8e8] bg-white p-3 shadow-sm transition duration-300 hover:shadow-md sm:p-4">


                        <!-- Featured Image -->
                        <div class="relative h-[190px] overflow-hidden rounded-[16px] sm:h-[230px] md:h-[265px]">

                            <a href="<?php the_permalink(); ?>">

                                <?php if (has_post_thumbnail()) : ?>

                                    <?php the_post_thumbnail(
                                        'large',
                                        array(
                                            'class' => 'h-full w-full object-cover transition duration-500 hover:scale-[1.02]'
                                        )
                                    ); ?>

                                <?php else : ?>

                                    <img
                                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/blog-image.webp'); ?>"
                                        alt="<?php echo esc_attr(get_the_title()); ?>"
                                        class="h-full w-full object-cover"
                                    >

                                <?php endif; ?>

                            </a>


                            <!-- Category Badge -->
                            <span class="absolute left-3 top-3 rounded-[9px] border border-[#4169e1] bg-white/95 px-3 py-1.5 text-[10px] font-medium text-[#4169e1] shadow-sm sm:text-[11px]">

                                <?php echo esc_html($category_name); ?>

                            </span>

                        </div>

                        <!-- CONTENT -->
                        <div class="pt-3 sm:pt-4">

                            <!-- Title -->
<h2 class="mb-2 text-[16px] font-bold leading-[1.3] tracking-[-0.4px] text-[#292929] sm:text-[28px]">

    <?php the_title(); ?>

</h2>

<!-- Excerpt -->
<p class="mb-4 overflow-hidden text-ellipsis whitespace-nowrap text-[13px] leading-5  sm:text-[15px]">
    <?php echo esc_html($excerpt); ?>
</p>
                            <!-- Bottom Info -->
                            <div class="flex items-center justify-between gap-4">
                                <!-- Author -->
                                <div class="flex items-center gap-2">
                                    <?php
                                    $author_id = get_the_author_meta('ID');
                                    ?>
                                    <?php echo get_avatar(
                                        $author_id,
                                        40,
                                        '',
                                        get_the_author(),
                                        array(
                                            'class' => 'h-7 w-7 rounded-full object-cover'
                                        )
                                    ); ?>

                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-medium text-[#333] sm:text-[11px]">
                                            <?php the_author(); ?>
                                        </span>
                                        <!-- Blue Dot -->
                                        <span class="h-[5px] w-[5px] rounded-full bg-[#4169e1]"></span>
                                        <!-- Date -->
                                        <span class="text-[9px] text-[#555] sm:text-[10px]">
                                            <?php echo esc_html(get_the_date('d.m.Y')); ?>
                                        </span>
                                    </div>
                                </div>
                                <!-- Arrow -->
                                <a
                                    href="<?php the_permalink(); ?>"
                                    aria-label="<?php echo esc_attr('Read ' . get_the_title()); ?>"
                                    class="flex h-7 w-7 items-center justify-center text-[18px] font-medium text-[#222] transition hover:text-[#4169e1]"
                                >
                                    →
                                </a>
                            </div>
                        </div>
                    </article>
                <?php
                    endwhile;

                else :
                ?>
                    <div class="rounded-[20px] bg-white p-10 text-center">

                        <h2 class="text-xl font-bold text-black">
                            No posts found
                        </h2>

                    </div>

                <?php
                endif;
                wp_reset_postdata();
                ?>
                <!-- =========================
                     PAGINATION
                ========================== -->
                <?php if ($query->max_num_pages > 1) : ?>
                 <div class="pt-5">
                        <div class="flex justify-center">
                            <?php
                            echo paginate_links(array(
                                'total'     => $query->max_num_pages,
                                'current'   => $paged,
                                'prev_text' => '←',
                                'next_text' => '→',
                                'type'      => 'list',
                            ));
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- =========================
                 RIGHT SIDEBAR
            ========================== -->
            <aside class="space-y-5">
                <!-- SEARCH BOX -->
                <div class="rounded-[18px] bg-white p-4 shadow-sm sm:p-5">
                    <h2 class="mb-4 text-[15px] font-semibold text-[#333]">
                        Find Your Information
                    </h2>
                    <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="relative">
                            <!-- Search Icon -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                            >
                                <circle cx="11" cy="11" r="7"></circle>
                                <path d="m20 20-3.5-3.5"></path>
                            </svg>
                            <input
                                type="search"
                                name="s"
                                value="<?php echo esc_attr(get_search_query()); ?>"
                                placeholder="Search A Blog Content"
                                class="h-[46px] w-full rounded-[12px] border border-[#4169e1] bg-[#fafafa] pl-10 pr-4 text-[11px] text-gray-700 outline-none transition focus:ring-2 focus:ring-[#4169e1]/20"
                            >
                        </div>
                        <button
                            type="submit"
                            class="mt-4 h-[48px] w-full rounded-[12px] bg-gradient-to-r from-[#5277d7] to-[#35529b] text-[13px] font-semibold text-white transition hover:opacity-90"
                        >
                            Search
                        </button>
                    </form>
                </div>

                <!-- =========================
                     LAST PUBLISHED
                ========================== -->
                <div class="rounded-[18px] bg-white p-4 shadow-sm sm:p-5">
                    <h2 class="mb-4 text-[15px] font-semibold text-[#333]">
                        Last Published
                    </h2>
                    <div class="space-y-3">
                        <?php
                        $latest_args = array(
                            'post_type'      => 'post',
                            'post_status'    => 'publish',
                            'posts_per_page' => 3,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        );
                        $latest_query = new WP_Query($latest_args);
                        if ($latest_query->have_posts()) :
                            while ($latest_query->have_posts()) :
                                $latest_query->the_post();
                        ?>
                               <a
                                    href="<?php the_permalink(); ?>"
                                    class="flex items-center gap-3 rounded-[12px] bg-[#f7f7f7] p-2 transition hover:bg-[#f0f0f0]"
                                >
                                    <!-- Thumbnail -->
                                    <div class="h-[62px] w-[62px] shrink-0 overflow-hidden rounded-[9px]">
                                     <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail(
                                                'thumbnail',
                                                array(
                                                    'class' => 'h-full w-full object-cover'
                                                )
                                            ); ?>
                                        <?php else : ?>
                                            <img
                                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/blog-image.webp'); ?>"
                                                alt="<?php echo esc_attr(get_the_title()); ?>"
                                                class="h-full w-full object-cover"
                                            >
                                        <?php endif; ?>
                                    </div>
                                    <!-- Post Title -->
                                    <h3 class="text-[13px] font-semibold leading-[1.5] text-[#292929]">
                                        <?php
                                        echo esc_html(
                                            wp_trim_words(
                                                get_the_title(),
                                                8,
                                                '...'
                                            )
                                        );
                                        ?>
                                    </h3>
                                </a>
                        <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>



<?php get_footer(); ?>