<?php
/*
Plugin Name: Stop XML-RPC
Plugin URI: https://github.com/dasj19/stop-xml-rpc
Description: This plugin disables and stops everything related to XML-RPC API in WordPress 6+.
Version: 0.1
Author: Daniel Șerbănescu
Author URI: https://github.com/dasj19
License: GPLv3
*/

// disable XML-RPC methods that require authentication.
add_filter( 'xmlrpc_enabled', '__return_false' );
// disable all xmlrpc methods.
add_filter( 'xmlrpc_methods', '__return_empty_array' );

// Remove the xmlrpc link from the html head.
remove_action( 'wp_head', 'rsd_link' );

add_action( 'wp_loaded', 'xmlrpc_disable' );

function xmlrpc_disable() {
    global $pagenow, $wp_query;
    if ( $pagenow === 'xmlrpc.php' ) {
        // Define this page as 404.
        $wp_query->set_404();
        // Respond with 404 server header.
        status_header( 404 );
        // Get and return the theme template for 404.
        get_template_part( 404 );
        // Tell the browser that we are returning HTML.
        header( 'Content-type: text/html' );
        // Terminate the request without further processing.
        exit();
    }
}
?>