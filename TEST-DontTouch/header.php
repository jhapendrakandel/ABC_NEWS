<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-inner">
        <div class="site-branding">
            <?php abcnepal_logo_markup(); ?>
        </div>

        <input class="nav-toggle" type="checkbox" id="nav-toggle" aria-label="<?php esc_attr_e('Toggle main menu', 'abcnepal-tv'); ?>">
        <label class="hamburger" for="nav-toggle" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <nav class="main-navigation" aria-label="<?php esc_attr_e('Primary navigation', 'abcnepal-tv'); ?>">
            <?php
            if (has_nav_menu('main-menu')) {
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container'      => false,
                    'menu_class'     => 'main-menu',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ));
            } else {
                ?>
                <ul class="main-menu">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">होमपेज</a></li>
                    <li><a href="<?php echo esc_url(home_url('/mainnews/')); ?>">मुख्य समाचार</a></li>
                    <li><a href="<?php echo esc_url(home_url('/politics/')); ?>">राजनीति</a></li>
                    <li><a href="<?php echo esc_url(home_url('/diplomacy/')); ?>">कूटनीति</a></li>
                    <li><a href="<?php echo esc_url(home_url('/economics/')); ?>">अर्थतन्त्र</a></li>
                    <li><a href="<?php echo esc_url(home_url('/sports/')); ?>">खेलकुद</a></li>
                    <li><a href="<?php echo esc_url(home_url('/international/')); ?>">अन्तर्राष्ट्रिय</a></li>
                    <li><a href="<?php echo esc_url(home_url('/entertainment/')); ?>">मनोरञ्जन</a></li>
                    <li><a href="<?php echo esc_url(home_url('/opinion/')); ?>">विचार</a></li>
                    <li><a href="<?php echo esc_url(home_url('/liveupdate/')); ?>">लाइभ अपडेट</a></li>
                    <li><a class="menu-highlight" href="<?php echo esc_url(home_url('/abc-videos/')); ?>">एबीसी भिडियो</a></li>
                    <li><a class="menu-highlight" href="<?php echo esc_url(home_url('/english/')); ?>">अंग्रेजी</a></li>
                </ul>
                <?php
            }
            ?>
        </nav>
    </div>
</header>
<div class="nepali-date-box nep-to-eng nepali-date-converter">
    <?php echo do_shortcode('[ndc-today-date]'); ?>
</div>
