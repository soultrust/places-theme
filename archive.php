<?php
get_header();
?>
<h2 class="archive-title"><?php the_archive_title(); ?></h2>
<ul class="links-list">
<?php
  $queried_obj = get_queried_object();
  
  $tag_args = array(
    'post_type' => 'place',
    'tag' => $queried_obj->slug
  );
  $category_args = array(
    'post_type' => 'place',
    'category_name' => $queried_obj->slug
  );

  if (is_tag()) {
    $places = new WP_Query($tag_args);
  }
  if (is_category()) {
    $places = new WP_Query($category_args);
  }
  
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
