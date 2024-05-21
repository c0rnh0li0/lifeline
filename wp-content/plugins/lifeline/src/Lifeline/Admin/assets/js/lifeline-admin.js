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

    var Admin = {
        account_pages_checked: false,
		init: function () {
            $('#manual_sync').off('click').on('click', this.manual_sync);
            $('#old_data_restore').off('click').on('click', this.old_data_restore);
		},
		manual_sync: function(event) {
			console.log('manual sync');

			Lifeline.Alert.show("message");

			return;

			var data = {
				action: 'manual_sync'
			};

            Lifeline.Ajax.call({
                url: lifeline_admin_js.ajaxurl,
                method: 'POST',
                data: data,
                loading: $(this),
                success: function(data, msg, xhr) {
                    Lifeline.Alert.show(data.message);

                    // Kerridge.Admin.init(false);
                },
                error: function() {
                    console.log('error', arguments);
                }
            });

		},
		old_data_restore: function(event) {
			console.log('old data restore');
		}
    };

	var Alert = {
        alert: '#liveToast',
        init: function() {},
        show: function(message) {
            var toast = new bootstrap.Toast(this.alert);

    		toast.show();
        }
    };

    Lifeline.Alert = Alert;

    Lifeline.Admin = Admin;
    Lifeline.Admin.init();

}(window.jQuery, window, document));