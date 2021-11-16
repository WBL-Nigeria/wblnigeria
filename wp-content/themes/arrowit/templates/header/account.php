<?php
$setting_popup = Arrowit::setting('setting_popup');
$logo_account = Arrowit::setting('account_logo_account');
$title_login = Arrowit::setting('account_title_login');
$title_register = Arrowit::setting('account_title_register');
if(class_exists( 'WooCommerce' )):
    if(isset($setting_popup) && $setting_popup && !is_account_page()): ?>
        <div id="account-popup" class="account-popup">
            <div class="logo-account">
                <img src="<?php echo esc_url($logo_account);?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')) ?>">
            </div>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#login-show">
                        <?php if((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && function_exists('icl_object_id') ): ?>
                            <?php echo esc_html__('Login','arrowit'); ?>
                        <?php elseif(isset($title_login) && $title_login != ''): ?>
                            <?php echo esc_attr($title_login); ?>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#register-show">
                        <?php if((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && function_exists('icl_object_id') ): ?>
                            <?php echo esc_html__('Register','arrowit'); ?>
                        <?php elseif(isset($title_register) && $title_register != ''): ?>
                            <?php echo esc_attr($title_register); ?>
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active arrowit-login" id="login-show">
                    <form class="woocommerce-form woocommerce-form-login login" method="post" name="loginpopopform" id="login">
                        <?php do_action( 'woocommerce_login_form_start' ); ?>
                        <div class="status "></div>
                        <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-row-name">
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text required" placeholder="<?php esc_attr_e( 'Username', 'arrowit' ); ?>" name="username" id="username" readonly
        onfocus="this.removeAttribute('readonly')"/>
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-row-pass">
                            <span class="login-password">
                            <input class="woocommerce-Input woocommerce-Input--text input-text required" placeholder="<?php esc_attr_e( 'Password', 'arrowit' ); ?>" type="password" name="password" id="password"/>
                            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="forgot-pass"><?php esc_html_e( 'Forgot password?', 'arrowit' ); ?></a>
                            </span>
                        </p>
                        <p class="form-row sm-login">
                            <button type="submit" class="woocommerce-Button button btn btn-type-1 btn-highlight" name="submit" value="<?php esc_attr_e( 'Login', 'arrowit' ); ?>"><?php esc_html_e( 'Login', 'arrowit' ); ?></button>
                        </p>
                        <?php do_action( 'woocommerce_login_form' ); ?>
                        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                        <label class="checkcontainer">
                            <?php esc_html_e( 'Remember me', 'arrowit' ); ?>
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                            <span class="checkmark"></span>
                        </label>
                        <?php do_action( 'woocommerce_login_form_end' ); ?>
                    </form>

                </div>
                <div class="tab-pane fade" id="register-show">
                    <form method="post" class="woocommerce-form woocommerce-form-register register" id="register" action="register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

                        <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>
                        <?php do_action( 'woocommerce_register_form_start' ); ?>
                        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                            <div class="status"></div>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-row-name">
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text required" placeholder="<?php esc_attr_e( 'Username', 'arrowit' ); ?>" name="username" id="reg_username" readonly
        onfocus="this.removeAttribute('readonly')"/>
                            </p>
                        <?php endif; ?>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-row-user">
                            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text required" placeholder="<?php esc_attr_e( 'Email', 'arrowit' ); ?>" name="email" id="reg_email"/>
                        </p>

                        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-row-pass">
                                <span class="login-password">
                                    <input class="woocommerce-Input woocommerce-Input--text input-text required" placeholder="<?php esc_attr_e( 'Password', 'arrowit' ); ?>" type="password" name="password" id="reg_password"/>
                                    <span class="show_pass"><i class="fa fa-eye"></i></span>
                                </span>
                            </p>
                        <?php endif; ?>
                        <?php do_action( 'woocommerce_register_form' ); ?>
                        <p class="woocommerce-FormRow form-row">
                            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                            <button type="submit" class="woocommerce-Button button btn btn-type-1 btn-highlight" value="<?php esc_attr_e( 'Register', 'arrowit' ); ?>"><?php esc_html_e( 'Register', 'arrowit' ); ?></button>
                        </p>
                        <?php do_action( 'woocommerce_register_form_end' ); ?>
                    </form>
                </div>
            </div>
        </div>
    <?php endif;
endif; ?>