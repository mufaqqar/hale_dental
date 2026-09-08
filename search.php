<?php get_header(); ?>

<main id="primary" class="content-area">
    <h1 class="text-3xl font-bold text-amber-900 mb-8">
        <?php printf(__('Search Results for: %s', 'hale-coffee'), get_search_query()); ?>
    </h1>

    <?php if (have_posts()) : ?>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="block">
                            <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
                        </a>
                    <?php endif; ?>
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="<?php the_permalink(); ?>" class="text-amber-900 no-underline hover:text-amber-700">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <div class="prose max-w-none">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="mt-8">
            <?php the_posts_pagination(); ?>
        </div>
    <?php else : ?>
        <p class="text-center text-gray-500"><?php _e('No results found.', 'hale-coffee'); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
