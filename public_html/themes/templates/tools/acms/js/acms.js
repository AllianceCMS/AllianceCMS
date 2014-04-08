/* Begin Bootstrap 3.0 Specific Code */

/* alert.js related code */
var acmsAlert = $.fn.alert.noConflict();
$.fn.acmsAlert = acmsAlert;
$(".acms-alert").acmsAlert();

/* tab.js related code */
$('.acms-tabs a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
});

/*
var acmsCollapse = $.fn.collapse.noConflict();
$.fn.acmsCollapse = acmsCollapse;
$(".collapse").acmsCollapse();
*/


/* End Bootstrap 3.0 Specific Code */


/* responsiveTabs.js related code */
/*
$( document ).ready(function() {
	RESPONSIVEUI.responsiveTabs()
});
*/