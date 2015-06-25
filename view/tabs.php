<div class="wrap">
	<div id="smsbump-container">

		<h2>SMSBump Settings</h2>

		<h2 class="nav-tab-wrapper">
			<a href="?page=smsbump/smsbump.php&tab=bulk" class="nav-tab<?php if(!isset($_GET['tab']) || $_GET['tab'] == 'bulk') { echo " nav-tab-active"; } ?>"><?php _e('Bulk Messaging', 'smsbump'); ?></a>
			<a href="?page=smsbump/smsbump.php&tab=settings" class="nav-tab<?php if($_GET['tab'] == 'settings') { echo " nav-tab-active"; } ?>"><?php _e('Settings', 'smsbump'); ?></a>
			<?php if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) { ?>
			<a href="?page=smsbump/smsbump.php&tab=woocommerce" class="nav-tab<?php if($_GET['tab'] == 'woocommerce') { echo " nav-tab-active"; } ?>"><?php _e('WooCommerce', 'smsbump'); ?></a>
			<?php } ?>
			<a href="?page=smsbump/smsbump.php&tab=help" class="nav-tab<?php if($_GET['tab'] == 'help') { echo " nav-tab-active"; } ?>"><?php _e('Help', 'smsbump'); ?></a>
		</h2>
		
	</div>