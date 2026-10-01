<?php

$dentaltabs = get_field('dentaltabs');
$tabdata = (is_array($dentaltabs) && !empty($dentaltabs['tabdata']) && is_array($dentaltabs['tabdata']))
    ? $dentaltabs['tabdata']
    : array();

?>
<section class="dental-tabs w-full bg-white py-12 md:py-16 lg:py-20">

    <div class="container mx-auto px-4">

        <div class="grid grid-cols-1 lg:grid-cols-[280px_minmax(0,1fr)] gap-8 lg:gap-10">

            <!-- =========================================
                 TABS NAVIGATION
            ========================================== -->
            <div class="tabs-nav flex md:flex-col flex-row w-full max-w-full overflow-x-auto">

                <?php if (!empty($tabdata)): ?>
                    <?php $index = 0; ?>
                    <?php foreach ($tabdata as $tab_row):
                        $index++;
                        $tab_id = 'tab-' . $index;
                        $tab_title = isset($tab_row['title']) ? $tab_row['title'] : '';
                        // Fallback if title is empty
                        if (empty($tab_title)) {
                            $tab_title = 'Tab ' . $index;
                        }
                        ?>

                        <button type="button"
                            class="tab-button w-full group text-left border-b border-[#e5e5e5] pt-5 md:pt-6 md:px-0 px-1.5 <?php echo $index === 1 ? 'active' : ''; ?>"
                            data-tab="<?php echo esc_attr($tab_id); ?>">
                            <div class="w-full flex items-center md:gap-5 gap-2">
                                <span
                                    class="tab-number md:text-sm text-xs font-medium transition-colors duration-300 <?php echo $index === 1 ? 'text-[#010311]' : 'text-[#999]'; ?>">
                                    <?php echo sprintf('%02d', $index); ?>
                                </span>
                                <span
                                    class="tab-title text-xs md:text-base font-medium transition-colors duration-300 <?php echo $index === 1 ? 'text-[#010311]' : 'text-[#666]'; ?>">
                                    <?php echo esc_html($tab_title); ?>
                                </span>
                            </div>

                            <span
                                class="tab-line block mt-4 h-[2px] bg-[#c7d8c4] transition-all duration-500 <?php echo $index === 1 ? 'w-full' : 'w-0'; ?>"></span>

                        </button>

                    <?php endforeach; ?>
                <?php endif; ?>

            </div>


            <!-- =========================================
                 TAB CONTENT
            ========================================== -->
            <div class="tabs-panels relative overflow-hidden transition-[height] duration-500 ease-out">

                <?php if (!empty($tabdata)): ?>
                    <?php $index = 0; ?>
                    <?php foreach ($tabdata as $tab_row):
                        $index++;
                        $tab_id = 'tab-' . $index;
                        $subtitle = isset($tab_row['subtitle']) ? $tab_row['subtitle'] : '';
                        $title = isset($tab_row['title']) ? $tab_row['title'] : '';
                        $description = isset($tab_row['description']) ? $tab_row['description'] : '';
                        $image = isset($tab_row['image']) ? $tab_row['image'] : null;
                        ?>

                        <div id="<?php echo esc_attr($tab_id); ?>" class="tab-content transition-all duration-500
                            <?php echo $index === 1
                                ? 'is-active relative opacity-100 visible'
                                : 'absolute inset-0 opacity-0 invisible'; ?>">

                            <div class="relative grid grid-cols-1 md:grid-cols-2 md:items-stretch
                                overflow-hidden
                                rounded-[18px]">

                                <!-- =========================================
                                     IMAGE
                                ========================================== -->
                                <div class="relative min-h-[220px] sm:min-h-[280px] overflow-hidden">

                                    <?php if (!empty($image)): ?>
                                        <img src="<?php echo esc_url($image); ?>" alt=""
                                            class="absolute inset-0 h-full w-full object-cover object-center">
                                    <?php endif; ?>

                                </div>


                                <!-- =========================================
                                     CONTENT
                                ========================================== -->
                                <div class="relative flex items-center
                                    bg-[#010311]
                                    px-7 py-10
                                    sm:px-10
                                    md:px-10
                                    lg:px-12">

                                    <!-- Curved transition -->
                                    <div class="absolute
                                        left-[-45px]
                                        top-[-10%]
                                        hidden md:block
                                        h-[120%]
                                        w-[100px]
                                        rounded-[50%]
                                        bg-[#010311]"></div>


                                    <div class="relative z-10 w-full">

                                        <!-- Subtitle (Category) -->
                                        <?php if (!empty($subtitle)): ?>
                                            <span class="block mb-3
                                                text-[11px]
                                                uppercase
                                                tracking-[3px]
                                                text-[#c7d8c4]">
                                                <?php echo esc_html($subtitle); ?>
                                            </span>
                                        <?php endif; ?>


                                        <!-- Title -->
                                        <?php if (!empty($title)): ?>
                                            <h2 class="mb-6
                                                text-3xl
                                                md:text-4xl
                                                lg:text-[42px]
                                                leading-tight
                                                text-white">
                                                <?php echo esc_html($title); ?>
                                            </h2>
                                        <?php endif; ?>


                                        <!-- Description (WYSIWYG) -->
                                        <?php if (!empty($description)): ?>
                                            <div class="space-y-4
                                                text-sm
                                                leading-6
                                                text-white/70
                                                [&>p]:mb-4">
                                                <?php echo wp_kses_post($description); ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

        </div>

    </div>

</section>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const root = document.querySelector('.dental-tabs');
        if (!root) {
            return;
        }

        const buttons = root.querySelectorAll('.tab-button');
        const contents = root.querySelectorAll('.tab-content');
        const panels = root.querySelector('.tabs-panels');

        /*
         * Only the active panel stays in normal flow, so the wrapper always
         * matches the height of the visible tab (desktop and mobile).
         */
        function showPanel(content) {
            if (!content) {
                return;
            }

            contents.forEach(function (item) {

                const isActive = item === content;

                item.classList.toggle('is-active', isActive);
                item.classList.toggle('relative', isActive);
                item.classList.toggle('absolute', !isActive);
                item.classList.toggle('inset-0', !isActive);
                item.classList.toggle('opacity-100', isActive);
                item.classList.toggle('visible', isActive);
                item.classList.toggle('opacity-0', !isActive);
                item.classList.toggle('invisible', !isActive);

            });
        }

        function syncHeight() {
            if (!panels) {
                return;
            }

            const active = panels.querySelector('.tab-content.is-active');

            if (!active) {
                panels.style.height = '';
                return;
            }

            panels.style.height = active.offsetHeight + 'px';
        }

        buttons.forEach(function (button) {

            button.addEventListener('click', function () {

                const target = this.getAttribute('data-tab');

                /*
                 * Reset all buttons
                 */
                buttons.forEach(function (btn) {

                    btn.classList.remove('active');

                    const number = btn.querySelector('.tab-number');
                    const title = btn.querySelector('.tab-title');
                    const line = btn.querySelector('.tab-line');

                    if (number) {
                        number.classList.remove('text-[#010311]');
                        number.classList.add('text-[#999]');
                    }

                    if (title) {
                        title.classList.remove('text-[#010311]');
                        title.classList.add('text-[#666]');
                    }

                    if (line) {
                        line.classList.remove('w-full');
                        line.classList.add('w-0');
                    }

                });


                /*
                 * Activate clicked button
                 */
                this.classList.add('active');

                const number = this.querySelector('.tab-number');
                const title = this.querySelector('.tab-title');
                const line = this.querySelector('.tab-line');

                if (number) {
                    number.classList.remove('text-[#999]');
                    number.classList.add('text-[#010311]');
                }

                if (title) {
                    title.classList.remove('text-[#666]');
                    title.classList.add('text-[#010311]');
                }

                if (line) {
                    line.classList.remove('w-0');
                    line.classList.add('w-full');
                }


                /*
                 * Swap panels, then animate the wrapper to the new height
                 */
                const activeContent = document.getElementById(target);

                showPanel(activeContent);

                window.requestAnimationFrame(syncHeight);

            });

        });


        /*
         * Keep the wrapper height correct on load, image decode, reflow
         */
        syncHeight();

        window.addEventListener('load', syncHeight);
        window.addEventListener('resize', syncHeight);

        if ('ResizeObserver' in window && panels) {
            new ResizeObserver(syncHeight).observe(panels);
        }

        root.querySelectorAll('.tab-content img').forEach(function (img) {
            if (img.complete) {
                return;
            }
            img.addEventListener('load', syncHeight);
            img.addEventListener('error', syncHeight);
        });

        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(syncHeight);
        }

    });
</script>
