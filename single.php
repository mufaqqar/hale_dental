<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <!-- =========================
         SINGLE POST HERO
    ========================= -->
    <section class="bg-[#f5f5f5] px-4 pb-10 pt-32 sm:px-6 md:pb-14 lg:px-8">

        <div class="mx-auto max-w-[1250px]">

            <div class="rounded-[28px] bg-white p-4 sm:p-5">

                <div class="relative min-h-[370px] overflow-hidden rounded-[18px] bg-[#f7f7f7]">

                    <?php if (has_post_thumbnail()) : ?>

                        <?php the_post_thumbnail(
                            'large',
                            array(
                                'class' => 'absolute inset-0 h-full w-full object-cover'
                            )
                        ); ?>

                        <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-black/60 to-transparent"></div>

                    <?php else : ?>

                        <div class="absolute right-[18%] top-[-80px] h-[300px] w-[300px] rounded-full bg-[#dce5ff] opacity-80 blur-[90px]"></div>
                        <div class="absolute left-[8%] bottom-[-100px] h-[260px] w-[260px] rounded-full bg-[#e3f0ff] opacity-80 blur-[90px]"></div>

                    <?php endif; ?>

                    <div class="relative z-10 flex min-h-[370px] flex-col items-center justify-center px-6 text-center">

                        <?php $categories = get_the_category(); ?>
                        <?php if (!empty($categories)) : ?>
                            <span class="mb-4 rounded-full border border-[#4169e1] bg-white/95 px-4 py-1.5 text-[11px]  text-[#4169e1] shadow-sm">
                                <?php echo esc_html($categories[0]->name); ?>
                            </span>
                        <?php endif; ?>

                        <h1 class="max-w-[850px] text-3xl font-bold leading-[1.15] tracking-[-1.5px] text-black sm:text-5xl">
                            <?php the_title(); ?>
                        </h1>

                    </div>

                </div>

            </div>

            <div class="mt-5 grid grid-cols-1 gap-5 lg:grid-cols-[minmax(0,1fr)_310px]">

                <!-- =========================
                     MAIN POST CONTENT
                ========================= -->
                <div class="space-y-5">

                    <article id="post-<?php the_ID(); ?>" <?php post_class('rounded-[22px] border border-[#e8e8e8] bg-white p-4 shadow-sm sm:p-6'); ?>>

                        <!-- Post Meta -->
                        <div class="flex flex-wrap items-center gap-3 border-b border-[#f0f0f0] pb-5">

                            <div class="flex items-center gap-2">
                                <?php $author_id = get_the_author_meta('ID'); ?>
                                <?php echo get_avatar(
                                    $author_id,
                                    40,
                                    '',
                                    get_the_author(),
                                    array('class' => 'h-9 w-9 rounded-full object-cover')
                                ); ?>

                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-[13px]   text-[#333]">
                                        <?php the_author(); ?>
                                    </span>
                                    <span class="h-[5px] w-[5px] rounded-full bg-[#4169e1]"></span>
                                    <span class="text-[11px] text-[#777]">
                                        <?php echo esc_html(get_the_date('d.m.Y')); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="ml-auto">
                                <a
                                    href="<?php echo esc_url(home_url('/blog/')); ?>"
                                    class="text-[12px]  text-[#4169e1] transition hover:text-[#2165ed]"
                                >
                                    ← Back to Blog
                                </a>
                            </div>

                        </div>

                        <!-- Content -->
                        <div class="post-content pt-6">
                            <?php the_content(); ?>
                        </div>

                        <!-- Tags -->
                        <?php if (has_tag()) : ?>
                            <div class="mt-8 flex flex-wrap items-center gap-2 border-t border-[#f0f0f0] pt-6">
                                <span class="text-[12px]   text-[#333]">
                                    Tags:
                                </span>
                                <?php
                                the_tags('<span class="flex flex-wrap gap-2">', '', '</span>');
                                ?>
                            </div>
                        <?php endif; ?>

                    </article>

                    <!-- Prev / Next -->
                    <nav class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <div class="rounded-[18px] border border-[#e8e8e8] bg-white p-4 shadow-sm transition hover:shadow-md">
                            <span class="text-[10px]  uppercase tracking-wider text-[#999]">
                                Previous Article
                            </span>
                            <div class="mt-2 text-[13px]   leading-[1.5] text-[#292929]">
                                <?php previous_post_link('%link', '&larr; %title'); ?>
                            </div>
                        </div>

                        <div class="rounded-[18px] border border-[#e8e8e8] bg-white p-4 text-right shadow-sm transition hover:shadow-md">
                            <span class="text-[10px]  uppercase tracking-wider text-[#999]">
                                Next Article
                            </span>
                            <div class="mt-2 text-[13px]   leading-[1.5] text-[#292929]">
                                <?php next_post_link('%link', '%title &rarr;'); ?>
                            </div>
                        </div>

                    </nav>

                    <!-- Comments -->
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <div class="rounded-[18px] border border-[#e8e8e8] bg-white p-4 shadow-sm sm:p-6">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>

                </div>

                <!-- =========================
                     SIDEBAR
                ========================= -->
                <aside class="space-y-5">

                    <!-- SEARCH -->
                    <div class="rounded-[18px] bg-white p-4 shadow-sm sm:p-5">
                        <h2 class="mb-4 text-[15px]   text-[#333]">
                            Find Your Information
                        </h2>
                        <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
                            <div class="relative">
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
                                class="mt-4 h-[48px] w-full rounded-[12px] bg-gradient-to-r from-[#5277d7] to-[#35529b] text-[13px]   text-white transition hover:opacity-90"
                            >
                                Search
                            </button>
                        </form>
                    </div>

                    <!-- LAST PUBLISHED -->
                    <div class="rounded-[18px] bg-white p-4 shadow-sm sm:p-5">
                        <h2 class="mb-4 text-[15px]   text-[#333]">
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
                                    <div class="h-[62px] w-[62px] shrink-0 overflow-hidden rounded-[9px]">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail(
                                                'thumbnail',
                                                array('class' => 'h-full w-full object-cover')
                                            ); ?>
                                        <?php else : ?>
                                            <img
                                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/blog-image.webp'); ?>"
                                                alt="<?php echo esc_attr(get_the_title()); ?>"
                                                class="h-full w-full object-cover"
                                            >
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="text-[13px]   leading-[1.5] text-[#292929]">
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

<?php endwhile; ?>

<?php get_footer(); ?>