<?php
/**
 * The sidebar template
 *
 * @package Hale_Dental
 */
?>

<div class="space-y-6">
    <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-blog' ); ?>
    <?php else : ?>

    <!-- Search Widget -->
    <div class="bg-dental-off-white rounded-theme p-6">
        <h4 class="font-heading text-lg   text-primary-dark mb-4"><?php esc_html_e( 'Search', 'hale-dental' ); ?></h4>
        <?php get_search_form(); ?>
    </div>

    <!-- Categories Widget -->
    <div class="bg-dental-off-white rounded-theme p-6">
        <h4 class="font-heading text-lg   text-primary-dark mb-4"><?php esc_html_e( 'Categories', 'hale-dental' ); ?></h4>
        <ul class="space-y-2 text-sm">
            <?php wp_list_categories( array(
                'title_li' => '',
                'class'    => 'text-dental-gray hover:text-primary transition-colors',
            ) ); ?>
        </ul>
    </div>

    <!-- Recent Posts Widget -->
    <div class="bg-dental-off-white rounded-theme p-6">
        <h4 class="font-heading text-lg   text-primary-dark mb-4"><?php esc_html_e( 'Recent Posts', 'hale-dental' ); ?></h4>
        <ul class="space-y-3">
            <?php
            $recent = new WP_Query( array(
                'posts_per_page' => 5,
                'no_found_rows'  => true,
            ) );
            while ( $recent->have_posts() ) : $recent->the_post();
            ?>
            <li>
                <a href="<?php the_permalink(); ?>" class="flex items-start space-x-3 group">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="w-16 h-12 rounded-lg overflow-hidden flex-shrink-0">
                            <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform' ) ); ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <span class="text-sm font-medium text-dental-dark-gray group-hover:text-primary transition-colors leading-tight block"><?php the_title(); ?></span>
                        <span class="text-xs text-dental-gray"><?php echo esc_html( get_the_date() ); ?></span>
                    </div>
                </a>
            </li>
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>
    </div>

    <?php endif; ?>
</div>
