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
		init: function () {
            
		}
    };

    Lifeline.Ajax = Ajax;
    Lifeline.Ajax.init();

    var Admin = {
        account_pages_checked: false,
		init: function () {
            
		},
    };

    Lifeline.Admin = Admin;
    Lifeline.Admin.init();

}(window.jQuery, window, document));