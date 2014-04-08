jQuery(document).ready(function($) {

	/*
	 * Карусель для верхнего виджета
	 */
	$(".bw-button-right").live('click', function() {
		var carusel = $(this).parents('.bw');
		right_carusel(carusel);
	});

	$(".bw-button-left").live('click', function() {
		var carusel = $(this).parents('.bw');
		left_carusel(carusel);
	});
	function left_carusel(carusel) {
		var block_width = $(carusel).find('.bw-block').width() + 20;
		$(carusel).find(".bw-items .bw-block").eq(-1).clone().prependTo($(carusel).find(".bw-items"));
		$(carusel).find(".bw-items").css({"left": "-" + block_width + "px"});
		$(carusel).find(".bw-items").animate({left: "0px"}, 200);
		$(carusel).find(".bw-items .bw-block").eq(-1).remove();
	}
	function right_carusel(carusel) {
		var block_width = $(carusel).find('.bw-block').width() + 20;
		$(carusel).find(".bw-items").animate({left: "-" + block_width + "px"}, 200);
		setTimeout(function() {
			$(carusel).find(".bw-items .bw-block").eq(0).clone().appendTo($(carusel).find(".bw-items"));
			$(carusel).find(".bw-items .bw-block").eq(0).remove();
			$(carusel).find(".bw-items").css({"left": "0px"});
		}, 300);
	}
});  