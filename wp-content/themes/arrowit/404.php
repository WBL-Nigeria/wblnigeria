<?php
get_header();
$title = Arrowit::setting('error_title');
$error404_content = Arrowit::setting('error404_content');
$overlay_enable = Arrowit::setting('overlay_enable');
$go_back_home_404 = Arrowit::setting('go_back_home_404');
$go_back_contact_us = Arrowit::setting('go_back_contact_us');
$error404_page_image_404 = Arrowit::setting('error404_page_image_404');
$contact_link = Arrowit::setting('choose_destination_contact');
?>
    <div class="page-404  error-page <?php if ($overlay_enable == 1) echo 'overlay404'; ?>">
        <div class="page-container-404 container">
            <div class="page-content-404">
                <div class="heading-404">
                    <div class="content-404">
                        <?php if (!empty($title)) { ?>
                            <h1 class="page-title"><?php echo esc_attr($title); ?></h1>
                        <?php } ?>
                        <?php if (!empty($error404_content)) { ?>
                            <p><?php echo esc_attr($error404_content); ?></p>
                        <?php } ?>
                        <a class="btn btn-type-1 btn-primary go-home" href="<?php echo esc_url(home_url('/')); ?>">
                            <?php echo esc_html($go_back_home_404); ?><i class="fas fa-long-arrow-alt-right"></i></a>
                        <a class="btn btn-type-1 btn-primary go-contact" href="<?php echo esc_url(home_url($contact_link)); ?>">
                            <?php echo esc_html($go_back_contact_us); ?><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div><!-- .content-404 -->
                </div>
            </div>
        </div>
    </div>
<?php get_footer();