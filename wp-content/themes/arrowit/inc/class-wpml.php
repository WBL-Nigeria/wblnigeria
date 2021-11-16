<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
//remove wpml language selector style
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
class Arrowit_WPML{
	//show currency switcher dropdown list
	public static function show_currencies_dropdown($arg = array()){
		?>
			<div class="currency_custom">
				<div class="dib header-currencies dropdown-menu">
					<div id="currencyHolder">
						<?php echo(do_shortcode('[currency_switcher]')); ?>
					</div>
				</div>
			</div>
		<?php
	}
	//show language switcher dropdown list
	public static function show_language_dropdown($arg = array()){
		global $sitepress;
		?>
		<?php if((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && function_exists('icl_object_id') ): 
		if( !defined( 'ICL_LANGUAGE_CODE' ) && !isset( $sitepress )) {
			return false;
		}
		$languages = icl_get_languages('skip_missing=0&orderby=code');
		$language_text = esc_html__('Languages', 'arrowit');
		if(defined('ICL_LANGUAGE_CODE')) {
			$language_text = ICL_LANGUAGE_CODE;
		}
		?>
			<div class="languges-flags site-header-lang">
				<?php 
				if(!empty($languages)){
					foreach ($languages as $l_active) {
						if ($l_active['active'] == 1) {
							echo '<div class="lang-'.$l_active['active'].'">';
							echo '<img src="'.$l_active['country_flag_url'].'" alt="'.$l_active['translated_name'].'"  /><span>'.$l_active['language_code'].'</span> <i class="fa fa-caret-down"></i>' ;
							echo '</div>';
						}
					}
					echo '<ul class="content-filter">';
					foreach($languages as $l){
						if ($l['active'] == 0) {
							echo '<li><a class="lang-'.$l['active'].'" href="'.$l['url'].'">';
							echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['translated_name'].'" width="16" /> <span>'.$l['language_code'].'</span>';
							echo '</a></li>';
						}
					}
					echo '</ul>';
				}
				?>
			</div>
		<?php elseif((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && unction_exists('is_plugin_active') ):?>
			<?php if(function_exists('pll_the_languages') && function_exists('pll_current_language')): ?>
			<div class="languges-flags display-inline">
				<ul><?php pll_the_languages(array('show_flags'=>0,'show_names'=>1));?></ul>
			</div>
			<?php endif;?>                
		<?php endif;?>
		<?php
	}
	//demo
	public static function show_language_dropdown_demo($arg = array()){
		?>
			<div class="languges-flags languges-flags-demo site-header-lang">
                <div class="lang-1">
                    <img src="<?php echo ARROWIT_THEME_URI.'/assets/images/lang-icon.png';?>" alt="<?php echo esc_attr__('en', 'arrowit') ?>">
                    <span><?php echo esc_html__('EN', 'arrowit');?></span><i class="fa fa-caret-down"></i>
                </div>
                <ul class="content-filter">
                    <li class="icl-en"><a href="#"><?php echo esc_html__('English', 'arrowit') ?></a></li>
                    <li class="icl-en"><a href="#"><?php echo esc_html__('German', 'arrowit') ?></a>
                </ul>
			</div>  
		<?php
	}
}
