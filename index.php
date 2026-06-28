<?php
/*
Template Name: Main News
*/
get_header();
?>

<?php include( get_template_directory() . '/breaking-banner.php' ); ?>

<style>
/* ================================================
   ABC Nepal TV — Main News Page Styles
   Uses .mn- prefix to avoid conflicts with theme
================================================ */

.mn-wrap {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 16px 60px;
    font-family: 'Hind Siliguri', sans-serif;
}

/* ── Featured Hero ── */
.mn-featured {
    position: relative;
    margin: 24px 0 32px;
    border-radius: 6px;
    overflow: hidden;
    background: #111;
}
.mn-featured a {
    display: block;
    text-decoration: none;
}
.mn-featured img {
    width: 100%;
    height: 520px;
    object-fit: cover;
    display: block;
    opacity: .88;
    transition: opacity .3s;
}
.mn-featured a:hover img { opacity: 1; }
.mn-featured-overlay {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: linear-gradient(to top, rgba(0,0,0,.9) 0%, rgba(0,0,0,.3) 60%, transparent 100%);
    padding: 40px 36px 32px;
}
.mn-featured-tag {
    display: inline-block;
    background: #c0392b;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 2px;
    letter-spacing: .6px;
    text-transform: uppercase;
    margin-bottom: 12px;
}
.mn-featured h1 {
    margin: 0 0 10px;
    font-size: 32px;
    font-weight: 800;
    color: #fff;
    line-height: 1.35;
}
.mn-featured h1 a {
    color: #fff;
    text-decoration: none;
}
.mn-featured h1 a:hover { text-decoration: underline; }
.mn-featured-excerpt {
    color: rgba(255,255,255,.8);
    font-size: 15px;
    margin: 0 0 16px;
    max-width: 680px;
    line-height: 1.6;
}
.mn-read-more {
    display: inline-block;
    background: #c0392b;
    color: #fff;
    padding: 9px 22px;
    border-radius: 3px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    letter-spacing: .3px;
    transition: background .2s;
}
.mn-read-more:hover { background: #a93226; }

/* ── Section header ── */
.mn-section {
    margin-bottom: 36px;
}
.mn-section-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0;
    padding-bottom: 10px;
    border-bottom-width: 3px;
    border-bottom-style: solid;
}
.mn-section-head h2 {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 20px;
    font-weight: 800;
    color: #1a1a2e;
    margin: 0;
}
.mn-section-head h2 .bar {
    width: 5px;
    height: 22px;
    border-radius: 2px;
    display: inline-block;
    flex-shrink: 0;
}
.mn-section-head a.view-all {
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    letter-spacing: .3px;
}
.mn-section-head a.view-all:hover { text-decoration: underline; }

/* ── Card grid (5 columns) ── */
.mn-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    border: 1px solid #ddd;
    border-top: none;
    background: #fff;
}
.mn-card {
    display: block;
    text-decoration: none;
    color: inherit;
    border-right: 1px solid #ddd;
    overflow: hidden;
    transition: background .15s;
}
.mn-card:last-child { border-right: none; }
.mn-card:hover { background: #fafafa; }
.mn-card-img {
    height: 140px;
    overflow: hidden;
    background: #eee;
}
.mn-card-img img {
    width: 100%;
    height: 140px;
    object-fit: cover;
    display: block;
    transition: transform .3s;
}
.mn-card:hover .mn-card-img img { transform: scale(1.04); }
.mn-card-body {
    padding: 10px 12px 14px;
}
.mn-card-body h3 {
    font-size: 13px;
    font-weight: 700;
    color: #1a1a2e;
    margin: 0 0 6px;
    line-height: 1.5;
    transition: color .2s;
}
.mn-card:hover .mn-card-body h3 { color: #c0392b; }
.mn-card-body .mn-date {
    font-size: 11px;
    color: #999;
    font-family: sans-serif;
}

/* ── 3-col layout for sections with fewer posts ── */
.mn-grid-3 {
    grid-template-columns: repeat(3, 1fr);
}

/* ── Province 4-col ── */
.mn-grid-4 {
    grid-template-columns: repeat(4, 1fr);
}
.mn-card-img-tall { height: 180px; }
.mn-card-img-tall img { height: 180px; }

/* ── Empty placeholder cell ── */
.mn-empty-cell {
    padding: 24px 14px;
    background: #f9f9f9;
    border-right: 1px solid #ddd;
}
.mn-empty-cell:last-child { border-right: none; }
.mn-empty-tag {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 2px;
    color: #fff;
    margin-bottom: 8px;
    font-family: sans-serif;
    text-transform: uppercase;
}
.mn-empty-text {
    font-size: 13px;
    color: #aaa;
    font-family: sans-serif;
    margin: 0;
}

/* ── Newsletter ── */
.mn-newsletter {
    background: #1a1a2e;
    color: #fff;
    border-radius: 6px;
    padding: 40px 44px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
    margin-top: 10px;
}
.mn-newsletter h2 {
    font-size: 22px;
    font-weight: 800;
    margin: 0 0 6px;
    color: #fff;
}
.mn-newsletter p {
    font-size: 14px;
    color: rgba(255,255,255,.7);
    margin: 0;
    font-family: sans-serif;
}
.mn-newsletter-form {
    display: flex;
    gap: 0;
    flex-shrink: 0;
}
.mn-newsletter-form input[type="email"] {
    padding: 12px 18px;
    border: none;
    border-radius: 3px 0 0 3px;
    font-size: 14px;
    width: 240px;
    outline: none;
    color: #1a1a2e;
    font-family: sans-serif;
}
.mn-newsletter-form button {
    padding: 12px 22px;
    background: #c0392b;
    color: #fff;
    border: none;
    border-radius: 0 3px 3px 0;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    font-family: sans-serif;
    white-space: nowrap;
}
.mn-newsletter-form button:hover { background: #a93226; }

/* ── Responsive ── */
@media (max-width: 900px) {
    .mn-grid { grid-template-columns: repeat(3, 1fr); }
    .mn-grid-4 { grid-template-columns: repeat(2, 1fr); }
    .mn-featured h1 { font-size: 22px; }
    .mn-featured img { height: 340px; }
    .mn-featured-overlay { padding: 24px 20px 20px; }
}
@media (max-width: 580px) {
    .mn-grid,
    .mn-grid-3,
    .mn-grid-4 { grid-template-columns: repeat(2, 1fr); }
    .mn-newsletter { flex-direction: column; align-items: flex-start; padding: 28px 20px; }
    .mn-newsletter-form { width: 100%; }
    .mn-newsletter-form input[type="email"] { width: 100%; flex: 1; }
    .mn-featured img { height: 240px; }
    .mn-featured h1 { font-size: 18px; }
}
</style>

<div class="mn-wrap">

<?php
/* =====================================================
   HELPER: render one section ribbon
   $cfg keys: label, cat, link, color (hex)
===================================================== */
function mn_section( $cfg ) {
    $label = $cfg['label'];
    $cat   = $cfg['cat'];
    $link  = $cfg['link'];
    $color = isset($cfg['color']) ? $cfg['color'] : '#c0392b';
    $cols  = isset($cfg['cols'])  ? (int)$cfg['cols']  : 5;
    $tall  = isset($cfg['tall'])  ? $cfg['tall']  : false;

    $q = new WP_Query(array(
        'posts_per_page' => $cols,
        'category_name'  => $cat,
    ));

    if ( ! $q->have_posts() ) {
        wp_reset_postdata();
        return;
    }

    $grid_class = 'mn-grid';
    if ( $cols === 3 ) $grid_class .= ' mn-grid-3';
    if ( $cols === 4 ) $grid_class .= ' mn-grid-4';
    ?>

    <div class="mn-section">

        <div class="mn-section-head" style="border-bottom-color:<?php echo esc_attr($color); ?>;">
            <h2>
                <span class="bar" style="background:<?php echo esc_attr($color); ?>;"></span>
                <?php echo esc_html($label); ?>
            </h2>
            <a class="view-all" href="<?php echo esc_url($link); ?>"
               style="color:<?php echo esc_attr($color); ?>;">
                सबै हेर्नुहोस् ›
            </a>
        </div>

        <div class="<?php echo esc_attr($grid_class); ?>">
        <?php
        while ( $q->have_posts() ) : $q->the_post();
            $img_class = $tall ? 'mn-card-img mn-card-img-tall' : 'mn-card-img';
        ?>
            <a class="mn-card" href="<?php the_permalink(); ?>">
                <div class="<?php echo $img_class; ?>">
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'medium' );
                    } else { ?>
                        <img src="https://placehold.co/280x140/<?php echo ltrim($color,'#'); ?>/ffffff?text=ABC"
                             alt="<?php the_title_attribute(); ?>">
                    <?php } ?>
                </div>
                <div class="mn-card-body">
                    <h3><?php the_title(); ?></h3>
                    <span class="mn-date"><?php echo get_the_date('M j, Y'); ?></span>
                </div>
            </a>
        <?php endwhile; wp_reset_postdata(); ?>
        </div>

    </div><!-- /mn-section -->
    <?php
}
?>

<!-- =====================================================
     FEATURED HERO
===================================================== -->
<?php
$featured = new WP_Query(array('posts_per_page' => 1));
if ( $featured->have_posts() ) :
while ( $featured->have_posts() ) : $featured->the_post(); ?>

<div class="mn-featured">
    <a href="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail() ) {
            the_post_thumbnail('full');
        } else { ?>
            <img src="https://placehold.co/1200x520/1a1a2e/ffffff?text=ABC+Nepal+TV" alt="">
        <?php } ?>
    </a>
    <div class="mn-featured-overlay">
        <span class="mn-featured-tag">मुख्य समाचार</span>
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <p class="mn-featured-excerpt">
            <?php echo wp_trim_words( get_the_excerpt(), 40 ); ?>
        </p>
        <a class="mn-read-more" href="<?php the_permalink(); ?>">पूरा समाचार →</a>
    </div>
</div>

<?php endwhile; wp_reset_postdata(); endif; ?>


<!-- =====================================================
     CATEGORY SECTIONS
     Correct slugs from WP category list:
       politics, news, business, opinion,
       international_news, sports, english-special
       province sub: provincial_koshi, provincial_madesh,
                     provincial_gandaki, provincial_lumbini
===================================================== -->

<?php

// 1 — मुख्य समाचार
mn_section(array(
    'label' => 'मुख्य समाचार',
    'cat'   => 'news',
    'link'  => home_url('/category/news/'),
    'color' => '#1a1a2e',
));

// 2 — राजनीति
mn_section(array(
    'label' => 'राजनीति',
    'cat'   => 'politics',
    'link'  => home_url('/category/politics/'),
    'color' => '#c0392b',
));

// 3 — अर्थ वाणिज्य   (slug: business)
mn_section(array(
    'label' => 'अर्थ वाणिज्य',
    'cat'   => 'business',
    'link'  => home_url('/category/business/'),
    'color' => '#16a085',
));

// 4 — विचार / विश्लेषण   (slug: opinion)
mn_section(array(
    'label' => 'विचार / विश्लेषण',
    'cat'   => 'opinion',
    'link'  => home_url('/category/opinion/'),
    'color' => '#8e44ad',
));

// 5 — अन्तर्राष्ट्रिय   (slug: international_news)
mn_section(array(
    'label' => 'अन्तर्राष्ट्रिय',
    'cat'   => 'international_news',
    'link'  => home_url('/category/international_news/'),
    'color' => '#2980b9',
    'cols'  => 3,
));

// 6 — खेलकुद   (slug: sports)
mn_section(array(
    'label' => 'खेलकुद',
    'cat'   => 'sports',
    'link'  => home_url('/category/sports/'),
    'color' => '#e67e22',
    'cols'  => 3,
));

// 7 — English News   (slug: english-special)
mn_section(array(
    'label' => 'English News',
    'cat'   => 'english-special',
    'link'  => home_url('/category/english-special/'),
    'color' => '#2c3e50',
    'cols'  => 3,
));

?>


<!-- =====================================================
     PROVINCE SPECIAL — 4 sub-provinces
===================================================== -->
<?php
$provinces = array(
    array( 'label' => 'कोशी',     'cat' => 'provincial_koshi',   'link' => home_url('/category/province/provincial_koshi/') ),
    array( 'label' => 'मधेश',    'cat' => 'provincial_madesh',  'link' => home_url('/category/province/provincial_madesh/') ),
    array( 'label' => 'गण्डकी',  'cat' => 'provincial_gandaki', 'link' => home_url('/category/province/provincial_gandaki/') ),
    array( 'label' => 'लुम्बिनी','cat' => 'provincial_lumbini', 'link' => home_url('/category/province/provincial_lumbini/') ),
);
?>

<div class="mn-section">

    <div class="mn-section-head" style="border-bottom-color:#2980b9;">
        <h2>
            <span class="bar" style="background:#2980b9;"></span>
            प्रदेश विशेष
        </h2>
        <a class="view-all" href="<?php echo home_url('/category/province/'); ?>"
           style="color:#2980b9;">
            सबै प्रदेश ›
        </a>
    </div>

    <div class="mn-grid mn-grid-4">
    <?php foreach ( $provinces as $idx => $prov ) :
        $pq = new WP_Query(array( 'posts_per_page' => 1, 'category_name' => $prov['cat'] ));

        if ( ! $pq->have_posts() ) {
            wp_reset_postdata(); ?>
            <div class="mn-empty-cell">
                <span class="mn-empty-tag" style="background:#2980b9;">
                    <?php echo esc_html($prov['label']); ?>
                </span>
                <p class="mn-empty-text">समाचार उपलब्ध छैन</p>
            </div>
            <?php continue;
        }

        while ( $pq->have_posts() ) : $pq->the_post(); ?>
        <a class="mn-card" href="<?php the_permalink(); ?>">
            <div class="mn-card-img mn-card-img-tall">
                <?php if ( has_post_thumbnail() ) {
                    the_post_thumbnail('medium');
                } else { ?>
                    <img src="https://placehold.co/310x180/2980b9/ffffff?text=<?php echo urlencode($prov['label']); ?>"
                         alt="<?php echo esc_attr($prov['label']); ?>">
                <?php } ?>
            </div>
            <div class="mn-card-body">
                <span style="
                    display:inline-block;
                    background:#2980b9;
                    color:#fff;
                    font-size:10px;
                    font-weight:700;
                    padding:2px 8px;
                    border-radius:2px;
                    margin-bottom:6px;
                    font-family:sans-serif;
                    text-transform:uppercase;
                "><?php echo esc_html($prov['label']); ?></span>
                <h3><?php the_title(); ?></h3>
                <span class="mn-date"><?php echo get_the_date('M j, Y'); ?></span>
            </div>
        </a>
        <?php endwhile; wp_reset_postdata();
    endforeach; ?>
    </div>

</div><!-- /province section -->


<!-- =====================================================
     NEWSLETTER
===================================================== -->
<div class="mn-newsletter">
    <div>
        <h2>ABC Nepal TV न्यूजलेटर</h2>
        <p>सबैभन्दा पहिले समाचार पाउनुहोस् — सोझै इमेलमा।</p>
    </div>
    <div class="mn-newsletter-form">
        <input type="email" placeholder="तपाईंको इमेल ठेगाना">
        <button type="button">सदस्य बन्नुहोस्</button>
    </div>
</div>

</div><!-- /mn-wrap -->

<?php get_footer(); ?>