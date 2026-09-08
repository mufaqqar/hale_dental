<?php
/** Template Name: About */
get_header();
?>
<?php
$featureproductsRes = [
    [
        'title' => 'R&D Department Helping in Branding',
        'subTitle' => 'Have you ever stood in a shop and picked one product without fully knowing why? That small moment of hesitation — that’s branding in action',
        'excerpt' => 'Hale Path Packaging works as a modern solution provider for all types of printing and packaging needs. You may already have a strong product. But does your packaging support it properly?
                    Our R&D department studies market trends and customer behaviour carefully. We look at what buyers prefer, what attracts attention, and what encourages a purchase. When your product sits on a shelf beside competitors in retail shops or shopping malls, packaging becomes the first impression. Often, it becomes the first trigger for brand choice.
                    Our R&D team improves artwork to make it clearer and more appealing. They guide clients on selecting the right stock, colour combinations, and branded finishes such as gold foiling, embossing, Spot UV, and fluorescent colours. These adjustments can directly impact sales performance.
                    We push for high standards across customisation, design, service, technology, and materials. We don’t aim for “good enough.” We aim for solid results. That approach allows us to offer wide options in textures, materials, designs, and innovative outlooks.',
        'slug' => ['current' => 'eco-packaging'],
        'gallery' => [
            ['asset' => ['url' => get_template_directory_uri() . '/assets/images/packaging-partner.jpg']]
        ],
    ],
    [
        'title' => 'Customize Packaging',
        'subTitle' => 'Every product is different. So why should packaging look the same?',
        'excerpt' => 'We are wholesale manufacturers of customized packaging serving thousands of satisfied clients. From small home-based startups to large wholesale businesses — and even individuals planning events — we provide packaging solutions for all.
                    Our pricing stays competitive and often lower than standard market rates. This allows clients to manage packaging costs more comfortably. We focus on long-term, mutually beneficial relationships. Our goal is to help products stand out through packaging that speaks for itself.
                    We work with customers across the USA, UK, Canada, and Europe. Our services include strong pre-sales guidance and dependable after-sales support. With countless styles, sizes, and colour options available, we create packaging for both professional and personal use.
                    Our production, creative design, and customer service teams operate within a modern facility equipped with advanced technology. The result? High-quality packaging delivered at reasonable prices.',
        'slug' => ['current' => 'custom-boxes'],
        'gallery' => [
            ['asset' => ['url' => get_template_directory_uri() . '/assets/images/packaging-partner.jpg']]
        ],
    ],
    [
        'title' => 'Graphic Designing Support',
        'subTitle' => 'Design is not just decoration. It guides the eye. It shapes perception.',
        'excerpt' => 'Our in-house design team works closely with clients to bring their ideas to life. We make sure every detail reflects their preferences. If someone feels unsure about their packaging direction, our designers step in with practical advice.
                    We assist with dielines, template styles, artwork setup, branded finish suggestions, and selecting colours that align with brand identity. Clients can share their ideas freely, and we refine them through unlimited revisions until everything feels right.
                    The goal is simple: packaging that looks correct, feels consistent, and represents the brand clearly.',
        'slug' => ['current' => 'luxury-packaging'],
        'gallery' => [
            ['asset' => ['url' => get_template_directory_uri() . '/assets/images/packaging-partner.jpg']]
        ],
    ],
    [
        'title' => 'Largest Production Facility',
        'subTitle' => 'Large-scale production only works if quality stays consistent.',
        'excerpt' => 'Our facility can produce up to 500,000 mixed-category units per day. Our advanced offset printing machines manage orders ranging from 100,000 to 500,000 units with a lead time of 11–14 business days, even when handling multiple clients.
                    Our skilled team carefully manages colour control, die-cutting plates, and lamination processes. Experience and technology work together to maintain steady output without compromising standards.',
        'slug' => ['current' => 'retail-packs'],
        'gallery' => [
            ['asset' => ['url' => get_template_directory_uri() . '/assets/images/packaging-partner.jpg']]
        ],
    ],
    [
        'title' => 'Logistics Solutions',
        'subTitle' => 'Large orders can reduce per-unit cost. But what if storage space is limited?',
        'excerpt' => 'We offer warehouse storage within our facility for clients who want to place large annual orders but do not have enough space. Inventory can be stored safely in controlled temperature conditions.
                    We then ship products on a regular schedule — monthly, weekly, or based on your requirement. This system allows businesses to benefit from large production runs and lower costs without worrying about storage management.
                    In simple terms, we handle the packaging supply so you can focus on running your business.',
        'slug' => ['current' => 'retail-packs'],
        'gallery' => [
            ['asset' => ['url' => get_template_directory_uri() . '/assets/images/packaging-partner.jpg']]
        ],
    ],
];
?>
<section
    class="py-16 sm:h-[350px] h-[260px] flex items-center justify-center bg-cover bg-no-repeat bg-center bg-black/50 bg-blend-overlay"
    style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/faq-bg.jpg')">
    <div class="container mx-auto px-4">
        <h1 class="text-white font-bold text-3xl md:text-5xl lg:text-[51px]">
            <?php the_title(); ?>
        </h1>
    </div>
</section>
<section class="my-16">
    <div class="container mx-auto px-4 md:flex items-center gap-5 md:gap-10 flex-row">
        <figure class="md:w-1/2">
            <img alt="Why Us Image"
                src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/packaging-partner.jpg"
                class="rounded-2xl">
        </figure>
        <div class="flex md:w-1/2 justify-center md:justify-start items-center md:items-start flex-col">
            <h4 class="text-[#111827] mt-5 md:mt-0 font-bold text-3xl text-center md:text-left mb-4">
                Packaging usually gets blamed for waste.</h4>
            <p class="mb-2 text-center md:text-left">
                Yet at Hale Path Packaging, we see it differently. We believe packaging can be strong, smart, and
                responsible at the same time.
                Hale Path Packaging offers complementary print technologies — Offset, UV offset, Flexo Printing, digital
                printing, and cold foil or hot foil — supported by state-of-the-art binding and finishing systems. That
                may sound technical, but here’s what it really means: we choose the right printing method for the right
                job. Some designs need sharp detail. Others need bold colour. Some need speed. We match the process to
                the purpose.
            </p>
            <p class="mb-2 text-center md:text-left">
                HPP leads the corrugated packaging market while operating as one of the largest renewable packaging
                facilities. In simple words, we don’t just produce boxes. We build packaging with long-term thinking. We
                even develop our own liner and fluting in-house. These inner layers give corrugated boxes the strength
                and durability required to pack and transport valuable products safely. If it needs to travel, stack, or
                sit on shelves, it needs structure. We make sure it has it.
            </p>
        </div>
    </div>
</section>
<section class="my-16">
    <div class="container mx-auto px-4 md:flex items-center gap-5 md:gap-10 flex-row-reverse">
        <figure class="md:w-1/2">
            <img alt="Why Us Image"
                src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/packaging-partner.jpg"
                class="rounded-2xl">
        </figure>
        <div class="flex md:w-1/2 justify-center md:justify-start items-center md:items-start flex-col">
            <h4 class="text-[#111827] mt-5 md:mt-0 font-bold text-3xl text-center md:text-left mb-4">
                Our Story! Who Are We?</h4>
            <p class="mb-2 text-center md:text-left">
                Our name wasn’t picked randomly. “Hale” means healthy. “Path” means way. And “Packaging” is what we do
                every day. Put it together, and it shows exactly what we stand for — a healthier, more responsible way
                of creating
                packaging.
            </p>
            <p class="mb-2 text-center md:text-left">
                At Hale Path Packaging, eco-friendly and sustainable packaging isn’t just a buzzword. We make sure our
                boxes, packaging, and inserts protect products while reducing environmental impact. Many businesses
                think they must choose between durability and sustainability. We don’t agree — we deliver both. Using
                renewable materials, careful production methods, and waste-minimizing systems, we help brands make
                smart, eco-conscious choices without compromising quality.
            </p>
            <p class="mb-2 text-center md:text-left">
                Let me tell you something more mesmerizing: A UK-based organic candle brand wanted packaging that
                reflected their commitment to sustainability. They approached us for custom eco-friendly candle boxes
                with inserts. Using recycled cardboard, soy-based inks, and minimal lamination, we delivered packaging
                that was durable, protective, and fully recyclable. The brand reported a 25% increase in customer
                appreciation for their eco-conscious efforts, and their boxes became a talking point in stores — showing
                that sustainable choices can also enhance brand appeal and sales.
            </p>
            <p class="mb-5 text-center md:text-left">
                At the end of the day, our goal is simple: create packaging that protects products, supports businesses,
                and moves the industry toward a healthier, greener path.
            </p>
        </div>
    </div>
</section>
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="md:text-4xl text-2xl font-bold text-coff_black capitalize mt-1 text-center mb-4">
            The Work We Do And <span class="text-primary">Love Doing</span>
        </h2>
        <p class="md:text-xl text-base font-normal text-title_Clr text-center max-w-[880px] mx-auto">
            <b>It might sound strange, but yes — packaging can influence how people think and buy.</b>
            It’s not just a box. It’s the first thing a customer sees. Sometimes it’s the reason they pick one product
            over another.
            This mix of psychology, engineering, and creativity is exactly what we enjoy working with every day at Hale
            Path Packaging.

        </p>
    </div>
    <div class="container mx-auto px-4 mt-10 flex flex-col gap-8 ">
        <?php foreach ($featureproductsRes as $product): ?>
            <div class='feature_box flex md:flex-row flex-col items-center md:even:flex-row-reverse'>
                <div class="md:w-1/3 w-full">
                    <img src="<?php echo esc_url( $product['gallery'][0]['asset']['url'] ); ?>" alt="img"
                        class='w-full object-cover object-center' />
                </div>
                <div class='md:w-2/3 w-full p-5'>
                    <h3 class=''>
                        <?php echo esc_html($product['title']); ?>
                    </h3>
                    <p class='md:text-lg text-base font-normal text-title_Clr'>
                        <?php echo esc_html($product['excerpt']); ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php get_footer(); ?>