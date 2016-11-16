<!DOCTYPE html>
<html>
<head <?php language_attributes(); ?> >
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title>WP CUSTOMANAGER</title>
	<?php wp_head(); 
	//
	/*wp_enqueue_style("bootstrap-css", get_template_directory_uri()."/css/bootstrap.min.css" );
	//
	wp_enqueue_script("jquery2-js", get_template_directory_uri()."/js/jquery2.min.js");
	wp_enqueue_script("bootbox-js", get_template_directory_uri()."/js/bootbox.min.js");
	wp_enqueue_script("bootstrap-js", get_template_directory_uri()."/js/bootstrap.min.js");*/
	?>
	
</head>
<body <?php body_class(); ?>>

<div class="container" style="padding-top:80px;">

<?php
	get_template_part("navbar");
?>