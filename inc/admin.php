<?php

///////////////SAVE DATA ON SUBMIT///////////////////
add_action('init', 'wpaq_save_settings');

function wpaq_save_settings(){
	if(!empty($_POST['submitcSettingsForm']) && isset($_POST['submitcSettingsForm'])){

		//check for nonce
		$retrieved_nonce = $_REQUEST['_wpnonce'];
		if (!wp_verify_nonce($retrieved_nonce, 'fsc_settings_nonce' ) ) die( 'Failed security check' );
		//
	
		//save settings
		if(@$_POST['wpaq_enabled']){
			update_option('wpaq_enabled',1);
		}else{
			delete_option('wpaq_enabled');
		}
		
		update_option('wpaq_font_color',@$_POST['wpaq_font_color']);
		update_option('wpaq_background_color',@$_POST['wpaq_background_color']);
		update_option('wpaq_font_size',@$_POST['wpaq_font_size']);
		update_option('wpaq_border_color',@$_POST['wpaq_border_color']);
		
	}
}

//display admin menu
add_action('admin_menu', 'wpaq_admin_menu');
function wpaq_admin_menu(){
    add_menu_page('Awesome Quotes', 'Awesome Quotes', 'manage_options', 
	'wpaq-settings', 'wpaq_settings',WPAQ_PLUGIN_URL."/assets/icon-20x20.png");

	add_submenu_page('wpaq-settings','All Quotes',' All Quotes',
	'edit_posts','edit.php?post_type=wpaq_quotes',"",'1');

    add_submenu_page('wpaq-settings','Add New Quote',' Add New Quote',
    'manage_options','post-new.php?post_type=wpaq_quotes',"",'2');
}
// function manage_quotes_function1(){
// echo "h1";
// 	}
// function manage_quotes_function(){
// 	wp_redirect(admin_url().'/post-new.php?post_type=wpaq_quotes');
// 	exit;
// }

function wpaq_settings(){
	//get all settings
	$wpaq_enabled = get_option('wpaq_enabled');
	$wpaq_font_color = get_option('wpaq_font_color');
	$wpaq_font_size = get_option('wpaq_font_size');
	$wpaq_background_color = get_option('wpaq_background_color');
	$wpaq_border_color = get_option('wpaq_border_color');
	
	
	?>

	<div class="fsc_container">
		<div class="fsc_container_inner">
			<div class="fsc_title">
				<div class="caption">
					<h1 class="caption-subject font-green-sharp "><?php _e('Awesome Quotes Settings', 'cqpim'); ?> </h1>
				</div>
			</div>
			<hr/>	
			<table class="settingsTable">
				<form method="post" action="" id="settingsForm">	
				<?php wp_nonce_field('fsc_settings_nonce'); ?>
				<tr>
					<td>Enable Quotes</td>
					<td><input type="checkbox" name="wpaq_enabled" id="wpaq_enabled" value="1" <?php if($wpaq_enabled==1) { echo "checked"; } ?>></td>
				</tr>
				<tr>
					<td style="height:20px"></td>
				</tr>
					
				<tr>
					<td>Font Color:</td>
					<td><input type="color" name="wpaq_font_color" id="wpaq_font_color" value="<?php echo $wpaq_font_color; ?>"></td>
				</tr>
				<tr>
					<td style="height:20px"></td>
				</tr>
				<tr>
					<td>Font Size(px):</td>
					<td><input type="number" name="wpaq_font_size" id="wpaq_font_size" value="<?php echo $wpaq_font_size; ?>"></td>
				</tr>	
					
				<tr>
					<td style="height:20px"></td>
				</tr>	
				<tr>
					<td>Background Color:</td>
					<td><input type="color" name="wpaq_background_color" id="wpaq_background_color" value="<?php echo $wpaq_background_color; ?>"></td>
				</tr>	
				<tr>
					<td style="height:20px"></td>
				</tr>	
				<tr>
					<td>Border Color:</td>
					<td><input type="color" name="wpaq_border_color" id="wpaq_border_color" value="<?php echo $wpaq_border_color; ?>"></td>
				</tr>	
				<tr>
					<td style="height:20px"></td>
				</tr>			
				<tr>
					<td></td><input type="hidden"  name="submitcSettingsForm" value="submitcSettingsForm" />
					<td><button type="submit" class="button button-primary">Save Settings</button></td>
				</tr>
				</form>		
				
			</table>
		</div>
	</div>
	<style>
		.fsc_container{
			background:#fff;
			width:100%;
			margin-top:20px;
		}
		.fsc_container_inner{
			padding:20px;
		}
	</style>		
<?php				

}
