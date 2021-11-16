<?php
$get_left_sidebar = Arrowit_Global::get_left_sidebar();
if ( $get_left_sidebar !== 'none' &&  $get_left_sidebar !== '' && is_active_sidebar($get_left_sidebar)):?>
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 left-sidebar active-sidebar">
    	<div class="content-sidebar">
    		<?php dynamic_sidebar($get_left_sidebar); ?>
    	</div>
    </div>
<?php endif;?>