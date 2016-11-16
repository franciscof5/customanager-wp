<?php
function themeslug_enqueue_style() {
	wp_enqueue_style("bootstrap-css", get_template_directory_uri()."/css/bootstrap.min.css");
}

function themeslug_enqueue_script() {
	wp_enqueue_script("jquery2-js", get_template_directory_uri()."/js/jquery2.min.js");
	wp_enqueue_script("bootbox-js", get_template_directory_uri()."/js/bootbox.min.js");
	wp_enqueue_script("bootstrap-js", get_template_directory_uri()."/js/bootstrap.min.js");
}

add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );