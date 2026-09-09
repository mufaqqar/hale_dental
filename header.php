<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('antialiased'); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="min-h-screen flex flex-col">
        <header id="masthead" class="sticky top-0 z-[9999] py-4">
            <div class="container mx-auto md:px-0 px-2">
                <div class="flex items-stretch justify-between sm:gap-4 gap-2">
                    <div class="flex items-center justify-between gap-4 w-full bg-white sm:px-4 px-2 rounded-xl">
                        <!-- Logo -->
                        <div class="site-branding inline-flex shrink-0">
                            <?php if (has_custom_logo()): ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex">
                                    <?php the_custom_logo(); ?>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center">
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.png"
                                        alt="Logo" height="54" width="72" />
                                </a>
                            <?php endif; ?>
                        </div>

                        <!-- Desktop navigation (centered) -->
                        <nav id="site-navigation" class="primary-navigation hidden lg:block flex-1">
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'primary',
                                'menu_class' => 'flex items-center justify-center list-none m-0 p-0',
                                'container' => false,
                                'fallback_cb' => false,
                                'walker' => new Hale_Mega_Walker(),
                            ]);
                            ?>
                        </nav>
                        <!-- Right: CTA + language (desktop) -->
                        <div class="hidden lg:flex items-center gap-6 shrink-0">
                            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-consult">
                                Get Consultation
                            </a>
                        </div>
                    </div>
                    <!-- Right: CTA + language (desktop) -->
                    <div class="hidden lg:flex items-center gap-6 shrink-0 bg-white sm:px-4 px-2 rounded-xl">
                        <div class="lang-switch" role="button" tabindex="0" aria-haspopup="true" aria-expanded="false">
                            <span>English</span>
                            <i class="fa-solid fa-chevron-down"></i>
                            <div class="lang-options">
                                <a href="#">English</a>
                                <a href="#">Español</a>
                                <a href="#">Français</a>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile hamburger -->
                    <button class="menu-toggle lg:hidden text-coff_black text-2xl p-2 bg-white px-4 rounded-xl" aria-label="Toggle menu"
                        aria-expanded="false">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>

                <!-- Mobile navigation panel -->
                <div id="mobile-nav" class="primary-navigation lg:hidden hidden pb-4 bg-white mt-2">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'menu_class' => 'flex flex-col gap-1 list-none m-0 p-0 pt-2',
                        'container' => false,
                        'fallback_cb' => false,
                        'walker' => new Hale_Mega_Walker(),
                    ]);
                    ?>
                    <div class="flex items-center justify-center gap-6 mt-4 pt-3 border-t border-gray-100">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-consult">
                            Get Consultation
                        </a>
                        <div class="lang-switch" role="button" tabindex="0" aria-haspopup="true" aria-expanded="false">
                            <span>English</span>
                            <i class="fa-solid fa-chevron-down"></i>
                            <div class="lang-options">
                                <a href="#">English</a>
                                <a href="#">Español</a>
                                <a href="#">Français</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div id="content" class="-mt-32">