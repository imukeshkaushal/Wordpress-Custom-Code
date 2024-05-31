<?php


add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

//load child theme custom CSS
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 11 );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri() );
}


// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'aos','bootstrap','imp','loveicon-custom-animate','flaticon','owl','magnific-popup','scrollbar','hiddenbar','icomoon','loveicon-header-section','loveicon-breadcrumb-section','loveicon-blog-section','loveicon-footer-section','loveicon-about-section','loveicon-event-section','loveicon-cause-section','loveicon-color','loveicon-theme-color','animate','bootstrap-select','date-picker','bxslider','fancybox','m-customScrollbar','slick','timePicker','bootstrap-touchspin' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 20 );

// END ENQUEUE PARENT ACTION
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
	        background-image: url(https://madisonavenuearmor.com/wp-content/uploads/2023/07/logo-1.png); 
		    background-size: contain;
	        width: auto;
	        height: 50px;
	        background-repeat: no-repeat;
            mix-blend-mode: darken;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function create_custom_post_type() {
    $args = array(
        'labels' => array(
            'name' => __( 'Cars' ),
            'singular_name' => __( 'Car' )
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'cars'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'), // Add 'excerpt' here
    );

    register_post_type( 'cars', $args );

    // Register a custom taxonomy for your custom post type
    $taxonomy_args = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Car Categories', 'taxonomy general name' ),
            'singular_name' => _x( 'Car Category', 'taxonomy singular name' ),
        ),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'car-category' ), // Change this slug as needed
    );

    register_taxonomy( 'car_category', 'cars', $taxonomy_args );
}
add_action( 'init', 'create_custom_post_type' );


add_action( 'init', 'create_custom_post_type' );

// Hooking up our function to theme setup

function custom_product_pagination($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_post_type_archive('cars')) { // Replace 'cars' with your actual custom post type slug
        $items_per_page = 10; // Number of products per page
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

        $query->set('posts_per_page', $items_per_page);
        $query->set('paged', $paged);
    }
}
add_action('pre_get_posts', 'custom_product_pagination');



function styleandscripts() {
    if (is_archive('cars') || is_singular('cars') || is_404() || is_search() || is_category('cars')) {
        // Enqueue Google Fonts
        wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');

        // Enqueue Swiper CSS
        wp_enqueue_style('swiper_style', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css');

        // Enqueue your custom CSS and JS
        wp_enqueue_style('custompage', get_theme_file_uri('/assets/style/single_cars.css'));
        wp_enqueue_style('cararchivepage', get_theme_file_uri('/assets/style/archive_cars.css'));
        wp_enqueue_script('accordian_custom', get_theme_file_uri('/assets/js/accordian.js'), array(), '1.0', true);

        // Enqueue Swiper script
        wp_enqueue_script('swiper_script', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'styleandscripts');




if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Common Product FAQ',
        'menu_title'    => 'Common Product FAQ',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));      
}

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Car Listing',
        'menu_title'    => 'Car Listing',
        'menu_slug'     => 'car-listing',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));      
}

function get_related_products() {
    global $post;
  
    $terms = wp_get_post_terms($post->ID, 'car_category'); // Change 'car_category' to your actual taxonomy slug
    if (!empty($terms) && !is_wp_error($terms)) {
      $term_ids = wp_list_pluck($terms, 'term_id');
    }
  
    $args = array(
      'post_type' => 'cars', // Replace 'cars' with your custom post type slug
      'posts_per_page' => 3, // Number of related products to show
      'post__not_in' => array($post->ID), // Exclude current product
      'tax_query' => array(
        array(
          'taxonomy' => 'car_category',
          'field' => 'term_id',
          'terms' => $term_ids,
        ),
      ),
    );
  
    return new WP_Query($args);
  }


?>
<?php
function header_code() { ?>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-1003663-6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-1003663-6');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-236107967-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-236107967-1');
</script>

<?php }

add_action( 'wp_head', 'header_code', 10);

  