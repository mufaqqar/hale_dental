<?php
/**
 * Brands slider: logos come from the "brands" CPT, the description below
 * the slider swaps on click / on autoplay for the active brand.
 *
 * @package hale-dental
 */

$brands_query = new WP_Query( [
	'post_type'      => 'brands',
	'post_status'    => 'publish',
	'posts_per_page' => 12,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'no_found_rows'  => true,
] );

$fallback_text = esc_html__( 'We utilise NIQ standards for data-driven insights and patient satisfaction analysis. This partnership validates our transparency and our commitment to continuously improving the patient experience through internationally verified data.', 'hale-dental' );

$fallback_logos = [
	'1.svg',
	'2.svg',
	'3.webp',
	'4.svg',
	'5.webp',
	'6.svg',
	'7.svg',
	'8.svg',
	'4.svg',
];

$first_text     = '';
$first_has_run  = false;
$logo_classes   = 'flex h-[35px] w-[117px] items-center justify-center';
$image_classes  = 'h-full w-full object-contain';
?>

<section class="w-full bg-gray-400 py-12">
	<div class="mx-auto px-4 py-5 brand-slider">
		<?php if ( $brands_query->have_posts() ) : ?>
			<?php
			$brand_index = 0;
			while ( $brands_query->have_posts() ) :
				$brands_query->the_post();

				$brand_id    = get_the_ID();
				$is_active   = ( 0 === $brand_index );
				$brand_index++;

				$description = function_exists( 'get_field' )
					? get_field( 'brand_description', $brand_id )
					: '';
				if ( empty( $description ) ) {
					$description = get_post_meta( $brand_id, 'brand_description', true );
				}
				if ( empty( $description ) ) {
					$description = get_the_excerpt( $brand_id );
				}
				if ( empty( $description ) ) {
					$description = get_the_content( null, false, $brand_id );
				}

				$text_html = trim( wpautop( wp_strip_all_tags( $description ) ) );
				$text_attr = preg_replace( '/\s+/', ' ', $text_html );

				if ( ! $first_has_run ) {
					$first_text    = $text_html;
					$first_has_run = true;
				}
				?>
				<div class="brand-slide">
					<button type="button" aria-controls="brand-slider-text"
						aria-pressed="<?php echo $is_active ? 'true' : 'false'; ?>"
						class="brand-logo <?php echo $is_active ? 'is-active' : ''; ?>"
						data-brand-text="<?php echo esc_attr( $text_attr ); ?>"
						title="<?php echo esc_attr( get_the_title( $brand_id ) ); ?>">
						<?php
						if ( has_post_thumbnail( $brand_id ) ) {
							echo wp_get_attachment_image(
								get_post_thumbnail_id( $brand_id ),
								'full',
								false,
								[
									'class'   => $image_classes,
									'alt'     => get_the_title( $brand_id ),
									'width'   => '117',
									'height'  => '35',
									'loading' => 'lazy',
								]
							);
						} else {
							printf(
								'<img src="%s" alt="%s" width="117" height="35" class="%s" loading="lazy" />',
								esc_url( get_template_directory_uri() . '/assets/images/1.svg' ),
								esc_attr( get_the_title( $brand_id ) ),
								esc_attr( $image_classes )
							);
						}
						?>
					</button>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		<?php else : ?>
			<?php foreach ( $fallback_logos as $logo ) : ?>
				<div class="<?php echo esc_attr( $logo_classes ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $logo ); ?>"
						alt="<?php echo esc_attr__( 'Dental partner logo', 'hale-dental' ); ?>" width="117"
						height="35" class="<?php echo esc_attr( $image_classes ); ?>" loading="lazy" />
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<div class="container mx-auto px-4 text-center mt-6">
		<div id="brand-slider-text" aria-live="polite"
			class="brand-slider-text text-base leading-[1.55] text-secondaryLight font-normal">
			<?php echo $first_has_run ? $first_text : esc_html( $fallback_text ); ?>
		</div>
	</div>
</section>
