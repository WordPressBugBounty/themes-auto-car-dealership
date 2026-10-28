/**
 * Auto Car Dealership — Front-end promo popup dismissal.
 */
(function () {
	'use strict';

	document.addEventListener('click', function (e) {
		var close = e.target.closest('.vw-upsell-popup__close');

		if (!close) {
			return;
		}

		e.preventDefault();

		var popup = close.closest('.vw-upsell-popup');

		if (!popup || typeof AutoCarDealershipPopup === 'undefined') {
			return;
		}

		var body = new URLSearchParams();

		body.append('action', AutoCarDealershipPopup.action);
		body.append('nonce', popup.getAttribute('data-nonce'));

		popup.classList.add('is-dismissing');

		window.fetch(AutoCarDealershipPopup.ajaxUrl, {
			method: 'POST',
			credentials: 'same-origin',
			body: body
		}).catch(function () {});

		window.setTimeout(function () {
			popup.remove();
		}, 250);
	});
})();
