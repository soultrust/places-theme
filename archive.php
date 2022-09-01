<?php
get_header();
?>
<h2 class="archive-title"><?php the_archive_title(); ?></h2>
<ul class="links-list">
<?php
  $places = new WP_Query(array(
    'post_type' => 'place',
    'tag' => single_tag_title('', false)
  ));
  while ($places->have_posts()) {
    $places->the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php 
  } wp_reset_postdata();
 ?>
</ul>

<?php
get_sidebar();
get_footer();
