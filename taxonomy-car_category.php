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





<div class="banner" style="background-image: url('https://madisonavenuearmor.com/wp-content/uploads/2023/11/Combine-Banner-Desktop-%E2%80%93-3.webp');">
        <div class="overlay"></div>
        <div class="banner-content">
            <h1 class="banner-heading"><?php single_term_title(); ?></h1>
        </div>
</div>

<?php

// Check if it's a category archive page
if ( is_tax('car_category') ) {
    // Get the current category object
    $category = get_queried_object();

    // Check if it's a specific category (replace 'your_category_slug' with the actual category slug)
    if ( $category->slug === 'new-vehicle-inventory' ) {
        // Your code to display the specific section for this category
        if (!empty($hero_title_1) && !empty($hero_title_2) && !empty($hero_description) && !empty($hero_video_wedget) ) :
            ?>
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
            <?php
        endif;
    }
}
?>


<div id="primary" class="content-area category_post_listing">
        <?php if ( have_posts() ) : ?>
            <div class="post-list">
                <?php while ( have_posts() ) : the_post(); ?>
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
            </div>
             <!-- Pagination -->
        <div id="custom_pagination">
            <div id="custom_pagination_container">
                <?php
                echo paginate_links(array(
                    'prev_text' => __('&laquo; Previous'),
                    'next_text' => __('Next &raquo;'),
                ));
                ?>
            </div>
        </div>
        <?php else : ?>
            <p class = "no_post"><?php _e( 'No posts found in this category.', 'textdomain' ); ?></p>
        <?php endif; ?>

</div>

<?php
get_footer();
?>
