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
        <div class="text-sm text-gray-500 mb-4">
            <?php echo get_the_date(); ?> by <?php the_author(); ?>
        </div>
        <div class="prose max-w-none">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>
