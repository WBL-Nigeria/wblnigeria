<?php 
get_header(); 
$cols = Arrowit_Global::get_page_sidebar();
?>
<?php get_sidebar('left'); ?> 
	<div class="<?php echo esc_attr($cols);?>">
		<div id="primary" class="content-area">
            <?php if (have_posts()): ?>   
               <?php get_template_part( 'templates/content', 'blog-archive' ); ?>
             <?php else: ?> 
			    <article id="post-0" class="post no-results not-found">
		            <h1 class="entry-title not-found-title"><?php echo esc_html__('Nothing Found', 'arrowit'); ?></h1>
		            <div class="row">
		                <div class="entry-content">
		                    <div class="col-md-12 col-sm-12 col-xs-12">
		                        <p><?php echo esc_html__('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'arrowit'); ?></p>
		                        <div class="widget widget_search">
		                        <?php get_search_form(); ?>
		                        </div>
		                    </div>
		                </div><!-- .entry-content -->
		            </div>
			    </article><!-- #post-0 -->
             <?php endif; ?>
		</div> <!-- End primary -->
	</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?>