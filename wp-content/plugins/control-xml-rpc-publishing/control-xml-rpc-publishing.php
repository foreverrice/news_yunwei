<?php
/*
Plugin Name: Control XML-RPC publishing
Plugin URI: http://eng.marksw.com/2012/12/15/control-xml-rp…rdpress-plugin/
Description: Add The ability to enable and disable XML-RPC from admin
Author: Mark Kaplun
Version: 1.0
Author URI: http://eng.marksw.com
*/

/*
  Filter the XML-RPC enable state. 
  Respect any other plugin before filtering by our configuration
*/  
function mk_xrp_filter($enabled) {

  if (!$enabled)
    return false;
  if (get_option('mk_xrp_enable_xmlrpc') == '1')
    return true;
  return false;
}

add_filter('xmlrpc_enabled','mk_xrp_filter');

function mk_xrp_set_settings() {

   	load_plugin_textdomain( 'mk_xrp_filter', false, dirname( plugin_basename(__FILE__) ) . '/lang');

    register_setting( 'writing', 'mk_xrp_enable_xmlrpc', 'intval' );
	
 	add_settings_section('mk_xrp',
		__('Remote publishing with XML-RPC','mk_xrp_filter'),
		'mk_xrp_section_callback_function',
		'writing');

 	add_settings_field('status',
		'<label for="mk_xrp_enable_xmlrpc">'.__('Enabled','mk_xrp_textdomain').'</lable>',
		'mk_xrp_show',
		'writing',
		'mk_xrp');
		
}

function mk_xrp_section_callback_function() {
  echo '<p>'.__('Must be enabled to be able to post from mobile clients, desktop software or other web sites that use the XML-RPC protocol','mk_xrp_textdomain').'</p>';
}  

function mk_xrp_show() {
?>
<input name="mk_xrp_enable_xmlrpc" type="checkbox" id="mk_xrp_enable_xmlrpc" value="1" <?php checked('1', get_option('mk_xrp_enable_xmlrpc')); ?> />
<?php
}

add_action( 'admin_init', 'mk_xrp_set_settings' );

function mk_xrp_activate() {
  if (get_option('mk_xrp_enable_xmlrpc') === false) { // Don't initialize on reactivation
    add_option('mk_xrp_enable_xmlrpc','0','','no');
  }
}

register_activation_hook( __FILE__, 'mk_xrp_activate' );

?>
