<?php
/*
Template Name: Custom Template
*/


get_header();
$product_title = get_field('product_title');
$product_description = get_field('product_description');
$button_link = get_field('button_link');
$detail_section_title_1 = get_field('section_title_1');
$detail_section_title_2 = get_field('section_title_2');
$detail_short_title = get_field('short_title');
$detail_description = get_field('long_description');
$faq_section_title_1 = get_field('faq_section_title_1');
$faq_section_title_2 = get_field('faq_section_title_2');
$youtube_video_link = get_field('youtube_video_link');
?>

<div class="hidden_element" style="display:none;"><?php echo '$product_title": '.$product_title;  echo '$product_description": '.$product_description;  echo '$button_link": '.$button_link; ?></div>
<?php if (!empty($product_title) && !empty($product_description) && !empty($button_link)): ?>
<div id="main_container">
    <div id="post_container">
        <div id="image_col">
        <?php if (have_rows('image_swiper')) : ?>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php while (have_rows('image_swiper')) : the_row(); ?>
                        <?php
                        $swiper_image = get_sub_field('swiper_image'); // Assuming 'swiper_image' is the field name
                        ?>
                        <div class="swiper-slide"><img src="<?php echo $swiper_image; ?>" alt="img"></div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                
            </div>
        <?php endif; ?>
            
        </div>
        <div id="content_col">
            <h2><?php echo esc_html($product_title); ?></h2>
            <p class="product_main_title"><?php echo esc_html($product_description); ?></p>
            <div class="content_container">
                <div id="product_info_container">
                    <div class="table-container">
                        <table class="table">
                            <?php if (have_rows('product_detailed_information')): ?>
                                <?php while (have_rows('product_detailed_information')) : the_row(); ?>
                                    <tr>
                                        <th>
                                            <div class="title_detail">
                                                <p><?php the_sub_field('product_info_title'); ?></p>
                                                
                                            </div>
                                        </th>
                                        <td>:</td>
                                        <td><?php the_sub_field('product_info_description'); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </table>
                    </div>
                    <a class="button_link" href="<?php echo esc_url($button_link); ?>">LETS CONNECT TO DISCUSS</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($detail_section_title_1) && !empty($detail_section_title_2) && !empty($detail_short_title) && !empty($detail_description)): ?>
<div id="specification_main_container">
    <div id="specification_content_container">
        <h1 class="detailed_title-1 temp_padding"><?php echo esc_html($detail_section_title_1); ?></h1>
        <h1 class="detailed_title-2"><?php echo esc_html($detail_section_title_2); ?></h1>
        <div id="detailed_content_main_container">
            <h2><?php echo esc_html($detail_short_title); ?></h2>
            <p class="detailed_description">
                <?php echo esc_html($detail_description); ?>
            </p>
        </div>
        <div id="table_main_container">
            <div id="table_section_1">
                <div class="table-container">
                    <table class="table">
                        <?php if (have_rows('products_feature_left_side_')): ?>
                            <?php while (have_rows('products_feature_left_side_')) : the_row(); ?>
                                <tr>
                                    <th>
                                        <div class="title_detail">
                                            <p><?php the_sub_field('product_key'); ?></p>
                                          
                                        </div>
                                    </th>
                                    <td>:</td>
                                    <td><?php the_sub_field('product_value'); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
            <div id="table_section_2">
                <div class="table-container">
                    <table class="table">
                        <?php if (have_rows('products_feature_right_side')): ?>
                            <?php while (have_rows('products_feature_right_side')) : the_row(); ?>
                                <tr>
                                    <th>
                                        <div class="title_detail">
                                            <p><?php the_sub_field('product_key'); ?></p>
                                           
                                        </div>
                                    </th>
                                    <td>:</td>
                                    <td><?php the_sub_field('product_value'); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($youtube_video_link) ): ?>

<div id = "youtube_video_container">

<?php

$iframe = get_field('youtube_video_link');

// Use preg_match to find iframe src.
preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];

// Add extra parameters to src and replace HTML.
$params = array(
    'controls'  => 0,
    'hd'        => 1,
    'autohide'  => 1
);
$new_src = add_query_arg($params, $src);
$iframe = str_replace($src, $new_src, $iframe);

// Add extra attributes to iframe HTML.
$attributes = 'frameborder="0"';
$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

// Display customized HTML.
echo $iframe;
?>
</div>
<?php endif; ?>

<div id="specification_main_container">
    <div id="specification_content_container">
        <h1 class="detailed_title-1">CHECK OTHERS</h1>
        <h1 class="detailed_title-2">YOU MAY LIKE TO SEE MORE</h1>
        <div id="collection_container">
        <?php
        $related_products = get_related_products(); // Custom function to retrieve related products

        if ($related_products->have_posts()) :
          while ($related_products->have_posts()) :
            $related_products->the_post();
        ?>
            <div>
              <div id="img_div">
                <a href="<?php the_permalink(); ?>">
                  <img class="related_img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="img">
                </a>
              </div>
              <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
            </div>
        <?php
          endwhile;
          wp_reset_postdata();
        else :
          echo 'No related products found.';
        endif;
        ?>
      </div>
    </div>
</div>




<?php if (!empty($faq_section_title_1) && !empty($faq_section_title_2)): ?>
<div id="specification_main_container">
    <div id="specification_content_container">
        <h1 class="detailed_title-1"><?php echo esc_html($faq_section_title_1); ?></h1>
        <h1 class="detailed_title-2"><?php echo esc_html($faq_section_title_2); ?></h1>
    </div>
    <?php if (have_rows('faq_repeater')): ?>
    <div id="faq_content_container">
        <div class="accordion">
            <?php while (have_rows('faq_repeater')) : the_row(); ?>
                <div class="accordion-item">
                    <div class="accordion-header">
                        <?php the_sub_field('faq_title'); ?>
                        <span class="icon"></span>
                    </div>
                    <div class="accordion-content">
                        <p><?php the_sub_field('faq_description'); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php else: ?>
        <?php if (have_rows('faq', 'option')): ?>
            <div id="faq_content_container">
                <div class="accordion">
                    <?php while (have_rows('faq', 'option')) : the_row(); ?>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <?php the_sub_field('question'); ?>
                                <span class="icon"></span>
                            </div>
                            <div class="accordion-content">
                                <p><?php the_sub_field('answer'); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php get_footer(); ?>
