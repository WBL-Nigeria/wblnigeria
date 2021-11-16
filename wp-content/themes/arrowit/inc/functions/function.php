<?php
function arrowit_pingback_header() {
	echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
}
add_action( 'wp_head', 'arrowit_pingback_header' );
// Customs icon markers
if ( class_exists( 'WP_Store_locator' ) ) {
    add_filter( 'wpsl_admin_marker_dir', 'arrowit_custom_admin_marker_dir' );
    add_filter( 'wpsl_marker_props', 'arrowit_custom_marker_props' );
    function arrowit_custom_admin_marker_dir() {
        $admin_marker_dir = get_stylesheet_directory() . '/wpsl-markers/';
        return $admin_marker_dir;
    }
    function arrowit_custom_marker_props( $marker_props ) {
        $marker_props['scaledSize'] = '36,53'; // Set this to 50% of the original size
        $marker_props['origin'] = '0,0';
        $marker_props['anchor'] = '18,35';
        
        return $marker_props;
    }
    define( 'WPSL_MARKER_URI', dirname( get_bloginfo( 'stylesheet_url') ) . '/wpsl-markers/' );
}

if ( ! function_exists( 'arrowit_get_search_form' ) ) {
    function arrowit_get_search_form() {
        $template = get_search_form(false);  
        $output = '';
        ob_start();
        ?>
        <div class="top-search">
            <?php echo wp_kses($template,arrowit_allow_html()); ?>
        </div>      
        <?php
        $output .= ob_get_clean();
        return $output;
    }
}

if( defined( 'YITH_WCWL' ) && ! function_exists( 'arrowit_yith_wcwl_ajax_update_count' ) ){
function  arrowit_yith_wcwl_ajax_update_count(){
wp_send_json( array(
'count' => yith_wcwl_count_all_products()
) );
}
add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'arrowit_yith_wcwl_ajax_update_count' );
add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'arrowit_yith_wcwl_ajax_update_count' );
}

function arrowit_get_meta_value($meta_key, $boolean = false) {
    global $wp_query, $arrowit_settings;

    $value = '';
    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $value = get_metadata('category', $cat->term_id, $meta_key, true);     
    } elseif(is_tax('product_cat')){
        $cat = $wp_query->get_queried_object();
        $value = get_metadata('product_cat', $cat->term_id, $meta_key, true);        
    } elseif(is_tax()){
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        if ($term) {
            $value = get_metadata($term->taxonomy, $term->term_id, $meta_key, true);
        }   
    }elseif (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $value = get_post_meta(wc_get_page_id( 'shop' ), $meta_key, true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $value = get_metadata($term->taxonomy, $term->term_id, $meta_key, true);
            }

        }
    } else {
        if (is_singular()) {
            $value = get_post_meta(get_the_id(), $meta_key, true);
        } else {
            if (!is_home() && is_front_page()) {
                if (isset($arrowit_settings[$meta_key]))
                    $value = $arrowit_settings[$meta_key];
            } elseif (is_home() && !is_front_page()) {

                if (isset($arrowit_settings['blog-'.$meta_key])){
                    $value = $arrowit_settings['blog-'.$meta_key];
                }else{
                    $value = get_post_meta(get_queried_object_id(), $meta_key, true);
                }
            } elseif (is_home() || is_front_page()) {
                if (isset($arrowit_settings[$meta_key]))
                    $value = $arrowit_settings[$meta_key];
            }
        }
    }

    if ($boolean) {
        $value = ($value != $meta_key) ? true : false;
    }

    return $value;
}
if( !function_exists('arrowit_get_layout_class')){
    /**
     * Return layout class when sidebar displays
     * 
     * @return [string] [arrowit_class]
     */
    function arrowit_get_layout_class(){
        $arrowit_class = '';
        $arrowit_layout = Arrowit_Helper::get_post_meta('layout');
        $arrowit_sidebar_left =  Arrowit_Global::get_left_sidebar();
        $arrowit_sidebar_right =  Arrowit_Global::get_right_sidebar();
        /** Sidebar left & right  */
        if ($arrowit_sidebar_left && $arrowit_sidebar_right && is_active_sidebar($arrowit_sidebar_left) && is_active_sidebar($arrowit_sidebar_right)){
            $arrowit_class .= 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 main-sidebar has-sidebar';
        /** Only sidebar left  */
        }elseif($arrowit_sidebar_left && (!$arrowit_sidebar_right|| $arrowit_sidebar_right=="none") && is_active_sidebar($arrowit_sidebar_left)){
            $arrowit_class .= 'f-right col-lg-9 col-md-12 col-sm-12 col-xs-12 main-sidebar has-sidebar';
        /** Only sidebar right  */
        }elseif((!$arrowit_sidebar_left || $arrowit_sidebar_left=="none") && $arrowit_sidebar_right && is_active_sidebar($arrowit_sidebar_right)){
            $arrowit_class .= 'col-lg-9 col-md-12 col-sm-12 col-xs-12 main-sidebar has-sidebar';
        /** No sidebar  */
        }else {
            $arrowit_class .= 'col-lg-12 col-md-12 col-sm-12 col-xs-12 main-sidebar';
            if($arrowit_layout == 'fullwidth'){
                $arrowit_class .= ' col-md-12';
            }
        }
        return $arrowit_class;
    }
}
if(!function_exists('arrowit_allow_html')){
    function arrowit_allow_html(){
        return array(
            'form'=>array(
                'role' => array(),
                'method'=> array(),
                'class'=> array(),
                'action'=>array(),
                'id'=>array(),
                ),
            'input' => array(
                'type' => array(),
                'name'=> array(),
                'class'=> array(),
                'title'=>array(),
                'id'=>array(), 
                'value'=> array(), 
                'placeholder'=>array(), 
                'autocomplete' => array(),
                'data-number' => array(),
                'data-keypress' => array(),                        
                ),
            'button' => array(
                'type' => array(),
                'name'=> array(),
                'class'=> array(),
                'title'=>array(),
                'id'=>array(),                            
                ),  
            'img'=> array(
                'src' => array(),
                'alt' => array(),
                'class'=> array(),
                ),                      
            'div'=>array(
                'class'=> array(),
                ),
            'h4'=>array(
                'class'=> array(),
                ),
            'a'=>array(
                'class'=> array(),
                'href'=>array(),
                'onclick' => array(),
                'aria-expanded' => array(),
                'aria-haspopup' => array(),
                'data-toggle' => array(),
                ),
            'i' => array(
                'class'=> array(),
            ),
            'p' => array(
                'class'=> array(),
            ), 
            'br' => array(),
            'span' => array(
                'class'=> array(),
                'onclick' => array(),
                'style' => array(),
            ), 
            'strong' => array(
                'class'=> array(),
            ),  
            'ul' => array(
                'class'=> array(),
            ),  
            'li' => array(
                'class'=> array(),
            ), 
            'del' => array(),
            'ins' => array(),
            'select'=> array(
                'class' => array(),
                'name' => array(),
            ),
            'option'=> array(
                'class' => array(),
                'value' => array(),
            ),        
        );
    }
}

function arrowit_posts_per_page( $query ) {
    global $wp_query;
    $arrowit_post_per_page = $arrowit_portfolio_per_page_cate ='';
    $arrowit_product_per_page = Arrowit::setting('shop_archive_number_item');
    $arrowit_portfolio_per_page = Arrowit::setting('portfolio_archive_number_item');
    $single_post_related_number = Arrowit::setting('single_post_related_number');
    if (is_category()){
        $category = $wp_query->get_queried_object();
        if(isset($category)){
            $cat_id = $category->term_id;
            if(get_metadata('category', $cat_id, 'post_per_page', true) != ''){
                $arrowit_post_per_page = get_metadata('category', $cat_id, 'post_per_page', true);
                $query->set( 'posts_per_page', $arrowit_post_per_page );
            }
        }
    }

    if(is_tax('portfolio_cat')){
        $cate = $wp_query->get_queried_object();
        if(isset($cate)){
            $cat_id = $cate->term_id;
            if(get_metadata('portfolio_cat', $cat_id, 'post_per_page_portfolio', true)  != ' '){
                $arrowit_portfolio_per_page_cate = get_metadata('portfolio_cat', $cat_id, 'post_per_page_portfolio', true);
                $query->set( 'posts_per_page', $arrowit_portfolio_per_page_cate );
            }
        }
    }
    if(isset($arrowit_portfolio_per_page) && $arrowit_portfolio_per_page != ''){
        if ( !is_admin() && $query->is_main_query() && (is_post_type_archive( 'portfolio' ) || is_tax('portfolio_cat') ) ) {
            $query->set( 'posts_per_page', $arrowit_portfolio_per_page );
        }
    }

    if (is_tax('product_cat')){
        $cat = $wp_query->get_queried_object();
        if(get_metadata('product_cat', $cat->term_id, 'product_per_page', true)  != 'default'){
            $arrowit_product_per_page = get_metadata('product_cat', $cat->term_id, 'product_per_page', true);
        }
    }
    if(isset($arrowit_product_per_page) && $arrowit_product_per_page != ''){
        if ( !is_admin() && $query->is_main_query() && (is_post_type_archive( 'product' ) || is_tax('product_cat') ) ) {
            $query->set( 'posts_per_page', $arrowit_product_per_page );
        }
    }
    if(isset($single_post_related_number) && $single_post_related_number != ''){
        if ( is_single() && 'post' == get_post_type() && $query->is_main_query() && !is_admin()) {
            $query->set( 'posts_per_page', $single_post_related_number );
        }
    }
}
add_action( 'pre_get_posts', 'arrowit_posts_per_page' );

function arrowit_get_save_template(){
    $block_options = array();
    $args = array(
        'numberposts' => -1,
        'post_type' => 'elementor_library',
        'post_status' => 'publish',
    );
    $posts = get_posts($args);
    $block_options[0] = 'Please Select Option';
    foreach( $posts as $_post ){
        $block_options[$_post->ID] = $_post->post_title;
    }
    return $block_options;
}
function arrowit_get_headers_post_type(){
    $header_type= [];
    $args = array(
        'post_type'      => 'header',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    );
    $header =get_posts( $args );
    foreach( $header as $header ){
        $header_type[$header->post_name] = $header->post_title;
    }
    return $header_type;
}
function arrowit_get_pages(){
    $page_type= [];
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    );
    $page =get_posts( $args );
    $page_type[0] = 'Please Select Option';
    foreach( $page as $page ){
        $page_type[$page->post_name] = $page->post_title;
    }
    return $page_type;
}
function arrowit_get_id_by_slug($slug){
    $id='';
    $args = array(
        'name'           => $slug,
        'post_type'      => 'header',
        'post_status'    => 'publish',
        'posts_per_page' => 1
    );
    $my_posts = get_posts( $args );
    if( $my_posts ) {
        $id = $my_posts[0]->ID;
    }
    return $id;
}
function arrowit_get_post_media(){
    $gallery = get_post_meta(get_the_ID(), 'gallery_metabox', true);
    $blog_layout = Arrowit::setting( 'blog_archive_layout' );
    if($blog_layout  === 'list') {
        $blog_column = Arrowit::setting( 'blog_archive_columns_list' );
    }
    if($blog_layout  === 'grid') {
        $blog_column = Arrowit::setting( 'blog_archive_columns_grid' );
    }
     if($blog_layout  === 'masonry') {
        $blog_column = Arrowit::setting( 'blog_archive_columns_masonry' );
    }
    if (is_category()){
        $blog_layout = arrowit_get_meta_value( 'blog_layout', false);
        $blog_column = arrowit_get_meta_value( 'blog_columns' , false );
    }
    $blog_id =  'blog_id-'.wp_rand();
    ?>
    <?php if ( get_post_format() === 'video') : ?>
        <?php $video = get_post_meta(get_the_ID(), 'post_video', true); ?>
        <?php if ($video && $video != ''): ?>
             <?php if(is_singular()):?>
                <div class="blog-video">
                    <a class="fancybox" data-fancybox href="<?php echo esc_url($video); ?>">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <?php
                        $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                         $image_url       = Arrowit_Helper::aq_resize( array(
                            'url'    => $full_image_size,
                            'width'  => 1170,
                            'height' => 722,
                        ) );
                        ?>
                        <img src="<?php echo esc_url( $image_url ); ?>"
                             alt="<?php the_title_attribute(); ?>"/>
                        <?php
                    }
                    ?>
                    <i class="fa fa-play" aria-hidden="true"></i></a>
                </div>
            <?php else: ?>
                <div class="blog-video blog-img">
                    <a class="fancybox" data-fancybox href="<?php echo esc_url($video); ?>">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <?php
                        $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                        if($blog_layout  === 'list') {
                            if ($blog_column === "2"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 500,
                                    'height' => 413,
                                ) );
                            } else {
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 991,
                                    'height' => 818,
                                ) );
                            }
                        } elseif($blog_layout  === 'grid') {
                            if ($blog_column === "2"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 810,
                                    'height' => 500,
                                ) );
                            }elseif ($blog_column === "3"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 510,
                                    'height' => 315,
                                ) );
                            }elseif ($blog_column === "4"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 310,
                                    'height' => 191,
                                ) );
                            }else {
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 1110,
                                    'height' => 679,
                                ) );
                            }
                        } elseif($blog_layout  === 'masonry' ) {
                            $image_url       = Arrowit_Helper::aq_resize( array(
                                'url'    => $full_image_size,
                                'width'  => 910,
                                'height' => 566,
                            ) );
                        } else{
                             $image_url       = Arrowit_Helper::aq_resize( array(
                                'url'    => $full_image_size,
                                'width'  => 570,
                                'height' => 570,
                            ) );
                        }
                        ?>
                        <img src="<?php echo esc_url( $image_url ); ?>"
                             alt="<?php the_title_attribute(); ?>"/>
                        <?php
                    }
                    ?><i class="fa fa-play" aria-hidden="true"></i></a>      
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php elseif ( get_post_format() == 'audio') : ?>
        <?php $audio = get_post_meta(get_the_ID(), 'post_audio', true); ?>
        <?php if ($audio && $audio != ''): ?>
            <?php if(is_singular()):?>
                <div class="blog-audio">
                        <?php if(get_post_format() == 'audio'){
                            echo '<div class="audio_container">';
                        }
                        ?>                    
                            <?php echo Arrowit_Helper::w3c_iframe( wp_oembed_get( $audio,  array('height'=>300 ) )); ?>
                        <?php if(get_post_format() == 'audio'){
                            echo '</div>';
                        }
                        ?>                 
                </div>
            <?php else:?>
                <div class="blog-audio">
                        <?php if(get_post_format() == 'audio'){
                            echo '<div class="audio_container">';
                        }
                        ?>                    
                            <?php echo Arrowit_Helper::w3c_iframe( wp_oembed_get( $audio,  array('height'=>230 ) )); ?>
                        <?php if(get_post_format() == 'audio'){
                            echo '</div>';
                        }
                        ?>                 
                </div>
            <?php endif;?>
        <?php endif; ?>
    <?php elseif (get_post_format() =='link'):?>
        <?php 
            $link = get_post_meta(get_the_ID(), 'post_link', true); 
            $link_title = get_post_meta(get_the_ID(), 'post_link', true);
        ?>
         <?php if(is_singular()):?>
            <?php if($link && $link != ''):?>
                <div class="blog-img">
                    <?php if ( has_post_thumbnail() ) { ?>
                    <?php
                        $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                         $image_url       = Arrowit_Helper::aq_resize( array(
                            'url'    => $full_image_size,
                            'width'  => 1170,
                            'height' => 722,
                        ) );
                    ?>
                        <img src="<?php echo esc_url( $image_url ); ?>"
                             alt="<?php the_title_attribute(); ?>"/>
                        <?php
                     } ?>                    
                </div> 
                <div class="link_section clearfix">
                    <div class="link-icon">
                        <a class="link-post"  href="<?php echo esc_url(is_ssl() ? str_replace( 'http://', 'https://', $link ) : $link);?>">
                            <i class="fa fa-link"></i>
                        </a>
                    </div>
                </div>
            <?php endif;?>
        <?php else:?>
            <?php if($link && $link != ''):?>
                <div class="link_section clearfix">
                    <div class="link-icon">
                        <a class="link-post"  href="<?php echo esc_url(is_ssl() ? str_replace( 'http://', 'https://', $link ) : $link);?>">
                            <i class="fa fa-link"></i>
                        </a>
                    </div>
                </div>
            <?php endif;?> 
        <?php endif;?>
    <?php elseif(get_post_format() =='quote'):?>
        <?php 
            $quote_text = get_post_meta(get_the_ID(), 'post_quote_text', true); 
        ?>
        <?php if(is_singular()):?>
            <div class="blog-img">
               <?php if ( has_post_thumbnail() ) { ?>
                    <?php
                    $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                     $image_url       = Arrowit_Helper::aq_resize( array(
                            'url'    => $full_image_size,
                            'width'  => 1170,
                            'height' => 722,
                        ) );
                    ?>
                    <img src="<?php echo esc_url( $image_url ); ?>"
                         alt="<?php the_title_attribute(); ?>"/>
                    <?php
                }
                ?>
            </div>
            <?php if($quote_text && $quote_text != ''):?>
                <div class="quote_section">
                    <blockquote class="var3">
                        <p><?php echo wp_kses($quote_text,array());?></p>
                    </blockquote>
                </div>
            <?php endif;?>  
        <?php else: ?>
            <?php if($quote_text && $quote_text != ''):?>
                    <div class="quote_section">
                        <blockquote class="var3">
                            <p><?php echo wp_kses( $quote_text ,array());?></p>
                        </blockquote>
                    </div>
            <?php endif;?>    
        <?php endif; ?>  
    <?php elseif(get_post_format() == 'gallery'): ?>
        <?php if (is_array($gallery) && count($gallery) > 1) : ?>   
            <?php if(is_singular()):?>
                <div class="blog-gallery-single blog-img arrows-custom"> 
                    <?php
                    $index = 0;
                    foreach ($gallery as $key => $value) :
                        $full_image_size = wp_get_attachment_image_src($value, 'full');
                        $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                        $image_url       = Arrowit_Helper::aq_resize( array(
                                'url'    => $full_image_size[0],
                                'width'  => 1110,
                                'height' => 740,
                            ) );
                        ?>
                        <div class ="img-gallery">
                            <img src="<?php echo esc_url( $image_url ); ?>"
                                 alt="<?php echo esc_attr( $alt ); ?>"/>
                        </div>
                        <?php
                        $index++;
                    endforeach;
                    ?>
                </div> 
            <?php else:?>   
                <div id="<?php echo esc_attr($blog_id); ?>" class="blog-gallery blog-img arrows-custom"> 
                    <?php
                    $index = 0;
                    foreach ($gallery as $key => $value) :
                        $full_image_size = wp_get_attachment_image_src($value, 'full');
                        $alt = get_post_meta($value, '_wp_attachment_image_alt', true);

                        if($blog_layout  === 'list') {
                            if ($blog_column === "2"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size[0],
                                    'width'  => 500,
                                    'height' => 413,
                                ) );
                            } else {
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size[0],
                                    'width'  => 991,
                                    'height' => 818,
                                ) );
                            }
                        } elseif($blog_layout  === 'grid') {
                            if ($blog_column === "2"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size[0],
                                    'width'  => 810,
                                    'height' => 500,
                                ) );
                            }elseif ($blog_column === "3"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size[0],
                                    'width'  => 510,
                                    'height' => 315,
                                ) );
                            }elseif ($blog_column === "4"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size[0],
                                    'width'  => 310,
                                    'height' => 191,
                                ) );
                            }else {
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size[0],
                                    'width'  => 1110,
                                    'height' => 679,
                                    'crop'   => true,
                                ) );
                            }
                        } elseif($blog_layout  === 'masonry' ) {
                            $image_url       = Arrowit_Helper::aq_resize( array(
                                'url'    => $full_image_size[0],
                                'width'  => 910,
                                'height' => 566,
                            ) );
                        } else{
                             $image_url       = Arrowit_Helper::aq_resize( array(
                                'url'    => $full_image_size[0],
                                'width'  => 848,
                                'height' => 420,
                            ) );
                        }

                        ?>
                        <div class ="img-gallery"> 
                            <img src="<?php echo esc_url( $image_url ); ?>"
                             alt="<?php echo esc_attr( $alt ); ?>"/>
                        </div>
                        <?php
                        
                        $index++;
                    endforeach;
                    ?>
                </div>
            <?php endif; ?> 
        <?php endif; ?>
     <?php elseif(get_post_format() == 'image'): ?>
        <?php if (has_post_thumbnail()): ?>
            <?php if(is_singular()): ?>
                <div class="blog-img">
                    <?php
                    $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                    $image_url       = Arrowit_Helper::aq_resize( array(
                        'url'    => $full_image_size,
                        'width'  => 1170,
                        'height' => 722,
                    ) );
                    ?>
                    <img src="<?php echo esc_url( $image_url ); ?>"
                         alt="<?php the_title_attribute(); ?>"/>
                </div>
            <?php else: ?>
                <?php
                    $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                    if($blog_layout  === 'list') {
                            if ($blog_column === "2"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 500,
                                    'height' => 413,
                                ) );
                            } else {
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 991,
                                    'height' => 818,
                                ) );
                            }
                        } elseif($blog_layout  === 'grid') {
                            if ($blog_column === "2"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 810,
                                    'height' => 500,
                                ) );
                            }elseif ($blog_column === "3"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 510,
                                    'height' => 315,
                                ) );
                            }elseif ($blog_column === "4"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 310,
                                    'height' => 191,
                                ) );
                            }else {
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 1110,
                                    'height' => 679,
                                ) );
                            }
                        } elseif($blog_layout  === 'masonry' ) {
                            $image_url       = Arrowit_Helper::aq_resize( array(
                                'url'    => $full_image_size,
                                'width'  => 910,
                                'height' => 566,
                            ) );
                        } else{
                             $image_url       = Arrowit_Helper::aq_resize( array(
                                'url'    => $full_image_size,
                                'width'  => 570,
                                'height' => 570,
                            ) );
                        }
                    ?>
                <div class="blog-img ">
                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title_attribute(); ?>"/>
                </div>
            <?php endif; ?>
        <?php endif;?>
    <?php else: ?>
        <?php if (has_post_thumbnail()): ?>
            <?php if(is_singular()): ?>
                <div class="blog-img">
                    <?php
                    $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                    $image_url       = Arrowit_Helper::aq_resize( array(
                        'url'    => $full_image_size,
                        'width'  => 1170,
                        'height' => 722,
                    ) );
                    ?>
                    <img src="<?php echo esc_url( $image_url ); ?>"
                         alt="<?php the_title_attribute(); ?>"/>
                </div>
            <?php else: ?>
                <div class="blog-img">
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                        if($blog_layout  === 'list') {
                            if ($blog_column === "2"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 500,
                                    'height' => 413,
                                ) );
                            } else {
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 991,
                                    'height' => 818,
                                ) );
                            }
                        } elseif($blog_layout  === 'grid') {
                            if ($blog_column === "2"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 810,
                                    'height' => 500,
                                ) );
                            }elseif ($blog_column === "3"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 510,
                                    'height' => 315,
                                ) );
                            }elseif ($blog_column === "4"){
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 310,
                                    'height' => 191,
                                ) );
                            }else {
                                $image_url       = Arrowit_Helper::aq_resize( array(
                                    'url'    => $full_image_size,
                                    'width'  => 1110,
                                    'height' => 679,
                                ) );
                            }
                        } elseif($blog_layout  === 'masonry' ) {
                            $image_url       = Arrowit_Helper::aq_resize( array(
                                'url'    => $full_image_size,
                                'width'  => 910,
                                'height' => 566,
                                'crop'   => true,
                            ) );
                        } else{
                             $image_url       = Arrowit_Helper::aq_resize( array(
                                'url'    => $full_image_size,
                                'width'  => 848,
                                'height' => 420,
                            ) );
                        }
                        ?>
                        <img src="<?php echo esc_url( $image_url ); ?>"
                             alt="<?php the_title_attribute(); ?>"/>
                    </a>
                </div>
            <?php endif; ?>
        <?php endif;?>
    <?php endif;
}

/**
 * [arrowpress_maintenance_mode description]
 * Enable coming soon mode for theme.
 */
if(!function_exists('arrowpress_maintenance_mode')){
    function arrowpress_maintenance_mode(){
        $coming_soon_enable = Arrowit::setting('coming_soon_enable');
        global $arrowit_settings;
        if(isset($coming_soon_enable) && $coming_soon_enable && (!current_user_can('edit_themes') || !is_user_logged_in())){
            add_filter( 'template_include', function() {
                return get_stylesheet_directory() . '/coming-soon.php';
            });
        }
    }
    add_action('template_redirect', 'arrowpress_maintenance_mode');
}

function arrowit_resizeImage($width, $height){
    $full_image_size = wp_get_attachment_url( get_post_thumbnail_id() );
    $image_url       = Arrowit_Helper::aq_resize( array(
        'url'    => $full_image_size,
        'width'  => $width,
        'height' => $height,
        'crop'   => true,
    ) );
    return $image_url;
}
function arrowit_ajax_search_product(){
    $search_val = $_POST['s'];
    $search_cat = $_POST['product_cat'];
    if ( isset( $_REQUEST['s'] ) && ! empty( $_REQUEST['s'] ) ) {
        $query = sanitize_text_field( $_REQUEST['s'] );
        // native WordPress search
        $args = array(
            's'             => $query,
            'post_status'   => 'publish',
            'post_type'     => 'product',
        );
        if(isset($_POST['product_cat']) && $_POST['product_cat'] !=''){
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $_POST['product_cat'],
                'operator' => 'IN'
            );
        }
        query_posts( $args );
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                $post_type = get_post_type_object( get_post_type() );
                ?>
                <div class="auto-search-result clearfix">
                    <div class="search-img">
                        <a href="<?php echo esc_url( get_permalink() )?>">
                            <img src="<?php echo esc_url(arrowit_resizeImage('85', '85'));?>">
                        </a>
                    </div>
                    <div class="search-info">
                        <a class="hover" href="<?php echo esc_url( get_permalink() ); ?>">
                            <?php the_title(); ?>
                        </a>
                        <?php echo do_shortcode('[add_to_cart id="'.get_the_ID().'"]');?>
                    </div>
                </div>
            <?php endwhile;
        else : ?>
            <p class="auto-search-no-results">
                <?php esc_html_e( 'No results found.', 'arrowit' ); ?>
            </p>
        <?php endif;
    }
    die();
}
add_action( 'wp_ajax_au_ajax_search_product', 'arrowit_ajax_search_product' );
add_action( 'wp_ajax_nopriv_au_ajax_search_product', 'arrowit_ajax_search_product' );
/**
 * Get related posts
 *
 * @param     $post_id
 * @param int $number_posts
 *
 * @return WP_Query
 */
function arrowit_get_related_posts( $post_id, $number_posts = - 1 ) {
    $query = new WP_Query();
    $args  = '';
    if ( $number_posts == 0 ) {
        return $query;
    }
    $args  = wp_parse_args( $args, array(
        'posts_per_page'      => $number_posts,
        'post__not_in'        => array( $post_id ),
        'ignore_sticky_posts' => 0,
        'category__in'        => wp_get_post_categories( $post_id )
    ) );
    $query = new WP_Query( $args );
    return $query;
}

/* Displays the class names for the #page element. */
function arrowit_page_class( $class = '' ) {
    // Separates class names with a single space, collates class names for body element
    echo 'class="' . join( ' ', arrowit_get_page_class( $class ) ) . '"';
}
/* Retrieves an array of the class names for the #page element. */
function arrowit_get_page_class( $class = '' ){
    $classes = array();
    $classes[] = 'hfeed';
    $classes[] = 'site';
    /* Page layout */
    $arrowit_site_layout = get_post_meta(get_the_ID(), 'site_layout', true);
    if(($arrowit_site_layout !== '') && ($arrowit_site_layout == 'wide')){
        $classes[] = 'wide';
    }elseif(($arrowit_site_layout !== '') && ($arrowit_site_layout == 'full-width')){

        $classes[] = 'full-width';;
    }elseif(($arrowit_site_layout !== '') && ($arrowit_site_layout == 'boxed')){
        $classes[] = 'boxed';
    }else{
        $classes[] = Arrowit_Global::check_layout_type();
    }
    /* Gradient - class */
    $general_gradient = Arrowit::setting('general_gradient');
    if ($general_gradient == 1){
        $classes[] = 'page-gradient';
    }else{
        $classes[] = '';
    }
    /* Site width */
    $arrowit_width = get_post_meta(get_the_ID(), 'site_width', true);
    if($arrowit_width){
        $classes[] = 'site-width';
    }
    /* Header fix */
    if(Arrowit::setting('fixed_header') || get_post_meta(get_the_ID(), 'fixed_header', true)=='1'){
        $classes[] = 'header-fixed';
    }else{
        $classes[] = '';
    }
    /* Remove padding top */
    $arrowit_remove_space_top = get_post_meta(get_the_ID(), 'remove_space_top', true);
    if($arrowit_remove_space_top){
        $classes[] = 'remove_space_top';
    }
    /* Remove padding bottom */
    $arrowit_remove_space_bottom = get_post_meta(get_the_ID(), 'remove_space_bottom', true);
    if($arrowit_remove_space_bottom){
        $classes[] = 'remove_space_bottom';
    }
    return array_unique( $classes );
}
function arrowit_resize_image($width, $height){
    $full_image_size = wp_get_attachment_url( get_post_thumbnail_id() );
    $image_url       = Arrowit_Helper::aq_resize( array(
        'url'    => $full_image_size,
        'width'  => $width,
        'height' => $height,
        'crop'   => true,
    ) );
    return $image_url;
}

/**
 * Display favicon
 */
function arrowit_favicon()
{
    if (function_exists('wp_site_icon')) {
        if (function_exists('has_site_icon')) {
            if (!has_site_icon()) {
                // Icon default
                $arrowit_favicon_src = get_template_directory_uri() . "/assets/images/favicon.ico";
                echo '<link rel="shortcut icon" href="' . esc_url($arrowit_favicon_src) . '" type="image/x-icon" />';
                return;
            }
            return;
        }
    }
    /**
     * Support WordPress < 4.3
     */

    $theme_options_data = get_theme_mods();
    $arrowit_favicon_src = '';
    if (isset($theme_options_data['arrowit_favicon'])) {
        $arrowit_favicon = $theme_options_data['arrowit_favicon'];
        $favicon_attachment = wp_get_attachment_image_src($arrowit_favicon, 'full');
        $arrowit_favicon_src = $favicon_attachment[0];
    }
    if (!$arrowit_favicon_src) {
        $arrowit_favicon_src = get_template_directory_uri() . "/assets/images/favicon.ico";
    }
    echo '<link rel="shortcut icon" href="' . esc_url($arrowit_favicon_src) . '" type="image/x-icon" />';
}

add_action('wp_head', 'arrowit_favicon');

function arrowit_limit_title($numberlimit)
{
    $tit = the_title('', '', FALSE);
    echo substr($tit, 0, $numberlimit);
    if (strlen($tit) > $numberlimit) echo esc_html__('...', 'arrowit');
}

function arrowit_limit_excerpt($numberlimit)
{
    $tit = get_the_excerpt('', '', FALSE);
    echo substr($tit, 0, $numberlimit);
    if (strlen($tit) > $numberlimit) echo esc_html__('...', 'arrowit');
}
