<?php
$choose_header_builder = Arrowit::setting('choose_header_builder');
$enable_header_custom = arrowit_get_meta_value('enable_header_custom');
$header_type = arrowit_get_meta_value('header_type');
?>
<div <?php Arrowit::header_sticky_builder_class() ?>>
    <div class="header-content">
        <?php
        if (!empty($header_type) && $header_type !== 'default') {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content(arrowit_get_id_by_slug($header_type), true);
        } else {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content(arrowit_get_id_by_slug($choose_header_builder), true);
        }
        ?>
    </div>
</div>