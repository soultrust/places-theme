<?php

get_header();

while(have_posts()) {
  the_post(); ?>
  <header class="place-header">
    <h2 class="place-name"><?php the_title(); ?></h2>
    <div class="place-meta">
   
<?php
$taxonomy = 'category';

// Get the term IDs assigned to post.
$post_terms = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));

// Separator between links.
$separator = ', ';
$categoryIndex = array_search('1', $post_terms);

if ($categoryIndex !== '') {
  if ($categoryIndex === 0 || $categoryIndex > 0) {
    if (get_cat_name($post_terms[$categoryIndex]) === 'Uncategorized') {
      unset($post_terms[$categoryIndex]);
    }
  }
}

if (!empty($post_terms ) && !is_wp_error($post_terms)) {
  $terms = wp_list_categories(array(
    'title_li' => '',
    'style'    => 'none',
    'echo'     => false,
    'taxonomy' => $taxonomy,
    'include'  => $post_terms,
    'exclude'  => ['1']
  ));

  $terms = rtrim(trim(str_replace('<br />', $separator, $terms)), $separator);
?>
<span class="categories place-meta__line-item">
  <?php // Display post categories.
    echo  $terms;
  ?>
</span>
<?php
}
?>

	  <span class="tags place-meta__line-item">
      <?php the_tags( 
        '<span class="place-meta__line-item-key">tags:</span> <span class="place-meta__line-item-value">', 
        ', ', 
        '</span>'
      ); ?>
    </span>
  
  <?php 
}
?>





<span>
    <a href="<?php the_field('website'); ?>" target="_blank">
      <?php the_field('website'); ?>
    </a>
</span>

      <span class="place-meta__line-item address">
        <?php the_field('address'); ?>
      </span>






    </div>
  </header>
  <?php if (is_singular('place') && get_field('map_location')) { ?>
    <div class="acf-map">
    <?php
        
        $mapLocation = get_field('map_location');
        print_r($mapLocation['lat']);
        ?>
        <div class="marker"
             data-lat="<?php echo $mapLocation['lat'] ?>"
             data-lng="<?php echo $mapLocation['lng'] ?>">
        </div>
        
    </div>
<?php } ?>
  <?php the_content(); 

get_footer();

?>