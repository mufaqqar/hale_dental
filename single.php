<?php get_header(); ?>

<main id="primary" class="content-area max-w-4xl mx-auto">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md p-8'); ?>>
            <?php if (has_post_thumbnail()) : ?>
                <div class="mb-6">
                    <?php the_post_thumbnail('large', ['class' => 'w-full rounded-lg']); ?>
                </div>
            <?php endif; ?>

            <h1 class="text-3xl font-bold text-amber-900 mb-4"><?php the_title(); ?></h1>

            <div class="text-sm text-gray-500 mb-6">
                <?php echo get_the_date(); ?> by <?php the_author(); ?> in <?php the_category(', '); ?>
            </div>

            <div class="prose max-w-none">
                <?php the_content(); ?>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <?php the_tags('<span class="font-semibold">Tags:</span> ', ', '); ?>
            </div>

            <div class="mt-8">
                <?php
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                ?>
            </div>

            <nav class="mt-8 flex justify-between">
                <div><?php previous_post_link('%link', '&larr; %title'); ?></div>
                <div><?php next_post_link('%link', '%title &rarr;'); ?></div>
            </nav>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
