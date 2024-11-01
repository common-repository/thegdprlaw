<?php 
add_action( 'admin_menu', 'thegdprlaw_add_admin_menu' );
add_action( 'admin_init', 'thegdprlaw_settings_init' );

function thegdprlaw_add_admin_menu(  ) { 

	add_submenu_page( 'options-general.php', THEGDPRLAW_PLUGIN_NAME, THEGDPRLAW_PLUGIN_NAME, 'manage_options', 'thegdprlaw_plugin', 'thegdprlaw_options_page' );

}

function thegdprlaw_settings_init(  ) { 

	register_setting( 'thegdprlaw_PluginPage', 'thegdprlaw_settings' );

	add_settings_section(
		'thegdprlaw_pluginPage_section', 
		__( '', 'wordpress' ), 
		'thegdprlaw_settings_section_callback', 
		'thegdprlaw_PluginPage'
	);

	add_settings_field( 
		'thegdprlaw_api_key', 
		__( 'Your GDPR LAW API Key', 'wordpress' ), 
		'thegdprlaw_api_key_render', 
		'thegdprlaw_PluginPage', 
		'thegdprlaw_pluginPage_section' 
	);
	
	add_settings_field( 
		'thegdprlaw_url_of_privacy_policy', 
		__( 'URL of Privacy Policy', 'wordpress' ), 
		'thegdprlaw_url_of_privacy_policy_render', 
		'thegdprlaw_PluginPage', 
		'thegdprlaw_pluginPage_section' 
	);
	
	add_settings_field( 
		'thegdprlaw_custom_css', 
		__( 'Enter Your Custom CSS Here', 'wordpress' ), 
		'thegdprlaw_custom_css_render', 
		'thegdprlaw_PluginPage', 
		'thegdprlaw_pluginPage_section' 
	);
	
}

//********************************//
//****    RENDER FORM FIELDS   ***//
//********************************//

##################
//API Key
##################
function thegdprlaw_api_key_render(  ) { 

	$options = get_option( 'thegdprlaw_settings' );
	?>
	<input size="45" type="text" name="thegdprlaw_settings[thegdprlaw_api_key]" value="<?php echo $options['thegdprlaw_api_key']; ?>">
	<?php

}

##################
//Privacy Policy URL
##################
function thegdprlaw_url_of_privacy_policy_render(  ) { 

	$options = get_option( 'thegdprlaw_settings' );
	?>
	<input size="45" type="text" name="thegdprlaw_settings[thegdprlaw_url_of_privacy_policy]" value="<?php echo $options['thegdprlaw_url_of_privacy_policy']; ?>">
	<?php

}

##################
//Custom CSS
##################
function thegdprlaw_custom_css_render(  ) { 

	$options = get_option( 'thegdprlaw_settings' );
	?>
	<textarea rows="8" cols="50" name="thegdprlaw_settings[thegdprlaw_custom_css]"><?php echo $options['thegdprlaw_custom_css']; ?></textarea>
	<?php

}

//********************************//
//****  END RENDER FORM FIELDS ***//
//********************************//

function thegdprlaw_settings_section_callback(  ) {
	
	echo __( '<hr>', 'wordpress' );
	echo __( '<h2>API Information</h2>', 'wordpress' );
	echo __( 'For advanced users, we offer a REST API. Please see the api documentation here: <a href="https://www.thegdprlaw.com/api/docs/" target="_blank">https://www.thegdprlaw.com/api/docs/</a>', 'wordpress' );
	echo __( '<br><hr><br>', 'wordpress' );

}

function thegdprlaw_options_page(  ) {
	
	?>
	<form action='options.php' method='post'>

		<h2><?php echo THEGDPRLAW_PLUGIN_NAME ?> (Version: <?php echo THEGDPRLAW_VERSION ?>)</h2>
		<p>This plugin helps you display GDPR compliant privacy policy on your web site without the fuss of maintaining and keeping it up to date.</p>
		<p>INSTRUCTIONS: Put the following short code on the page where you want to show the privacy policy: [thegdprlaw_privacy_policy].</p>
		<p>DISCLAIMER: You, the site owner are responsible for GDPR compliance, we are merely providing a service to help you. Whilst we take every step to ensure that the privacy policy templates provided meet GDPR criteria, you should also seek qualifed legal advice.</p>
		<p>For any questions, feature requests or development of this plugin, please contact <a href="mailto:<?php echo THEGDPRLAW_API_CONTACT ?>"><?php echo THEGDPRLAW_API_CONTACT ?></a></p>

		<?php
		settings_fields( 'thegdprlaw_PluginPage' );
		do_settings_sections( 'thegdprlaw_PluginPage' );
		submit_button("Update Your Settings");
		?>

	</form>
	<?php

}

?>