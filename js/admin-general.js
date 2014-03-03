(function($) {
	$(function() {

		function createCookie(name, value, days) {
			if (days) {
				var date = new Date();
				date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
				var expires = "; expires=" + date.toGMTString();
			}
			else
				var expires = "";
			document.cookie = name + "=" + value + expires + "; path=/";
		}
		function readCookie(name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for (var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ')
					c = c.substring(1, c.length);
				if (c.indexOf(nameEQ) == 0)
					return c.substring(nameEQ.length, c.length);
			}
			return null;
		}
		function eraseCookie(name) {
			createCookie(name, "", -1);
		}

		$('.krutilka').krutilka();
		$('.krutilka').css({"display": "none"});
		$('.updet').click(function() {
			$('.krutilka').css({"display": "block"});
			var data = {
				action: 'my_action',
				updat: 'upda'
			};
			var a1 = $('#opt').attr('ajax');

			var ajax = a1 + '/wp-admin/admin-ajax.php';

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajax, data, function(response) {
				$('.krutilka').css({"display": "none"});
				alert("The data is loaded successfully.");
				window.location.reload();
			});
		});

		$('.updete_default').click(function() {
			$('.krutilka').css({"display": "block"});
			var data = {
				action: 'set_default'
			};
			var a1 = $('#opt').attr('ajax');

			var ajax = a1 + '/wp-admin/admin-ajax.php';

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajax, data, function(response) {
				$('.krutilka').css({"display": "none"});

				if (response == 'true') {
					alert('The reset to standard settings is accomplished successfully');
					window.location.reload();
				}

				if (response == 'false') {
					alert('The reset to standard settings is not accomplished');
					window.location.reload();
				}

			});

		});

		$('select[name="BW_Lang"]').change(function() {
			var BW_Lang = $('select[name="BW_Lang"]').val();
			var data = {
				action: 'update_lang',
				BW_Lang: BW_Lang
			};
			var a1 = $('#opt').attr('ajax');

			var ajax = a1 + '/wp-admin/admin-ajax.php';

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajax, data, function(response) {
				window.location.reload();
			});

		});


		$('ul.tabs').each(function(i) {
			var cookie = readCookie('tabCookie' + i);
			if (cookie)
				$(this).find('li').eq(cookie).addClass('current').siblings().removeClass('current')
						.parents('div.bw_section').find('div.box').hide().eq(cookie).show();
		});

		$('ul.tabs').on('click', 'li:not(.current)', function() {
			$(this).addClass('current').siblings().removeClass('current')
					.parents('div.bw_section').find('div.box').eq($(this).index()).fadeIn(150).siblings('div.box').hide();
			var ulIndex = $('ul.tabs').index($(this).parents('ul.tabs'));
			eraseCookie('tabCookie' + ulIndex);
			createCookie('tabCookie' + ulIndex, $(this).index(), 365);
		});

		$('.sport_list li .label').on('click', function() {
			if ($(this).parent().find('input[type="checkbox"]').is(':checked')) {
				$(this).parent().find('input[type="checkbox"]').prop('checked', false);
			} else {
				$(this).parent().find('input[type="checkbox"]').prop('checked', true);
			}
			//alert($(this).find('input[type="checkbox"]').val());
		});

	});
})(jQuery)