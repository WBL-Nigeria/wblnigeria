(function ($) {
    "use strict";
    //Global variable
    var $body = $('body');
    var $rtl = false;
    if (arrowit_params.arrowit_rtl == 'yes') {
        $rtl = true;
    }
    // Check images loaded
    $.fn.JAS_ImagesLoaded = function (callback) {
        var JAS_Images = function (src, callback) {
            var img = new Image;
            img.onload = callback;
            img.src = src;
        }
        var images = this.find('img').toArray().map(function (el) {
            return el.src;
        });
        var loaded = 0;
        $(images).each(function (i, src) {
            JAS_Images(src, function () {
                loaded++;
                if (loaded == images.length) {
                    callback();
                }
            })
        })
    }

    function arrowitAutocompleteSearch() {
        $('.search-form').each(function () {
            var url = arrowit_params.ajax_url + "?action=arrowit_search";
            var $this = $(this);
            var $post_type = ($(this).find("input[name='post_type']").val() != '') ? $(this).find("input[name='post_type']").val() : '';
            var s1 = [];
            // var s2 = [];
            $(this).find(' select').each(function () {
                $(this).on('change', function () {
                    s1.unshift({
                        tax: $(this).attr('name'),
                        term: $(this).find(":selected").val()
                    });
                    var categories = [];
                    var dup = [];
                    if (s1.length !== 0) {
                        $.each(s1, function (index, value) {
                            if (typeof value !== "undefined") {
                                if ($.inArray(value.tax, categories) == -1) {
                                    categories.push(value.tax);
                                } else {
                                    dup.push(value.tax);
                                    s1.pop();
                                }
                            }
                        });
                    }
                });

            });
            $(this).find(".search-input").autocomplete({
                // source: url,
                source: function (request, response) {
                    var request_data = {
                        term: request.term,
                        post_type: $post_type,
                        tax: s1,
                        min_price: function () {
                            return $('.first_limit').text();
                        },
                        max_price: function () {
                            return $('.last_limit').text();
                        },
                    };
                    $.getJSON(arrowit_params.ajax_url + '?&action=arrowit_search', request_data, response);
                },
                appendTo: $this.parent(),
                autoFocus: true,
                delay: 500,
                minLength: 3,
                search: function (event, ui) {
                    $this.find('.searchsubmit .fa-search').removeClass('fa-search').addClass('fa fa-spin fa-refresh');
                },
                response: function (event, ui) {
                    $this.find('.searchsubmit .fa-spin').removeClass('fa fa-spin fa-refresh').addClass('fa fa-search');
                    $this.parent().toggleClass('s-no-result-found');

                    $this.parent().find('.search-no-results').remove();
                    $this.parent().append('<div class="search-no-results"><p>' + arrowit_params.arrowit_search_no_result + '</p></div>');
                }
            })._renderItem = function (ul, item) {
                $this.parent().find('.search-no-results').remove();
                var result = "<div class='search-content'>";
                if (item.imgsrc != '') {
                    result += "<div class='search-img'><a href='" + item.link + "'><img src='" + item.imgsrc + "' alt='' /></a></div>";
                }
                result += "<div class='search-info'>";
                result += "<a href='" + item.link + "'>" + item.label + "</a>";

                if (item.add_cart !== '' && item.add_cart !== 'undefined') {
                    result += "<div class='price'>" + item.add_cart + "</div>";
                }
                result += "</div>" + "</div>";
                return $("<li>")
                    .append(result)
                    .appendTo(ul);
            };
            $(this).find("input[name='s']").on('autocompleteselect', function (e, ui) {
                $this.parent().find('.ui-autocomplete').addClass('show');
                if ($this.find('input[name="post_type"]').val() != 'product') {
                    $this.parent().find('.ui-autocomplete').removeClass('show');
                }
            });
        });
        if ($('.category_dropdown ul.chosen-results li').length) {
            $('.category_dropdown ul.chosen-results li').each(function () {
                $(this).on("click", function () {
                    $(this).closest('.category_dropdown').find('.chosen-single').html('<span>' + $(this).text() + '</span><i class="fa fa-angle-down"></i>');
                    $(this).closest('form.woocommerce-product-search').find('input[name="product_cat"]').val($(this).data('val'));
                    $(this).closest('.category_dropdown').find('.chosen-single li').removeClass('active');
                    $(this).addClass('active');
                });
            });
        }
        /*********** Search ajax **********/
        $('.woocommerce-product-search').each(function () {
            var $_this = $(this);
            var $_input_search = $(this).find('.search-field');
            var $_search_result = $(this).find('.auto_ajax_search');
            var $_btn_search_sm = $('button[type="submit"] i');
            var myVar = false;
            $_input_search.keyup(function (e) {
                $_search_result.addClass('loading');
                $_btn_search_sm.addClass('fa fa-pulse fa-refresh');
                var search_val = $_input_search.val();
                var search_cat = $_this.find('input[name="product_cat"]').val();
                if (search_val.length > 2) {
                    myVar = setTimeout(
                        function () {
                            $.ajax({
                                url: arrowit_params.ajax_url,
                                type: "post",
                                data: {
                                    action: 'au_ajax_search_product',
                                    s: search_val,
                                    product_cat: search_cat
                                },
                                complete: function (response) {
                                    $_search_result.addClass('active');
                                    $_search_result.removeClass('loading');
                                    $_btn_search_sm.removeClass('fa fa-pulse fa-refresh');
                                },
                                success: function (response) {
                                    $_search_result.html(response);
                                }
                            });
                        },
                        500
                    );
                } else {
                    if (search_val == '') {
                        $_search_result.removeClass('loading');
                        $_search_result.html('');
                        $_btn_search_sm.removeClass('fa fa-pulse fa-refresh');
                    }
                    $_search_result.removeClass('active');
                    clearTimeout(myVar);
                }
            }).keyup(function (e) {
                $_search_result.removeClass('active');
                $_search_result.html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
                clearTimeout(myVar);
                var search_val = $_input_search.val();
                var search_cat = $_this.find('input[name="product_cat"]').val();
                if (search_val.length > 2) {
                    myVar = setTimeout(
                        function () {
                            $.ajax({
                                url: arrowit_params.ajax_url,
                                type: "post",
                                data: {
                                    action: 'au_ajax_search_product',
                                    s: search_val,
                                    product_cat: search_cat
                                },
                                complete: function (response) {
                                    $_search_result.addClass('active');
                                    $_search_result.removeClass('loading');
                                    $_btn_search_sm.removeClass('fa fa-pulse fa-refresh');
                                },
                                success: function (response) {
                                    $_search_result.html(response);
                                }
                            });
                        },
                        500
                    );
                } else {
                    if (search_val == '') {
                        $_search_result.removeClass('loading');
                        $_search_result.html('');
                        $_btn_search_sm.removeClass('fa fa-pulse fa-refresh');
                    }
                    clearTimeout(myVar);
                    $_search_result.removeClass('active');
                }
            });
        });
    }

    function arrowitCounter() {
        var i = '';
        var j = '';
        var counters = $(".count-content .count");
        var countersQuantity = counters.length;
        var counter = [];

        for (i = 0; i < countersQuantity; i++) {
            counter[i] = parseInt(counters[i].innerHTML);
        }

        var count = function (start, value, id) {
            var localStart = start;
            setInterval(function () {
                if (localStart < value) {
                    localStart++;
                    counters[id].innerHTML = localStart;
                }
            }, 40);
        }

        for (j = 0; j < countersQuantity; j++) {
            count(0, counter[j], j);
        }
    }

    function arrowitScrollBarTab() {
        $('.tabs-scroll .tabs-content-adv').slimScroll({
            alwaysVisible: true,
            railVisible: true,
            railColor: '#ffffff',
            railOpacity: '1',
            color: '#bfbfe5',
            distance: '0',
            height: '100%',
            borderRadius: '0',
            width: '100%',
            position: 'right',
            size: '5px',
            opacity: '1',
        });
    }

    // Woocommer
    function arowthemeWoocommerceAddCartAjaxMessage() {
        if ($('.add_to_cart_button').length !== 0 && $('#cart_added_msg_popup').length === 0) {
            var message_div = $('<div>')
                    .attr('id', 'cart_added_msg'),
                popup_div = $('<div>')
                    .attr('id', 'cart_added_msg_popup')
                    .html(message_div)
                    .hide();
            $('body').prepend(popup_div);
        }
    }

    function arrowitWoocommer() {
        // Redirect On off
        $('#woosearch-search').on('submit', function (e) {
            if ($(this).data('redirect') == 1) {
                e.preventDefault();
            }
        });
        if (arrowit_params.arrowit_woo_enable == 'yes') {
            //woocommerce
            $('body').on('added_to_cart', function (response) {
                $('body').trigger('wc_fragments_loaded');
            });
            //end ajax search

            arowthemeWoocommerceAddCartAjaxMessage();
            //Woocommerce update cart sidebar
            $('body').on('added_to_cart', function (response) {
                $('body').trigger('wc_fragments_loaded');
                $('ul.products li .added_to_cart').remove();
                var msg = $('#cart_added_msg_popup');
                $('.search-form').each(function () {
                    $(this).parent().find('.ui-autocomplete').removeClass('show');
                });
                $('#cart_added_msg').html(arrowit_params.ajax_cart_added_msg);
                msg.css('margin-left', '-' + $(msg).width() / 2 + 'px').fadeIn();
                window.setTimeout(function () {
                    msg.fadeOut();
                }, 2000);
            });

            // tabs
            $("form.cart").on("change", "input.qty", function () {
                $(this.form).find("button[data-quantity]").data("quantity", this.value);
            });

            /**page shop**/
            $('.list-view-as li').each(function () {
                $(this).find('a').on("click", function (e) {
                    e.preventDefault();
                    var data_show = $(this).data('layout');
                    var data_column = $(this).data('column');
                    var current_grid = $('.list-view-as li a.active').data('column');
                    if (data_show == 'layout-grid') {
                        $('ul.products').removeClass('columns-' + current_grid);
                        $('ul.products').addClass('columns-' + data_column);
                        $('ul.products').removeClass('product-list');
                        $('ul.products').addClass('product-grid');
                    } else if (data_show == 'layout-list') {
                        $('ul.products').removeClass('columns-' + current_grid);
                        $('ul.products').addClass('columns-' + data_column);
                        $('ul.products').removeClass('product-grid');
                        $('ul.products').addClass('product-list');
                    }
                    $('.list-view-as li a').removeClass('active');
                    $(this).addClass('active');
                    $('.products').find('>div').removeClass('active');
                    $('.products' + ' .' + data_show).addClass('active').fadeIn("slow");
                });
            });
            //quantily
            // Target quantity inputs on product pages
            $('input.qty:not(.product-quantity input.qty)').each(function () {
                var min = parseFloat($(this).attr('min'));

                if (min && min > 0 && parseFloat($(this).val()) < min) {
                    $(this).val(min);
                }
            });

            $(document).off('click', '.plus, .minus').on('click', '.plus, .minus', function () {
                // Get values
                var $qty = $(this).closest('.quantity').find('.qty'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = $qty.attr('step');

                // Format values
                if (!currentVal || currentVal === '' || currentVal === 'NaN')
                    currentVal = 0;
                if (max === '' || max === 'NaN')
                    max = '';
                if (min === '' || min === 'NaN')
                    min = 1;
                if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
                    step = 1;

                // Change the value
                if ($(this).is('.plus')) {

                    if (max && (max === currentVal || currentVal > max)) {
                        $qty.val(max);
                    } else {
                        $qty.val(currentVal + parseFloat(step));
                    }

                } else {

                    if (min && (min === currentVal || currentVal < min)) {
                        $qty.val(min);
                    } else if (currentVal > 0) {
                        $qty.val(currentVal - parseFloat(step));
                    }

                }

                // Trigger change event
                $qty.trigger('change');
            });

            // Viewby
            $('.woocommerce-viewing').off('change').on('change', 'select.count', function () {
                $(this).closest('form').submit();
            });

            // Single product
            $('.product-list-thumbnails img').on('click', function (e) {
                $('.woocommerce-product-gallery__image').trigger('zoom.destroy'); // remove zoom
            });
            $('.woocommerce-product-gallery__wrapper').on('afterChange', function (event, slick, currentSlide, nextSlide) {
                $('.slick-slide').removeClass('flex-active-slide');
                $("[data-slick-index='" + currentSlide + "']").addClass('flex-active-slide');
            });
            if ($('.product-detail').hasClass('single_3')) {
                var dot = true;
                var arrows = false;
                var arrowsthumb = true;
                var nextArrow = '<button class="btn-next">' + '<i class="' + arrowit_params.single_product_next + '"></i>' + '</button>';
                var prevArrow = '<button class="btn-prev">' + '<i class="' + arrowit_params.single_product_prev + '"></i>' + '</button>';
            }
            if ($('.main-sidebar').hasClass('col-xl-9')) {
                if ($('.product-detail').hasClass('single_3')) {
                    var slidesToShow = 2;
                } else {
                    var slidesToShow = 2;
                }
            } else {
                var slidesToShow = 3;
            }
            var $productGallery = $('.single-product .product-detail .woocommerce-product-gallery__wrapper'),
                $productGalleryThumb = $('.single-product .product-detail .product-list-thumbnails');
            if ($('.product-detail').hasClass('single_3')) {
                $productGallery.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: dot,
                    arrows: arrows,
                    nextArrow: nextArrow,
                    prevArrow: prevArrow,
                    infinite: true,
                    rtl: $rtl,
                    asNavFor: $productGalleryThumb
                });
                $productGalleryThumb.slick({
                    slidesToShow: slidesToShow,
                    slidesToScroll: 1,
                    nextArrow: nextArrow,
                    prevArrow: prevArrow,
                    dots: false,
                    arrows: arrowsthumb,
                    focusOnSelect: true,
                    infinite: true,
                    centerMode: false,
                    speed: 300,
                    rtl: $rtl,
                    asNavFor: $productGallery,
                    responsive: [
                        {
                            breakpoint: 1200,
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
                                slidesToShow: 2,
                            }
                        }
                    ]
                });
            }
        }
        $(document).on('added_to_wishlist removed_from_wishlist', function () {
            var counter = $('.ajax-wishlist');
            $.ajax({
                url: yith_wcwl_l10n.ajax_url,
                data: {
                    action: 'yith_wcwl_update_wishlist_count'
                },
                dataType: 'json',
                success: function (data) {
                    counter.html(data.count);
                },
                beforeSend: function () {
                    counter.block();
                },
                complete: function () {
                    counter.unblock();
                }
            })
        });
        $('.yith-woocompare-widget .clear-all').on('click', function () {
            if ($('.compare_product .add_to_compare').hasClass('added')) {
                $('.compare_product .add_to_compare').addClass('removed');
            } else {
                $('.compare_product .add_to_compare').removeClass('removed');
            }
        });

        if ($('.single-product .container .main-sidebar').hasClass('has-sidebar')) {
            var slidesToShowProduct = 3;
        } else {
            var slidesToShowProduct = arrowit_params.single_per_limit;
        }

        $('.related .products, .up-sells .products, .cross-sells .products').slick({
            slidesToShow: slidesToShowProduct,
            slidesToScroll: 1,
            arrows: true,
            nextArrow: '<button class="btn-next"><i class="fa fa-arrow-right"></i></button>',
            prevArrow: '<button class="btn-prev"><i class="fa fa-arrow-left"></i></button>',
            fade: false,
            rtl: $rtl,
            infinite: true,
            variableWidth: false,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                    }
                },

                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
        $('.cate-archive').slick({
            nextArrow: '<button class="btn-next"><i class="icon-next4"></i></button>',
            prevArrow: '<button class="btn-prev"><i class="icon-back3"></i></button>',
            slidesToShow: arrowit_params.arrowit_number_cate,
            slidesToScroll: 1,
            rtl: $rtl,
            dots: false,
            arrows: true,
            infinite: true,
            speed: 300,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }

    function arrowitLoadMore() {
        var $j = jQuery.noConflict();
        var $container = $j('.load-item');
        var i = 1;
        var paged = $('.load_more_button').data('data-paged');
        var page = paged ? paged + 1 : 2;
        $j('.load_more_button a').off('click tap').on('click tap', function (e) {
            e.preventDefault();
            var el = $(this);
            $j('.load_more_button a').after('<span class="theme-icon-loading2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span></span>');
            el.addClass('hide-loadmore');
            var link = $j(this).attr('href');
            var $content = '.load-item';
            var $anchor = '.load_more_button a';
            var $next_href = $j($anchor).attr('href');
            $j.get(link + '', function (data) {
                $j('.load_more_button').find('.theme-icon-loading2').remove();
                el.removeClass('hide-loadmore');
                var $new_content = $j($content, data).wrapInner('').html();
                $next_href = $j($anchor, data).attr('href');
                if ($('.blog-entries-wrap').hasClass('blog-masonry')) {
                    $container.isotope({
                        itemSelector: '.item',
                        layoutMode: 'masonry',
                        getSortData: {
                            name: '.item'
                        }
                    });
                } else {
                    $container.isotope({
                        itemSelector: '.item',
                        layoutMode: 'fitRows',
                        getSortData: {
                            name: '.item'
                        }
                    });
                }
                $container.append($new_content).isotope('reloadItems').isotope({sortBy: 'original-order'});

                setTimeout(function () {
                    $j('.load-item').isotope('layout');
                }, 400);

                if ($j('.load_more_button').attr('rel') > i) {
                    $j('.load_more_button a').attr('href', $next_href); // Change the next URL
                } else {
                    $j('.load_more_button').remove();
                }

                $('.item-page'+i).each( function() {
                    var id = $(this).find('.blog-img').attr('id');
                    $('#'+id+'.blog-gallery').slick({
                        dots: true,
                        arrows: true,
                        nextArrow: '<button class="btn-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
                        prevArrow: '<button class="btn-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                        rtl:$rtl,
                        infinite: true,
                        autoplay: false,
                        autoplaySpeed: 2000,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    });
                    var portfolio = $(this).find('.single-delivery').attr('id');
                    $('#'+portfolio+' .portfolio-gallery').slick({
                        dots: true,
                        arrows: false,
                        rtl:$rtl,
                        infinite: true,
                        autoplay: false,
                        autoplaySpeed: 2000,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    });
                });
            });
            i++;
        });
    }

    function arrowitGallerySlider(page) {
        $('.item').each( function() {
            var id = $(this).find('.blog-img').attr('id');
            $('#'+id+'.blog-gallery').slick({
                dots: true,
                arrows: true,
                nextArrow: '<button class="btn-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
                prevArrow: '<button class="btn-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                rtl:$rtl,
                infinite: true,
                autoplay: false,
                autoplaySpeed: 2000,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        });
        $('.item-page' + page).each(function () {
            if ($(this).find('.blog-img').hasClass('blog-gallery')) {
                var id = $(this).find('.blog-img').attr('id');
                $('#' + id).slick({
                    dots: true,
                    arrows: true,
                    prevArrow: '<button class="btn-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>',
                    nextArrow: '<button class="btn-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>',
                    rtl: $rtl,
                    infinite: true,
                    autoplay: false,
                    autoplaySpeed: 2000,
                    slidesToShow: 1,
                    slidesToScroll: 1
                });
            }
        });
        if ($('.blog-img').hasClass('blog-gallery')) {
            $('.blog-shortcode .blog-gallery').slick({
                dots: true,
                arrows: true,
                prevArrow: '<button class="btn-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>',
                nextArrow: '<button class="btn-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>',
                rtl: $rtl,
                infinite: true,
                autoplay: false,
                autoplaySpeed: 2000,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        }
    }

    function arrowitPostGallery() {
        $('.slide-icon-box .elementor-widget-wrap ').slick({
            dots: true,
            arrows: false,
            rtl: $rtl,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 2000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
        $('.slider-price .elementor-widget-wrap ').slick({
            dots: true,
            arrows: false,
            rtl: $rtl,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 2000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
        $('.blog-gallery-single').slick({
            dots: true,
            arrows: true,
            nextArrow: '<button class="slick-next"></button>',
            prevArrow: '<button class="slick-prev"></button>',
            rtl: $rtl,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 2000,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                       arrows: false,
                    }
                }
            ]
        });
        $('.portfolio-single .portfolio-gallery-single').slick({
            dots: true,
            arrows: true,
            prevArrow: '<button class="btn-prev"><i class="fa fa-caret-left"></i></button>',
            nextArrow: '<button class="btn-next"><i class="fa fa-caret-right"></i></button>',
            rtl: $rtl,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 400,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
        $(".view_detail_portfolio").on('click', function () {
                $('.delivery-return .portfolio-gallery').not('.slick-initialized').slick({
                    dots: true,
                    arrows: true,
                    prevArrow: '<button class="btn-prev"><i class="fa fa-caret-left"></i></button>',
                    nextArrow: '<button class="btn-next"><i class="fa fa-caret-right"></i></button>',
                    rtl: $rtl,
                    infinite: true,
                    autoplay: false,
                    autoplaySpeed: 2000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 400,
                            settings: {
                                slidesToShow: 1,
                            }
                        }
                    ]
                });
        });
        $('.blog-gallery2').slick({
            dots: false,
            arrows: true,
            prevArrow: '<button class="btn-prev"><span class="fa fa-angle-left"></span></button>',
            nextArrow: '<button class="btn-next"><span class="fa fa-angle-right"></span></button>',
            rtl: $rtl,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 2000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
        $('.blog-slide').slick({
            dots: false,
            arrows: true,
            nextArrow: '<button class="btn-next">next&nbsp;<span class="icon-right-arrow"></span></button>',
            prevArrow: '<button class="btn-prev"><span class="icon-left-arrow"></span>&nbsp;previous</button>',
            rtl: $rtl,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 2000,
            slidesToShow: 2,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 586,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }

    function arrowitTestimonial() {
        jQuery(document).ready(function ($) {
            $('.testimonial-box .testimonial-image').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.testimonial-box .testimonial-content',
                dots: false,
                rtl: $rtl,
                centerPadding: '0px',
                focusOnSelect: true,
                centerMode: true,
                infinite: true,
                arrows: false,
                variableWidth: true,
            });
        });
        jQuery(document).ready(function ($) {
            $('.testimonial-box  .testimonial-content').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                rtl: false,
                centerMode: true,
                asNavFor: '.testimonial-box  .testimonial-image',
                dots: true,
                arrows: false,
                nextArrow: '<button class="btn-next"><i class="icon-next4"></i></button>',
                prevArrow: '<button class="btn-prev"><i class="icon-back3"></i></button>',
                autoplay: true,
                infinite: true,
                autoplaySpeed: 5000,
                speed: 500,
                pauseOnHover: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    },
                ]

            });
        });
    }

    //Filter Isotop Window Load
    function arrowitFilterIsotopLoad() {
        var $grid = $('.isotope');
        var container = $('.isotope').isotope({
            itemSelector: '.item',
            layoutMode: 'fitRows',
            getSortData: {
                name: '.item'
            }
        });
        var container = $('.product-packery .product-grid').isotope({
            itemSelector: '.item',
            layoutMode: 'masonry',
            getSortData: {
                name: '.item'
            }
        });
        $('.btn-filter').each(function (i, buttonGroup) {
            var filterLoadValue = $(this).find('.active').attr('data-filter');
            container.isotope({filter: filterLoadValue});
        });
        $('.blog-masonry').masonry({
            itemSelector: '.item',
            percentPosition: true
        });


        $('.btn-filter').on('click', '.button', function () {
            var filterValue = $(this).attr('data-filter');
            container.isotope({filter: filterValue});
        });
        $('.btn-filter').each(function (i, buttonGroup) {
            var buttonGroup = $(buttonGroup);
            buttonGroup.on('click', '.button', function () {
                buttonGroup.find('.active').removeClass('active');
                $(this).addClass('active');
            });
        });

        var container = $('.product-packery .product-grid').isotope({
            itemSelector: '.item',
            layoutMode: 'masonry',
            getSortData: {
                name: '.item'
            }
        });
    }

    // Srcoll Top
    function arrowitScrollTop() {
        if ($('.scroll-to-top').length) {
            $(window).scroll(function () {
                if ($(this).scrollTop() > $('#page:not(.fixed-header) .site-header').height() + 40) {
                    if ($('header').hasClass('header-bottom')) {
                        $('.scroll-to-top').css({bottom: "90px"});
                    } else {
                        $('.scroll-to-top').css({bottom: "54px"});
                    }
                    if ($(window).width() < 991) {
                        $('.scroll-to-top').css({bottom: "100px"});
                    }
                } else {
                    $('.scroll-to-top').css({bottom: "-100px"});
                }
            });

            $('.scroll-to-top').on('click', function () {
                $('html, body').animate({scrollTop: '0px'}, 800);
                return false;
            });
        }
        if (arrowit_params.coming_subcribe_text) {
            if (arrowit_params.coming_subcribe_text.trim() && arrowit_params.coming_subcribe_text.length > 0) {
                $('.page-coming-soon .mc4wp-form input[type="submit"]').attr("value", arrowit_params.coming_subcribe_text);
            }
        }
    }

    function arrowitComingSoonCountdown() {
        if (arrowit_params.coming_soon_countdown) {
            $("#clock_coming_soon").countdown(arrowit_params.coming_soon_countdown, function (event) {
                $(this).html(event.strftime(''
                    + '<div class="countdown-section"><div class="countdown-number"><span>%D</span></div><div class="countdown-label">Days</div></div>'
                    + '<div class="countdown-section"><div class="countdown-number"><span>%H</span></div><div class="countdown-label">Hours</div></div>'
                    + '<div class="countdown-section"><div class="countdown-number"><span>%M</span></div><div class="countdown-label">Minutes</div></div>'
                    + '<div class="countdown-section"><div class="countdown-number"><span>%S</span></div><div class="countdown-label">Seconds</div></div>'));
            });
        }
    }

    // Sticky Menu
    function arrowitStickyMenu() {
        var header_wp = $(".site-header");
        var header_sticky = $(".header-sticky");
        var menuH = header_wp.outerHeight() + 200;
        var current = 0;
        $(window).scroll(function () {
            if ($(this).scrollTop() <= menuH) {
                header_sticky.removeClass('is-sticky hidden-menu');
                $body.removeClass('enable-sticky')
            } else {
                var next = $(this).scrollTop();
                if ((current - next) > 0) {
                    header_sticky.addClass('is-sticky').removeClass('hidden-menu');
                    $body.addClass('enable-sticky')
                } else {
                    header_sticky.removeClass('is-sticky').addClass('hidden-menu');
                    $body.removeClass('enable-sticky')
                }
                current = next;
            }
        });
        var header_scroll = $(".header-scroll");
        var slider_scroll = $('.slider-scroll').height();
        $(window).scroll(function () {
            if ($(window).scrollTop() > slider_scroll + 20) {
                header_scroll.addClass("sticky");
                $body.addClass('enable-sticky')
            } else {
                header_scroll.removeClass("sticky");
                $body.removeClass('enable-sticky')
            }
        });
    }
    // Megamenu
    function arrowitMegamenu() {
        var headerH = $(".site-header").height();
        var megamenu_sub = $(".megamenu_sub");
        var megamenu_subH = megamenu_sub.height();
        var height = $(window).height();
        if (((megamenu_subH + headerH) >= height) && $(window).width() > 1024) {
            var megamenuH = height - headerH;
            megamenu_sub.css({
                'height': megamenuH
            });

            $('.megamenu-content').slimScroll({
                alwaysVisible: true,
                railVisible: true,
                railColor: '#f0f1f0',
                distance: '0',
                height: '100%',
                width: '100%',
                position: 'right', size: '5px',
            });
        }
    }

    // Function Click
    function arrowitClick() {
        // toggle class to body to show/hide account popup's bg
        $('.site-header-account a,.account-header a').on('click', function () {
            if (!$('body').hasClass('show-bg-fancybox')) {
                $('body').addClass('show-bg-fancybox');
            }
        });

        //portfolio
        $('.post-type-archive-portfolio .tabs-fillter .button').on('click', function () {
            $('.pagination-content').css({
                "display": 'none',
            });
            $('.load-item').css({
                "margin-bottom": 80+ 'px',
            });
        });
        $('.post-type-archive-portfolio .tabs-fillter .filtrerall').on('click', function () {
            $('.pagination-content').css({
                "display": 'block',
            });
            $('.load-item').css({
                "margin-bottom": 0,
            });
        });

        //portfolio_cat
        $('.tax-portfolio_cat .tabs-fillter .button').on('click', function () {
            $('.pagination-content').css({
                "display": 'none',
            });
            $('.load-item').css({
                "margin-bottom": 80+ 'px',
            });
        });
        $('.tax-portfolio_cat .tabs-fillter .filtrerall').on('click', function () {
            $('.pagination-content').css({
                "display": 'block',
            });
            $('.load-item').css({
                "margin-bottom": 0,
            });
        });

        // filter items on button click Gallery
        var $gridGallery = $('.isotope');
        $('.button-group').on('click', 'button', function () {
            var filterValueGallery = $(this).attr('data-filter');
            $gridGallery.isotope({filter: filterValueGallery});
            $('.button-group button').removeClass('is-checked');
            $(this).addClass('is-checked');
        });

        // filter items on button click Blog
        var $grid = $('.grid-isotope');
        $('.button-group').on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({filter: filterValue});
            $('.button-group button').removeClass('is-checked');
            $(this).addClass('is-checked');
        });

        $('.cate-menu .title-cate').on('click', function () {
            $(this).toggleClass('active');
            $('.header-menu .cate-menu .product-categories').slideToggle();
        });

        $(".cart_label").on('click', function (event) {
            event.preventDefault();
        });

        $(".thumbs_list a.view-img").on('click', function (event) {
            event.preventDefault();
        });
        $('.mobile-tool .cart_label').on('click', function (e) {
            $('.mobile-tool .cart-block').slideToggle();
        });

        $(".select-cate").on('click', function () {
            $(".category-list").toggleClass("active");
        });
        $('.toggle-contact').on('click', function () {
            $(this).toggleClass('active');
            if ($('.humburger-content.contact-info').hasClass('active')) {
                $('.humburger-content.contact-info').removeClass('active');
            } else {
                $('.humburger-content.contact-info').addClass('active');
            }
        });
        var wdw = $(window).width();
        if (wdw > 767) {
            var widthformAll = $(".widget_mc4wp_form_widget:not(.add-socia)").width();
            $('#btn-show-social').on('click', function () {
                if ($('.list-social').hasClass('show')) {
                    $('.list-social').removeClass('show');
                } else {
                    $('.list-social').addClass('show');
                }
                if ($('.widget_mc4wp_form_widget').hasClass('add-social')) {
                    $('.widget_mc4wp_form_widget').removeClass('add-social');
                    $('.widget_mc4wp_form_widget').css({
                        "width": 100 + "%"
                    });
                } else {

                    $('.widget_mc4wp_form_widget').addClass('add-social');
                    var widthListsocial = $('.social-footer').width();
                    $('.widget_mc4wp_form_widget.add-social').css({
                        "width": widthformAll - widthListsocial + 'px'
                    });
                }
            });
        }

    }

    // Submenu hover left
    function arrowitFixSubMenu() {
        $('.mega-menu > li:not(.megamenu)').mouseover(function () {
            var wapoMainWindowWidth = $(window).width();
            // checks if third level menu exist
            var subMenuExist = $(this).children('.sub-menu').length;
            if (subMenuExist > 0) {
                var subMenuWidth = $(this).children('.sub-menu').width();
                var subMenuOffset = $(this).children('.sub-menu').parent().offset().left + subMenuWidth;
                // if sub menu is off screen, give new position
                if ((subMenuOffset + subMenuWidth + 50) > wapoMainWindowWidth) {
                    var newSubMenuPosition = subMenuWidth;
                    $(this).addClass('left_side_menu');
                } else {
                    var newSubMenuPosition = subMenuWidth;
                    $(this).removeClass('left_side_menu');
                }
            }
        });
    }

    // Search, cart click body remove
    function arrowitRemoveActive() {
        $(".select-cate").on('click', function (e) {
            e.stopPropagation();
        });
        $('body').on('click', function (e) {
            if (!$(e.target).is('.category-list, .category-list *')) {
                $(".category-list").removeClass('active');
            }
        });
        if ($(window).width() < 992) {
            $(".cart-header .cart_label").on('click', function (e) {
                e.stopPropagation();
            });

            $('body').on('click', function (e) {
                if (!$(e.target).is('.content-filter, .content-filter *')) {
                    $(".content-filter").removeClass('active');
                }
            });
        }
    }

    // Fillter Isotop
    function arrowitFillterIsotop() {
        var filterValue = $('.active_cat').attr('data-filter');
        var container = $('.isotope').isotope({
            itemSelector: '.item',
            filter: filterValue,
            layoutMode: 'fitRows',
            getSortData: {
                name: '.item'
            }
        });
        $('.btn-filter').on('click', '.button', function () {
            var filterValue = $(this).attr('data-filter');
            container.isotope({filter: filterValue});
        });
        $('.btn-filter').each(function (i, buttonGroup) {
            var buttonGroup = $(buttonGroup);
            buttonGroup.on('click', '.button', function () {
                buttonGroup.find('.active').removeClass('active');
                $(this).addClass('active');
            });
        });
    }

    // Fix Height Content
    function arrowitHeightContent() {
        // Fix Height Blog
        var wdw = $(window).width();
        var widthInstagram = $('.footer-instagram .widget.instagram .instagram-gallery .instagram-img').width();
        $('.footer-instagram .widget.instagram .instagram-gallery .instagram-img').css('height', widthInstagram + 'px');
        var widthInstagram1 = $('.footer-top .widget.instagram .instagram-gallery .instagram-img').width();
        $('.footer-top .widget.instagram .instagram-gallery .instagram-img').css('height', widthInstagram1 + 'px');
        var widthInstagram2 = $('.active-sidebar .widget.instagram .instagram-gallery .instagram-img').width();
        $('.active-sidebar .widget.instagram .instagram-gallery .instagram-img').css('height', widthInstagram2 + 'px');


        var heightHeader = $('.site-header').height();
        var heightFooter = $('footer').height();
        if ($(window).width() < 992) {
            if ($('.site-header').hasClass('header-bottom')) {
                $('footer').css('margin-bottom', heightHeader + 'px');
            }
        }
        if ($(window).width() > 767) {
            if ($('#page').hasClass('footer-fixed')) {
                $('#page').css('margin-bottom', heightFooter + 'px');
            }
        }

        // Fix Height menu vertical
        var height = $(window).height();
        var width = $(window).width();
        var heightNav = $('.header-sidebar').height();
        var heightNavMenu = $('.mega-menu').height();
        if (heightNav > height) {
            $('.header-ver').addClass('header-scroll');
        }
        if (width < 992) {
            if (heightNavMenu > height) {
                $('.header-center').addClass('header-scroll');
            }
        }
        $(window).resize(function () {
            var widthInstagram = $('.footer-instagram .instagram-img').width();
            $('.footer-instagram .instagram-img').css('height', widthInstagram + 'px');
        });

    }

    // Menu
    function arrowitMenu() {
        $(".mega-menu .caret-submenu, .nav-menu-mobile .caret-submenu").on('click', function (e) {
            $(this).toggleClass('active');
            $(this).siblings('.sub-menu').toggle(300);
            $(this).siblings('.megamenu_sub').toggle(300);
            $(this).parent().toggleClass('sub-menu-active');
        });

        $('ul.mega-menu > li.megamenu .menu-bottom').hide();
        $('ul.mega-menu > li.megamenu .menu-bottom').each(function () {
            var className = $(this).parent().parent().attr('id');
            if ($(this).hasClass(className)) {
                $(this).show();
            }
        });

        //Add class category
        $('.widget_categories ul').each(function () {
            if ($(this).hasClass('children')) {
                $(this).parent().addClass('cat-item-parent');
            }
        });

        var $title_box_shipping = $(".box-shipping .title-hdwoo");
        $title_box_shipping.on('click', function () {
            var $div_shipping = $(".box-shipping .form-shipping-cs");
            if ($div_shipping.is(':hidden') === true) {

                $div_shipping.slideDown();
                $title_box_shipping.find('span').remove();
                $title_box_shipping.append('<span class= "fa fa-angle-up"></span>');
                $(this).find('span').remove();
                $(this).append('<span class= "fa fa-angle-down"></span>');
            } else {
                $div_shipping.slideUp();
                $(this).find('span').remove();
                $(this).append('<span class= "fa fa-angle-up"></span>');
            }
        });

        // Menu Category Sidebar
        $("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > a");
        var $p = $(".widget_product_categories ul.product-categories > li p");
        $(".widget_product_categories ul.product-categories > li:not(.current-cat):not(.current-cat-parent) p").append('<span class= "fa fa-angle-down"></span>');
        $(".widget_product_categories ul.product-categories > li.current-cat p").append('<span class= "fa fa-angle-down"></span>');
        $(".widget_product_categories ul.product-categories > li.current-cat-parent p").append('<span class= "fa fa-angle-down"></span>');
        $(".widget_product_categories ul.product-categories > li:not(.current-cat):not(.current-cat-parent) > ul").hide();

        $(".widget_product_categories ul.product-categories > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }

        });

        $p.on('click', function () {
            var $accordion = $(this).nextAll('ul');

            if ($accordion.is(':hidden') === true) {

                $(".widget_product_categories ul.product-categories > li > ul").slideUp();
                $accordion.slideDown();

                $p.find('span').remove();
                $p.append('<span class= "fa fa-angle-down"></span>');
                $(this).find('span').remove();
                $(this).append('<span class= "fa fa-angle-up"></span>');
            }else {
                $accordion.slideUp();
                $(this).find('span').remove();
                $(this).append('<span class= "fa fa-angle-down"></span>');
            }
        });

        // Menu Lever 2
        $("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > ul > li > a");
        var $pp = $(".widget_product_categories ul.product-categories > li > ul > li p");
        $(".widget_product_categories ul.product-categories > li >ul >li > ul").hide();
        $(".widget_product_categories ul.product-categories > li > ul > li p").append('<span class= "fa fa-angle-down"></span>');

        $(".widget_product_categories ul.product-categories > li > ul > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }
        });

        $pp.on('click', function () {
            var $accordions = $(this).nextAll('ul');

            if ($accordions.is(':hidden') === true) {

                $(".widget_product_categories ul.product-categories > li > ul > li > ul").slideUp();
                $accordions.slideDown();

                $pp.find('span').remove();
                $pp.append('<span class= "fa fa-angle-down"></span>');
                $(this).find('span').remove();
                $(this).append('<span class= "fa fa-angle-up"></span>');
            } else {
                $accordions.slideUp();
                $(this).find('span').remove();
                $(this).append('<span class= "fa fa-angle-down"></span>');
            }
        });

        // Menu Lever 3
        $("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > ul > li > ul > li > a");
        var $ppp = $(".widget_product_categories ul.product-categories > li > ul > li > ul > li p");
        $(".widget_product_categories ul.product-categories > li > ul > li > ul > li > ul").hide();
        $(".widget_product_categories ul.product-categories > li > ul > li > ul > li p").append('<span class= "fa fa-angle-down"></span>');

        $(".widget_product_categories ul.product-categories > li > ul > li > ul > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }
        });

        $ppp.on('click', function () {
            var $accordions = $(this).nextAll('ul');

            if ($accordions.is(':hidden') === true) {

                $(".widget_product_categories ul.product-categories > li > ul > li > ul > li > ul").slideUp();
                $accordions.slideDown();

                $ppp.find('span').remove();
                $ppp.append('<span class= "fa fa-angle-down"></span>');
                $(this).find('span').remove();
                $(this).append('<span class= "fa fa-angle-up"></span>');
            } else {
                $accordions.slideUp();
                $(this).find('span').remove();
                $(this).append('<span class= "fa fa-angle-down"></span>');
            }
        });
        // Categories Blog Sidebar
        $('.widget.widget_categories .cat-item-parent > a, .widget_pages .page_item_has_children > a, .widget.widget_nav_menu .menu-item-has-children > a').after('<i class="fas fa-angle-right"></i>');
        $('.widget.widget_categories .cat-item-parent i, .widget.widget_pages .page_item_has_children i,  .widget.widget_nav_menu .menu-item-has-children i').on("click", function () {
            $(this).toggleClass('fa-angle-down');
            $(this).parent().find('> .children').toggleClass('opening');
            $(this).parent().find('> .sub-menu').toggleClass('opening');
        })

        // Vertical Menu
        var $bdy = $('html');
        if ($('.site-header').hasClass('header-02')) {
            $('html').addClass('page-overlay');
        }
        $('.menu-icon').on('click', function (e) {
            $('.overlay').addClass('overlay-menu');
            if ($bdy.hasClass('openmenu')) {
                jsAnimateMenu2('close');
            } else {
                jsAnimateMenu2('open');
            }
        });
        $('.close-menu-mobile').on('click', function (e) {
            if ($bdy.hasClass('openmenu')) {
                jsAnimateMenu2('close');
                if ($('.site-header').hasClass('header-02')) {
                    jsAnimateMenu1('close');
                }
            } else {
                jsAnimateMenu2('open');
            }
        });

        $('a[href$="#"]').on('click', function (e) {
            e.preventDefault();
        });

        $('.overlay').on('click', function () {
            if ($('html').hasClass('openmenu')) {
                jsAnimateMenu2('close');
                if ($('.site-header').hasClass('header-02')) {
                    jsAnimateMenu1('close');
                }
            }
        });
    }

    function arrowitHumburgerMenu() {
        $('.btn-humburger').on('click', function (e) {
            e.preventDefault();
            $('html').addClass('side-humburger_menu-active');
        });
        $('.close-humburger-menu, .overlay').on('click', function () {
            $('html').removeClass('side-humburger_menu-active');
        });

        var swiper = new Swiper('.humburger-menu .swiper-container', {
            direction: 'vertical',
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: '.swiper-scrollbar',
            },
            mousewheel: true,
        });
        if ($('.humburger-menu .swiper-scrollbar').css('display') == 'none') {
            $('.humburger-content').addClass('remove-scroll');
        } else {
            $('.humburger-content').removeClass('remove-scroll');
        }
    }

    //Tooltip
    function arrowitTooltip() {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // Preloader
    function arrowitPreloader() {
        $('.preloader').fadeOut(500,function(){$(this).remove();});
    }

    // FancyBox
    function arrowitFancyBox() {
        $('.menu_open_box > a').fancybox({});
        $('.fancybox-link').fancybox({});
        $('img').on('hover', function (e) {
            $(this).data("title", $(this).attr("title")).removeAttr("title");
        });
        $('.iframe_fancybox').fancybox({
            maxWidth: 800,
            maxHeight: 600,
            fitToView: false,
            width: '70%',
            height: '70%',
            autoSize: false,
            closeClick: false,
            openEffect: 'elastic',
            closeEffect: 'none'
        });
        // Choose what buttons to display by default
        $.fancybox.defaults.buttons = [
            'slideShow',
            'fullScreen',
            'thumbs',
            'close'
        ];
        $('[data-fancybox]').fancybox({
            preload: "auto",
            thumbs: {
                autoStart: true
            },
            touch: false,
            afterClose: function () {
                if ($('body').hasClass('show-bg-fancybox')) {
                    $('body').removeClass('show-bg-fancybox');
                }
            }
        });


        if (arrowit_params.arrowit_woo_enable == 'yes') {
            $(".fancybox-zoomcontainer").fancybox({
                helpers: {
                    title: {
                        type: 'inside'
                    },
                    buttons: {},
                    thumbs: {
                        width: 50,
                        height: 50
                    }
                },
                afterShow: function () {
                    $('.zoomContainer').remove();
                    $('img.fancybox-image').elevateZoom({
                        zoomType: "inner",
                        cursor: "crosshair",
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 750
                    });
                },
                afterClose: function () {
                    $('.zoomContainer').remove();
                    $('img.zoom').elevateZoom({
                        zoomType: "inner",
                        cursor: "crosshair",
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 750
                    });
                }
            });
        }
    }

    //Validate Form
    function arrowitValidateForm() {
        if (arrowit_params.arrowit_valid_form == 'yes') {
            $('#commentform').validate();
        }
    }

    //Animation

    function arrowitAnimation() {
        if ($(window).width() > 991) {
            var wow = new WOW({
                mobile: false
            });
            wow.init();
        }
        if ($(window).width() < 767) {
            $('div').removeClass('tm-animation');
        }
        
        $('.animated').appear(function () {
            var el     = $(this),  
            newone = el.clone(true);             
            el.before(newone);               
            el.remove();
        });
    }

    //One Page
    function arrowitOnePage() {
        $('ul.mega-menu > li > a[href*="#"]:not([href="#"]), .site-header .mega-menu .children li a[href*="#"]:not([href="#"])').on('click', function () {
            $('ul.mega-menu > li > a[href*="#"]:not([href="#"]), .site-header .mega-menu .children li a[href*="#"]:not([href="#"])').removeClass('active');
            $(this).addClass('active');
            $('html').removeClass('openmenu');
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                || location.hostname == this.hostname) {
                var target = $(this.hash),
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - 20
                    }, 500);
                    return false;
                }
            }
        });
    }

    // Fix Height Content
    function arrowitHeightContentResize() {
        var h = $(window).height();
        var heightHeader = $('.site-header').height();
        var heightFooter = $('footer').height();
        var widthInstagram = $('.footer-instagram .widget.instagram .instagram-gallery .instagram-img').width();
        $('.footer-instagram .widget.instagram .instagram-gallery .instagram-img').css('height', widthInstagram + 'px');
        var widthInstagram1 = $('.footer-top .widget.instagram .instagram-gallery .instagram-img').width();
        $('.footer-top .widget.instagram .instagram-gallery .instagram-img').css('height', widthInstagram1 + 'px');
        var widthInstagram2 = $('.active-sidebar .widget.instagram .instagram-gallery .instagram-img').width();
        $('.active-sidebar .widget.instagram .instagram-gallery .instagram-img').css('height', widthInstagram2 + 'px');
        var wdw = $(window).width();
        if ($(window).width() < 992) {
            if ($('.site-header').hasClass('header-bottom')) {
                $('footer').css('margin-bottom', heightHeader + 'px');
            }
        }
        if ($(window).width() > 767) {
            if ($('#page').hasClass('footer-fixed')) {
                $('#page').css('margin-bottom', heightFooter + 'px');
            }
        }
        // Fix height header vertical
        var height = $(window).height();
        var width = $(window).width();
        var heightNav = $('.header-sidebar').height();
        var heightNavMenu = $('.mega-menu').height();

        if (heightNav > height) {
            $('.header-ver').addClass('header-scroll');
        }
        if (width < 992) {
            if (heightNavMenu > height) {
                $('.header-center').addClass('header-scroll');
            }
        }
        // Fix Height Category Menu Home 1
        var heightSliderHomeResize = $('.slider-home .rev_slider_wrapper').height();
        if ($(window).width() > 991) {
            $('.wpb_text_column .product-categories').css('height', heightSliderHomeResize + 'px');
        }
    }

    // Sticky Sidebar For Single Product Layout 4
    function arrowitStickySidebar() {
        if ($('.single_product_4 .info').length > 0) {
            $('.single_product_4 .info').stick_in_parent({offset_top: 100});
        }
    }

    function arrowitInsertTags() {
        $('.blog.post-single .commentform .form-submit .btn-primary').after('<i class="fas fa-long-arrow-alt-right"></i>');
        $('.page .commentform .form-submit .btn-primary').after('<i class="fas fa-long-arrow-alt-right"></i>');
        $('.single-product .comment-form .form-submit .btn-primary').after('<i class="fas fa-long-arrow-alt-right"></i>');
        $('.footer-01 .footer-mailchimp ').append('<button id="open-newsletter" class="btn-highlight btn-type-1 btn open-newsletter">Newsletters&nbsp;<i class="fas fa-long-arrow-alt-right"></i></button>');
        $('.footer-01 .footer-mailchimp .mc4wp-form-fields').append('<span id="close-newsletter" class="close-newsletter">&times;</span>');
        $(window).load(function () {
            $(".open-newsletter").on('click', function () {
                $('.mc4wp-form').show();
            });

            $('.close-newsletter').on('click', function () {
                $('.mc4wp-form').hide();
            });
        });
        $('.comment-item').each(function () {
            var container = $(this);
            container.find('.wpulike.wpulike-default ').appendTo(container.find('.comment-actions'));

        })
        if ($('.elementor-toggle-icon').hasClass('elementor-toggle-icon-left')) {
            $('.elementor-toggle').addClass('elementor-toggle-left');
        }
        if ($('.elementor-toggle-icon').hasClass('elementor-toggle-icon-right')) {
            $('.elementor-toggle').addClass('elementor-toggle-right');
        }
    }

    // Search box
    function arrowitSearchBox() {

        $('.toggle-search').on('click', function (e) {
            e.preventDefault();
            $('.search-box').slideToggle();
        });

        $('#page').on('click', '.close-search-box', function () {
            $('.search-box').slideToggle();
        });

        $('.menu-mobile').on('click', '.mobile-tool .account-header > a', function () {
            $('.account-header ul.content-filter').slideToggle();
        });

        $('.mobile-tool-right .lang-1').on('click', function () {
            $('.mobile-tool-right .content-filter').slideToggle();
        });
        $(".product-number > .arrow-item").on("click", function () {
            $('#order_review tbody').slideToggle();
            $(this).toggleClass("active");
        });
        $(".btn-menu-cv").on("click", function () {
            $('.menu-mobile-cv').slideToggle();
        });
    }

    function arrowitPopupLogin() {
        //Add view password into checkbox field
        $('.login-password').append('<span class="show_pass"><i class="fa fa-eye"></i></span>');
        $(document).on('click', '.show_pass', function () {
            var el = $(this),
                account_pass = el.parents('.login-password').find('>input');
            if (el.hasClass('active')) {
                account_pass.attr('type', 'password');
            } else {
                account_pass.attr('type', 'text');
            }
            el.toggleClass('active');
        });
    }

    function arrowitHandlerPageNotFound() {
        var height = $(window).height();
        var width = $(window).width();
        var page_cm = $('#page').find('.coming-soon-container');
        var page_404 = $('.error-page');
        var h_content = $('.coming-soon').height();
        var h_content_404 = $('.page-content-404').height();
        if (height <= h_content_404) {
            page_404.css({
                'min-height': h_content_404 + 50
            });
        } else {
            page_404.css({
                'min-height': height
            });
        }
        if (height <= h_content) {
            $('#page').find('.coming-soon-container').css({
                'min-height': h_content + 50
            });
            $('.coming-soon-container:before').css({
                'display': none
            });
        } else {
            page_cm.css({
                'min-height': height
            });
        }
    }

    function arrowitFeatures() {
        //features
        var li = $('.features-pagination .elementor-icon-list-item');
        for (var i = 0; i < li.length; i++) {
            var href = $(li[i]).find('a').attr('href');
            var url = location.href;
            if (href == url) {
                $(li[i]).addClass('active');
            }
        }
    }

    function arrowitCv(){
        $('.work-cv-slider .elementor-widget-wrap ').slick({
            dots: true,
            arrows: false,
            infinite: false,
            autoplay: false,
            slidesPerRow: 3,
            rows: 2,
            slidesToShow: 1,
            centerPadding: '0',
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesPerRow: 2,
                        rows: 3,
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesPerRow: 1,
                        rows: 3,
                    }
                },
            ]

        });
        $('.cv-4-slider > .elementor-container > .elementor-row').slick({
            arrows: true,
            infinite: false,
            autoplay: false,
            centerPadding: '30px',
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow:"<button type='button' class='slick-prev'><i class='theme-icon-back' ></i></button>",
            nextArrow:"<button type='button' class='slick-next'><i class='theme-icon-next' ></i></button>",
            responsive: [
                {
                    breakpoint: 1341,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                    }
                },
            ]
        });
        $('#fullpage').fullpage({
            'scrollingSpeed': 800,
            'verticalCentered': true,
            'css3': true,
            responsiveWidth: 1025,
        });
    }

    /**
     * DOMready event.
     */
    $(document).ready(function () {
        arrowitWoocommer();
        arrowitGallerySlider();
        arrowitStickyMenu();
        arrowitClick();
        arrowitFillterIsotop();
        arrowitRemoveActive();
        arrowitHeightContent();
        arrowitMenu();
        arrowitFixSubMenu();
        arrowitTestimonial();
        arrowitCounter();
        arrowitTooltip();
        arrowitPreloader();
        arrowitScrollBarTab();
        arrowitPostGallery();
        if (arrowit_params.arrowit_fancybox_enable == 'yes') {
            arrowitFancyBox();
        }
        arrowitValidateForm();
        arrowitAnimation();
        arrowitOnePage();
        arrowitStickySidebar();
        arrowitAutocompleteSearch();
        arrowitInsertTags();
        arrowitComingSoonCountdown();
        arrowitHumburgerMenu();
        arrowitSearchBox();
        arrowitPopupLogin();
        arrowitHandlerPageNotFound();
        arrowitMegamenu();
        arrowitFeatures();
        arrowitCv();
    });
    $(window).resize(function () {

        arrowitHeightContentResize();
        arrowitLoadMore();
        if ($(window).width() < 992) {
            arrowitRemoveActive();
        }
        arrowitHandlerPageNotFound();
        arrowitMegamenu();
        arrowitHumburgerMenu();
    });
    $(window).load(function () {

        arrowitScrollTop();
        arrowitFilterIsotopLoad();
        arrowitLoadMore();

    });
})(jQuery);

function jsAnimateMenu1(tog) {
    if (tog == 'open') {
        jQuery('html').addClass('openmenu openmenu-ver');
    }
    if (tog == 'close') {
        jQuery('html').removeClass('openmenu openmenu-ver');
    }
}

function jsAnimateMenu2(tog) {
    if (tog == 'open') {
        jQuery('html').addClass('openmenu');
    }
    if (tog == 'close') {
        jQuery('html').removeClass('openmenu');
    }
}

// Active Cart, Search
function toggleFilter(obj) {
    if (jQuery(window).width() < 1199) {
        if (jQuery(obj).parent().find('> .content-filter').hasClass('active')) {
            jQuery(obj).parent().find('> .content-filter').removeClass('active');
            jQuery(obj).removeClass('btn-active');
        } else {
            jQuery('.cart_label, .languges-flags > a').removeClass('btn-active');
            jQuery('.content-filter').removeClass('active');
            jQuery(obj).parent().find(' > .content-filter').addClass('active');
            jQuery(obj).addClass('btn-active');
        }
    }
}