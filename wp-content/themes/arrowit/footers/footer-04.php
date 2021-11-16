
<?php
	$footer_layout = Arrowit::setting('footer_layout');
  	if ($footer_layout === 'wide'){
    	$f_container ='container-fluid';
	}elseif ($footer_layout === 'full_width'){
	    $f_container ='container';
	}else{
	    $f_container ='container-fluid boxed';
	}
?>
<footer  id="page-footer" <?php Arrowit::footer_class(); ?>>
	<div class="<?php echo esc_attr( $f_container); ?>">
		<?php if (is_active_sidebar('footer4-top')) { ?>
			<div class="footer-top">
				<div class="container-fluid">
					<div class="row">
						<?php dynamic_sidebar('footer4-top'); ?>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php if (is_active_sidebar('footer4-left')) { ?>
		<div class="footer-left">
			<div class="row">
				<?php dynamic_sidebar('footer4-left');?>
				<div class="col-md-12 footer-copyright footer-copyright-content footer-bt-center">
					<?php echo  Arrowit::setting( 'footer_copyright' ); ?> 
				</div>    
			</div> 
		</div>
		<?php } ?>
		<?php if (is_active_sidebar('footer4-right')) { ?>
		<div class="footer-right">
			<div class="row">
				<?php dynamic_sidebar('footer4-right'); ?>	
			</div>
		</div>
		<?php } ?>
		<?php if (!is_active_sidebar('footer4-left') && !is_active_sidebar('footer4-right')) { ?>
			<div class="footer-bottom-content">
				<div class="row">
					<div class="col-md-12 footer-copyright footer-bt-center">
						<?php echo  Arrowit::setting( 'footer_copyright' ); ?> 
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="footer-bottom">
		<div class="row">
			<div class="col-md-12 footer-copyright footer-bt-center">
				<?php echo  Arrowit::setting( 'footer_copyright' ); ?> 
			</div>
		</div>
	</div>
</footer>
