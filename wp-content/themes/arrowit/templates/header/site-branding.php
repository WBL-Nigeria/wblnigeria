<div class="site-branding">
    <div class="wrap">
        <?php if (is_front_page() && has_custom_logo()) : ?>
            <h1>
                <?php the_custom_logo(); ?>
            </h1>
        <?php else : ?>
            <?php the_custom_logo(); ?>
        <?php endif; ?>
        <div class="site-branding-text ">

            <?php if (is_front_page() && !has_custom_logo()) : ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                       rel="home"><?php echo esc_attr(get_bloginfo('name', 'display')) ?></a>
                </h1>
            <?php else : ?>
                <p class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                       rel="home"><?php echo esc_attr(get_bloginfo('name', 'display')) ?></a>
                </p>
            <?php endif; ?>
            <?php
            $description = get_bloginfo('description', 'display');

            if ($description || is_customize_preview()) :
                ?>
                <p class="site-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div><!-- .site-branding-text -->
    </div><!-- .wrap -->
</div><!-- .site-branding -->