<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

while ( have_posts() ) : the_post(); ?>

 <div class="product">

	<div id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>

		<?php do_action( 'yith_wcqv_product_image' ); ?>
        <script>
            (function ($) {
                "use strict";
                var $rtl = false;
                if (arrowit_params.arrowit_rtl == 'yes') {
                    $rtl = true;
                }
                $(document).ready(function () {
                    $('#yith-quick-view-modal .product-list-thumbnails img').on('click', function(e){
                        $('#yith-quick-view-modal .woocommerce-product-gallery__image').trigger('zoom.destroy'); // remove zoom
                    });
                    $('#yith-quick-view-modal .woocommerce-product-gallery__wrapper').on('afterChange', function(event, slick, currentSlide, nextSlide){
                        $('.slick-slide').removeClass('flex-active-slide');
                        $("[data-slick-index='"+currentSlide+"']").addClass('flex-active-slide');
                    });
                    var $productGallery = $( '#yith-quick-view-modal .woocommerce-product-gallery__wrapper' ),
                        $productGalleryThumb = $( '#yith-quick-view-modal .product-list-thumbnails' );
                    $productGallery.slick( {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        rtl: $rtl,
                        focusOnSelect: true,
                        arrows: false,
                        fade: true,
                        infinite: true,
                        asNavFor: $productGalleryThumb
                    } );
                    $productGalleryThumb.slick( {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        nextArrow: '<button class="btn-next"><i class="fa fa-angle-right"></i></button>',
                        prevArrow: '<button class="btn-prev"><i class="fa fa-angle-left"></i></button>',
                        dots: false,
                        rtl: $rtl,
                        focusOnSelect: true,
                        vertical: false,
                        infinite: true,
                        asNavFor: $productGallery,
                        responsive: [
                            {
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 3,
                                }
                            },
                            {
                                breakpoint: 1199,
                                settings: {
                                    slidesToShow: 3,
                                }
                            },
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 3,
                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 3,
                                }
                            },
                            {
                                breakpoint: 577,
                                settings: {
                                    slidesToShow: 3,
                                    vertical: false,
                                }
                            }
                        ]
                    } );
                });
            })(jQuery);
        </script>
		<div class="summary entry-summary">
			<div class="summary-content">
				<?php do_action( 'yith_wcqv_product_summary' ); ?>
			</div>
		</div>

	</div>

</div>

<?php endwhile; // end of the loop.