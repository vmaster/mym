// i18n Calendar in Spanish
// URL Source: https://code.google.com/p/logicss/source/browse/trunk/media/jquery/jquery.ui.i18n.all.min.js?r=41
//(function($) {
	$.datepicker.regional['es'] = {clearText : "Limpiar", clearStatus : "",
						closeText : "Cerrar", closeStatus : "",
						prevText : "&#x3c;Ant", prevStatus : "",
						prevBigText : "&#x3c;&#x3c;", prevBigStatus : "",
						nextText : "Sig&#x3e;", nextStatus : "",
						nextBigText : "&#x3e;&#x3e;", nextBigStatus : "",
						currentText : "Hoy", currentStatus : "",
						monthNames : [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
						               "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre",
						               "Diciembre" ],
						monthNamesShort : [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul",
						                    "Ago", "Sep", "Oct", "Nov", "Dic" ],
						monthStatus : "", yearStatus : "",
						weekHeader : "Sm", weekStatus : "",
						dayNames : [ "Domingo", "Lunes", "Martes", "Mi&eacute;rcoles",
						             "Jueves", "Viernes", "S&aacute;bado" ],
						             dayNamesShort : [ "Dom", "Lun", "Mar", "Mi&eacute;", "Juv", "Vie",
						                               "S&aacute;b" ],
						dayNamesMin : [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "S&aacute;" ],
						dayStatus : "DD", dateStatus : "D, M d",
						dateFormat : "mm/dd/yy", firstDay : 0,
						initStatus : "",
						isRTL : false};
	$.datepicker.setDefaults($.datepicker.regional['es']);
//})(jQuery);