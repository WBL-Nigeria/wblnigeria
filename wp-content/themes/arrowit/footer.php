					</div><!-- End row-->
				</div><!-- End container-->
			</div> <!-- End main-->

			<?php
				$arrowit_footer_type = Arrowit_Global::instance()->set_footer_type();
				$arrowit_hide_footer = get_post_meta(get_the_ID(), 'hide_footer', true);
				if(is_category() || is_tax()){
				    $arrowit_hide_footer_cat = arrowit_get_meta_value('hide_footer', true);
				    if (!$arrowit_hide_footer_cat) {
				        $arrowit_hide_footer = true;
				    }
				}
				if(!$arrowit_hide_footer && $arrowit_footer_type != 'none' && !is_404()) {
					Arrowit_Templates::footer();
				}
			?>
			<?php do_action('arrowit_render_footer'); ?>
            <div class="overlay"></div>
        </div> <!-- End page-->
        <?php wp_footer(); ?>
    </body>
</html>


