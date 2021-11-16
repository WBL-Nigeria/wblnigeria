<?php
    $blog_post_meta = Arrowit::setting( 'single_post_meta' );
    $other_news_title = Arrowit::setting( 'other_news_title' );
    $single_post_related_number = Arrowit::setting( 'single_post_related_number' );
    $number_related = apply_filters( 'arrowit_related_posts', 3 );
    $related        = arrowit_get_related_posts( $post->ID, $number_related );
?>
<div class="blog post-single">
    <div class="blog-content">
        <?php arrowit_get_post_media();?>
        <?php if (!empty($blog_post_meta)){
                foreach ($blog_post_meta as $value){
                    if (in_array($value, $blog_post_meta,true)){ ?>
                        <?php if ($value ==='categories'):?>  
                            <div class="category-post">
                               <?php echo get_the_term_list($post->ID,'category', '',' ','' ); ?>
                            </div>
                        <?php endif;?>
                        <?php
                    }
                }
            }
        ?>
        <h3 class="title-post-single">
            <?php echo the_title_attribute();?>
        </h3>
        <div class="blog-info-single">
            <?php if (!empty($blog_post_meta)){
                foreach ($blog_post_meta as $value){
                    if (in_array($value, $blog_post_meta,true)){ ?>
                        <?php if ($value ==='author'):?>
                            <div class="info author-post">
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                    <?php the_author(); ?>
                                </a>     
                            </div>
                        <?php endif;?>
                        <?php if ($value ==='date'):?>
                            <div class="info date-post">
                                <div class=" default-date">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo get_the_date(); ?>
                                    </a>
                                </div>
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
        </div>
        <div class="blog_post_desc">                    
            <?php the_content();?>
                <?php 
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'arrowit' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'arrowit' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                ?>                          
        </div> 
        <?php if (!empty($blog_post_meta)){
                foreach ($blog_post_meta as $value){
                    if (in_array($value, $blog_post_meta,true)){ ?>
                        <?php if ($value ==='tags'):?> 
                            <?php
                            $tag = get_the_tag_list('',' ','');
                            $tags = count(wp_get_post_tags($post->ID)) ;
                            if(!empty($tag)){
                                echo '<div class="related-topic">';
                                if ($tags > 1) {
                                    echo '<h3>' . esc_html__('Tags:', 'arrowit') . '</h3>';
                                }else{
                                    echo '<h3>' . esc_html__('Tag:', 'arrowit') . '</h3>';
                                }
                                
                                echo get_the_tag_list('',' ','');
                                echo '</div>';
                            } 
                            ?>
                        <?php endif;?>
                        <?php
                    }
                }
            }
        ?>   
        <?php if ( Arrowit::setting( 'single_post_share_enable' ) === '1' ) : ?>
            <div class="action">
                <?php Arrowit_Templates::post_sharing(); ?>
            </div>
        <?php endif; ?>
        <?php if ( Arrowit::setting( 'single_post_related_enable' ) === '1' ) : ?>
        <?php
        if ( $related->have_posts() ) {
           ?>
           <div class="related-archive">
               <?php if($other_news_title !== ''): ?>
                        <?php if((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && function_exists('icl_object_id') ): ?>
                            <h3><?php echo esc_html__('Other news from the Arrowit: ','arrowit' );?> </h3>
                        <?php else :?> 
                            <h3><?php echo wp_kses_post($other_news_title); ?></h3>
                        <?php endif;?>
                    <?php endif;?>
               <?php
               echo '<div class="item-posts">';
               while ( $related->have_posts() ) {
               $related->the_post();?>
               <h5>
                   <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( the_title_attribute() ); ?>"><?php the_title(); ?></a>
               </h5>
               <?php
               }
               wp_reset_postdata();
               echo '</div>';
               ?>
           </div>
        <?php }?>
        <?php endif; ?> 
        <?php
            if ( Arrowit::setting( 'single_post_comment_enable' ) === '1' ) {
            comments_template('', true);
        }?>
    </div>
</div>