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

    var Admin = {
        account_pages_checked: false,
        status_interval: false, 
        prev_sync_status: 0,
		init: function () {
            $('#manual_sync').off('click').on('click', this.manual_sync);
            $('#old_data_restore').off('click').on('click', this.old_data_restore);

            $('.ll-sync-progress-bar').hide();
            $('.ll-restore-progress-bar').hide();
		},
		manual_sync: function(event) {
            var sync_btn = this;

            $(sync_btn).hide();
            $('.ll-sync-progress-bar').show();

            Lifeline.Ajax.call({
                url: lifeline_admin_ajax.ajaxurl,
                method: 'POST',
                data: {
                    action: 'll_sync'
                },
                success: function(data, msg, xhr) {
                    data.results.type = 'sync';

                    Lifeline.Alert.show(data.results);

                    Lifeline.Admin.update_progress(100, 'sync');

                    setTimeout(function() {
                        $('.ll-sync-progress-bar').hide();
                        Lifeline.Admin.update_progress(0, 'sync');

                        $(sync_btn).show();
                    }, 3000);

                    clearInterval(Lifeline.Admin.status_interval);                    
                },
                error: function() {
                    console.log('error', arguments);
                    clearInterval(Lifeline.Admin.status_interval);
                }
            });

            Lifeline.Admin.update_status('sync');
		},
		old_data_restore: function(event) {
            var restore_btn = this;

			$(restore_btn).hide();
            $('.ll-restore-progress-bar').show();

            Lifeline.Ajax.call({
                url: lifeline_admin_ajax.ajaxurl,
                method: 'POST',
                data: {
                    action: 'll_restore'
                },
                // loading: $(this),
                success: function(data, msg, xhr) {
                    data.results.type = 'restore';

                    Lifeline.Alert.show(data.results);

                    Lifeline.Admin.update_progress(100, 'restore');

                    setTimeout(function() {
                        $('.ll-restore-progress-bar').hide();
                        Lifeline.Admin.update_progress(0, 'restore');
    
                        $(restore_btn).show();
                    }, 3000);

                    clearInterval(Lifeline.Admin.status_interval);
                },
                error: function() {
                    console.log('error', arguments);
                    clearInterval(Lifeline.Admin.status_interval);
                }
            });

            Lifeline.Admin.update_status('restore');
		},
        update_status: function(what) {
            Lifeline.Admin.status_interval = window.setInterval(function(){
                Lifeline.Ajax.call({
                    url: lifeline_admin_ajax.ajaxurl,
                    method: 'POST',
                    data: {
                        action: 'll_sync_status'
                    },
                    // loading: $(this),
                    success: function(data, msg, xhr) {
                        if (typeof data.status != 'undefined' && data.status > 0) {
                            Lifeline.Admin.prev_sync_status = data.status;
                            Lifeline.Admin.update_progress(data.status, what);
                        }                        
                    },
                    error: function() {
                        console.log('error', arguments);
                        // clearInterval(Lifeline.Admin.status_interval);
                    }
                });
            }, 5000);
		},
        update_progress: function(percent, what) {
            $(`.ll-${what}-progress`).attr('aria-valuenow', percent).css({ 'width': `${percent}%`}).html(`${percent}%`);
        }
    };

    var Groups = {
        init: function () {
            $('.new-group-btn').off('click').on('click', this.add_group);
            $('.groups-forms').off('submit').on('submit', this.save_group);

            this.init_groups();
		},
        init_groups: function() {
            $(".ll-group").each(function(index, el) {
                var group_id = $(el).data('id');
                var form = $(el).closest('form');

                // Promotions
                $(form).find('input[name="promo"]').off('change').on('change', function(event){
                    if ($(this).is(':checked'))
                        $(form).find('.datepickers-container').show();
                    else
                        $(form).find('.datepickers-container').hide();

                    return true;
                });

                if ($(form).find('input[name="promo"]:checked').length == 1)
                    $(form).find('.datepickers-container').show();
                else
                    $(form).find('.datepickers-container').hide();

                // Bestsellers 
                $(form).find('input[name="is_bestseller"]').off('change').on('change', function(event){
                    if ($(this).is(':checked'))
                        $(form).find('.bestseller-container').show();
                    else
                        $(form).find('.bestseller-container').hide();

                    return true;
                });

                if ($(form).find('input[name="is_bestseller"]:checked').length == 1)
                    $(form).find('.bestseller-container').show();
                else
                    $(form).find('.bestseller-container').hide();

                // Tag input
                $(`#group_${group_id}`).tokenInput(`${lifeline_admin_ajax.ajaxurl}?action=ll_group_products`, {
                    prePopulate: JSON.parse($(`#group_${group_id}`).val())
                });

                // Calendars
                $(form).find('.datepicker').each(function(index, dp) {
                    var dp_options = {
                        format: 'dd.mm.yyyy',
                        autoclose: true,
                        // calendarWeeks: true,
                        todayHighlight: true,
                        weekStart: 1
                    };

                    if ($(dp).hasClass('start') && $(dp).val() == '') {
                        dp_options.startDate = '+1d';
                    }                        

                    if ($(dp).hasClass('end') && $(dp).val() == '') {
                        dp_options.startDate = '+1d';
                    }                        

                    $(dp).datepicker(dp_options);
                });

                // Delete 
                $(form).find('.btn-delete').off('click').on('click', Lifeline.Groups.delete_group);
            });            
        },
        add_group: function(event) {
            console.log('add new group');

            Lifeline.Ajax.call({
                url: lifeline_admin_ajax.ajaxurl,
                method: 'POST',
                data: {
                    action: 'll_new_group'
                },
                // loading: $(this),
                success: function(data, msg, xhr) {
                    console.log(data);

                    $('.groups-container').prepend(data.content);

                    $(`#group_0`).tokenInput(`${lifeline_admin_ajax.ajaxurl}?action=ll_group_products`);

                    $('.groups-forms').off('submit').on('submit', Lifeline.Groups.save_group);
                    Lifeline.Groups.init_datepicker();
                },
                error: function() {
                    console.log('error', arguments);
                }
            });
        },
        save_group: function(event) {
            event.preventDefault();

            var form_id = $(this).data('id');

            var formData = $(this).serializeObject();

            formData.products = JSON.stringify($(`#group_${form_id}`).tokenInput("get"));

            Lifeline.Ajax.call({
                url: lifeline_admin_ajax.ajaxurl,
                method: 'POST',
                data: formData,
                loading: $(this),
                success: function(data, msg, xhr) {
                    if (form_id == 0)
                        window.location.reload();
                    else {
                        $('.groups-container').prepend(data.content);
                        $(`#group_0`).tokenInput(`${lifeline_admin_ajax.ajaxurl}?action=ll_group_products`);
                    }                    
                },
                error: function() {
                    console.log('error', arguments);
                }
            });

            return false;
        },
        delete_group: function(event) {
            var group_id = $(this).closest('form').data('id');

            Lifeline.Ajax.call({
                url: lifeline_admin_ajax.ajaxurl,
                method: 'POST',
                data: {
                    action: 'll_delete_group', 
                    id: group_id
                },
                loading: $(this),
                success: function(data, msg, xhr) {
                    if (data.success)
                        $(`.group-${group_id}`).remove();
                },
                error: function() {
                    console.log('error', arguments);
                }
            });

            return false;
        }
    };

    Lifeline.Groups = Groups;
    Lifeline.Groups.init();

	var Alert = {
        alert: '#liveToast',
        init: function() {},
        show: function(data) {
            var restore_map = {
                "inserted": "Untouched",
                "updated": "Updated",
                "deleted": "Not found"
            };

            for (const property in data) {
                if (data.type == 'sync') {
                    $(this.alert).find(`.type-${property}`).html(property.charAt(0).toUpperCase() + property.slice(1));
                    $(this.alert).find(`.value-${property}`).html(data[property]);
                } else {
                    var restore_label = typeof restore_map[property] != 'undefined' ? restore_map[property] : property.charAt(0).toUpperCase() + property.slice(1);
                    $(this.alert).find(`.type-${property}`).html(restore_label);
                    $(this.alert).find(`.value-${property}`).html(data[property]);
                }
            }

            var toast = new bootstrap.Toast(this.alert);


    		toast.show();
        }
    };

    Lifeline.Alert = Alert;

    Lifeline.Admin = Admin;
    Lifeline.Admin.init();

}(window.jQuery, window, document));