<?php
global $wp_query;
$terms = '';
$taxonomy_names = get_object_taxonomies('portfolio');
$cat = $wp_query->get_queried_object();
if (isset($cat->term_id)) {
    $woo_cat = $cat->term_id;
} else {
    $woo_cat = 0;
}
if (is_array($taxonomy_names) && count($taxonomy_names) > 0 && in_array('portfolio_cat', $taxonomy_names)) {
    $terms = get_terms('portfolio_cat', array(
        'hide_empty' => true,
        'parent' => $woo_cat,
        'hierarchical' => false,
        'orderby' => 'COUNT',
        'order' => 'DESC',
    ));
}
$animation = Arrowit::setting('portfolio_css_animation');
$animation_class = Arrowit_Helper::get_animation_classes($animation);
$portfolio_column = Arrowit_Portfolio::portfolio_columns();
$portfolio_title = Arrowit::setting('portfolio_title');
$portfolio_pagination = Arrowit::setting('portfolio_pagination');
$portfolio_number_cate = Arrowit::setting('portfolio_number_cate');
$portfolio_num_cate = array_slice($terms, 0, $portfolio_number_cate);
$current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
$arrowit_portfolio_layout = arrowit_get_meta_value('portfolio_layout', false);
$portfolio_layout = Arrowit::setting('portfolio_layouts');
if (is_category()){
    $portfolio_pagination = arrowit_get_meta_value('post_pagination_portfolio', false);
}
?>
<?php if (empty($terms) == false) { ?>
    <div class="filter text-center tabs-fillter">
        <ul class="nav nav-tabs tabs wc-tabs btn-filter">
            <li class="button active filtrerall" data-filter="*">
                <a><?php echo esc_html__('All', 'arrowit') ?></a>
            </li>
            <?php foreach ($portfolio_num_cate as $values) { ?>
                <li class="button" data-filter=".<?php echo esc_attr($values->slug); ?>">
                    <a><?php echo esc_attr($values->name) ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
<div class="portfolio-container">
    <div class="tabs_sort portfolio-sort">
        <div class="load-item row portfolio-entries-wrap isotope clearfix <?php echo esc_attr($animation_class); ?>">
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $arrowit_portfolio_term_arr = get_the_terms(get_the_ID(), 'portfolio_cat');
                $link_portfolio = get_post_meta(get_the_ID(), 'link_portfolio', true);
                $comment_portfolio = get_post_meta(get_the_ID(), 'comment_portfolio', true);
                $arrowit_portfolio_term_filters = '';
                if (is_array($arrowit_portfolio_term_arr) || is_object($arrowit_portfolio_term_arr)) {
                    foreach ($arrowit_portfolio_term_arr as $post_term) {
                        $arrowit_portfolio_term_filters .= $post_term->slug . ' ';
                        if ($post_term->parent != 0) {
                            $parent_term = get_term($post_term->parent, 'portfolio_cat');
                            $arrowit_portfolio_term_filters .= $parent_term->slug . ' ';
                        }
                    }
                }
                $arrowit_portfolio_term_filters = trim($arrowit_portfolio_term_filters);
                    ?>
                    <div class="item <?php echo esc_attr($portfolio_column); ?> <?php echo esc_attr($arrowit_portfolio_term_filters); ?> item-page<?php echo esc_attr($current_page); ?>">
                        <div class="portfolio_body text-center <?php if (($portfolio_layout == 'grid-3' && $arrowit_portfolio_layout == '') || ($arrowit_portfolio_layout == 'grid-3')) {
                                echo 'portfolio-type-3';
                            } ?>">
                            <?php
                            if ($arrowit_portfolio_layout == '') {
                                if ($portfolio_layout == 'grid-1'):
                                    ?>
                                    <h2 class="portfolio_title">
                                        <?php echo arrowit_limit_title(30); ?>
                                    </h2>
                                <?php
                                endif;
                            } else {
                                if ($arrowit_portfolio_layout == 'grid-1'):
                                    ?>
                                    <h2 class="portfolio_title">
                                        <?php echo arrowit_limit_title(30); ?>
                                    </h2>
                                <?php
                                endif;
                            }
                            ?>
                            <?php
                            if ($arrowit_portfolio_layout == '') {
                                if ($portfolio_layout == 'grid-3'):
                                    ?>
                                    <h2 class="portfolio_title">
                                        <a target="_blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php echo arrowit_limit_title(30); ?>
                                        </a>
                                    </h2>
                                <?php
                                endif;
                            } else {
                                if ($arrowit_portfolio_layout == 'grid-3'):
                                    ?>
                                    <h2 class="portfolio_title">
                                        <a target="_blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php echo arrowit_limit_title(30); ?>
                                        </a>
                                    </h2>
                                <?php
                                endif;
                            }
                            ?>
                            <div class="<?php if (($portfolio_layout == 'grid-2' && $arrowit_portfolio_layout == '') || ($arrowit_portfolio_layout == 'grid-2')) {
                                echo 'portfolio-img-link';
                            } ?>">
                                <div class="portfolio-content image-hover-content">
                                    <div class="portfolio-img">
                                        <?php if (has_post_thumbnail()) { ?>
                                            <?php
                                            $image = arrowit_resize_image(555, 345);
                                            ?>
                                            <img src="<?php echo esc_url($image); ?>"
                                                 alt="<?php the_title_attribute(); ?>"/>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (($portfolio_layout == 'grid-2' && $arrowit_portfolio_layout == '') || $arrowit_portfolio_layout == 'grid-2'):
                                ?>
                                <h2 class="portfolio_title portfolio_title_link">
                                    <a href="<?php echo esc_url($link_portfolio); ?>"
                                       target="_blank"><?php echo arrowit_limit_title(30); ?></a>
                                </h2>
                            <?php
                            endif;
                            ?>
                            <div class="portfolio-description <?php if (($portfolio_layout == 'grid-2' && $arrowit_portfolio_layout == '') || ($arrowit_portfolio_layout == 'grid-2')) {
                                echo 'portfolio-description-link';
                            } ?>">
                                <p>
                                    <?php echo arrowit_limit_excerpt(141); ?>
                                </p>
                            </div>
                            <?php  ?>
                            <?php
                            if ((($portfolio_layout == 'grid-3' && $arrowit_portfolio_layout == '') || $arrowit_portfolio_layout == 'grid-3') && $comment_portfolio != '' ):
                                ?>
                            <div class="portfolio-comment">
                                <p>&ldquo;<?php echo esc_attr($comment_portfolio); ?>&rdquo;</p>
                            </div>
                            <?php endif;?>
                            <?php
                            if (($portfolio_layout !== 'grid-3' && $arrowit_portfolio_layout == '') || $arrowit_portfolio_layout !== 'grid-3' ):
                                ?>
                            <div class="portfolio-more-detail <?php if (($portfolio_layout == 'grid-2' && $arrowit_portfolio_layout == '') || ($arrowit_portfolio_layout == 'grid-2')) {
                                echo 'portfolio-more-detail-link';
                            } ?>">
                                <div class="delivery-return">
                                    <?php
                                    if (($portfolio_layout == 'grid-2' && $arrowit_portfolio_layout == '') || ($arrowit_portfolio_layout == 'grid-2')) :
                                    ?>
                                        <a href="<?php echo esc_url($link_portfolio); ?>"
                                           class="btn btn-type-1 btn-primary btn-sm"
                                           target="_blank"> <?php echo esc_html__('Buy now' , 'arrowit');?> <i class="fa fa-shopping-cart"
                                                                      aria-hidden="true"></i></a>
                                    <?php
                                    else:
                                        ?>
                                        <h5>
                                            <a class="view_detail_portfolio" data-fancybox
                                               href="#single-delivery<?php echo get_the_ID(); ?>"><?php echo esc_html__('More Detail', 'arrowit') ?></a>
                                        </h5>
                                    <?php
                                    endif;
                                    ?>
                                    <div id="single-delivery<?php echo get_the_ID(); ?>"
                                         class="single-delivery">
                                        <div class="portfolio-img">
                                            <?php
                                            $gallery = get_post_meta(get_the_ID(), 'gallery_metabox', true);
                                            if (is_array($gallery) && count($gallery) > 1) : ?>
                                                <div class="portfolio-gallery arrows-custom">
                                                    <?php
                                                    foreach ($gallery as $key => $value) :
                                                        $full_image_size = wp_get_attachment_image_src($value, 'full');
                                                        $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                                        $image_url = Arrowit_Helper::aq_resize(array(
                                                            'url' => $full_image_size[0],
                                                            'width' => 970,
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
                                                <?php if (has_post_thumbnail()) { ?>
                                                    <?php
                                                    $image = arrowit_resize_image(555, 345);
                                                    ?>
                                                    <img src="<?php echo esc_url($image); ?>"
                                                         alt="<?php the_title_attribute(); ?>"/>
                                                    <?php
                                                }
                                                ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="portfolio-content-text clearfix">
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
                                            </div>
                                            <div class="portfolio-right">
                                                <div class="portfolios-info">
                                                    <h1 class="portfolio-name"><?php echo esc_html__('Project Details', 'arrowit') ?></h1>
                                                </div>
                                                <div class="portfolio-desc">
                                                    <p><?php echo esc_html__('Completed: ', 'arrowit') ?>
                                                        <span><?php the_modified_time('F jS, Y'); ?></span>
                                                    </p>
                                                    <p><?php echo esc_html__('Author: ', 'arrowit') ?>
                                                        <span><?php the_author(); ?></span></p>
                                                    <?php
                                                    $portfolio_category = get_the_term_list(get_the_ID(), 'portfolio_cat', ' ', ', ');
                                                    if ($portfolio_category != '') {
                                                        ?>
                                                        <p><?php echo esc_html__('Category: ', 'arrowit') ?><?php echo get_the_term_list(get_the_ID(), 'portfolio_cat', ' ', ', '); ?></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endwhile; ?>
        </div>
        <?php if ($portfolio_pagination === 'load_more'): ?>
            <?php if (get_next_posts_link()) { ?>
                <div class="pagination-content type-loadmore load_more_button text-center"
                     rel="<?php echo esc_attr($wp_query->max_num_pages); ?>"
                     data-paged="<?php echo esc_attr($current_page) ?>"
                     data-totalpage="<?php echo esc_attr($wp_query->max_num_pages); ?>">
                    <?php echo get_next_posts_link(esc_html__('More', 'arrowit') . '<span class="icon-right-arrow"></span>'); ?>
                </div>
            <?php } ?>
        <?php endif; ?>
        <?php if ($portfolio_pagination === 'next_prev'): ?>
            <?php if( get_previous_posts_link() ||  get_next_posts_link()):?>
                <ul class="pagination-content type-5 text-center">
                    <?php if( get_previous_posts_link()): ?>
                        <li class="pagination_button_prev"><?php previous_posts_link( '<span class="theme-icon-back"></span> ' ); ?></li>
                    <?php endif; ?>
                    <?php if( get_next_posts_link()): ?>
                        <li class="pagination_button_next"><?php next_posts_link( '<span class="theme-icon-next"></span>'); ?></li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($portfolio_pagination === 'number'): ?>
            <div class="pagination-content type-number text-center">
                <?php Arrowit_Templates::paging_nav(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>