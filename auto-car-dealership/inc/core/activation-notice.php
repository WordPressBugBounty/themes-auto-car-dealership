<?php
// Show notice only on Themes page
add_action( 'admin_init', function () {
    global $pagenow;

    if ( is_admin() && $pagenow === 'themes.php' ) {
        add_action( 'admin_notices', 'auto_car_dealership_activation_notice' );
    }
});

// Admin Notice Function
function auto_car_dealership_activation_notice() {

    $auto_car_dealership_meta = get_option( 'auto_car_dealership_admin_notice' );

    if ( $auto_car_dealership_meta ) {
        return;
    }
    ?>
    <div id="auto-car-dealership-welcome-notice" class="notice notice-success is-dismissible welcome-notice">
        <div class="notice-row">
            <div class="notice-text">

                <p class="welcome-text1">
                    <?php esc_html_e( '🎉 Welcome to VW Themes,', 'auto-car-dealership' ); ?>
                </p>

                <p class="welcome-text2">
                    <?php esc_html_e(
                        'You are now using the Auto Car Dealership, a beautifully designed theme to kickstart your website.',
                        'auto-car-dealership'
                    ); ?>
                </p>

                <p class="welcome-text3">
                    <?php esc_html_e(
                        'To help you get started quickly, use the options below:',
                        'auto-car-dealership'
                    ); ?>
                </p>

                <span class="import-btn">
                    <a href="javascript:void(0);" id="install-activate-button" class="button admin-button info-button">
                        <?php esc_html_e( 'GET STARTED', 'auto-car-dealership' ); ?>
                    </a>
                </span>

                <span class="demo-btn">
                    <a href="https://www.vwthemes.net/auto-car-dealership/"
                       class="button button-primary" target="_blank">
                        <?php esc_html_e( 'VIEW DEMO', 'auto-car-dealership' ); ?>
                    </a>
                </span>

                <span class="upgrade-btn">
                    <a href="https://www.vwthemes.com/products/car-wordpress-theme"
                       class="button button-primary" target="_blank">
                        <?php esc_html_e( 'UPGRADE TO PRO', 'auto-car-dealership' ); ?>
                    </a>
                </span>

                <span class="bundle-btn">
                    <a href="https://www.vwthemes.com/products/wp-theme-bundle"
                       class="button button-primary" target="_blank">
                        <?php esc_html_e( 'BUNDLE OF 485+ THEMES', 'auto-car-dealership' ); ?>
                    </a>
                </span>

            </div>

            <div class="notice-img1">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/arrow-notice.png' ); ?>"
                     width="180"
                     alt="<?php esc_attr_e( 'Auto Car Dealership', 'auto-car-dealership' ); ?>" />
            </div>

            <div class="notice-img2">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/bundle-notice.png' ); ?>"
                     width="180"
                     alt="<?php esc_attr_e( 'Auto Car Dealership', 'auto-car-dealership' ); ?>" />
            </div>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).on('click', '#install-activate-button', function () {
            const button = jQuery(this);
            const redirectUrl = '<?php echo esc_url( admin_url( 'admin.php?page=auto-car-dealership-info' ) ); ?>';

            jQuery.post(ajaxurl, { action: 'check_plugin_activation' }, function (response) {

                if (response.success && response.data.active) {
                    window.location.href = redirectUrl;
                } else {
                    button.text('Installing & Activating...');

                    jQuery.post(ajaxurl, {
                        action: 'install_and_activate_required_plugin',
                        nonce: '<?php echo wp_create_nonce( 'install_activate_nonce' ); ?>'
                    }, function (response) {

                        if (response.success) {
                            window.location.href = redirectUrl;
                        } else{
                            alert('Failed to activate the plugin.');
                            button.text('Try Again');
                        }
                    });
                }
            });
        });
    </script>
    <?php
}
// Add bundle image in customizer
add_action('customize_controls_print_footer_scripts', function () {
    ?>
    <script>
        jQuery(document).ready(function($) {
            var auto_car_dealership_banner = `
                <div class="vw-bundle-banner" style="padding:10px 12px;">
                    <a href="https://www.vwthemes.com/products/wp-theme-bundle" target="_blank">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/bundle-img.png' ); ?>" style="width:100%; border-radius:4px;">
                    </a>
                </div>
            `;
            $('.customize-pane-parent').prepend(auto_car_dealership_banner);
        });
    </script>
    <?php
});
