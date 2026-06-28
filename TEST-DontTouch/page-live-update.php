<?php
/*
Template Name: Live Update Page
*/
get_header();

$active_topic = abcnepal_get_live_update_topic_slug();
$topics = get_terms(array(
    'taxonomy'   => 'update_topic',
    'hide_empty' => false,
));
$query = new WP_Query(abcnepal_live_update_query_args(1, $active_topic));
?>

<main class="container live-update-page">
    <header class="live-update-header">
        <p class="live-kicker">Live Timeline</p>
        <h1 class="section-title">लाइभ अपडेट</h1>
        <p class="live-update-intro">
            पछिल्ला घटनाक्रम, ताजा सूचना र मैदानबाट आएका अपडेटहरू समयक्रमअनुसार यहाँ हेर्नुहोस्।
        </p>
    </header>

    <nav class="live-topic-filter" aria-label="<?php esc_attr_e('Live update topics', 'abcnepal-tv'); ?>">
        <a class="<?php echo empty($active_topic) ? 'active' : ''; ?>" href="<?php echo esc_url(remove_query_arg('topic')); ?>">
            सबै अपडेट
        </a>

        <?php if (!is_wp_error($topics) && !empty($topics)) : ?>
            <?php foreach ($topics as $topic) : ?>
                <a
                    class="<?php echo $active_topic === $topic->slug ? 'active' : ''; ?>"
                    href="<?php echo esc_url(add_query_arg('topic', $topic->slug)); ?>"
                >
                    <?php echo esc_html($topic->name); ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </nav>

    <section
        id="live-feed"
        class="live-feed-content"
        data-topic="<?php echo esc_attr($active_topic); ?>"
        aria-live="polite"
    >
        <?php
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                abcnepal_render_live_update_card();
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p class="live-empty">अहिले यो विषयमा कुनै लाइभ अपडेट छैन।</p>
            <?php
        endif;
        ?>
    </section>

    <?php if ($query->max_num_pages > 1) : ?>
        <button
            id="load-more-btn"
            class="load-more-btn"
            type="button"
            data-page="2"
            data-topic="<?php echo esc_attr($active_topic); ?>"
        >
            थप अपडेटहरू हेर्नुहोस्
        </button>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
