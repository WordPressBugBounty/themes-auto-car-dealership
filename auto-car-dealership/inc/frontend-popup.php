<?php
/**
 * Front-end promo popup for pro theme upgrade.
 *
 * Shown bottom-right on the front end to super admins only.
 * Closing it hides it for 48 hours per user (persisted via user meta).
 * The snooze is reset whenever the theme is activated or deactivated.
 *
 * @package Auto Car Dealership
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AUTO_CAR_DEALERSHIP_POPUP_META_KEY', 'auto_car_dealership_popup_dismissed' );
define( 'AUTO_CAR_DEALERSHIP_POPUP_NONCE', 'auto_car_dealership_popup_dismiss' );
define( 'AUTO_CAR_DEALERSHIP_POPUP_SNOOZE', 2 * DAY_IN_SECONDS );
define( 'AUTO_CAR_DEALERSHIP_PRO_SLUG', 'car-wordpress-theme' );
define( 'AUTO_CAR_DEALERSHIP_PRO_PRICE_URL', 'https://www.vwthemes.com/products/' . AUTO_CAR_DEALERSHIP_PRO_SLUG . '.js' );
define( 'AUTO_CAR_DEALERSHIP_PRO_PRICE_TRANSIENT', 'auto_car_dealership_pro_price' );

/**
 * Fetch the premium theme price from the store by product slug.
 *
 * Cached for 12 hours (1 hour on failure). Returns a formatted price
 * such as "$60", or an empty string if the price could not be fetched.
 */
function auto_car_dealership_get_pro_price() {
	$auto_car_dealership_price = get_transient( AUTO_CAR_DEALERSHIP_PRO_PRICE_TRANSIENT );

	if ( false !== $auto_car_dealership_price ) {
		return $auto_car_dealership_price;
	}

	$auto_car_dealership_price    = '';
	$auto_car_dealership_response = wp_remote_get( AUTO_CAR_DEALERSHIP_PRO_PRICE_URL, array( 'timeout' => 10 ) );

	if ( ! is_wp_error( $auto_car_dealership_response ) && 200 === wp_remote_retrieve_response_code( $auto_car_dealership_response ) ) {
		$auto_car_dealership_product = json_decode( wp_remote_retrieve_body( $auto_car_dealership_response ) );

		// Store returns price in cents.
		if ( isset( $auto_car_dealership_product->price ) && is_numeric( $auto_car_dealership_product->price ) ) {
			$auto_car_dealership_amount = $auto_car_dealership_product->price / 100;
			$auto_car_dealership_price  = '$' . number_format_i18n( $auto_car_dealership_amount, floor( $auto_car_dealership_amount ) == $auto_car_dealership_amount ? 0 : 2 );
		}
	}

	set_transient( AUTO_CAR_DEALERSHIP_PRO_PRICE_TRANSIENT, $auto_car_dealership_price, '' === $auto_car_dealership_price ? HOUR_IN_SECONDS : 12 * HOUR_IN_SECONDS );

	return $auto_car_dealership_price;
}

/**
 * Whether the popup should render for the current request.
 */
function auto_car_dealership_popup_should_show() {
	if ( is_admin() || ! is_user_logged_in() || ! is_super_admin() ) {
		return false;
	}

	// A child theme that ships its own popup takes over.
	if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/inc/frontend-popup.php' ) ) {
		return false;
	}

	$auto_car_dealership_dismissed = (int) get_user_meta( get_current_user_id(), AUTO_CAR_DEALERSHIP_POPUP_META_KEY, true );

	return ( time() - $auto_car_dealership_dismissed ) >= AUTO_CAR_DEALERSHIP_POPUP_SNOOZE;
}

/**
 * Render popup in the front-end footer.
 */
function auto_car_dealership_frontend_promo_popup() {

	if ( ! auto_car_dealership_popup_should_show() ) {
		return;
	}

	$auto_car_dealership_logo_url = get_template_directory_uri() . '/images/final-logo.png';
	$auto_car_dealership_buy_url  = defined( 'AUTO_CAR_DEALERSHIP_BUY_NOW' ) ? AUTO_CAR_DEALERSHIP_BUY_NOW : 'https://www.vwthemes.com/products/car-wordpress-theme';
	$auto_car_dealership_demo_url = defined( 'AUTO_CAR_DEALERSHIP_LIVE_DEMO' ) ? AUTO_CAR_DEALERSHIP_LIVE_DEMO : 'https://www.vwthemes.net/auto-car-dealership/';
	$auto_car_dealership_nonce    = wp_create_nonce( AUTO_CAR_DEALERSHIP_POPUP_NONCE );
	$auto_car_dealership_price    = auto_car_dealership_get_pro_price();
	?>
	<div class="vw-upsell-popup" role="dialog" aria-labelledby="vw-upsell-popup-title" data-nonce="<?php echo esc_attr( $auto_car_dealership_nonce ); ?>">
		<div class="vw-upsell-popup__inner">
			<img src="<?php echo esc_url( $auto_car_dealership_logo_url ); ?>" alt="<?php esc_attr_e( 'VW Themes', 'auto-car-dealership' ); ?>" class="vw-upsell-popup__logo" />
			<h2 id="vw-upsell-popup-title" class="vw-upsell-popup__title"><?php esc_html_e( 'Take Your Website Further with Auto Car Dealership Pro', 'auto-car-dealership' ); ?></h2>
			<p class="vw-upsell-popup__text"><?php
				if ( $auto_car_dealership_price ) {
					printf(
						/* translators: %s: Pro theme price. */
						esc_html__( 'Upgrade to Pro & get access to premium features, extra sections and Customizations just at %s', 'auto-car-dealership' ),
						'<strong>' . esc_html( $auto_car_dealership_price ) . '</strong>'
					);
				} else {
					esc_html_e( 'Upgrade to Pro & get access to premium features, extra sections and Customizations', 'auto-car-dealership' );
				}
				?>
			</p>
			<div class="vw-upsell-popup__actions">
				<a href="<?php echo esc_url( $auto_car_dealership_buy_url ); ?>" class="vw-upsell-popup__btn vw-upsell-popup__btn--buy" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Get Pro Now', 'auto-car-dealership' ); ?></a>
				<?php if ( $auto_car_dealership_demo_url ) : ?>
					<a href="<?php echo esc_url( $auto_car_dealership_demo_url ); ?>" class="vw-upsell-popup__btn vw-upsell-popup__btn--demo" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Live Demo', 'auto-car-dealership' ); ?></a>
				<?php endif; ?>
			</div>
		</div>
		<button type="button" class="vw-upsell-popup__close" aria-label="<?php esc_attr_e( 'Close', 'auto-car-dealership' ); ?>">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php
}
add_action( 'wp_footer', 'auto_car_dealership_frontend_promo_popup' );

/**
 * Enqueue popup CSS + JS on the front end.
 */
function auto_car_dealership_frontend_promo_popup_assets() {

	if ( ! auto_car_dealership_popup_should_show() ) {
		return;
	}

	$auto_car_dealership_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'auto-car-dealership-upsell-popup',
		get_template_directory_uri() . '/css/frontend-popup.css',
		array(),
		$auto_car_dealership_version
	);

	wp_enqueue_script(
		'auto-car-dealership-upsell-popup',
		get_template_directory_uri() . '/js/frontend-popup.js',
		array(),
		$auto_car_dealership_version,
		true
	);

	wp_localize_script(
		'auto-car-dealership-upsell-popup',
		'AutoCarDealershipPopup',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'action'  => 'auto_car_dealership_dismiss_popup',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'auto_car_dealership_frontend_promo_popup_assets' );

/**
 * AJAX handler: snooze the popup for the current user.
 */
function auto_car_dealership_dismiss_popup_handler() {

	if ( ! is_super_admin() ) {
		wp_send_json_error( array( 'message' => 'forbidden' ), 403 );
	}

	check_ajax_referer( AUTO_CAR_DEALERSHIP_POPUP_NONCE, 'nonce' );

	update_user_meta( get_current_user_id(), AUTO_CAR_DEALERSHIP_POPUP_META_KEY, time() );

	wp_send_json_success();
}
add_action( 'wp_ajax_auto_car_dealership_dismiss_popup', 'auto_car_dealership_dismiss_popup_handler' );

/**
 * Reset the snooze for all users so the popup shows again
 * whenever this theme is activated (fresh install or re-activation).
 */
function auto_car_dealership_reset_popup_dismissal() {
	delete_metadata( 'user', 0, AUTO_CAR_DEALERSHIP_POPUP_META_KEY, '', true );
}
add_action( 'after_switch_theme', 'auto_car_dealership_reset_popup_dismissal' );

/**
 * Also clear it when switching away from this theme (deactivation).
 */
add_action( 'switch_theme', 'auto_car_dealership_reset_popup_dismissal' );
