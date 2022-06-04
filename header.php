<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head() ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
<?php if (is_front_page() && is_home()) { ?>
  <h1>SOULTRUST PLACES <span style="opacity: 0.4">DATABASE</span></h1>
<?php } else { ?>
<h1>
  <a href="<?php echo esc_url(home_url('/')); ?>">
    SOULTRUST PLACES <span style="opacity: 0.4">DATABASE</span>
  </a>
</h1>
<?php } ?>

<div class="search">
  <div class="search-field" id="search-field">
    <input type="text" class="search-input" id="search-input" placeholder="Search Places" autocomplete="off" />
  </div>
  <div class="search-trigger" id="search-trigger">
    <div class="search-trigger-txt" id="search-trigger-text">
      <span>Search</span>
      <span>Places</span>
    </div>
    <div class="dashicons dashicons-search search-icon"></div>
  </div>
</div>
</header>
<div class="site">