/**
 * Lifeline Plugin JS Library
*/
'use strict';

window.Lifeline || (window.Lifeline = {});

(function($, window, document) {

    Lifeline.$window = $(window);
	Lifeline.$body = $(document.body);
	
	// Detect Internet Explorer
	Lifeline.isIE = navigator.userAgent.indexOf("Trident") >= 0;
	// Detect Edge
	Lifeline.isEdge = navigator.userAgent.indexOf("Edge") >= 0;
	// Detect Mobile
	Lifeline.isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    // Helper functions and extensions
    $.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    var Ajax = {
		overlay: null, 
        lazyload: null,
        init: function () {},
        hide_loader: function() {
            if (typeof Lifeline.Ajax.overlay != 'undefined' && Lifeline.Ajax.overlay) {
                Lifeline.Ajax.overlay.hide();
                Lifeline.Ajax.overlay = null;
            }
        },
        call: function(args) {
            var opts = {};
            
            opts.url = args.url;
            opts.type = args.method || 'GET';
            opts.data = args.data || {};
            opts.dataType = args.dataType || 'json';
            opts.success = args.success || null;
            opts.error = args.error || null;
            opts.complete = function() {
                // hide the loader and remove it's instance
                if (typeof Lifeline.Ajax.overlay != 'undefined' && Lifeline.Ajax.overlay) {
                    Lifeline.Ajax.overlay.hide();
                    Lifeline.Ajax.overlay = null;
                }
            }

            var loading = args.loading || null;
            if (loading && !Lifeline.Ajax.overlay)
				Lifeline.Ajax.overlay = PlainOverlay.show($(loading)[0], {
                    blur: 2,
                    style: {
                        background: 'transparent',
                        // face: place loader here
                    }
                });

            var ajax = $.ajax(opts);

            return ajax;
        }
    };

    Lifeline.Ajax = Ajax;
    Lifeline.Ajax.init();

    var Frontend = {
        init: function() {
            var scrollFactor = 6;

            if (Lifeline.isMobile)
                scrollFactor = 2;

            var slick_opts = {
                slidesToShow: scrollFactor,
                slidesToScroll: scrollFactor,
                dots: false,
                infinite: true,
                autoplay: false,
                // autoplaySpeed: 2000,
                responsive: [
                    {
                      breakpoint: 1200,
                      settings: {
                        slidesToShow: 4,
                      }
                    },
                    {
                      breakpoint: 900,
                      settings: {
                        slidesToShow: 3,
                      }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                          slidesToShow: 2,
                        }
                      }
                  ]
            };

            $('.lifeline-slider-group .products').slick(slick_opts);

            slick_opts.slidesToShow = 6;

            if (Lifeline.isMobile)
                slick_opts.slidesToShow = 2;

            $('.brands-slider-container').slick(slick_opts);

            $('.brands-page-container a').off('click').on('click', function(event){
                event.preventDefault();
                
                window.location.href = $(this).closest('div.ll-brand-cart').data('url');

                return false;
            });
        }
    };

    Lifeline.Frontend = Frontend;
    Lifeline.Frontend.init();

}(window.jQuery, window, document));