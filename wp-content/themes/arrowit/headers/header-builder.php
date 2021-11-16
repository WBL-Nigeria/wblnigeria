<?php
$choose_header_builder = Arrowit::setting('choose_header_builder');
$header_type = arrowit_get_meta_value('header_type');
$header_class ='';
if (!empty($header_type) && $header_type !=='default'){
    $header_class=$header_type;
}else{
    $header_class=$choose_header_builder;
}

get_template_part('templates/header/account');
?>
<header class="site-header header-builder <?php echo esc_attr($header_class);?>">
    <div class="header-content">
        <?php
        if (!empty($header_type) && $header_type !=='default'){
        echo \Elementor\Plugin::$instance->frontend->get_builder_content(arrowit_get_id_by_slug($header_type), true);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content(arrowit_get_id_by_slug($choose_header_builder), true);
        }
        ?>
    </div>
</header>