(function($) {
	$(function() {
		var curItems = '#' + $('.current').attr('bw-items');
		$('.bw-items').html('');
		$('.bw-items').html($(curItems).html());

		$('ul.bw-tabs').on('click', 'li:not(.current)', function() {
			$(this).addClass('current').siblings().removeClass('current')
					.parents('div.bw-section').find('div.bw-box').eq($(this).index()).fadeIn(150).siblings('div.bw-box').hide();
			var bw_item = $(this).attr('bw-items');
			var itemID = '#' + bw_item;

			$('.bw-items').fadeOut(500).html('');
			$('.bw-items').fadeIn(500).html($(itemID).html());

		})
	})
	$('div.openSub').live('click', function() {
		$(this).parent().children('ul').toggle("slow");
		if ($(this).is(".first_ul")) {
			$(this).toggleClass('.first-hover');
		}
		if ($(this).is(".second_ul_select")) {
			$(this).toggleClass('bw-sub-select');
			$(this).find('span').toggleClass('arrow-right');
			$(this).find('span').toggleClass('arrow-bottom');
		}
	});

	var data = {
		action: 'my_action',
		whatever: 1234
	};
	var a1 = $('#opt').attr('ajax');
	var ajax = a1 + '/wp-admin/admin-ajax.php';

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajax, data, function(response) {

	});


	$('.first_ul').on('click', function() {
		$(this).toggleClass('first-hover');
	});

	$(window).keydown(function(e) {
      if (e.which == 39) {
         if (e.ctrlKey){ console.log('right'); }
      }
      if (e.which == 37) {
         if (e.ctrlKey){ console.log('left'); }
      }
   });

})(jQuery)

