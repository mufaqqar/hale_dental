<?php get_header(); ?>

<main id="primary" class="content-area">
    <h1 class="text-3xl font-bold text-primary mb-8">
        <?php
        if (is_category()) {
            single_cat_title();
        } elseif (is_tag()) {
            single_tag_title();
        } elseif (is_author()) {
            printf(__('Author: %s', 'hale-coffee'), get_the_author());
        } elseif (is_date()) {
            echo get_the_date('F Y');
        } else {
            _e('Archives', 'hale-coffee');
        }
        ?>
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
                        <h2 class="text-xl   mb-2">
                            <a href="<?php the_permalink(); ?>" class="text-primary no-underline hover:text-secondary">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <div class="text-sm text-secondaryLight mb-4">
                            <?php echo get_the_date(); ?>
                        </div>
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
        <p class="text-center text-secondaryLight"><?php _e('No posts found.', 'hale-coffee'); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
