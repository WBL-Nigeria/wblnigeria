
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
	<?php if (is_active_sidebar('footer6-top')) { ?>
		<div class="footer-top">
			<div class="container-fluid">
				<div class="row">
					<?php dynamic_sidebar('footer6-top'); ?>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php if (is_active_sidebar('footer6')) { ?>
		<div class="footer-content">
			<div class="container-fluid">
				<div class="row">
					<?php dynamic_sidebar('footer6'); ?>
					<div class="col-md-6 footer-copyright">
						<?php echo  Arrowit::setting( 'footer_copyright' ); ?> 
					</div>	
				</div>
			</div>
		</div>
	<?php }else{ ?>
		<div class="footer-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 footer-copyright text-center">
						<?php echo  Arrowit::setting( 'footer_copyright' ); ?> 
					</div>	
				</div>
			</div>
		</div>
	<?php } ?>
</footer>