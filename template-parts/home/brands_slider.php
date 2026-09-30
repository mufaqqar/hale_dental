<?php
/**
 * Brands slider + tabs
 *
 * Each brand logo acts as a tab.
 * The corresponding description is shown when the brand is active.
 *
 * @package hale-dental
 */

$brands_query = new WP_Query([
	'post_type' => 'brands',
	'post_status' => 'publish',
	'posts_per_page' => 12,
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'no_found_rows' => true,
]);

$fallback_text = esc_html__(
	'We utilise NIQ standards for data-driven insights and patient satisfaction analysis. This partnership validates our transparency and our commitment to continuously improving the patient experience through internationally verified data.',
	'hale-dental'
);

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

$image_classes = 'h-full w-full object-contain';
?>

<section class="w-full bg-gray-100 py-12">

	<div class="container mx-auto px-4">

		<?php if ($brands_query->have_posts()): ?>

			<!-- BRAND LOGO SLIDER -->
			<div class="brand-slider">

				<?php
				$brand_index = 0;

				while ($brands_query->have_posts()):
					$brands_query->the_post();

					$brand_id = get_the_ID();
					$is_active = (0 === $brand_index);

					/*
					 * Get brand description
					 */
					$description = '';

					if (function_exists('get_field')) {
						$description = get_field('brand_description', $brand_id);
					}

					if (empty($description)) {
						$description = get_post_meta(
							$brand_id,
							'brand_description',
							true
						);
					}

					if (empty($description)) {
						$description = get_the_excerpt($brand_id);
					}

					if (empty($description)) {
						$description = get_the_content(
							null,
							false,
							$brand_id
						);
					}

					/*
					 * Clean description for the content panel
					 */
					$description = wp_kses_post($description);

					?>

					<div class="brand-slide" data-brand-index="<?php echo esc_attr($brand_index); ?>">

						<button type="button" class="brand-logo <?php echo $is_active ? 'is-active' : ''; ?>"
							data-brand-tab="<?php echo esc_attr($brand_index); ?>"
							aria-controls="brand-content-<?php echo esc_attr($brand_index); ?>"
							aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
							title="<?php echo esc_attr(get_the_title($brand_id)); ?>">

							<?php if (has_post_thumbnail($brand_id)): ?>

								<?php
								echo wp_get_attachment_image(
									get_post_thumbnail_id($brand_id),
									'full',
									false,
									[
										'class' => $image_classes,
										'alt' => get_the_title($brand_id),
										'width' => '117',
										'height' => '35',
										'loading' => 'lazy',
									]
								);
								?>

							<?php else: ?>

								<img src="<?php echo esc_url(
									get_template_directory_uri() . '/assets/images/1.svg'
								); ?>" alt="<?php echo esc_attr(get_the_title($brand_id)); ?>" width="117"
									height="35" class="<?php echo esc_attr($image_classes); ?>" loading="lazy" />

							<?php endif; ?>

						</button>

					</div>

					<?php
					$brand_index++;

				endwhile;

				wp_reset_postdata();
				?>

			</div>

			<!-- BRAND CONTENT / TABS -->
			<div class="brand-content-wrapper mt-8">

				<?php
				$content_index = 0;

				$brands_query->rewind_posts();

				while ($brands_query->have_posts()):
					$brands_query->the_post();

					$brand_id = get_the_ID();

					/*
					 * Get description again
					 */
					$description = '';

					if (function_exists('get_field')) {
						$description = get_field(
							'brand_description',
							$brand_id
						);
					}

					if (empty($description)) {
						$description = get_post_meta(
							$brand_id,
							'brand_description',
							true
						);
					}

					if (empty($description)) {
						$description = get_the_excerpt($brand_id);
					}

					if (empty($description)) {
						$description = get_the_content(
							null,
							false,
							$brand_id
						);
					}

					?>

					<div id="brand-content-<?php echo esc_attr($content_index); ?>"
						class="brand-content <?php echo 0 === $content_index ? 'is-active' : ''; ?>"
						data-brand-content="<?php echo esc_attr($content_index); ?>" <?php echo 0 !== $content_index ? 'hidden' : ''; ?>>

						<div class="mx-auto max-w-4xl text-center">

							<?php if (!empty($description)): ?>

								<div class="text-base leading-[1.55] text-secondaryLight font-normal">
									<?php echo wp_kses_post($description); ?>
								</div>

							<?php else: ?>

								<div class="text-base leading-[1.55] text-secondaryLight font-normal">
									<?php echo esc_html($fallback_text); ?>
								</div>

							<?php endif; ?>

						</div>

					</div>

					<?php
					$content_index++;

				endwhile;

				wp_reset_postdata();
				?>

			</div>

		<?php else: ?>

			<!-- FALLBACK LOGOS -->
			<div class="brand-slider">

				<?php foreach ($fallback_logos as $logo): ?>

					<div class="brand-slide">

						<div class="flex h-[35px] w-[117px] items-center justify-center">

							<img src="<?php echo esc_url(
								get_template_directory_uri() .
								'/assets/images/' .
								$logo
							); ?>" alt="<?php echo esc_attr__(
							 	'Dental partner logo',
							 	'hale-dental'
							 ); ?>" width="117" height="35" class="<?php echo esc_attr($image_classes); ?>"
								loading="lazy" />

						</div>

					</div>

				<?php endforeach; ?>

			</div>

			<div class="mx-auto mt-8 max-w-4xl text-center">

				<div class="text-base leading-[1.55] text-secondaryLight font-normal">
					<?php echo esc_html($fallback_text); ?>
				</div>

			</div>

		<?php endif; ?>

	</div>

</section>