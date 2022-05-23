<?php
get_header();
?>
<h2><?php wp_title( '' ); ?></h2>

<ul class="links-list">
    <?php
        $places = new WP_Query(
            array(
                'post_type' => 'place'
            )
        );

        while ($places->have_posts()) {
            $places->the_post(); ?>
        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php
        } wp_reset_postdata(); ?>
    </ul>

<?php
get_sidebar();
get_footer();
