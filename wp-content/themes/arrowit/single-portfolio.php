<?php get_header();
$cols = Arrowit_Global::get_page_sidebar();
?>
    <div class="col-md-12">
        <div id="primary" class="content-area">
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $taxonomy_names = get_object_taxonomies('portfolio');
                if (is_array($taxonomy_names) && count($taxonomy_names) > 0 && in_array('portfolio_cat', $taxonomy_names)) {
                    $terms = get_terms('portfolio_cat', array(
                        'hide_empty' => true,
                        'parent' => 0,
                        'hierarchical' => false,
                    ));
                }
                ?>

                <div class="portfolio-single">
                    <?php
                    $portfolio_id = 'portfolio_id-' . wp_rand();
                    $comment_portfolio = get_post_meta(get_the_ID(), 'comment_portfolio', true);
                    $gallery = get_post_meta(get_the_ID(), 'gallery_metabox', true);
                    if (is_array($gallery) && count($gallery) > 1) : ?>
                        <?php if (is_singular()): ?>
                            <div class="portfolio-gallery-single portfolio-img arrows-custom">
                                <?php
                                foreach ($gallery as $key => $value) :
                                    $full_image_size = wp_get_attachment_image_src($value, 'full');
                                    $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                    $image_url = Arrowit_Helper::aq_resize(array(
                                        'url' => $full_image_size[0],
                                        'width'  => 970,
                                        'height' => 588,
                                    ));
                                    ?>
                                    <div class="img-gallery">
                                        <img src="<?php echo esc_url($image_url); ?>"
                                             alt="<?php echo esc_attr($alt); ?>"/>
                                    </div>
                                    <?php
                                endforeach;
                                ?>
                            </div>
                        <?php else: ?>
                            <div id="<?php echo esc_attr($portfolio_id); ?>"
                                 class="portfolio-gallery portfolio-img arrows-custom">
                                <?php
                                foreach ($gallery as $key => $value) :
                                    $full_image_size = wp_get_attachment_image_src($value, 'full');
                                    $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                    $image_url = Arrowit_Helper::aq_resize(array(
                                        'url' => $full_image_size,
                                        'width'  => 970,
                                        'height' => 588,
                                    ));
                                    ?>
                                    <div class="img-gallery">
                                        <img src="<?php echo esc_url($image_url); ?>"
                                             alt="<?php echo esc_attr($alt); ?>"/>
                                    </div>
                                    <?php
                                endforeach;
                                ?>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if (has_post_thumbnail()) { ?>
                            <?php
                            $image = arrowit_resize_image(555, 345);
                            ?>
                            <div class="portfolio-gallery-single">
                                <div class="item-img-single">
                                    <img src="<?php echo esc_url($image); ?>"
                                     alt="<?php the_title_attribute(); ?>"/>
                                </div>
                                
                            </div>
                            <?php
                        }
                        ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="portfolio-left">
                            <div class="portfolios-info">
                                <h1 class="portfolio-name"><?php the_title(); ?></h1>
                            </div>
                            <div class="portfolio-desc">
                                <?php
                                echo '<div class="entry-content">';
                                the_content();
                                wp_link_pages(array(
                                    'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'arrowit') . '</span>',
                                    'after' => '</div>',
                                    'link_before' => '<span>',
                                    'link_after' => '</span>',
                                    'pagelink' => '<span class="screen-reader-text">' . esc_html__('Page', 'arrowit') . ' </span>%',
                                    'separator' => '<span class="screen-reader-text">, </span>',
                                ));
                                echo '</div>';
                                ?>
                            </div>
                            <?php
                            if ($comment_portfolio != '' ): ?>
                                <div class="portfolio-comment">
                                    <p>&ldquo;<?php echo esc_attr($comment_portfolio); ?>&rdquo;</p>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            <?php endwhile; // End of the loop. ?>
        </div> <!-- End primary -->
    </div>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>