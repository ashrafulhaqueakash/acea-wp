jQuery(function ($) {
	'use strict';

	/**
	 * ---------------------------------------
	 * ------------- DOM Ready ---------------
	 * ---------------------------------------
	 */



	$('.fdth-tala-form').on('submit', function (event) {
		event.preventDefault();
		var $form = $(this);
		var $tala = $form.find('[name=tala_key]');
		var $tala_key = $tala.val();
		var $submit_button = $form.find('.fdth-check-tala');

		$submit_button.text('');
		$submit_button.append('<span class="dashicons dashicons-update"></span>');
		if ($tala.val().length == 0) {
			$tala.css('border-color', 'red');
			$tala.click();
			return;
		}

		$submit_button.addClass('fdth-tala-disable');
		$submit_button.attr('disabled');
		$tala.attr('disabled');

		var data = new FormData();
		data.append('action', 'fdth_tala_ajax');
		data.append('security', fdth_vars.nonce);
		data.append('tala', $tala_key);

		fdthTalaajaxCall(data)

	});

	$('.fdth-tala-deactivate').on('click', function (event) {
		event.preventDefault();
		var $btn = $(this);

		$btn.attr('disabled');
		$btn.text('');
		$btn.append('<span class="dashicons dashicons-update"></span>');

		var data = new FormData();
		data.append('action', 'fdth_tala_deactivate');
		data.append('security', fdth_vars.nonce);


		$.ajax({
				method: 'POST',
				url: fdth_vars.ajax_url,
				data: data,
				contentType: false,
				processData: false,
			})
			.done(function (response) {
				location.reload();
			})
			.fail(function (error) {
				location.reload();

			});

	});


	function fdthTalaajaxCall(data) {
		$.ajax({
				method: 'POST',
				url: fdth_vars.ajax_url,
				data: data,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$('.fdth-tala-form').css('opacity', '0.5');

					// welcome.slideUp();
					// progress.slideDown();
					// progressbar.show();


				}
			})
			.done(function (response) {
				console.log(response);
				var welcome = $('.fdth-tala .fdth-setup-welcome'),
					success = $('.fdth-tala .fdth-setup-success'),
					error = $('.fdth-tala .fdth-setup-error');
				welcome.slideUp();
				if (response === true) {
					success.slideDown();
				} else {
					error.slideDown();
				}
			})
			.fail(function (error) {
				var error = $('.fdth-tala .fdth-setup-error');

				error.slideDown(300);

			});
	}

});