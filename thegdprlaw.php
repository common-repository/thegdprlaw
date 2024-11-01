<?php 
/*
Plugin Name: The GDPR Law
Version: 1.8
Author: Craig Edmonds
Plugin URI: https://www.thegdprlaw.com
Email: craig@thegdprlaw.com
Date: 14th of May 2018
Description: Our plugin helps you with GDPR compliance whereby you can apply a shortcode; [thegdprlaw_privacy_policy], to a page/post and we will provide you with a base privacy policy template with your details filled in.
*/

###################################
//LOAD THE THEGDPRLAW OPTIONS/SETTINGS
###################################
$options = get_option( 'thegdprlaw_settings' );

###################################
//PLUGIN NAME
###################################
define( 'THEGDPRLAW_PLUGIN_NAME', "The GDPR Law" );

###################################
//HOST NAME
###################################
define( 'THEGDPRLAW_PLUGIN_HOST_NAME', $_SERVER['HTTP_HOST'] );

###################################
//RESALES ONLINE API KEY
###################################
define( 'THEGDPRLAW_API_KEY', $options['thegdprlaw_api_key'] );

###################################
//get the current plugin path
###################################
define( 'THEGDPRLAW_PATH_TO_PLUGIN', plugin_dir_path( __FILE__ ) );

###################################
//get the current plugin folder url
###################################
define( 'THEGDPRLAW_URL_TO_PLUGIN', plugin_dir_url( __FILE__ ) );

###################################
//GET PLUGIN DATA
###################################
if( !function_exists('get_plugin_data') ){ require_once( ABSPATH . 'wp-admin/includes/plugin.php' ); }
$thegdprlaw_version = get_plugin_data( __FILE__, $markup = true, $translate = true );
define( 'THEGDPRLAW_VERSION', $thegdprlaw_version["Version"]);

###################################
//API DEVELOPER
###################################
define( 'THEGDPRLAW_API_CONTACT', "craig@thegdprlaw.com" );

###################################
//get functions
###################################
require_once(THEGDPRLAW_PATH_TO_PLUGIN . "functions.php");
require_once(THEGDPRLAW_PATH_TO_PLUGIN. "functions-options.php");


