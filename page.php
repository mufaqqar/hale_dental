<?php get_header(); ?>

<main id="primary" class="content-area max-w-4xl mx-auto">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md p-8'); ?>>
            <h1 class="text-3xl font-bold text-amber-900 mb-6"><?php the_title(); ?></h1>
            <div class="prose max-w-none">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
