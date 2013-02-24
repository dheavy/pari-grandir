<?php
// Insert all backend functions for custom pages.
$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

if ($template_file == 'page-accueil.php') {
	require_once('backend/functions.page-accueil.php');
}