
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
		<?php if (is_active_sidebar('footer3-left')) { ?>
		<div class="footer-left">
			<div class="row">
				<?php dynamic_sidebar('footer3-left');?>  
			</div>  
		</div>
		<?php } ?>
		<?php if (is_active_sidebar('footer3-right')) { ?>
		<div class="footer-right">
			<div class="row">
				<?php dynamic_sidebar('footer3-right'); ?>
				<div class="footer-copyright col-lg-8 col-md-12 footer-bt-right">
					<?php echo  Arrowit::setting( 'footer_copyright' ); ?> 
				</div>	
			</div>
		</div>
		<?php } ?>
		<?php if (!is_active_sidebar('footer3-left') && !is_active_sidebar('footer3-right')) { ?>
			<div class="footer-bottom">
				<div class="row">
					<div class="col-md-12 footer-copyright">
						<?php echo  Arrowit::setting( 'footer_copyright' ); ?> 
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</footer>