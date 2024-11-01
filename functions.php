<?php
/*
This page is foir misc functions related to the thegdprlaw.com plugin
*/

##################################
//This shortcode will contact the remote api and request the details
//end point url: https://www.thegdprlaw.com/api/live/v1/privacy_policy/
##################################
add_shortcode( 'thegdprlaw_privacy_policy', 'thegdprlaw_privacy_policy_shortcode' );
function thegdprlaw_privacy_policy_shortcode( $atts, $content = null ) {
	
	global $wp_version;
	$args = array(
		'timeout'     => 5,
		'redirection' => 5,
		'httpversion' => '1.0',
		'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
		'blocking'    => true,
		'headers'     => array(),
		'cookies'     => array(),
		'body'        => null,
		'compress'    => false,
		'decompress'  => true,
		'sslverify'   => true,
		'stream'      => false,
		'filename'    => null,
		'headers' => array( 'thegdprlaw-api-key' => THEGDPRLAW_API_KEY),
	);
	
	$response = wp_remote_post( "https://www.thegdprlaw.com/api/live/v1/privacy_policy/", $args );
	if ( is_array( $response ) ) {
	  $header = $response['headers']; // array of http header lines
	  $body = $response['body']; // use the content
	} else {
		return "There was an unknown error, please contact " . THEGDPRLAW_API_CONTACT;
	}
	
	//convert the json api response to php array
	$php_array = json_decode($body,TRUE);
	
	//check if is array or not
	if(!is_array($php_array)) {
		return "There was an unknown error with the api response from thegdprlaw.com, please contact " . THEGDPRLAW_API_CONTACT;
	}
	
	//check if there is any custom css
	$options = get_option( 'thegdprlaw_settings' );
	$custom_css = $options['thegdprlaw_custom_css'];
	
	if(!empty($custom_css)) {
		$custom_css = "<style>$custom_css</style>";
	}

	//grab the privacy policy text (and adding css if there is any)
	$privacy_text_html = $custom_css . $php_array["PrivacyPolicyText"];

	//send response back to browser
	return $privacy_text_html;

}

//end of functions file
?>