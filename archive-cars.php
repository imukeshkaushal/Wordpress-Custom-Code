<?php
get_header();

$banner_title = get_field('listing_banner_title', 'option');
$banner_img = get_field('listing_banner_image', 'option');
$video_link = get_field('hero_video_wedget', 'option');
$hero_title_1 = get_field('hero_title_1', 'option');
$hero_title_2 = get_field('hero_title_2', 'option');
$hero_description = get_field('hero_description', 'option');
$hero_video_wedget = get_field('hero_video_wedget', 'option');
$viip_title_1 = get_field('viip_title_1', 'option');
$viip_title_2 = get_field('viip_title_2', 'option');
$viip_peragraph = get_field('viip_peragraph', 'option');
$viip_button_link = get_field('viip_button', 'option');
$feature_title_1 = get_field('feature_title_1', 'option');
$feature_title_2 = get_field('feature_title_2', 'option');
$feature_image = get_field('feature_image', 'option');
$feature_point_title = get_field('feature_point_title', 'option');

$page = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$args = array(
    'post_type' => 'cars',
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'orderby' => 'title',
    'order' => 'ASC',
    'paged' => $page,
);

$loop = new WP_Query($args);

$total_pages = $loop->max_num_pages;

// Get the current page
$current_page = max(1, get_query_var('paged'));

?>

<script>
        function playVideo() {
            var video = document.getElementById("myVideo");
            var playIcon = document.querySelector(".play-icon");

            if (video.paused) {
                video.play();
                playIcon.style.display = "none";
            }
        }
</script>

<?php if (!empty($banner_title) && !empty($banner_img)) : ?>
    <div class="banner" style="background-image: url('<?php echo esc_html($banner_img); ?>');">
        <div class="overlay"></div>
        <div class="banner-content">
            <h1 class="banner-heading"><?php echo esc_html($banner_title); ?></h1>
        </div>
    </div>
    <div id="video_main_content_video_container">
        <!-- ... rest of your banner content ... -->
	<div id="video_main_content_video_container">
        <div id="video_section_container">
            <div id="video_content_container">
                <h1 class="video_section_title-1"><?php echo esc_html($hero_title_1); ?></h1>
                <h1 class="video_section_title-2">
                    <?php echo esc_html($hero_title_2); ?>
                </h1>
                <p class="video_content_description">
                    <?php echo esc_html($hero_description); ?>
                </p>
            </div>
            <div id="video_graphic_container">
                <div class="video-container">
                    <video id="myVideo">
                        <source src="<?php echo esc_html($hero_video_wedget); ?>" type="video/mp4">
                    </video>
                    <div class="play-icon" onclick="playVideo()">
                        &#9658; <!-- Play icon -->
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    </div>
<?php endif; ?>

<!-- Start of the main loop. -->

<?php if ($loop->have_posts()) : ?>
    <?php while ($loop->have_posts()) : $loop->the_post(); ?>

        <?php
        // ... your listing content code ...

        $long_description = get_the_excerpt();
        $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        ?>
        <div id="listing_inside_container">
            <?php if (!empty($featured_image)) : ?>
                <div class="listing_image_box">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title(); ?>">
                    </a>
                </div>
            <?php endif; ?>
            <div id="listing_content_box">
                <h3 class="listing-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                <p class="listing-post-description">
                    <?php
                    $truncated_description = substr($long_description, 0, 350);
                    $truncated_description = esc_html($truncated_description);
                    if (strlen($long_description) > 350) {
                        $truncated_description .= '...';
                    }
                    echo $truncated_description;
                    ?>
                </p>
                <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
            </div>
        </div>
    <?php endwhile; ?>



<!-- Pagination -->
<div id="custom_pagination">
<div id ="custom_pagination_container">
    <?php
    echo paginate_links(array(
        'base' => '/new/cars/page/%#%', // Adjust the base to match your URL structure
        'format' => 'page/%#%', // Adjust the format to match your URL structure
        'current' => $current_page,
        'total' => $total_pages,
        'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>'
    ));
    ?>
</div>
</div>

    <!-- End of the main loop -->

<?php else : ?>

    <?php _e('Sorry, no posts matched your criteria.'); ?>

<?php endif; ?>

<!-- ... rest of your template ... -->


<div id="vip_main_container">
    <h1 class="video_section_title-1 transparent_title"><?php echo esc_html($viip_title_1); ?></h1>
    <h1 class="video_section_title-2 temp_title_viip">
        <?php echo esc_html($viip_title_2); ?>
    </h1>
    <p><?php echo esc_html($viip_peragraph); ?></p>
    <button><a href="<?php echo esc_html($viip_button_link); ?>">Lets Connect to Discuss</a></button>
</div>


<div id="maa_features_container">
    <h1 class="video_section_title-1"><?php echo esc_html($feature_title_1); ?></h1>
    <h1 class="video_section_title-2"><?php echo esc_html($feature_title_2); ?></h1>
    <div id="maa_features_points">

        <?php if (have_rows('maa_features_point', 'option')): ?>
                    <?php while (have_rows('maa_features_point', 'option')) : the_row(); ?>
                        <div>
                            <img src="<?php  the_sub_field('feature_image') ?>" alt="images">
                            <p><?php  the_sub_field('feature_point_title'); ?></p>
                        </div>

                    <?php endwhile; ?>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
