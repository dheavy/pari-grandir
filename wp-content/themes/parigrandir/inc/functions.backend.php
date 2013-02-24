<?php
// Displays the proper customisation for page depending on the page template.
$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

switch ($template_file) 
{
	case 'page-accueil.php':
		require_once('backend/functions.page-accueil.php');
		break;

	case 'page-presentation.php':
		require_once('backend/functions.page-presentation.php');
		break;

	case 'page-atelierbebeetparents-massagebebe.php':
		require_once('backend/functions.page-atelierbebeetparents-massagebebe.php');
		break;
}