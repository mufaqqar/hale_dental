<!-- =========================================
             GET VIDEO TESTIMONIALS
        ========================================== -->

<?php

$testimonial_query = new WP_Query([
    'post_type' => 'video_testimonails',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
]);

?>

<?php if ($testimonial_query->have_posts()): ?>
    <section class="bg-[#f7f7f7] py-10">
        <div class="container mx-auto px-4">
            <div class="mx-auto mb-7 max-w-[1000px] text-center">
                <h2 class="text-3xl tracking-tight text-coff_black md:text-5xl">
                    Real, Life-Changing Transformations
                </h2>
                <p class="mx-auto mt-5 max-w-[900px] text-lg leading-relaxed text-coff_black">
                    Experience the impact of expert care through the voices of our patients.
                    Watch real testimonials from those who trusted Ilam Din Dental for their smile makeover.
                </p>
            </div>
            <div class="relative mt-6">
                <button type="button"
                    class="testimonial-prev absolute left-[-16px] top-1/2 z-30 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-md"
                    aria-label="Previous">
                    <svg class="h-4 w-4 text-[#4d7cff]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                </button>
                <div id="testimonial-slider" class="testimonial-slider flex flex-col gap-6 md:flex-row">
                    <?php while ($testimonial_query->have_posts()): ?>
                        <?php
                        $testimonial_query->the_post();
                        $video_url = get_field(
                            'video_url',
                            get_the_ID()
                        );
                        ?>
                        <?php if ($video_url): ?>
                            <div class="video-card px-2">
                                <video autoplay muted loop playsinline preload="metadata" class="w-full">
                                    <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
                <button type="button"
                    class="testimonial-next absolute right-[-16px] top-1/2 z-30 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-md"
                    aria-label="Next">
                    <svg class="h-4 w-4 text-[#4d7cff]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M9 18l6-6-6-6" />
                    </svg>
                </button>
            </div>
            <div class="mt-5 flex justify-center">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-consult">
                    Get Quote Now
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php
/*
 * Reset the global post data
 */
wp_reset_postdata();
?>