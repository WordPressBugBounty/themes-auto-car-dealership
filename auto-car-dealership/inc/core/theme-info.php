<?php

/* Add to Dashboard main menu */
function auto_car_dealership_dashboard_menu() {
    add_menu_page(
        esc_html__( 'Auto Car Dealership', 'auto-car-dealership' ), // Page title
        esc_html__( 'Auto Car Dealership', 'auto-car-dealership' ), // Menu title
        'manage_options',                                             // Capability
        'auto-car-dealership-info',                                  // Menu slug (same)
        'auto_car_dealership_theme_page_display',                    // Callback
         get_template_directory_uri() . '/images/menu-icon.svg', // Image icon
        59                                           // Position
    );
}
add_action( 'admin_menu', 'auto_car_dealership_dashboard_menu' );

function auto_car_dealership_admin_theme_style() {
	wp_enqueue_style('auto-car-dealership-custom-admin-style', esc_url(get_template_directory_uri()) . '/css/admin-style.css');
	wp_enqueue_script('auto-car-dealership-tabs', esc_url(get_template_directory_uri()) . '/js/tab.js');

	// Admin notice code START
	wp_register_script('auto-car-dealership-notice', esc_url(get_template_directory_uri()) . '/inc/core/js/notice.js', array('jquery'), time(), true);
	wp_enqueue_script('auto-car-dealership-notice');
	// Admin notice code END
}
add_action('admin_enqueue_scripts', 'auto_car_dealership_admin_theme_style');

/**
 * Display About page
 */
function auto_car_dealership_theme_page_display() {
	$auto_car_dealership_theme = wp_get_theme();

	if ( is_child_theme() ) {
		$auto_car_dealership_theme = wp_get_theme()->parent();
	} ?>
 
	<div class="wrapper-info">
	<div class="tab-sec">
    	
    	<div class="tab">
			<button class="tablinks" onclick="auto_car_dealership_open_tab(event, 'lite_theme')"><?php esc_html_e( 'Free Setup', 'auto-car-dealership' ); ?></button>
			<button class="tablinks" onclick="auto_car_dealership_open_tab(event, 'theme_pro')"><?php esc_html_e( 'Get Premium', 'auto-car-dealership' ); ?></button>
  			<button class="tablinks" onclick="auto_car_dealership_open_tab(event, 'free_pro')"><?php esc_html_e( 'Free VS Premium', 'auto-car-dealership' ); ?></button>
  			<button class="tablinks" onclick="auto_car_dealership_open_tab(event, 'get_bundle')"><?php esc_html_e( 'WP Theme Bundle', 'auto-car-dealership' ); ?></button>
		</div>

		<?php 
			$auto_car_dealership_plugin_custom_css = '';
			if(class_exists('Ibtana_Visual_Editor_Menu_Class')){
				$auto_car_dealership_plugin_custom_css ='display: block';
			}
		?>

		<div id="lite_theme" class="tabcontent open">
			<div class="lite-theme-tab">
				<h3><?php esc_html_e( 'Auto Car Dealership', 'auto-car-dealership' ); ?></h3>
				<hr class="h3hr">
			  	<p><?php esc_html_e('Auto Car Dealership is an impressive block-based theme tailored for businesses in the automotive sector, including car rentals, bike rentals, car mechanics, and auto dealerships in the city. This theme comes packed with full site editing features, block patterns, and block editor patterns, allowing for extensive customization. Created by WordPress experts, it utilizes a lightweight design along with the latest HTML codes, which are optimized for faster page load speeds. The elegant and professional appearance effectively showcases your automobile business. With a retina-ready and responsive design, this theme ensures compatibility across all devices. There’s a beautifully designed banner along with sections for displaying information about your team, client testimonials, and much more. Developers have focused on SEO-friendly practices to minimize extra efforts for optimization, and a Call to Action Button (CTA) guides visitors toward the next steps. Additionally, the theme offers multiple social media options and is translation-ready to accommodate various languages. For a closer look, visit the demo at: https://www.vwthemes.net/auto-car-dealership/.','auto-car-dealership'); ?></p>
			  	<div class="col-left-inner">
					<div class="pro-links">
				    	<a href="<?php echo esc_url( admin_url() . 'site-editor.php' ); ?>" target="_blank"><?php esc_html_e('Edit Your Site', 'auto-car-dealership'); ?></a>
						<a href="<?php echo esc_url( home_url() ); ?>" target="_blank"><?php esc_html_e('Visit Your Site', 'auto-car-dealership'); ?></a>
					</div>
					<div class="support-forum-col-section">
						<div class="support-forum-col">
							<h4><?php esc_html_e('Having Trouble, Need Support?', 'auto-car-dealership'); ?></h4>
							<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'auto-car-dealership'); ?></p>
							<div class="info-link">
								<a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'auto-car-dealership'); ?></a>
							</div>
						</div>
						<div class="support-forum-col">
							<h4><?php esc_html_e('Reviews & Testimonials', 'auto-car-dealership'); ?></h4>
							<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'auto-car-dealership'); ?>  </p>
							<div class="info-link">
								<a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'auto-car-dealership'); ?></a>
							</div>
						</div>
						<div class="support-forum-col">
							<h4><?php esc_html_e('Theme Documentation', 'auto-car-dealership'); ?></h4>
							<p> <?php esc_html_e('If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'auto-car-dealership'); ?>  </p>
							<div class="info-link">
								<a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_FREE_DOC ); ?>" target="_blank"><?php esc_html_e('Free Theme Documentation', 'auto-car-dealership'); ?></a>
							</div>
						</div>
					</div>
			  	</div>
			</div>
		</div>

		<div id="theme_pro" class="tabcontent">		  	
			<div class="pro-info">
				<div class="col-left-pro">
					<h3><?php esc_html_e( 'Premium Theme Information', 'auto-car-dealership' ); ?></h3>
					<hr class="h3hr">
			    	<p><?php esc_html_e('This spectacular premium Automobile WordPress Theme is made for the motor-heads. We have created our Automobile themes Stunning design with respect to the automotive industry. The frenzy for keeping our cars immaculate and shiny is well known. We assure you that it will be well reflected in our theme. As they are made with utilizing clean coding standards and it will function well with current WordPress version. It is built on the foundation of being responsive & user-friendly. This allows it to function at its optimal best across all platforms. This takes care of all the visitors and users, regardless of the source of traffic is being driven from.','auto-car-dealership'); ?></p>
			    	<div class="pro-links">
				    	<a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_LIVE_DEMO ); ?>" target="_blank" class="demo-btn"><?php esc_html_e('Live Demo', 'auto-car-dealership'); ?></a>
						<a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_BUY_NOW ); ?>" target="_blank" class="prem-btn"><?php esc_html_e('Buy Premium', 'auto-car-dealership'); ?></a>
						<a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_PRO_DOC ); ?>" target="_blank" class="doc-btn"><?php esc_html_e('Documentation', 'auto-car-dealership'); ?></a>
					</div>
			    </div>
			    <div class="col-right-pro scroll-image-wrapper">
			    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/premium-img.jpg" alt="" class="pro-img" />		    	
			    </div>
			</div>		    
		</div>

		<div id="free_pro" class="tabcontent">
		  	<div class="featurebox">
			    <h3><?php esc_html_e( 'Theme Features', 'auto-car-dealership' ); ?></h3>
				<hr class="h3hr">
				<div class="table-image">
					<table class="tablebox">
						<thead>
							<tr>
								<th><?php esc_html_e('Features', 'auto-car-dealership'); ?></th>
								<th><?php esc_html_e('Free Themes', 'auto-car-dealership'); ?></th>
								<th><?php esc_html_e('Premium Themes', 'auto-car-dealership'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e('Easy Setup', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Responsive Design', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('SEO Friendly', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Banner Settings', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Template Pages', 'auto-car-dealership'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'auto-car-dealership'); ?></td>
								<td class="table-img"><?php esc_html_e('14', 'auto-car-dealership'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Home Page Template', 'auto-car-dealership'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'auto-car-dealership'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'auto-car-dealership'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Theme sections', 'auto-car-dealership'); ?></td>
								<td class="table-img"><?php esc_html_e('2', 'auto-car-dealership'); ?></td>
								<td class="table-img"><?php esc_html_e('12', 'auto-car-dealership'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Contact us Page Template', 'auto-car-dealership'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('1', 'auto-car-dealership'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Blog Templates & Layout', 'auto-car-dealership'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'auto-car-dealership'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Reordering', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Demo Importer', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Full Documentation', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Latest WordPress Compatibility', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Support 3rd Party Plugins', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Secure and Optimized Code', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Exclusive Functionalities', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Enable / Disable', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Google Font Choices', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Gallery', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Simple & Mega Menu Option', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support to add custom CSS / JS ', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Shortcodes', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Premium Membership', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Budget Friendly Value', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Priority Error Fixing', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Feature Addition', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('All Access Theme Pass', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Seamless Customer Support', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('WordPress 6.4 or later', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('PHP 8.2 or 8.3', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('MySQL 5.6 (or greater) | MariaDB 10.0 (or greater)', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Influence Registration', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Detailed Influencer Portfolio', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Premium Pricing Plan', 'auto-car-dealership'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
							<td></td>
							<td class="table-img"></td>
							<td class="update-link"><a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'auto-car-dealership'); ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="get_bundle" class="tabcontent">	
			<div class="bundle-info">
				<div class="col-left-pro">
			   		<h3><?php esc_html_e( 'WP Theme Bundle', 'auto-car-dealership' ); ?></h3>
			   		<hr class="h3hr">
			    	<p><?php esc_html_e('Enhance your website effortlessly with our WP Theme Bundle. Get access to 485+ premium WordPress themes and 5+ powerful plugins, all designed to meet diverse business needs. Enjoy seamless integration with any plugins, ultimate customization flexibility, and regular updates to keep your site current and secure. Plus, benefit from our dedicated customer support, ensuring a smooth and professional web experience.','auto-car-dealership'); ?></p>
			    	<div class="feature">
			    		<h4><?php esc_html_e( 'Features:', 'auto-car-dealership' ); ?></h4>
			    		<p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/tick.png" alt="" /><?php esc_html_e('485+ Premium Themes & 5+ Plugins.', 'auto-car-dealership'); ?></p>
			    		<p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/tick.png" alt="" /><?php esc_html_e('Seamless Integration.', 'auto-car-dealership'); ?></p>
			    		<p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/tick.png" alt="" /><?php esc_html_e('Customization Flexibility.', 'auto-car-dealership'); ?></p>
			    		<p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/tick.png" alt="" /><?php esc_html_e('Regular Updates.', 'auto-car-dealership'); ?></p>
			    		<p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/tick.png" alt="" /><?php esc_html_e('Dedicated Support.', 'auto-car-dealership'); ?></p>
			    	</div>
			    	<p><?php esc_html_e('Upgrade now and give your website the professional edge it deserves, all at an unbeatable price of $99!', 'auto-car-dealership'); ?></p>
			    	<div class="pro-links">
						<a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_THEME_BUNDLE_BUY_NOW ); ?>" target="_blank" class="bundle-buy"><?php esc_html_e('Get Bundle', 'auto-car-dealership'); ?></a>
						<a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_THEME_BUNDLE_DOC ); ?>" target="_blank" class="bundle-doc"><?php esc_html_e('Documentation', 'auto-car-dealership'); ?></a>
					</div>
			   	</div>
			   	<div class="col-right-pro scroll-image-wrapper">
			    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/bundle.jpg" alt="" />
			   	</div>
			</div>	  	
		</div>
	</div>
	<div class="coupen-code-section">
		<div class="sshot-section">
			<div class="sshot-inner">
				<h2><?php esc_html_e('Welcome To Auto Car Dealership','auto-car-dealership'); ?> </h2>
				<div class="on-pro">
					<span class="version"><?php esc_html_e( 'Version', 'auto-car-dealership' ); ?>: <?php echo esc_html($auto_car_dealership_theme['Version']);?></span>
					<span class="coupon-code"><?php esc_html_e('Get 20% Of On Pro Theme-Use Code: ','auto-car-dealership'); ?><span class="code-highlight"><?php esc_html_e('VWPRO20','auto-car-dealership'); ?></span>
				</div>
		    	<p><?php esc_html_e('All Our Wordpress Themes Are Modern, Minimalist, 100% Responsive, Seo-Friendly,Feature-Rich, And Multipurpose That Best Suit Designers, Bloggers And Other Professionals Who Are Working In The Creative Fields.','auto-car-dealership'); ?></p>
		    	<div class="btn-section">
			    	<div class="proo-links">
				    	<a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_LIVE_DEMO ); ?>" target="_blank" class="demo-btn"><?php esc_html_e('Live Demo', 'auto-car-dealership'); ?></a>
						<a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_BUY_NOW ); ?>" target="_blank" class="prem-btn"><?php esc_html_e('Buy Premium', 'auto-car-dealership'); ?></a>
						<a href="<?php echo esc_url( AUTO_CAR_DEALERSHIP_PRO_DOC ); ?>" target="_blank" class="doc-btn"><?php esc_html_e('Documentation', 'auto-car-dealership'); ?></a>
						
					</div>
			    	
			    </div>
			</div>
	    	<div class="bundle-banner">
	    		<div class="bundle-img">
	    			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/bundle-notice.png" alt="" />
	    		</div>
	    		<div class="bundle-text">
		  			<h2><?php esc_html_e('WP THEME BUNDLE','auto-car-dealership'); ?></h2>
					<h4><?php esc_html_e('Get Access to 485+ Premium WordPress Themes At Just $99','auto-car-dealership'); ?></h4>
					<div class="bundle-button">
			  			<a href="<?php echo esc_url( 'https://www.vwthemes.com/discount/FREEBREF?redirect=/products/wp-theme-bundle'); ?>" target="_blank"><?php esc_html_e('Get 10% OFF On Bundle', 'auto-car-dealership'); ?></a>
			  		</div>
		  		</div>
	    	</div>
	    </div>
	    <div class="coupen-section">
	    	<div class="logo-section">
			  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" alt="" />
		  	</div>
		  	<div class="logo-right">	
		  		<div class="logo-text">
		  			<h2><?php esc_html_e('GET PRO','auto-car-dealership'); ?></h2>
					<h4><?php esc_html_e('20% Off','auto-car-dealership'); ?></h4>
		  		</div>						
			</div>
	    </div>
	</div>
</div>
<?php }?>
