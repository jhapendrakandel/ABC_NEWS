<?php get_header(); ?>

<div class="breaking-news-container">
    <div class="breaking-label">ब्रेकिङ</div>
    <div class="marquee-wrapper">
        <div class="breaking-ticker">
            <span>संसद बैठक आज बस्ने, नयाँ विधेयकमाथि छलफल हुने</span>
            <span class="dot">•</span>
            <span>नेपाल–भारत क्रिकेट फाइनलमा भिड्ने</span>
            <span class="dot">•</span>
            <span>संसद बैठक आज बस्ने, नयाँ विधेयकमाथि छलफल हुने</span>
        </div>
    </div>
</div>

<div class="container">

<div class="breaking-news">
    <span>ताजा अपडेट</span>
</div>

<?php

$featured = new WP_Query(array(
    'posts_per_page' => 1
));

if($featured->have_posts()) :

while($featured->have_posts()) :

$featured->the_post();

?>

<h1 class="main-headline">
    <?php the_title(); ?>
</h1>

<div class="news-grid">

    <div class="main-news">

        <a href="<?php the_permalink(); ?>">

            <?php

            if(has_post_thumbnail()){

                the_post_thumbnail('large');

            } else {

                echo '<img src="https://placehold.co/800x450" alt="">';

            }

            ?>

        </a>

    </div>

    <div class="side-news">

        <h3>ताजा समाचार</h3>

        <ul>

            <?php

            $latest = new WP_Query(array(
                'posts_per_page' => 5,
                'offset' => 1
            ));

            while($latest->have_posts()) :

            $latest->the_post();

            ?>

            <li>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </li>

            <?php endwhile; ?>

        </ul>

    </div>

</div>

<?php

endwhile;

wp_reset_postdata();

endif;

?>

<div class="category-section">

    <h2>राजनीति</h2>

    <div class="category-grid">

        <?php

        $politics = new WP_Query(array(
            'posts_per_page' => 4,
            'category_name' => 'politics'
        ));

        while($politics->have_posts()) :

        $politics->the_post();

        ?>

        <article>

            <a href="<?php the_permalink(); ?>">

                <?php

                if(has_post_thumbnail()){

                    the_post_thumbnail('medium');

                }

                ?>

                <h3><?php the_title(); ?></h3>

            </a>

        </article>

        <?php endwhile; ?>

    </div>

</div>

</div>

<?php get_footer(); ?>
