<?php
/*
Plugin Name: GeoNames Form
Description: A plugin to display countries and cities dropdowns using the GeoNames API
Version: 1.0
Author: Ricardo Ortiz V
*/

// Boostrap
function enqueue_bootstrap_and_jquery() {
    wp_enqueue_script('jquery');
    wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), '', true);
}

add_action('wp_enqueue_scripts', 'enqueue_bootstrap_and_jquery');

// Js Script
function enqueue_geonames_dropdown_script() {
    wp_enqueue_script('geonames-dropdown', plugin_dir_url(__FILE__) . 'js/geonames-script.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_geonames_dropdown_script');

// Shortcode deployment for WordPress
function geonames_form_shortcode() {
    ob_start(); // Start an output buffer

    // Include the template file with the form
    include(plugin_dir_path(__FILE__) . 'templates/geonames-form-template.php');

    return ob_get_clean(); // Return the contents of the output buffer
}

add_shortcode('geonames_form', 'geonames_form_shortcode');

// Aditional css (fonts)
function enqueue_custom_styles() {
    wp_enqueue_style('custom-styles', plugin_dir_url(__FILE__) . 'css/custom-styles.css');
}

add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

?>