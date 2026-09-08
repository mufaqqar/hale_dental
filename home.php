<?php get_header(); ?>
<main id="primary" class="content-area">
    <?php if (have_posts()) : ?>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', get_post_type()); ?>
            <?php endwhile; ?>
        </div>

        <div class="mt-8">
            <?php the_posts_pagination(['class' => 'flex justify-center space-x-2']); ?>
        </div>
    <?php else : ?>
        <p class="text-center text-gray-500"><?php _e('No posts found.', 'hale-coffee'); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
