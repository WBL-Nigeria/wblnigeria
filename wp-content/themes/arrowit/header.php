<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="robots" content="index,follow">
    <?php 
        if (is_ssl()) {
            echo '<link rel="profile" href="//gmpg.org/xfn/11" />';
        }else{
            echo '<link rel="profile" href="http://gmpg.org/xfn/11" />';
        }
    ?>
	
    <?php wp_head(); ?>
</head>
<?php
$arrowit_site_layout = get_post_meta(get_the_ID(), 'site_layout', true);
$arrowit_hide_header = get_post_meta(get_the_ID(), 'hide_header', true);
if(is_category() || is_tax()){
    $arrowit_hide_header_cat = arrowit_get_meta_value('hide_header', true);
    if (!$arrowit_hide_header_cat) {
        $arrowit_hide_header = true;
    }
}
$container = Arrowit_Global::check_container_type();

$arrowit_class = get_post_meta(get_the_ID(), 'arrowit_class', true);
if($arrowit_class != ''){
    $classes = $arrowit_class;
}else{
    $classes='';
}
?>
<body <?php body_class($classes); ?>>
	<?php Arrowit_Functions::arrowit_pre_loader(); ?>
    <div id="page" <?php arrowit_page_class();?>>
        <?php
        Arrowit_Templates::get_search_box();
        get_template_part('templates/header/humburger');
        if(!$arrowit_hide_header && !is_404()) {
            if (Arrowit::setting('header_sticky_enable') == 1 || arrowit_get_meta_value('meta_header_sticky') == 1){
                Arrowit::get_header_sticky_type();
            }
            Arrowit::get_header_type(); }
        ?>
        <?php get_template_part('breadcrumb'); ?>
        <div id="site-main" class="wrapper">
            <?php if($arrowit_site_layout == 'full-width') :?>
                <div class="container">
            <?php elseif ($arrowit_site_layout == 'wide' || $arrowit_site_layout == 'boxed'): ?>
                <div class="container-fluid">
            <?php else: ?>
                <div class="<?php echo esc_attr($container);?>">
            <?php endif;?>
                    <div class="row">