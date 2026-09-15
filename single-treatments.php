<?php
/**
 * Template Name: Single Treatment
 * Template Post Type: treatments
 */

get_header();

// Parse content: extract H2s, build TOC, wrap sections in <section> tags.
$raw_content = get_the_content();
$parsed = hale_generate_toc_from_content($raw_content);
$toc_html = $parsed['toc'];
$article_html = $parsed['content'];
?>

<?php get_template_part('template-parts/treatment/main_banner'); ?>
<?php get_template_part('template-parts/treatment/about'); ?>
<?php get_template_part('template-parts/home/cta'); ?>
<?php get_template_part('template-parts/home/customerstory'); ?>
<section class="bg-primary py-16">
    <div class="container mx-auto px-4 flex md:flex-row flex-col gap-6 items-center">
        <div class="md:w-1/2 w-full">
            <div class="relative w-full overflow-hidden rounded-xl aspect-video">
                <iframe class="absolute inset-0 h-full w-full" src="https://www.youtube.com/watch?v=vUHfclgd5qE"
                    title="Video" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
        <div class="md:w-1/2 w-full">
            <h2 class="md:text-5xl text-3xl text-white tracking-tight">
                At a Glance:
                Your Rhinoplasty Abroad
            </h2>
            <p class="text-lg text-white leading-relaxed max-w-xl">
                With 56,650 nose surgeries in 2022 according to ISAPS, Turkey is the 2nd country in the world in number
                of
                rhinoplasties, only behind Brazil. This trend has turned Turkish plastic surgeons into some of the most
                skilled in the world in the last 15 years. Due to ever-growing demand, Turkish clinics have become
                expert
                hosts on top of impeccable plastic surgeons. Natural Clinic’s Turkey rhinoplasty package ensures a
                seamless
                experience and all-inclusive travel:
            </p>
        </div>
    </div>
</section>
<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="grid items-center gap-10 lg:grid-cols-12">
            <div class="hidden lg:col-span-4 lg:block">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image-433.webp"
                    alt="Nasal reshaping techniques" class="w-full rounded-[20px] object-cover" />
            </div>
            <div class="lg:col-span-8">
                <h2
                    class="text-center font-serif text-[28px] leading-[1.2] text-coff_black md:text-[52px] lg:text-left">
                    Sniffing Out<!-- --> <br><span class="text-brand-accent">2 Nasal Reshaping Techniques</span></h2>
                <p class="mt-5 text-[15px] leading-[1.9] text-[#566]">Modern medicine has developed 2 nose surgery
                    techniques, employed by cosmetic surgeons all around the world.</p>
                <p class="mt-3 text-[15px] leading-[1.9] text-[#566]">Depending on the patient’s preferences and
                    condition, one technique might be better than the other. Important considerations include the
                    patient’s nose type and the budget allocated to the rhinoplasty cost Turkey.</p>
            </div>
        </div>
        <div class="mt-8 grid gap-6 md:grid-cols-2">
            <div class="rounded-[18px] border border-secondary/10 bg-amber-50 p-6 md:p-8">
                <h4 class="font-serif text-xl font-normal text-coff_black">Open Rhinoplasty</h4>
                <h5 class="text-[14px] text-brand-accent">Technique</h5>
                <p class="mt-3 text-[15px] leading-[1.85] text-[#566]">The open rhinoplasty technique involves an
                    incision between the nostrils (columella), allowing for maximum visibility and full access to the
                    underlying tissue by the surgeon.</p>
                <p class="mt-3 text-[15px] leading-[1.85] text-[#566]">This technique allows for greater plastic
                    flexibility and more accurate results. On the downside, it requires a longer recovery time due to
                    incisions. Scars and swelling will also be initially more visible.</p>
            </div>
            <div class="rounded-[18px] border border-secondary/10 bg-amber-50 p-6 md:p-8">
                <h4 class="font-serif text-xl font-normal text-coff_black">Closed Or Endonasal</h4>
                <h5 class="text-[14px] text-brand-accent">Rhinoplasty</h5>
                <p class="mt-3 text-[15px] leading-[1.85] text-[#566]">The closed or endonasal technique does not
                    involve incisions, as all plastic manipulation is performed by accessing the underlying tissue
                    through the nostrils. This technique allows for minimal scarring and swelling. It also has a shorter
                    recovery time. However, it limits the surgeon’s visibility, and does not allow for all types of
                    plastic changes.</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>