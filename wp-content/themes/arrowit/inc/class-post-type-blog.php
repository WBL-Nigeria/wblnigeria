<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'Arrowit_Post' ) ) {
    class Arrowit_Post {
        public function __construct() {
        }
        public static function blog_layout(){
            $blog_layout = Arrowit::setting( 'blog_archive_layout' );
            if (is_category()){
                $blog_layout = arrowit_get_meta_value('blog_layout', false);
            }
            if ($blog_layout === 'grid'){
                $style = 'blog-grid';
            }elseif ($blog_layout === 'masonry'){
                $style= 'blog-masonry';
            }else{
                $style= 'blog-list';
            }
            return $style;
        }
        public static function blog_columns(){
            $blog_layout = Arrowit::setting( 'blog_archive_layout' );
            if ($blog_layout === 'list'){
                $blog_columns = Arrowit::setting( 'blog_archive_columns_list' );
            } elseif ($blog_layout === 'grid'){
                $blog_columns = Arrowit::setting( 'blog_archive_columns_grid' );
            } else{
                $blog_columns = Arrowit::setting( 'blog_archive_columns_masonry' );
            }
            if (is_category()){
                $blog_columns = arrowit_get_meta_value('blog_columns', false);
                $blog_layout = arrowit_get_meta_value('blog_layout', false);
            }
            if ($blog_columns === '4'){
                $column = 'col-xl-3 col-md-3 col-sm-6 col-xs-12 blog-col-4';
            }elseif ($blog_columns === '2'){
                if ($blog_layout === 'list'){
                     $column = 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 blog-col-2 ';
                }else{
                    $column = 'col-xl-6 col-md-6 col-sm-6 col-xs-12 blog-col-2 ';
                }
            }elseif ($blog_columns === '3'){
                $column = 'col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 blog-col-4';
            }else{
                $column = 'col-xl-12 col-md-12 col-sm-12 col-xs-12 blog-col-1';
            }
            return $column;
        }
    }
    new Arrowit_Post();
}