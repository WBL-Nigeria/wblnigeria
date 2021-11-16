<?php 
$header_search_config = Arrowit::setting('show_search');
$header_search_type = Arrowit::setting('header_search');
$show_search_category = Arrowit::setting('show_search_category');
if (get_post_type() =='portfolio') {
    $searchTaxArray = array('portfolio_cat');
}else if (get_post_type_object( 'product' )) {
    $searchTaxArray = array('product_cat');
}else{
    $searchTaxArray = array('category');
}
?>
<form role="search" method="get"  class="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="search-form woosearch-search">
        <div class="woosearch-input-box">
        	<?php
        		if ($header_search_config && ($header_search_type === 'product') && $show_search_category) {

                ?>
                <?php
                foreach ($searchTaxArray as $taxonomy) {
                    $taxonomy     = $taxonomy;
                    $orderby      = 'name';
                    $show_count   = 1;
                    $pad_counts   = 0;
                    $hierarchical = 1;
                    $title        = '';
                    $empty        = 0;
                    $args = array(
                         'taxonomy'     => $taxonomy,
                         'orderby'      => $orderby,
                         'show_count'   => $show_count,
                         'pad_counts'   => $pad_counts,
                         'hierarchical' => $hierarchical,
                         'title_li'     => $title,
                    );
                    $terms = get_categories( $args );
                    $term_array =array();
                    foreach ($terms as $cat) {
                        $category_id = $cat->term_id;
                        $term_array[$cat->slug] = $cat->name;
                    }
                    $default_name_select = esc_html__('All Category','arrowit');
                    if((is_array($term_array) || is_object($term_array)) && !empty($term_array)){
                        echo '<select class="pro_cat_select"  name="'.esc_attr($taxonomy).'">';
                        echo '<option value="">'.$default_name_select.'</option>';
                        foreach($term_array as $key => $value):
                            echo '<option value="'.esc_attr($key).'">'.$value.'</option>'; //close your tags!!
                        endforeach;
                        echo '</select> ' ;
                    }
                }
        	}
        	?>
			<input class="product-search search-input" type="text" name="s"  placeholder="<?php echo esc_attr__("Search", "arrowit") ?>"/>
        </div>
		<button type="submit" class="searchsubmit woosearch-submit submit btn-search">
			<span class="search-text"><?php echo esc_html__('Search','arrowit'); ?></span>
			<i class="fa fa-search" aria-hidden="true"></i>
		</button>  
		<?php 
            if (get_post_type() == 'post') {
                echo  '<input type="hidden" name="post_type" value="post" />';
            } else if (get_post_type()=='portfolio') {
                echo  '<input type="hidden" name="post_type" value="portfolio" />';
            } else {
		        if(class_exists( 'WooCommerce' )) {
		            echo  '<input type="hidden" name="post_type" value="product" />';
		        }            	 
            } 
		?>
    </div>
</form>