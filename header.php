<?php
/**
 * ABC Nepal TV — header.php
 *
 * ─── SETUP: add to functions.php ─────────────────────────────────────────
 *
 * function abc_enqueue_header_assets() {
 *     wp_enqueue_style(
 *         'abc-nav',
 *         get_template_directory_uri() . '/css/header-nav.css',
 *         array(), '1.1'
 *     );
 *     wp_enqueue_script(
 *         'abc-nav',
 *         get_template_directory_uri() . '/js/header-nav.js',
 *         array(), '1.1',
 *         true   // <-- load in footer so DOM exists
 *     );
 * }
 * add_action( 'wp_enqueue_scripts', 'abc_enqueue_header_assets' );
 *
 * ─────────────────────────────────────────────────────────────────────────
 *
 * FILE PLACEMENT:
 *   header.php       → /wp-content/themes/abctvnepal/header.php
 *   header-nav.css   → /wp-content/themes/abctvnepal/css/header-nav.css
 *   header-nav.js    → /wp-content/themes/abctvnepal/js/header-nav.js
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- =====================================================
     SITE HEADER
===================================================== -->
<header class="site-header" role="banner">
    <div class="header-inner">

        <!-- Logo -->
        <div class="site-branding">
            <a href="<?php echo esc_url( home_url('/') ); ?>"
               aria-label="<?php esc_attr_e( 'ABC Nepal TV — होमपेज', 'abcnepal-tv' ); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/abc.png' ); ?>"
                     alt="<?php esc_attr_e( 'ABC Nepal TV', 'abcnepal-tv' ); ?>"
                     height="42"
                     width="auto">
            </a>
        </div>

        <!-- Hamburger (visible ≤ 900px via CSS) -->
        <button
            id="abc-hamburger"
            class="hamburger-btn"
            type="button"
            aria-controls="abc-main-nav"
            aria-expanded="false"
            aria-label="<?php esc_attr_e( 'मेनु खोल्नुहोस्', 'abcnepal-tv' ); ?>"
        >
            <span class="hb-box" aria-hidden="true">
                <span class="hb-line"></span>
                <span class="hb-line"></span>
                <span class="hb-line"></span>
            </span>
        </button>

        <!-- Primary navigation -->
        <nav id="abc-main-nav"
             class="main-navigation"
             aria-label="<?php esc_attr_e( 'मुख्य नेभिगेसन', 'abcnepal-tv' ); ?>">

            <!-- Mobile-only drawer label (hidden on desktop via CSS) -->
            <div class="drawer-label" aria-hidden="true">समाचार मेनु</div>

            <?php
            if ( has_nav_menu('main-menu') ) {
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container'      => false,
                    'menu_class'     => 'main-menu',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ));
            } else {
                // Fallback with correct WP category slugs
                ?>
                <ul class="main-menu" role="list">
                    <li><a href="<?php echo esc_url( home_url('/') ); ?>">होमपेज</a></li>
                    <li><a href="<?php echo esc_url( home_url('/category/news/') ); ?>">मुख्य समाचार</a></li>
                    <li><a href="<?php echo esc_url( home_url('/category/politics/') ); ?>">राजनीति</a></li>
                    <li><a href="<?php echo esc_url( home_url('/category/business/') ); ?>">अर्थ वाणिज्य</a></li>
                    <li><a href="<?php echo esc_url( home_url('/category/opinion/') ); ?>">विचार</a></li>
                    <li><a href="<?php echo esc_url( home_url('/category/international_news/') ); ?>">अन्तर्राष्ट्रिय</a></li>
                    <li><a href="<?php echo esc_url( home_url('/category/sports/') ); ?>">खेलकुद</a></li>
                    <li><a href="<?php echo esc_url( home_url('/category/province/') ); ?>">प्रदेश</a></li>
                    <li><a href="<?php echo esc_url( home_url('/liveupdate/') ); ?>">लाइभ अपडेट</a></li>
                    <li><a class="menu-highlight"
                           href="<?php echo esc_url( home_url('/category/english-special/') ); ?>">ENGLISH</a></li>
                </ul>
                <?php
            }
            ?>
        </nav>

    </div><!-- /header-inner -->
</header>

<!-- Backdrop overlay — sits behind drawer, above page content -->
<div id="abc-nav-overlay"
     class="nav-overlay"
     aria-hidden="true"
     style="display:none;"></div>

<!-- Nepali date bar -->
<div class="nepali-date-box nep-to-eng nepali-date-converter"
     aria-label="<?php esc_attr_e( 'आजको मिति', 'abcnepal-tv' ); ?>">
    <?php echo do_shortcode('[ndc-today-date]'); ?>
</div>