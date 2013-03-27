<?php
/*
Plugin Name: Happy Collision Testing Functions
Description: Defines some nice functionality that other plugins might be happy to rely on. Also defines some useful functions for testing purposes.
Author: Don Denton
Version: 2.0
Author URI: http://happycollision.com
*/

//print the contents of any array (or object) in a human readable format
if(!function_exists('hcprint')){ function hcprint($any_array, $return = false, $html = false) {
	$output = print_r($any_array,true);
	if($html){
		$output = htmlentities($output);
	}
	if($return){
		return '<pre>' . $output . '</pre>';
	}
	echo '<pre>'.$output.'</pre>';
}}

// Why vommit? Because it isn't necessarily pretty... and it happens when it wants.
// js alert any string
if(!function_exists('vommit')){ function vommit($string) {
	$output = '<script type="text/javascript">
		alert("'.$string.'");</script>';
	echo $output;
}}

//Send php stuff to the console
if(!function_exists('console')){function console($string) {
	echo '<script type="text/javascript">console.log("'.$string.'");</script>';
}}

//Add any warnings to wp-admin screens
if(!function_exists('hcwarn')){ function hcwarn($message, $is_error = FALSE){
	$hc_warning_message = get_option('hc_warning_message');
	$hc_warning_message[]=array($message, $is_error);
	update_option('hc_warning_message', $hc_warning_message);
}}
add_action( 'admin_notices', 'happycol_custom_error_notice' );
if(!function_exists('happycol_custom_error_notice')){function happycol_custom_error_notice(){
	$hc_warning_message = get_option('hc_warning_message');
	if(is_array($hc_warning_message)) { foreach($hc_warning_message as $message){
		echo ($message[1]) ? '<div class="error">' : '<div class="updated">';
		echo is_array($message[0]) ? hcprint($message[0], true) : '<p>'.$message[0].'</p>';
		echo '</div>';
	}}
	update_option('hc_warning_message','');
}}


// Old habits...
if(!function_exists('ddprint')){ function ddprint($any_array, $return = false, $html = false) {
	hcprint($any_array,$return,$html);
}}
