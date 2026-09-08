<?php get_header(); ?>

<main id="primary" class="content-area text-center py-20">
    <h1 class="text-6xl font-bold text-amber-900 mb-4">404</h1>
    <p class="text-xl text-gray-600 mb-8"><?php _e('Page not found.', 'hale-coffee'); ?></p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block bg-amber-900 text-white px-6 py-3 rounded-lg no-underline hover:bg-amber-800">
        <?php _e('Go Home', 'hale-coffee'); ?>
    </a>
</main>

<?php get_footer(); ?>
