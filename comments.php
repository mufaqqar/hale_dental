<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="text-2xl font-bold text-amber-900 mb-6">
            <?php
            printf(
                _n('One comment', '%1$s comments', get_comments_number(), 'hale-coffee'),
                number_format_i18n(get_comments_number())
            );
            ?>
        </h2>

        <ol class="comment-list space-y-6">
            <?php
            wp_list_comments([
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
            ]);
            ?>
        </ol>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav class="mt-8 flex justify-between">
                <div><?php previous_comments_link(__('&larr; Older Comments', 'hale-coffee')); ?></div>
                <div><?php next_comments_link(__('Newer Comments &rarr;', 'hale-coffee')); ?></div>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="text-gray-500"><?php _e('Comments are closed.', 'hale-coffee'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>
</div>
