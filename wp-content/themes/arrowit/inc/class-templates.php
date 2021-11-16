<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom template tags for this theme.
 */
class Arrowit_Templates{
    public static function get_related_posts( $args ) {
        $defaults = array(
            'post_id'      => '',
            'number_posts' => 3,
        );
        $args     = wp_parse_args( $args, $defaults );
        if ( $args['number_posts'] <= 0 || $args['post_id'] === '' ) {
            return false;
        }

        $categories = get_the_category( $args['post_id'] );

        if ( ! $categories ) {
            return false;
        }

        foreach ( $categories as $category ) {
            if ( $category->parent === 0 ) {
                $term_ids[] = $category->term_id;
            } else {
                $term_ids[] = $category->parent;
                $term_ids[] = $category->term_id;
            }
        }

        // Remove duplicate values from the array.
        $unique_array = array_unique( $term_ids );

        $query_args = array(
            'post_type'      => 'post',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'posts_per_page' => $args['number_posts'],
            'post__not_in'   => array( $args['post_id'] ),
            'no_found_rows'  => true, // Skip pagination, makes the query faster.
            'tax_query'      => array(
                array(
                    'taxonomy'         => 'category',
                    'terms'            => $unique_array,
                    'include_children' => false,
                ),
            ),
        );

        $query = new WP_Query( $query_args );

        return $query;
    }
    Public static function get_logo_sticky(){
        $show_sticky = Arrowit::setting( 'header_sticky_enable' );
        $logo__sticky = get_post_meta(get_the_ID(), 'logo_header_sticky', true);
        if($logo__sticky){
            $logo = $logo__sticky;
        }else{
            $logo = Arrowit::setting( 'header_sticky_logo' );
        }
        if($show_sticky): ?>
            <h2 class="logo d-flex align-items-center">
                <a class="logo-sticky" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url($logo);?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')) ?>"></a>
            </h2>
        <?php endif;
    }
    public static function get_search_box(){
        ?>
        <div class="search-box">
            <div class="search-box__header-container">
                <div class="container">
                    <div class="search-box__header row">
                        <div class="search-box__title col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-10">
                            <p><?php echo esc_html__('What are you Looking for?', 'arrowit')?></p>
                        </div>
                        <div class="search-box__close col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-2 text-right">
                            <span class="close-search-box"><i class="fas fa-times"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--./search-box_header-container-->
            <div class="search-box__content">
                <div class="container">
                    <?php self::header_search(); ?>
                </div>
            </div>
        </div>
        <?php
    }
    public static function mobile_menu(){
        ?>
        <div class="menu-mobile">
            <div class="menu-mobile-content">
                <div class="top-mobile">
                    <?php
                    if (has_custom_logo()){
                        the_custom_logo();
                    }else{
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"  rel="home" class="site-title"><?php echo esc_attr(get_bloginfo('name', 'display')) ?></a>
                        <?php
                    }?>
                    <div class="close-menu-mobile d-flex align-items-center justify-content-end">
                        <div class="close-menu btn-menu">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                </div>
                <div class="mobile-content">
                    <nav class="main-navigation">
                        <?php
                        Arrowit::menu_primary();
                        self::get_search_box();
                        ?>
                    </nav>
                </div>
            </div>
        </div>
        <?php
    }
    public static function footer($footer_type = ''){
        $footer_type = Arrowit_Global::instance()->set_footer_type();
        get_template_part('footers/footer', $footer_type);
    }

    public static function footer_logo()
    {
        $logo_url = '';
        $logo_footer_url = Arrowit::setting('logo_footer');
        ?>
        <div class="footer-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php if ($logo_footer_url !== '') { ?>
                <img src="<?php echo esc_url($logo_footer_url); ?>"
                alt="<?php esc_attr(bloginfo('name')); ?>" class="footer-logo">
                <?php } ?>
            </a>
        </div>
        <?php
    }
	
	public static function get_product_single_style(){
        $single_layout = get_post_meta(get_the_id(), 'meta_single_style', true);
        if ( $single_layout &&  $single_layout !== 'default'){
            $single_type = $single_layout;
        }elseif(Arrowit::setting('single_style')){
            $single_type = Arrowit::setting('single_style');
        }else{
            $single_type = 'single_1';
        }
        return $single_type;
	}

    public static function paging_nav($query = false)
    {
        global $wp_query, $wp_rewrite;
        if ($query === false) {
            $query = $wp_query;
        }

// Don't print empty markup if there's only one page.
        if ($query->max_num_pages < 2) {
            return;
        }

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $page_num_link = html_entity_decode(get_pagenum_link());
        $query_args = array();
        $url_parts = explode('?', $page_num_link);

        if (isset($url_parts[1])) {
            wp_parse_str($url_parts[1], $query_args);
        }

        $page_num_link = esc_url(remove_query_arg(array_keys($query_args), $page_num_link));
        $page_num_link = trailingslashit($page_num_link) . '%_%';

        $format = '';
        if ($wp_rewrite->using_index_permalinks() && !strpos($page_num_link, 'index.php')) {
            $format = 'index.php/';
        }
        if ($wp_rewrite->using_permalinks()) {
            $format .= user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged');
        } else {
            $format .= '?paged=%#%';
        }

// Set up paginated links.

        $args = array(
            'base' => $page_num_link,
            'format' => $format,
            'total' => $query->max_num_pages,
            'current' => max(1, $paged),
            'mid_size' => 1,
            'add_args' => array_map('urlencode', $query_args),
            'prev_text' => esc_html__('', 'arrowit'),
            'next_text' => esc_html__('', 'arrowit'),
            'type' => 'array',
        );
        $pages = paginate_links($args);

        if (is_array($pages)) {
            echo '<ul class="page-pagination">';
            foreach ($pages as $page) {
                printf('<li>%s</li>', $page);
            }
            echo '</ul>';
        }
    }
    public static function paging_nav_shop($query = false){
        $links = paginate_links( array(
            'prev_next'          => false,
            'type'               => 'array'
        ) );

        if ( $links ) :
            echo '<nav class="woocommerce-pagination">';
            echo '<ul class="page-numbers">';

            // get_previous_posts_link will return a string or void if no link is set.
            if ( $prev_posts_link = get_previous_posts_link( __( 'Previous','arrowit' ) ) ) :
                echo '<li class="prev-list-item">';
                echo esc_attr( $prev_posts_link );
                echo '</li>';
            endif;
            // get_next_posts_link will return a string or void if no link is set.
            if ( $next_posts_link = get_next_posts_link( __( 'Next','arrowit' ) ) ) :
                echo '<li class="next-list-item">';
                echo esc_attr( $next_posts_link );
                echo '</li>';
            endif;
            echo '<li>';
            echo join( '</li><li>', $links );
            echo '</li>';
            echo '</ul>';
            echo '</nav>';
        endif;
    }
    public static function page_links()
    {
        wp_link_pages(array(
            'before' => '<div class="page-links">',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'nextpagelink' => esc_html__('Next', 'arrowit'),
            'previouspagelink' => esc_html__('Prev', 'arrowit'),
        ));
    }

    public static function post_nav_links()
    {
        $args = array(
            'prev_text' => '%title',
            'next_text' => '%title',
            'in_same_term' => false,
            'excluded_terms' => '',
            'taxonomy' => 'category',
            'screen_reader_text' => esc_html__('Post navigation', 'arrowit'),
        );

        $previous = get_previous_post_link('<div class="nav-previous">%link</div>', $args['prev_text'], $args['in_same_term'], $args['excluded_terms'], $args['taxonomy']);

        $next = get_next_post_link('<div class="nav-next">%link</div>', $args['next_text'], $args['in_same_term'], $args['excluded_terms'], $args['taxonomy']);

// Only add markup if there's somewhere to navigate to.
        if ($previous || $next) { ?>

        <nav class="navigation post-navigation" role="navigation">

            <?php $return_link = Arrowit::setting('single_post_pagination_return_link'); ?>
            <?php if ($return_link !== '') : ?>
                <a href="<?php echo esc_url($return_link); ?>" class="return-blog-page"><span
                    class="ion-grid"></span></a>
                <?php endif; ?>

                <?php echo '<h2 class="screen-reader-text">' . $args['screen_reader_text'] . '</h2>'; ?>

                <div class="nav-links">
                    <?php echo '<div class="previous nav-item">' . $previous . '</div>'; ?>
                    <?php echo '<div class="next nav-item">' . $next . '</div>'; ?>
                </div>
            </nav>
            <?php
        }
    }

    public static function comment_navigation($args = array())
    {
// Are there comments to navigate through?
        if (get_comment_pages_count() > 1 && get_option('page_comments')) {
            $defaults = array(
                'container_id' => '',
                'container_class' => 'navigation comment-navigation',
            );
            $args = wp_parse_args($args, $defaults);
            ?>
            <nav id="<?php echo esc_attr($args['container_id']); ?>"
               class="<?php echo esc_attr($args['container_class']); ?>">
               <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'arrowit'); ?></h2>

               <div class="comment-nav-links">
                <?php paginate_comments_links(array(
                    'prev_text' => esc_html__('Prev', 'arrowit'),
                    'next_text' => esc_html__('Next', 'arrowit'),
                    )); ?>
                </div>
            </nav>
            <?php
        }
        ?>
        <?php
    }

    public static function comment_template($comment, $args, $depth)
    {

        $GLOBALS['comment'] = $comment;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div class="comment-item" id="comment-<?php comment_ID(); ?>">
                <div class="comment-content">
                    <div class="comment-text">
                         <?php comment_text() ; ?>
                    </div>
                    <div class="box-info-comment">
                        <div class="post-author-box">
                                <div class="img-author">
                                    <?php echo get_avatar( $comment);?>
                                </div>
                                <div class="info-comment">
                                    <?php printf('<span class="name-author">%s</span>', get_comment_author_link()); ?> - 
                                    <?php echo get_comment_date(); ?>
                                </div>
                        </div>                    
                        <div class="comment-actions">
                            <div class="comment-reply">
                            <?php comment_reply_link(array_merge($args, array(
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                                'reply_text' => esc_html__('Reply','arrowit'),
                                ))); ?>
                                <?php edit_comment_link(esc_html__('Edit','arrowit')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php if ($comment->comment_approved == '0') : ?>
                    <em class="comment-awaiting-messages"><?php esc_html_e('Your comment is awaiting moderation.', 'arrowit') ?></em>
                    <br/>
                <?php endif; ?>
            </div>
        <?php
    }

    public static function comment_form(){
        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_login='';
        if ( is_user_logged_in() ) {$comment_login="comment-field-login";}

        $comment_args = array( 
            'class_form' => 'commentform ',
            'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' => '<div class="comment-field fields row">
                <div class="col-md-6 col-sm-12 col-xs-12 inner-info comment-form-author ">'.'<input placeholder="' .esc_attr__('Name* ', 'arrowit' ) . '" id="author" class="required" name="author" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
                '</div>',
                'email'  => '<div class="col-md-6 col-sm-12 col-xs-12 inner-info comment-form-email ">' . '<input placeholder="' .esc_attr__('Email*', 'arrowit' ) . '" id="email" class="required email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
                '</div>',
                '</div>',
                'url'    => '' ) ),
            'comment_field' => '<div class=" comment-textarea"><div class="comment-right-field ' . $comment_login.' ">' .
            '<textarea id="comment" class="required" name="comment" cols="45" rows="4" aria-required="true" placeholder="' .esc_attr__('Your comment', 'arrowit' ) . '"></textarea>' .
            '</div></div>',
            'title_reply'  => esc_html__( 'Write a comment','arrowit' ),
            'cancel_reply_link' => esc_html__('Cancel reply','arrowit'),

            'logged_in_as' => '',
            'comment_notes_before' => '',
            'class_submit'         => 'btn btn-primary btn-radius',
            'label_submit'      => esc_html__('Send','arrowit'),
            'comment_notes_after' => '',
        );

        comment_form($comment_args);
    }

    public static function post_author()
    {
        ?>
        <div class="entry-author">
            <div class="author-info">
                <div class="author-avatar">
                    <?php echo get_avatar(get_the_author_meta('email'), '90'); ?>
                </div>
                <div class="author-description">
                    <h5 class="author-name"><?php the_author(); ?></h5>
                    <div class="author-biographical-info">
                        <?php the_author_meta('description'); ?>
                    </div>
                </div>
            </div>
            <?php
            $email_address = get_the_author_meta('email_address');
            $facebook = get_the_author_meta('facebook');
            $twitter = get_the_author_meta('twitter');
            $google_plus = get_the_author_meta('google_plus');
            $instagram = get_the_author_meta('instagram');
            $linkedin = get_the_author_meta('linkedin');
            $pinterest = get_the_author_meta('pinterest');
            ?>
            <?php if ($facebook || $twitter || $google_plus || $instagram || $linkedin || $email_address) : ?>
                <div class="author-social-networks">
                    <?php if ($email_address) : ?>
                        <a class="hint--bounce hint--top"
                            aria-label="<?php echo esc_html__('Email', 'arrowit') ?>"
                            href="mailto:<?php echo esc_url($email_address); ?>" target="_blank">
                            <i class="ion-email"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($facebook) : ?>
                        <a class="hint--bounce hint--top"
                        aria-label="<?php echo esc_html__('Facebook', 'arrowit') ?>"
                        href="<?php echo esc_url($facebook); ?>" target="_blank">
                            <i class="ion-social-facebook"></i>
                        </a>
                     <?php endif; ?>
                    <?php if ($twitter) : ?>
                        <a class="hint--bounce hint--top"
                            aria-label="<?php echo esc_html__('Twitter', 'arrowit') ?>"
                            href="<?php echo esc_url($twitter); ?>" target="_blank">
                            <i class="ion-social-twitter"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($google_plus) : ?>
                        <a class="hint--bounce hint--top"
                        aria-label="<?php echo esc_html__('Google +', 'arrowit') ?>"
                        href="<?php echo esc_url($google_plus); ?>" target="_blank">
                            <i class="ion-social-googleplus"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($instagram) : ?>
                        <a class="hint--bounce hint--top"
                        aria-label="<?php echo esc_html__('Instagram', 'arrowit') ?>"
                        href="<?php echo esc_url($google_plus); ?>" target="_blank">
                            <i class="ion-social-instagram-outline"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($linkedin) : ?>
                        <a class="hint--bounce hint--top"
                        aria-label="<?php echo esc_html__('Linkedin', 'arrowit') ?>"
                        href="<?php echo esc_url($linkedin); ?>" target="_blank">
                            <i class="ion-social-linkedin"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($pinterest) : ?>
                        <a class="hint--bounce hint--top"
                        aria-label="<?php echo esc_html__('Pinterest', 'arrowit') ?>"
                        href="<?php echo esc_url($pinterest); ?>" target="_blank">
                        <i class="ion-social-pinterest"></i>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }

    public static function post_sharing($args = array())
    {
        $social_sharing = Arrowit::setting('single_post_item_enable');
        if (!empty($social_sharing)) {
            ?>
            <div class="post-share">
                <div class="post-share-toggle">
                    <h3><?php echo esc_html__('Share this story: ', 'arrowit') ?></h3>
                    <div class="post-share-list">
                        <?php self::get_sharing_list($args); ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    public static function product_sharing($args = array())
    {
        ?>
		<div class="product-share meta-item">
			<div class="product-sharing-list"><?php self::get_sharing_list($args); ?></div>
		</div>
		<?php
    }

    public static function get_sharing_list($args = array()){
        $defaults = array(
            'target' => '_blank',
        );
        $args = wp_parse_args($args, $defaults);
        $social_sharing = Arrowit::setting('single_post_item_enable');
        if (!empty($social_sharing)) {
            foreach ($social_sharing as $social) {
                if ($social === 'facebook') {
                        if (!wp_is_mobile()) {
                            $facebook_url = 'http://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '&t=' . urlencode(get_the_title());
                        } else {
                            $facebook_url = 'https://m.facebook.com/sharer.php?u=' . rawurlencode(get_permalink());
                        }
                        ?>
                        <a class="facebook" target="<?php echo esc_attr($args['target']); ?>"
							 aria-label="<?php echo esc_html__('Facebook', 'arrowit') ?>"
							 href="<?php echo esc_url($facebook_url); ?>">
							 <i class="fa fa-facebook"></i>
						</a>
                     <?php
                }elseif ($social === 'twitter') {
                    ?>
                    <a class="twitter" target="<?php echo esc_attr($args['target']); ?>"
                         aria-label="<?php echo esc_html__('Twitter', 'arrowit') ?>"
                         href="https://twitter.com/share?text=<?php echo rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&url=<?php echo rawurlencode(get_permalink()); ?>">
                         <i class="fa fa-twitter"></i>
                    </a>
                    <?php
                }elseif ($social === 'pinterest') {
                    $pinterest_url = 'https://www.pinterest.com/pin/create/button/?url=' . rawurlencode(get_permalink()) . '&media=' . wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) . '&description=' . rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
                    ?>
                    <a class="pinterest"
                        target="<?php echo esc_attr($args['target']); ?>"
                        aria-label="<?php echo esc_html__('Pinterest', 'arrowit') ?>"
                        href="<?php echo esc_url($pinterest_url); ?>">
                        <i class="fa fa-pinterest-p"></i>
                    </a>
                <?php
                }elseif ($social === 'gmail') {
                    ?>
                    <a class="gmail"
                        target="<?php echo esc_attr($args['target']); ?>"
                        aria-label="<?php echo esc_html__('Gmail', 'arrowit') ?>"
                        href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to&su=<?php echo rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&body=<?php echo rawurlencode(get_permalink()); ?>">
                        <i class="fa fa-envelope-o"></i>
                    </a>
                <?php
                }elseif ($social === 'whatsapp') {
                    ?>
                    <a class="whatsapp"
                        target="<?php echo esc_attr($args['target']); ?>"
                        aria-label="<?php echo esc_html__('Whatsapp', 'arrowit') ?>"
                        href="whatsapp://send?text=<?php echo rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>"  data-action="share/whatsapp/share">
                        <i class="fa fa-whatsapp"></i>
                    </a>
                    
                <?php
                }  
            }
        }
    }


    public static function header_search($arg = array()){       
        $arrowit_search_template = arrowit_get_search_form();
        echo '<div class="search-block-top header-search">' .wp_kses($arrowit_search_template, arrowit_allow_html()) . '</div>';
    }


    public static function get_minicart_template($arg = array()){
        if(class_exists( 'WooCommerce' )){
            $cart_item_count = WC()->cart->cart_contents_count;
            $cart_item_qty = WC()->cart->get_cart_total();
            ?>
            <div class="cart-header d-inline-block">
                <div class="cart_label">
                    <div class="text-header">
                        <div class="icon-header">
                            <span class="fas fa-shopping-cart"></span>
                        </div>

                        <div class="minicart-content">
                            <?php if($cart_item_count > 0): ?>
                                <?php printf( _n( '<span class="text-items">1</span>', '<span class="text-items">%1$s</span>', $cart_item_count, 'arrowit' ),
                                number_format_i18n( $cart_item_count ) ); ?>
                            <?php else: ?>
                                <span class="text-items"><?php echo esc_html__('0','arrowit'); ?></span>
                            <?php endif; ?>
                            <p class="cart_qty"><?php echo wp_kses($cart_item_qty,arrowit_allow_html());?></p>
                        </div>
                    </div>

                </div>
                <div class="cart-block sub-cart">
                    <div class="widget_shopping_cart_content">
                        <?php echo esc_html__('No products in the cart.', 'arrowit'); ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    public static function get_setting_template($arg = array()){
        $arrowit_myaccount_page_id = get_option('woocommerce_myaccount_page_id');
        $logout_url = wp_logout_url(get_permalink($arrowit_myaccount_page_id));
        if (get_option('woocommerce_force_ssl_checkout') == 'yes') {
            $logout_url = str_replace('http:', 'https:', $logout_url);
        }
        ?>
		<?php  if(class_exists( 'WooCommerce' )): ?>
			<div class="account-header">
				<?php if (!is_user_logged_in() & !is_account_page()) {echo '<a href="#account-popup" data-fancybox>';}
				else{
					?>
                    <a href="<?php echo esc_url(get_permalink($arrowit_myaccount_page_id));?>">
                    <?php
				}?><i class="fa fa-user"></i></a>
				<?php if (is_user_logged_in()): ?>
					<ul class="content-filter">
						<li class="customlinks"><a href="<?php echo esc_url(get_permalink($arrowit_myaccount_page_id)); ?>"><?php echo esc_html__('My Account', 'arrowit') ?></a></li>
						<li class="customlinks"><a href="<?php echo esc_url($logout_url) ?>"><?php echo esc_html__('Logout', 'arrowit') ?></a></li>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>
        <?php
    }



    public static function string_limit_words($string, $word_limit)
    {
        $words = explode(' ', $string, $word_limit + 1);
        if (count($words) > $word_limit) {
            array_pop($words);
        }

        return implode(' ', $words);
    }

    public static function string_limit_characters($string, $limit)
    {
        $string = substr($string, 0, $limit);
        $string = substr($string, 0, strripos($string, " "));

        return $string;
    }

    public static function excerpt($args = array())
    {
        $defaults = array(
            'limit' => 55,
            'after' => '&hellip;',
            'type' => 'word',
        );
        $args = wp_parse_args($args, $defaults);

        $excerpt = '';

        if ($args['type'] === 'word') {
            $excerpt = self::string_limit_words(get_the_excerpt(), $args['limit']);
        } elseif ($args['type'] === 'character') {
            $excerpt = self::string_limit_characters(get_the_excerpt(), $args['limit']);
        }
        if ($excerpt !== '' && $excerpt !== '&nbsp;') {
            printf('<p>%s %s</p>', $excerpt, $args['after']);
        }
    }

    public static function grid_filters($post_type = 'post', $filter_enable, $filter_align, $filter_counter, $filter_wrap = '0')
    {
        if ($filter_enable == 1) :

            $_catPrefix = '';
            $_categories = array();

            switch ($post_type) {
                case 'portfolio' :
                $_categories = get_terms(array(
                    'taxonomy' => 'portfolio_cat',
                    'hide_empty' => true,
                ));
                $_catPrefix = '.portfolio_cat-';
                break;
                case 'product' :
                $_categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                ));

                $_catPrefix = '.product_cat-';
                break;
                default :
                $_categories = get_terms(array(
                    'taxonomy' => 'category',
                    'hide_empty' => true,
                ));

                $_catPrefix = '.category-';
                break;
            }

            $filter_classes = array('tm-filter-button-group', $filter_align);
            if ($filter_counter == 1) {
                $filter_classes[] = 'show-filter-counter';
            }
            ?>

            <div class="<?php echo implode(' ', $filter_classes); ?>"
                <?php
                if ($filter_counter == 1) {
                    echo 'data-filter-counter="true"';
                }
                ?>
                >
                <div class="tm-filter-button-group-inner">
                    <?php if ($filter_wrap == '1') { ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php } ?>
                                <a href="javascript:void(0);" class="btn-filter current"
                                data-filter="*">
                                <span class="filter-text"><?php esc_html_e('All', 'arrowit'); ?></span>
                            </a>
                            <?php
                            foreach ($_categories as $term) {
                                printf('<a href="javascript:void(0);" class="btn-filter" data-filter="%s"><span class="filter-text">%s</span></a>', esc_attr($_catPrefix . $term->slug), $term->name);
                            }
                            ?>
                            <?php if ($filter_wrap == '1') { ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php
    endif;
    }

    public static function grid_pagination($arrowit_query, $number, $pagination, $pagination_align, $pagination_button_text)
    {
        if ($pagination !== '' && $arrowit_query->found_posts > $number) { ?>
        <div class="tm-grid-pagination" style="text-align:<?php echo esc_attr($pagination_align); ?>">
            <?php if ($pagination === 'loadmore_alt' || $pagination === 'loadmore' || $pagination === 'infinite') { ?>
            <div class="tm-loader"></div>

            <?php if ($pagination === 'loadmore') { ?>
            <a href="#" class="tm-button style-outline tm-button-grey tm-grid-loadmore-btn">
                <span><?php echo esc_html($pagination_button_text); ?></span>
            </a>
            <?php } ?>
            <?php } elseif ($pagination === 'pagination') { ?>
            <?php Arrowit_Templates::paging_nav($arrowit_query); ?>
            <?php } ?>
        </div>
        <div class="tm-grid-messages" style="display: none;">
            <?php esc_html_e('All items displayed.', 'arrowit'); ?>
        </div>
        <?php
        }
    }

    /**
     * Echo rating html template.
     *
     * @param int $rating
     */
    public static function get_rating_template($rating = 5)
    {
        $full_stars = intval($rating);
        $template = '';

        $template .= str_repeat('<i class="fa fa-star"></i>', $full_stars);

        $half_star = floatval($rating) - $full_stars;

        if ($half_star != 0) {
            $template .= '<i class="fa fa-star-half-alt"></i>';
        }

        $empty_stars = intval(5 - $rating);
        $template .= str_repeat('<i class="fa fa-star"></i>', $empty_stars);

        echo esc_attr( $template );
    }


    public static function page_title() {

       global  $post, $wp_query, $author;

        $home = esc_html__('Home', 'arrowit');

        $shop_page_id = false;
        $front_page_shop = false;
        if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
            $shop_page_id = wc_get_page_id( 'shop' );
            $front_page_shop = get_option( 'page_on_front' ) == wc_get_page_id( 'shop' );
        }

        if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && $front_page_shop ) ) || is_paged() ) {

            if ( is_home() ) {

            } else if ( is_category() ) {

                echo single_cat_title( '', false );

            } elseif ( is_search() ) {

                echo esc_html__( 'Search results for &ldquo;', 'arrowit' ) . get_search_query() . '&rdquo;';

            } elseif ( is_tax('product_cat') || is_tax('portfolio_cat')) {

                $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                echo esc_html( $current_term->name );

            } elseif ( is_tax('portfolio_cat') ) {

                $queried_object = $wp_query->get_queried_object();
                echo esc_html($queried_object->name) ;

            } elseif ( is_tax('product_tag') ) {

                $queried_object = $wp_query->get_queried_object();
                echo esc_html__( 'Products tagged &ldquo;', 'arrowit' ) . $queried_object->name . '&rdquo;';

            } elseif ( is_day() ) {

                printf( esc_html__( 'Daily Archives: %s', 'arrowit' ), get_the_date() );

            } elseif ( is_month() ) {

                printf( esc_html__( 'Monthly Archives: %s', 'arrowit' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'arrowit' ) ) );

            } elseif ( is_year() ) {

                printf( esc_html__( 'Yearly Archives: %s', 'arrowit' ), get_the_date( _x( 'Y', 'yearly archives date format', 'arrowit' ) ) );

            } elseif ( is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id ) {

                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }

                if ( is_search() ) {
                    echo esc_html__( 'Search results for &ldquo;', 'arrowit' ) . get_search_query() . '&rdquo;';
                } elseif ( is_paged() ) {

                } else {

                    echo esc_html($_name);

                }

            }elseif(is_post_type_archive('portfolio')){

                echo esc_html(Arrowit::setting( 'portfolio_title' ));

            } elseif (is_post_type_archive('service')){

                 echo esc_html(Arrowit::setting( 'service_title' ));

            } elseif (is_post_type_archive('member')){

                echo esc_html(Arrowit::setting( 'member_title' ));
                
            }else if ( is_post_type_archive() ) {
                sprintf( esc_html__( 'Archives: %s', 'arrowit' ), post_type_archive_title( '', false ) );
            } elseif ( is_single() && ! is_attachment() ) {

                 if ('post'== get_post_type()) {

                    echo get_the_title();

                } elseif ('portfolio'== get_post_type()) {

                    echo esc_html(Arrowit::setting( 'portfolio_title' ));

                }elseif ( 'wpsl_stores' == get_post_type() ){
                    echo esc_html__( 'STORE LOCATOR', 'arrowit' );
                }else {

                    echo get_the_title();
                }
            } elseif ( is_404() ) {

                echo esc_html__( 'Error 404', 'arrowit' );

            }elseif ( is_attachment() ) {

                echo get_the_title();

            } elseif ( is_page() && !$post->post_parent ) {

                echo get_the_title();

            } elseif ( is_page() && $post->post_parent ) {

                echo get_the_title();

            } elseif ( is_search() ) {

                echo esc_html__( 'Search results for &ldquo;', 'arrowit' ) . get_search_query() . '&rdquo;';

            } elseif ( is_tag() ) {

                echo esc_html__( 'Posts tagged &ldquo;', 'arrowit' ) . single_tag_title('', false) . '&rdquo;';

            } elseif ( is_author() ) {

                $userdata = get_userdata($author);
                echo esc_html__( 'Author:', 'arrowit' ) . ' ' . $userdata->display_name;

            }

            if ( get_query_var( 'paged' ) ) {
                echo ' (' . esc_html__( 'Page', 'arrowit' ) . ' ' . get_query_var( 'paged' ) . ')';
            }
        } else {
            if ( is_home() && !is_front_page() ) {
                if ( ! empty( $home ) ) {
                    echo force_balance_tags(Arrowit::setting( 'blog_title' ));
                }
            }
        }
    }

    public static function breadcrumbs() {
         global $post, $wp_query, $author;
        $prepend = '';
        $before = '<li>';
        $after = '</li>';
        $home = '<span>' .esc_html__('Home', 'arrowit'). '</span>';
        $shop_page_id = false;
        $shop_page = false;
        $front_page_shop = false;
        if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
            $permalinks   = get_option( 'woocommerce_permalinks' );
            $shop_page_id = wc_get_page_id( 'shop' );
            $shop_page    = get_post( $shop_page_id );
            $front_page_shop = get_option( 'page_on_front' ) == wc_get_page_id( 'shop' );
        }

        // If permalinks contain the shop page in the URI prepend the breadcrumb with shop
        if ( $shop_page_id && $shop_page && strstr( $permalinks['product_base'], '/' . $shop_page->post_name ) && get_option( 'page_on_front' ) != $shop_page_id ) {
            $prepend = $before . '<a href="' . get_permalink( $shop_page ) . '">' . $shop_page->post_title . '</a> ' . $after;
        }

        if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && $front_page_shop ) ) || is_paged() ) {
            echo '<ul class="breadcrumb">';

            if ( ! empty( $home ) ) {
                    echo wp_kses($before,array('li'=>array())) . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url('/') ) . '"><i class="'.esc_attr(Arrowit::setting('icon_link')).'"></i> ' . $home . '</a>' . $after;
                }

            if ( is_home() ) {

                echo wp_kses($before,array('li'=>array())) . single_post_title('', false) . $after;

            } else if ( is_category()) {

                if ( get_option( 'show_on_front' ) == 'page' ) {
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_permalink( get_option('page_for_posts' ) ) . '">' . get_the_title( get_option('page_for_posts', true) ) . '</a>' . $after;
                }

                $cat_obj = $wp_query->get_queried_object();
                $this_category = get_category( $cat_obj->term_id );

                echo wp_kses($before,array('li'=>array())) . single_cat_title( '', false ) . $after;

            } elseif ( is_search() ) {

                echo wp_kses($before,array('li'=>array())) . esc_html__( 'Search results for &ldquo;', 'arrowit' ) . get_search_query() . '&rdquo;' . $after;

            } elseif ( is_tax('product_cat') || is_tax('product_cat')) {
                echo wp_kses($prepend, arrowit_allow_html());
                if ( is_tax('product_cat') ) {
                    $post_type = get_post_type_object( 'product' );
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( 'product' ) . '">' . $post_type->labels->singular_name . '</a>' . $after;
                }
                $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

                foreach ( $ancestors as $ancestor ) {
                    $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after;
                }

                echo wp_kses($before,array('li'=>array())) . esc_html( $current_term->name ) . $after;

            }elseif ( is_tax('product_tag') ) {

                $queried_object = $wp_query->get_queried_object();
                echo wp_kses($prepend, arrowit_allow_html()). wp_kses($before,array('li'=>array())) . ' ' . esc_html__( 'Products tagged &ldquo;', 'arrowit' ) . $queried_object->name . '&rdquo;' . $after;

            }elseif ( is_tax('portfolio_cat') ){
                if(is_tax('portfolio_cat')){

                    echo wp_kses($prepend, arrowit_allow_html());

                    $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                    $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

                        echo wp_kses($before,array('li'=>array())) . '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after;
                    }

                    echo wp_kses($before,array('li'=>array())) . esc_html( $current_term->name ) . $after;
                }else{
                    $queried_object = $wp_query->get_queried_object();
                        echo wp_kses($prepend, arrowit_allow_html()) . wp_kses($before,array('li'=>array())) . ' ' . esc_html__( 'Portfolio', 'arrowit' ) . $queried_object->name . '&rdquo;' . $after;
                }
            }elseif ( is_tax('service_category') ){
                if(is_tax('service_category')){
                    if(isset($apr_settings['service_slug'])){
                        $service_slug = $apr_settings['service_slug'];
                    }
                    else {$service_slug = "service_category"; }                 
                    echo wp_kses($prepend, arrowit_allow_html());

                    $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                    $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

                        echo wp_kses($before,array('li'=>array())) . '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after;
                    }

                    echo wp_kses($before,array('li'=>array())) . esc_html( $current_term->name ) . $after;
                }
            }elseif ( is_tax('member_category') ){
                if(is_tax('member_category')){
                    if(isset($apr_settings['member_slug'])){
                        $member_slug = $apr_settings['member_slug'];
                    }
                    else {$member_slug = "member_category"; }                 
                    echo wp_kses($prepend, arrowit_allow_html());

                    $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                    $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

                        echo wp_kses($before,array('li'=>array())) . '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after;
                    }

                    echo wp_kses($before,array('li'=>array())) . esc_html( $current_term->name ) . $after;
                }
            } elseif ( is_day() ) {

                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . $after;
                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after;
                echo wp_kses($before,array('li'=>array())) . get_the_time('d') . $after;

            } elseif ( is_month() ) {

                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after;
                echo wp_kses($before,array('li'=>array())) . get_the_time('F') . $after;

            } elseif ( is_year() ) {

                echo wp_kses($before,array('li'=>array())) . get_the_time('Y') . $after;

            } elseif ( is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id ) {

                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }

                if ( is_search() ) {

                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . esc_html__( 'Search results for &ldquo;', 'arrowit' ) . get_search_query() . '&rdquo;' . $after;

                } elseif ( is_paged() ) {

                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $after;

                } else {

                    echo wp_kses($before,array('li'=>array())) . $_name . $after;

                }

            } elseif (is_post_type_archive('service')){

                if (Arrowit::setting('service_title') && Arrowit::setting('service_title') !=""){
                    $post_type = get_post_type_object( get_post_type() );
                    $slug = $post_type->rewrite;
                    echo wp_kses($before,array('li'=>array())) .esc_html(Arrowit::setting('service_title')). $after;                
                } elseif (Arrowit::setting('service_slug') && Arrowit::setting('service_slug') !=""){
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html(Arrowit::setting('service_slug')). '</a>' . $after;                                
                } else {
                    $post_type = get_post_type_object( 'service' );
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('service') . '">' .  esc_html($post_type->labels->name) . '</a>' . $after;
                }   

            } elseif (is_post_type_archive('portfolio')){

                if (Arrowit::setting('portfolio_title') && Arrowit::setting('portfolio_title') !=""){
                    $post_type = get_post_type_object( get_post_type() );
                    $slug = $post_type->rewrite;
                    echo wp_kses($before,array('li'=>array())) .esc_html(Arrowit::setting('portfolio_title')). $after;                
                } elseif (Arrowit::setting('portfolio_slug') && Arrowit::setting('portfolio_slug') !=""){
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html(Arrowit::setting('portfolio_slug')). '</a>' . $after;                                
                } else {
                    $post_type = get_post_type_object( 'portfolio' );
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('portfolio') . '">' .  esc_html($post_type->labels->name) . '</a>' . $after;
                }   

            }  else if(is_post_type_archive('member')){

                if(Arrowit::setting('member_title') && Arrowit::setting('member_title') !=""){
                    $post_type = get_post_type_object( get_post_type() );
                    $slug = $post_type->rewrite;
                    echo wp_kses($before,array('li'=>array())) .esc_html(Arrowit::setting('member_title')). $after;                
                }elseif (Arrowit::setting('member_slug') && Arrowit::setting('member_slug') !=""){
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html(Arrowit::setting('member_slug')). '</a>' . $after;                                
                }else{
                    $post_type = get_post_type_object( 'member' );
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('member') . '">' .  esc_html($post_type->labels->name) . '</a>' . $after;
                }                

            } elseif ( is_single() && ! is_attachment() ) {

                if ( 'product' == get_post_type() ) {

                    echo wp_kses($prepend, arrowit_allow_html());

                    if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                        $main_term = $terms[0];
                        $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                        $ancestors = array_reverse( $ancestors );

                        foreach ( $ancestors as $ancestor ) {
                            $ancestor = get_term( $ancestor, 'product_cat' );

                            if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a>' . $after;
                            }
                        }

                        echo wp_kses($before,array('li'=>array())) . '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a>' . $after;

                    }

                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;

                }elseif (is_post_type_archive('service')){

                    if (Arrowit::setting('service_title') && Arrowit::setting('service_title') !=""){
                        $post_type = get_post_type_object( get_post_type() );
                        $slug = $post_type->rewrite;
                        echo wp_kses($before,array('li'=>array())) .esc_html(Arrowit::setting('service_title')). $after;                
                    } elseif (Arrowit::setting('service_slug') && Arrowit::setting('service_slug') !=""){
                        echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html(Arrowit::setting('service_slug')). '</a>' . $after;                                
                    } else {
                        $post_type = get_post_type_object( 'service' );
                        echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('service') . '">' .  esc_html($post_type->labels->name) . '</a>' . $after;
                    }   

                } elseif (is_post_type_archive('portfolio')){

                    if (Arrowit::setting('portfolio_title') && Arrowit::setting('portfolio_title') !=""){
                        $post_type = get_post_type_object( get_post_type() );
                        $slug = $post_type->rewrite;
                        echo wp_kses($before,array('li'=>array())) .esc_html(Arrowit::setting('portfolio_title')). $after;                
                    } elseif (Arrowit::setting('portfolio_slug') && Arrowit::setting('portfolio_slug') !=""){
                        echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html(Arrowit::setting('portfolio_slug')). '</a>' . $after;                                
                    } else {
                        $post_type = get_post_type_object( 'portfolio' );
                        echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('portfolio') . '">' .  esc_html($post_type->labels->name) . '</a>' . $after;
                    }   

                }  else if(is_post_type_archive('member')){

                    if(Arrowit::setting('member_title') && Arrowit::setting('member_title') !=""){
                        $post_type = get_post_type_object( get_post_type() );
                        $slug = $post_type->rewrite;
                        echo wp_kses($before,array('li'=>array())) .esc_html(Arrowit::setting('member_title')). $after;                
                    }elseif (Arrowit::setting('member_slug') && Arrowit::setting('member_slug') !=""){
                        echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html(Arrowit::setting('member_slug')). '</a>' . $after;                                
                    }else{
                        $post_type = get_post_type_object( 'member' );
                        echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('member') . '">' .  esc_html($post_type->labels->name) . '</a>' . $after;
                    }                

                } elseif ( 'wpsl_stores' == get_post_type() ) {
                    $post_type = get_post_type_object( get_post_type() );
                    echo wp_kses($before,array('li'=>array())) . '<a href="' .  get_permalink( $post->post_parent ) . '">' . esc_html__('Store Locator','arrowit'). '</a>' . $after;
                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;

                } elseif ( 'post' != get_post_type() ) {
                    $post_type = get_post_type_object( get_post_type() );
                    $slug = $post_type->rewrite;
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . $post_type->labels->singular_name . '</a>' . $after;
                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;

                }else {

                    if ( 'post' == get_post_type() && get_option( 'show_on_front' ) == 'page' ) {
                        echo wp_kses($before,array('li'=>array())) . '<a href="' . get_permalink( get_option('page_for_posts' ) ) . '">' . get_the_title( get_option('page_for_posts', true) ) . '</a>' . $after;
                    }

                    $cat = current( get_the_category() );
                    if ( ( $parents = get_category_parents( $cat, TRUE, $after . $before ) ) && ! is_wp_error( $parents ) ) {
                        echo wp_kses($before,array('li'=>array())) . substr( $parents, 0, strlen($parents) - strlen($after . $before) ) . $after;
                    }
                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;

                }

            } elseif ( is_404() ) {

                echo wp_kses($before,array('li'=>array())) . esc_html__( 'Error 404', 'arrowit' ) . $after;

            } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

                $post_type = get_post_type_object( get_post_type() );

                if ( $post_type ) {
                    echo wp_kses($before,array('li'=>array())) . $post_type->labels->singular_name . $after;
                }

            } elseif ( is_attachment() ) {

                $parent = get_post( $post->post_parent );
                $cat = get_the_category( $parent->ID );
                if(isset($cat[0])){
                    $cat = $cat[0];
                }
                if ( ( $parents = get_category_parents( $cat, TRUE, $after . $before ) ) && ! is_wp_error( $parents ) ) {
                    echo wp_kses($before,array('li'=>array())) . substr( $parents, 0, strlen($parents) - strlen($after . $before) ) . $after;
                }
                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>'. $after;
                echo wp_kses($before,array('li'=>array())). get_the_title() . $after;

            } elseif ( is_page() && !$post->post_parent ) {

                echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;

            } elseif ( is_page() && $post->post_parent ) {

                $parent_id  = $post->post_parent;
                $breadcrumbs = array();

                while ( $parent_id ) {
                    $page = get_post( $parent_id );
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title( $page->ID ) . '</a>';
                    $parent_id  = $page->post_parent;
                }

                $breadcrumbs = array_reverse( $breadcrumbs );

                foreach ( $breadcrumbs as $crumb ) {
                    echo ''.$before . $crumb . $after;
                }

                echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;

            } elseif ( is_search() ) {

                echo wp_kses($before,array('li'=>array())) . esc_html__( 'Search results for &ldquo;', 'arrowit' ) . get_search_query() . '&rdquo;' . $after;

            } elseif ( is_tag() ) {

                echo wp_kses($before,array('li'=>array())) . esc_html__( 'Posts tagged &ldquo;', 'arrowit' ) . single_tag_title('', false) . '&rdquo;' . $after;

            } elseif ( is_author() ) {

                $userdata = get_userdata($author);
                echo wp_kses($before,array('li'=>array())) . esc_html__( 'Author:', 'arrowit' ) . ' ' . $userdata->display_name . $after;

            }

            if ( get_query_var( 'paged' ) ) {
                echo wp_kses($before,array('li'=>array())) . '&nbsp;(' . esc_html__( 'Page', 'arrowit' ) . ' ' . get_query_var( 'paged' ) . ')' . $after;
            }

            echo '</ul>';
        } else {
            if ( is_home() && !is_front_page() ) {
                echo '<ul class="breadcrumb">';

                if ( ! empty( $home ) ) {
                    echo wp_kses($before,array('li'=>array())) . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url('/') ) . '"> ' . $home . '</a>' . $after;

                    echo wp_kses($before,array('li'=>array())) . esc_html( Arrowit::setting( 'blog_title')) . $after;
                }

                echo '</ul>';
            }
        }
    }
}
