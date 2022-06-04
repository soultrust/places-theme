<?php

function places_files() {
  wp_enqueue_script('googleMap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAGdVdFxtF_PzKxIETa0HIZ_DAknIXGCFY', NULL, '1.0', true);
  wp_enqueue_script('main-js', get_theme_file_uri('/build/index.js'), ['googleMap', 'jquery'], '1.0', true);
  wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=Oswald&family=Lato&display=swap', [], null);
  wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
  wp_enqueue_style('main-styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('dashicons');

  // For dynamically setting k6.root_url prop to point to root
  // whether on prod or local. (example usage in Search.js)
  wp_localize_script(
    'main-js', 'places', array(
      'root_url' => get_site_url()
    )
  );
}
add_action('wp_enqueue_scripts', 'places_files');

function places_features() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'places_features');

// Make admin use main style from front end
// function ourLoginCSS() {
//   wp_enqueue_style( 'login-style', get_theme_file_uri('/build/style-login.css'));
//   wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet');
// }
// add_action('login_enqueue_scripts', 'ourLoginCSS');

// function login_styles() {
//   wp_enqueue_style( 'custom-styles', get_theme_file_uri('/build/style-index.css'));
// }
// add_action( 'login_enqueue_scripts', 'login_styles' );

// Enable "Widgets" admin section
// function k6_widgets_init() {
// 	register_sidebar(
// 		array(
// 			'name'          => esc_html__( 'Sidebar', 'twentytwentyone' ),
// 			'id'            => 'sidebar-1',
// 			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
// 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
// 			'after_widget'  => '</section>',
// 			'before_title'  => '<h2 class="widget-title">',
// 			'after_title'   => '</h2>',
// 		)
// 	);
// }
// add_action( 'widgets_init', 'k6_widgets_init' );

// Enable tags for recipes
// function gp_register_taxonomy_for_object_type() {
//     register_taxonomy_for_object_type( 'post_tag', 'recipe' );
// };
// add_action( 'init', 'gp_register_taxonomy_for_object_type' );









// add_filter( 'enter_title_here', 'custom_enter_title_text' );

// function custom_enter_title_text( $input ) {
//   if ( 'recipe' === get_post_type() ) {
//       return __( 'Add recipe title', 'wp-rig' );
//   }
//   return $input;
// }


// function change_columns( $cols ) {
//   $cols = array(
//     'title'      => 'Recipe Title'
//   );
//   return $cols;
// }

// add_action("manage_site_posts_custom_column", "custom_columns", 10, 2);
// add_filter("manage_recipe_posts_columns", "change_columns");

/**
 * Adds custom classes to indicate whether a sidebar is present to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array Filtered body classes.
 */

// add_filter('body_class', 'filter_body_classes');

// function filter_body_classes( array $classes ) : array {
//     if (is_active_sidebar('sidebar-1')) {
//         global $template;
//         if (! in_array(
//             basename($template),
//             array('single-recipe.php', '404.php', '500.php', 'offline.php')
//         )
//         ) {
//             $classes[] = 'has-sidebar';
//         }
//     }
//     return $classes;
// }

// add_action('admin_enqueue_scripts', 'load_admin_style');

// function load_admin_style()
// {
//     wp_enqueue_style('admin_css', get_stylesheet_directory_uri() . '/admin-style.css', false, '1.0.0');
// }


// Redirect subscriber-level members to home page.
// (demo account is a subcriber)
// function redirectToFrontEnd() {
//   $ourCurrentUser = wp_get_current_user();

//   if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
//     wp_redirect(site_url('/'));
//     exit;
//   }
// }
// add_action('admin_init', 'redirectToFrontEnd');

// Redirect everybody to home page after logging in.
// Subsequent visits to admin will not redirect.
// add_filter('login_redirect', 'mylogin_redirect', 10, 3);

// function mylogin_redirect($redirect_to, $url_redirect_to, $user) {
//   return home_url();
// }

// Remove admin bar for subscribers
// add_action('wp_loaded', 'noSubsAdminBar');

// function noSubsAdminBar() {
//   $ourCurrentUser = wp_get_current_user();

//   if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
//     show_admin_bar(false);
//   }
// }

// // Customize Title Link for Login Screen
// add_filter('login_headerurl', 'ourHeaderUrl');

// function ourHeaderUrl() {
//   return esc_url(site_url('/'));
// }

// // Change the Login Page Title
// add_filter('login_headertitle', 'ourLoginTitle');

// function ourLoginTitle() {
//   return get_bloginfo('name');
// }




































// below here from places 2022


function places_post_types() {
  register_post_type('place', array(
    'supports' => array('title', 'thumbnail', 'widget'),
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'places'),
    'has_archive' => true,
    'menu_position' => 2,
    'public' => true,
    'labels' => array(
      'name' => 'Places',
      'all_items' => 'All Places',
      'add_new_item' => 'Add New Place',
      'edit_item' => 'Edit Place',
      'singular_name' => 'Place'
    ),
    'menu_icon' => 'dashicons-food'
  ));
}
add_action('init', 'places_post_types');

// function custom_enter_title_text( $input )
// {
//     if ('site' === get_post_type() ) {
//         return __('Add site name', 'wp-rig');
//     }
//     if ('people' === get_post_type()) {
//         return __('Add full name', 'wp-rig');
//     }
//     return $input;
// }
// add_filter('enter_title_here', 'custom_enter_title_text');

// function change_columns($cols)
// {
//     $cols = array(
//         'title'      => 'Site Name',
//         'location'   => 'Location',
//     );
//     return $cols;
// }

// function custom_columns($column)
// {
//     // global $post;
//     if ($column == 'location') {
//         $location = get_field('location');
//         if ($location) {
//             echo $location;
//         } else {
//             echo '-';
//         }
//     }
// }
// add_action("manage_site_posts_custom_column", "custom_columns", 10, 2);
// add_filter("manage_site_posts_columns", "change_columns");

// /**
//  * Adds custom classes to indicate whether a sidebar is
//  * present to the array of body classes.
//  *
//  * @param array $classes Classes for the body element.
//  * @return array Filtered body classes.
//  */
// function filter_body_classes( array $classes ) : array
// {
//     if (is_active_sidebar('sidebar-1')) {

//         if (!in_array(
//             basename(get_page_template()),
//             array('404.php', '500.php', 'offline.php')
//         )
//         ) {
//             $classes[] = 'has-sidebar';
//         }
//     }
//     return $classes;
// }

// add_filter('body_class', 'filter_body_classes');


// function get_soultrust_theme_mod($slug, $default_value)
// {
//     if (get_theme_mod($slug) === '0') {
//         return '0';
//     }
//     return get_theme_mod($slug) ? get_theme_mod($slug) : $default_value;
// }

// add_action('wp_enqueue_scripts', 'load_dashicons_front_end');
// function load_dashicons_front_end()
// {
//     wp_enqueue_style('dashicons');
// }

function soultrustMapKey()
{
    $api['key'] = 'AIzaSyAGdVdFxtF_PzKxIETa0HIZ_DAknIXGCFY';
    return $api;
}
add_filter('acf/fields/google_map/api', 'soultrustMapkey');
?>