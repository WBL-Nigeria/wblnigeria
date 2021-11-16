<?php
global $wp_query;
$blog_archive_layout = Arrowit_Post::blog_layout();
$blog_column = Arrowit_Post::blog_columns();
$blog_meta_list = Arrowit::setting( 'blog_archive_post_meta_list' );
$blog_meta_grid = Arrowit::setting( 'blog_archive_post_meta_grid' );
$blog_meta_masonry = Arrowit::setting( 'blog_archive_post_meta_masonry' );
$blog_date_format =  Arrowit::setting( 'blog_general_date_format' );
$current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
$animation = Arrowit::setting( 'blog_css_animation' );
$animation_class = Arrowit_Helper::get_animation_classes( $animation );
$blog_pagination = Arrowit::setting( 'blog_archive_pagination' );
$blog_layout = Arrowit::setting( 'blog_archive_layout' );
$i = 1;
if (is_category()){
    $blog_pagination = arrowit_get_meta_value('post_pagination', false);
    $blog_layout = arrowit_get_meta_value('blog_layout', false);
    if ($blog_layout === '') {
        $blog_layout = 'list';
    }
}

?>

<div class="row load-item blog-entries-wrap <?php echo esc_attr($blog_archive_layout);?>">
	<?php while (have_posts()) : the_post(); ?>
        <?php
            $format_class = '';
            if( get_post_format() ==='quote'){
                $format_class = 'post-quote';
            } elseif( get_post_format() ==='link'){
                $format_class = 'post-link';
            } elseif( get_post_format() ==='audio'){
                $format_class = 'post-audio';
            } elseif( get_post_format() ==='video'){
                $format_class = 'post-video';
            } elseif( get_post_format() ==='image'){ 
                $format_class = 'post-image';
            } elseif(has_post_thumbnail()){
                $format_class = 'blog-has-img';
            }else{
                $format_class = "";
            }

        ?>
		<div class="item <?php echo esc_attr($animation_class);?> <?php echo esc_attr($blog_column);?> item-page<?php echo esc_attr($current_page); ?>">
    		<div class="blog-item <?php echo esc_attr($format_class);?>  <?php if ( !has_post_thumbnail() &&  get_post_format() !=='quote' && get_post_format() !=='link' && get_post_format() !=='audio' ) {echo 'no-image';}?> <?php if ( get_post_format() ==='gallery' ){ echo 'item-gallery';} ?> <?php if ( is_sticky() ){ echo 'post_sticky';} ?>">
                    <?php if ( is_sticky() ):?>
                         <div class="icon-sticky"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                    <?php endif;?>
                    <?php if(($blog_layout ==='masonry') ) : ?>
                        <div  class="blog-post-info masonry">
                        <?php
                            if (!empty($blog_meta_masonry)){
                                foreach ($blog_meta_masonry as $value){
                                    if (in_array($value, $blog_meta_masonry,true)){?>
                                       <?php if ($value ==='date'):?>
                                            <?php if($blog_date_format ):?>
                                                <div class="custom-date ">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo get_the_time('d'); ?> <?php echo get_the_time('M'); ?> <?php echo get_the_time('Y'); ?>
                                                    </a>
                                                </div>
                                            <?php else:?>
                                                <div class=" default-date">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo get_the_date(); ?>
                                                    </a>
                                                </div>
                                            <?php endif;?>
                                        <?php endif;?>
                                        
                                         <?php
                                    }
                                }
                            }
                        ?>
                        <h4 class="post-name"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                         <?php
                            if (!empty($blog_meta_masonry)){
                                foreach ($blog_meta_masonry as $value){
                                    if (in_array($value, $blog_meta_masonry,true)){?>
                                        <?php if ($value ==='categories'):?>  
                                            <div class="category-post">
                                               <?php echo get_the_term_list($post->ID,'category', '','' ); ?>
                                            </div>
                                        <?php endif;?>
                                        <?php if ($value ==='author'):?>
                                            <div class="info author-post">
                                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                                    <?php the_author(); ?>
                                                </a>     
                                            </div>
                                        <?php endif;?>
                                        <?php if ($value ==='comment'):?>
                                            <div class="info info-comment"> 
                                                <?php comments_popup_link(esc_html__('0 Comment (s)', 'arrowit'), esc_html__('1 Comment', 'arrowit'), esc_html__('% Comments', 'arrowit')); ?>
                                            </div>  
                                        <?php endif;?>
                                        <?php
                                        }
                                    }
                                }
                            ?>
                        </div>
                    <?php endif;?>
                    <?php if (get_post_format() !=='quote') : ?>
                        <?php arrowit_get_post_media();?>
                    <?php endif;?>
                    <div class="blog-post-info">
                        <?php if(($blog_layout ==='list') ) : ?>
                                <?php
                                    if (!empty($blog_meta_list)){
                                        foreach ($blog_meta_list as $value){
                                            if (in_array($value, $blog_meta_list,true)){?>
                                                <?php if ($value ==='categories'):?>  
                                                    <div class="category-post">
                                                       <?php echo get_the_term_list($post->ID,'category', '','' ); ?>
                                                    </div>
                                                <?php endif;?>
                                                 <?php
                                            }
                                        }
                                    }
                                ?>
                        <?php elseif(($blog_layout ==='grid') ) : ?>
                            <?php
                                if (!empty($blog_meta_grid)){
                                    foreach ($blog_meta_grid as $value){
                                        if (in_array($value, $blog_meta_grid,true)){?>
                                            <?php if ($value ==='categories'):?>  
                                                <div class="category-post">
                                                   <?php echo get_the_term_list($post->ID,'category', '','' ); ?>
                                                </div>
                                            <?php endif;?>
                                             <?php
                                        }
                                    }
                                }

                            ?>
                        <?php endif; ?>
                        <h4 class="post-name"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                        <div class="info-post">
                            <?php if(($blog_layout ==='list') ) : ?>
                                <?php
                                    if (!empty($blog_meta_list)){
                                        foreach ($blog_meta_list as $value){
                                            if (in_array($value, $blog_meta_list,true)){?>
                                                    <?php if ($value ==='author'):?>
                                                        <div class="info author-post">
                                                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                                                <?php the_author(); ?>
                                                            </a>     
                                                        </div>
                                                    <?php endif;?>
                                                    <?php if ($value ==='date'):?>
                                                        <div class="info custom-date ">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php echo get_the_date(); ?>
                                                            </a>
                                                        </div>
                                                    <?php endif;?>
                                                    <?php if ($value ==='comment'):?>
                                                        <div class="info info-comment"> 
                                                            <?php comments_popup_link(esc_html__('0 comment (s)', 'arrowit'), esc_html__('1 comment', 'arrowit'), esc_html__('% comments', 'arrowit')); ?>
                                                        </div>  
                                                    <?php endif;?>
                                                 <?php
                                            }
                                        }
                                    }
                                ?>
                            <?php elseif(($blog_layout ==='grid') ) : ?>

                            <?php
                                if (!empty($blog_meta_grid)){
                                    foreach ($blog_meta_grid as $value){
                                        if (in_array($value, $blog_meta_grid,true)){?>
                                                <?php if ($value ==='author'):?>
                                                    <div class="info author-post">
                                                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                                            <?php the_author(); ?>
                                                        </a>     
                                                    </div>
                                                <?php endif;?>
                                                <?php if ($value ==='date'):?>
                                                    <div class="info custom-date ">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php echo get_the_date(); ?>
                                                        </a>
                                                    </div>
                                                <?php endif;?>
                                                <?php if ($value ==='comment'):?>
                                                    <div class="info info-comment"> 
                                                        <?php comments_popup_link(esc_html__('0 comment (s)', 'arrowit'), esc_html__('1 comment', 'arrowit'), esc_html__('% comments', 'arrowit')); ?>
                                                    </div>  
                                                <?php endif;?>
                                             <?php
                                        }
                                    }
                                    }
                                ?>
                            <?php endif; ?>
                            </div>
                        <?php if (get_post_format() ==='quote') : ?>
                            <?php arrowit_get_post_media();?>
                        <?php endif;?>
                        <div class="blog_post_desc">
                            <?php
                            echo '<div class="entry-content">';
                            $excerpt = get_the_excerpt();
                            echo '<p>' . substr( $excerpt, 0, 141 ) . '&hellip;' . '</p>';
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'arrowit' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                                'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'arrowit' ) . ' </span>%',
                                'separator'   => '<span class="screen-reader-text">, </span>',
                            ) );
                            echo '</div>';
                            ?>
                        </div>
                        <?php
                            if(($blog_layout ==='masonry') ) :
                                if (!empty($blog_meta_masonry)){
                                    foreach ($blog_meta_masonry as $value){
                                        if (in_array($value, $blog_meta_masonry,true)){?>
                                            <?php if ($value ==='tags'):?> 
                                                <?php
                                                 $tag = get_the_tag_list(' ','.',' ');
                                                if(!empty($tag)){
                                                    echo '<div class="info-tag"><i class="theme-icon-tag"></i>'. $tag .'</div>';
                                                } 
                                                ?>
                                            <?php endif;?>
                                            
                                             <?php
                                        }
                                    }
                                }
                            endif;
                            if(($blog_layout ==='grid') ) :
                                if (!empty($blog_meta_grid)){
                                    foreach ($blog_meta_grid as $value){
                                        if (in_array($value, $blog_meta_grid,true)){?>
                                            <?php if ($value ==='tags'):?> 
                                                <?php
                                                 $tag = get_the_tag_list(' ','.',' ');
                                                if(!empty($tag)){
                                                    echo '<div class="info-tag"><i class="theme-icon-tag"></i>'. $tag .'</div>';
                                                } 
                                                ?>
                                            <?php endif;?>
                                            <?php
                                        }
                                    }
                                }
                            endif;
                            if(($blog_layout ==='list') ) :
                                if(!empty($blog_meta_list)){
                                    foreach ($blog_meta_list as $value){
                                        if (in_array($value, $blog_meta_list,true)){?>
                                            <?php if ($value ==='tags'):?> 
                                                <?php
                                                 $tag = get_the_tag_list(' ','.',' ');
                                                if(!empty($tag)){
                                                    echo '<div class="info-tag"><i class="theme-icon-tag"></i>'. $tag .'</div>';
                                                } 
                                                ?>
                                            <?php endif;?>
                                            <?php
                                        }
                                    }
                                }
                            endif;
                        ?>
                    </div>
    		</div>
		</div>
		<?php $i++; ?>
	<?php endwhile;?>
	
</div>
<?php if ($blog_pagination === 'load_more'):?>
    <?php if (get_next_posts_link()) { ?>
        <div class="pagination-content type-loadmore load_more_button text-center" rel="<?php echo esc_attr($wp_query->max_num_pages); ?>" data-paged="<?php echo esc_attr($current_page) ?>" data-totalpage="<?php echo esc_attr($wp_query->max_num_pages) ?>">
            <?php echo get_next_posts_link(esc_html__('More', 'arrowit')); ?>

        </div>
    <?php } ?>
<?php endif;?>
<?php if ($blog_pagination === 'next_prev'):?>
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
<?php endif;?>
<?php if ($blog_pagination === 'number'):?>
    <div class="pagination-content type-number">
        <?php Arrowit_Templates::paging_nav(); ?>
    </div>
<?php endif;?>