
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
	<?php if (is_active_sidebar('footer5-top')) { ?>
	<div class="footer-top">
		<div class="container-fluid">
			<div class="row">
				<?php dynamic_sidebar('footer5-top'); ?>    
			</div>
		</div>
	</div>
	<?php } ?>
	<?php if (is_active_sidebar('footer5')) { ?>
	<div class="footer-content">
		<div class="<?php echo esc_attr( $f_container ); ?>">
			<div class="row">
				<?php dynamic_sidebar('footer5'); ?>	
				   
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12 footer-copyright">
					<?php echo  Arrowit::setting( 'footer_copyright' ); ?> 
				</div>	
			</div>
		</div>
	</div>
</footer>