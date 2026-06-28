<?php
/*
Template Name: Main News
*/
get_header();
?>

<div class="container">

<!-- ============================= -->
<!-- FEATURED NEWS -->
<!-- ============================= -->

<?php

$featured = new WP_Query(array(
    'posts_per_page' => 1
));

if($featured->have_posts()) :

while($featured->have_posts()) :

$featured->the_post();

?>

<section class="featured-section">

<h1 class="main-headline">

<a href="<?php the_permalink(); ?>">

<?php the_title(); ?>

</a>

</h1>

<div class="featured-grid">

<div class="featured-image">

<a href="<?php the_permalink(); ?>">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('large');

}else{

echo '<img src="https://picsum.photos/900/500?random=1">';

}

?>

</a>

</div>

<div class="featured-content">

<p>

<?php echo wp_trim_words(get_the_excerpt(),45); ?>

</p>

<a class="read-more-btn"

href="<?php the_permalink(); ?>">

पूरा समाचार →

</a>

</div>

</div>

</section>

<?php

endwhile;

endif;

wp_reset_postdata();

?>

<!-- ============================= -->
<!-- MAIN NEWS -->
<!-- ============================= -->

<section class="homepage-box">

<div class="box-title">

<h2>मुख्य समाचार</h2>

<a href="<?php echo esc_url(home_url('/mainnews/')); ?>">

सबै समाचार →

</a>

</div>

<div class="box-grid">

<?php

$query = new WP_Query(array(

'posts_per_page'=>5

));

while($query->have_posts()):

$query->the_post();

?>

<a class="news-card"

href="<?php the_permalink(); ?>">

<div class="card-image">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('medium');

}else{

echo '<img src="https://picsum.photos/500/300?random='.rand(1,100).'">';

}

?>

</div>

<div class="card-content">

<h3>

<?php the_title(); ?>

</h3>

</div>

</a>

<?php endwhile;

wp_reset_postdata();

?>

</div>

</section>

<!-- ============================= -->
<!-- POLITICS -->
<!-- ============================= -->

<section class="homepage-box">

<div class="box-title">

<h2>राजनीति</h2>

<a href="<?php echo esc_url(home_url('/rajniti/')); ?>">

सबै समाचार →

</a>

</div>

<div class="box-grid">

<?php

$query = new WP_Query(array(

'posts_per_page'=>5,

'category_name'=>'politics'

));

while($query->have_posts()):

$query->the_post();

?>

<a class="news-card"

href="<?php the_permalink(); ?>">

<div class="card-image">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('medium');

}else{

echo '<img src="https://picsum.photos/500/300?random='.rand(101,200).'">';

}

?>

</div>

<div class="card-content">

<h3>

<?php the_title(); ?>

</h3>

</div>

</a>

<?php endwhile;

wp_reset_postdata();

?>

</div>

</section>

<section class="homepage-box">

<div class="box-title">

<h2>प्रदेश विशेष</h2>

<a href="<?php echo esc_url(home_url('/pradesh/')); ?>">

सबै समाचार →

</a>

</div>

<div class="box-grid">

<?php

$query=new WP_Query(array(
'posts_per_page'=>5,
'category_name'=>'pradesh'
));

while($query->have_posts()):
$query->the_post();

?>

<a class="news-card" href="<?php the_permalink(); ?>">

<div class="card-image">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('medium');

}else{

echo '<img src="https://picsum.photos/500/300?random='.rand(401,500).'">';

}

?>

</div>

<div class="card-content">

<h3><?php the_title(); ?></h3>

</div>

</a>

<?php endwhile; wp_reset_postdata(); ?>

</div>

</section>
<!-- ============================= -->
<!-- KUTNITI -->
<!-- ============================= -->

<section class="homepage-box">

<div class="box-title">

<h2>कूटनीति</h2>

<a href="<?php echo esc_url(home_url('/kutniti/')); ?>">

सबै समाचार →

</a>

</div>

<div class="box-grid">

<?php

$query = new WP_Query(array(
'posts_per_page'=>5,
'category_name'=>'kutniti'
));

while($query->have_posts()):
$query->the_post();

?>

<a class="news-card" href="<?php the_permalink(); ?>">

<div class="card-image">

<?php
if(has_post_thumbnail()){
the_post_thumbnail('medium');
}else{
echo '<img src="https://picsum.photos/500/300?random='.rand(201,300).'">';
}
?>

</div>

<div class="card-content">

<h3><?php the_title(); ?></h3>

</div>

</a>

<?php endwhile; wp_reset_postdata(); ?>

</div>

</section>
<section class="homepage-box">

<div class="box-title">

<h2>अर्थ वाणिज्य</h2>

<a href="<?php echo esc_url(home_url('/artha/')); ?>">

सबै समाचार →

</a>

</div>

<div class="box-grid">

<?php

$query=new WP_Query(array(
'posts_per_page'=>5,
'category_name'=>'artha'
));

while($query->have_posts()):
$query->the_post();

?>

<a class="news-card" href="<?php the_permalink(); ?>">

<div class="card-image">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('medium');

}else{

echo '<img src="https://picsum.photos/500/300?random='.rand(301,400).'">';

}

?>

</div>

<div class="card-content">

<h3><?php the_title(); ?></h3>

</div>

</a>

<?php endwhile; wp_reset_postdata(); ?>

</div>

</section>
<section class="homepage-box">

<div class="box-title">

<h2>खेलकुद</h2>

<a href="<?php echo esc_url(home_url('/sports/')); ?>">

सबै समाचार →

</a>

</div>

<div class="box-grid">

<?php

$query=new WP_Query(array(
'posts_per_page'=>5,
'category_name'=>'sports'
));

while($query->have_posts()):
$query->the_post();

?>

<a class="news-card" href="<?php the_permalink(); ?>">

<div class="card-image">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('medium');

}else{

echo '<img src="https://picsum.photos/500/300?random='.rand(501,600).'">';

}

?>

</div>

<div class="card-content">

<h3><?php the_title(); ?></h3>

</div>

</a>

<?php endwhile; wp_reset_postdata(); ?>

</div>

</section>
<section class="homepage-box">

<div class="box-title">

<h2>अन्तर्राष्ट्रिय</h2>

<a href="<?php echo esc_url(home_url('/international/')); ?>">

सबै समाचार →

</a>

</div>

<div class="box-grid">

<?php

$query=new WP_Query(array(
'posts_per_page'=>5,
'category_name'=>'international'
));

while($query->have_posts()):
$query->the_post();

?>

<a class="news-card" href="<?php the_permalink(); ?>">

<div class="card-image">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('medium');

}else{

echo '<img src="https://picsum.photos/500/300?random='.rand(601,700).'">';

}

?>

</div>

<div class="card-content">

<h3><?php the_title(); ?></h3>

</div>

</a>

<?php endwhile; wp_reset_postdata(); ?>

</div>

</section>
<section class="homepage-box">

<div class="box-title">

<h2>मनोरञ्जन</h2>

<a href="<?php echo esc_url(home_url('/entertainment/')); ?>">

सबै समाचार →

</a>

</div>

<div class="box-grid">

<?php

$query=new WP_Query(array(
'posts_per_page'=>5,
'category_name'=>'entertainment'
));

while($query->have_posts()):
$query->the_post();

?>

<a class="news-card" href="<?php the_permalink(); ?>">

<div class="card-image">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('medium');

}else{

echo '<img src="https://picsum.photos/500/300?random='.rand(701,800).'">';

}

?>

</div>

<div class="card-content">

<h3><?php the_title(); ?></h3>

</div>

</a>

<?php endwhile; wp_reset_postdata(); ?>

</div>

</section>
<!-- ============================= -->
<!-- OPINION -->
<!-- ============================= -->

<section class="homepage-box">

<div class="box-title">

<h2>विचार</h2>

<a href="<?php echo esc_url(home_url('/opinion/')); ?>">

सबै लेख →

</a>

</div>

<div class="box-grid">

<?php

$query=new WP_Query(array(

'posts_per_page'=>5,

'category_name'=>'opinion'

));

while($query->have_posts()):

$query->the_post();

?>

<a class="news-card"

href="<?php the_permalink(); ?>">

<div class="card-image">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('medium');

}else{

echo '<img src="https://picsum.photos/500/300?random='.rand(801,900).'">';

}

?>

</div>

<div class="card-content">

<h3><?php the_title(); ?></h3>

</div>

</a>

<?php endwhile;

wp_reset_postdata();

?>

</div>

</section>
<section class="homepage-box">

<div class="box-title">

<h2>साहित्य</h2>

<a href="<?php echo esc_url(home_url('/literature/')); ?>">

सबै साहित्य →

</a>

</div>

<div class="box-grid">

<?php

$query=new WP_Query(array(

'posts_per_page'=>5,

'category_name'=>'literature'

));

while($query->have_posts()):

$query->the_post();

?>

<a class="news-card"

href="<?php the_permalink(); ?>">

<div class="card-image">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('medium');

}else{

echo '<img src="https://picsum.photos/500/300?random='.rand(901,1000).'">';

}

?>

</div>

<div class="card-content">

<h3><?php the_title(); ?></h3>

</div>

</a>

<?php endwhile;

wp_reset_postdata();

?>

</div>

</section>
<section class="homepage-box">

<div class="box-title">

<h2>एबीसी भिडियो</h2>

<a href="<?php echo esc_url(home_url('/video/')); ?>">

सबै भिडियो →

</a>

</div>

<div class="box-grid">

<?php

$query=new WP_Query(array(

'posts_per_page'=>5,

'category_name'=>'video'

));

while($query->have_posts()):

$query->the_post();

?>

<a class="news-card"

href="<?php the_permalink(); ?>">

<div class="card-image">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('medium');

}else{

echo '<img src="https://picsum.photos/500/300?random='.rand(1001,1100).'">';

}

?>

</div>

<div class="card-content">

<h3><?php the_title(); ?></h3>

</div>

</a>

<?php endwhile;

wp_reset_postdata();

?>

</div>

</section>
<section class="homepage-box">

<div class="box-title">

<h2>English News</h2>

<a href="<?php echo esc_url(home_url('/english/')); ?>">

View All →

</a>

</div>

<div class="box-grid">

<?php

$query=new WP_Query(array(

'posts_per_page'=>5,

'category_name'=>'english'

));

while($query->have_posts()):

$query->the_post();

?>

<a class="news-card"

href="<?php the_permalink(); ?>">

<div class="card-image">

<?php

if(has_post_thumbnail()){

the_post_thumbnail('medium');

}else{

echo '<img src="https://picsum.photos/500/300?random='.rand(1101,1200).'">';

}

?>

</div>

<div class="card-content">

<h3><?php the_title(); ?></h3>

</div>

</a>

<?php endwhile;

wp_reset_postdata();

?>

</div>

</section>
<section class="wide-ad-section">

<img

src="https://picsum.photos/1400/180?random=250"
alt="">

</section>
<section class="newsletter-section">

<h2>

ABC Nepal TV Newsletter

</h2>

<p>

सबैभन्दा पहिले समाचार प्राप्त गर्नुहोस्।

</p>

<input

type="email"

placeholder="Email Address">

<button type="button">

Subscribe

</button>

</section>






<?php get_footer(); ?>
