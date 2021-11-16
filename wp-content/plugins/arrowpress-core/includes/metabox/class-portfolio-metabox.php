<?php
class Apr_Core_Portfolio_Metabox extends Apr_Metabox {
    private $screen = array(
        'portfolio',
    );
    public function add_meta_boxes() {
        foreach ( $this->screen as $single_screen ) {
            add_meta_box(
                'portfolio_metabox',
                __( 'Post Options', 'apr-core' ),
                array( $this, 'meta_box_callback' ),
                $single_screen,
                'normal',
                'default'
            );
        }
    }
    public function general_meta_fields(){
        $meta_fields = array(
            array(
                'title'     => esc_attr__( 'Portfolio', 'apr-core' ),
                'id'        => 'portfolio_option',
                'fields'    => array(
                    array(
                        'id'                =>'gallery_metabox',
                        'type'              =>'gallery',
                        'label'             => esc_html__( 'Galery Format', 'apr-core' ),
                        'desc'              => esc_html__( ' Upload images gallery ', 'apr-core' ),
                        'default'           => '',
                    ),
                    array(
                        'id' => 'link_portfolio',
                        'label' => esc_attr__('Link Portfolio', 'apr-core'),
                        'desc' => esc_attr__('Enter link portfolio.', 'apr-core'),
                        'type' => 'text',
                        'default' => '',
                    ),
                    array(
                        'id' => 'comment_portfolio',
                        'label' => esc_attr__('Comment ', 'apr-core'),
                        'desc' => esc_attr__('Enter comment of customer. Only work Portfolio layout: Grid layout 3', 'apr-core'),
                        'type' => 'text',
                        'default' => '',
                    ),
                ),
            ),
            $this -> general_option(),
            $this -> skin_option(),
            $this -> breadcrumbs_option(),
            $this -> header_option(),
            $this -> footer_option(),
        );
        return $meta_fields;
    }
}
if (class_exists('Apr_Core_Portfolio_Metabox')) {
    new Apr_Core_Portfolio_Metabox;
};

