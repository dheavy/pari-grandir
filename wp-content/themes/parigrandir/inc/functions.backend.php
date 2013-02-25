<?php
/**
 * Displays the proper customisation for page depending on the page template.
 */

$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
$template_file = get_post_meta($post_id, '_wp_page_template', TRUE);

switch ($template_file) 
{
	case 'page-accueil.php':
		require_once('backend/functions.page-accueil.php');
		break;

	case 'page-presentation.php':
		require_once('backend/functions.page-presentation.php');
		break;

	case 'page-atelierbebeetparents-massagebebe.php':
	case 'page-atelierbebeetparents-babygym.php':
	case 'page-atelierbebeetparents-chanteravecbebe.php':
		require_once('backend/functions.page-atelierbebeetparents.php');
		break;

	case 'page-atelierenfants-20mois3ans-eveilmusical.php':
	case 'page-atelierenfants-20mois3ans-gymmotricite.php':
	case 'page-atelierenfants-20mois3ans-prepaabc.php':
	case 'page-atelierenfants-3ans6ans-anglais.php':
	case 'page-atelierenfants-3ans6ans-artsplastiques.php':
	case 'page-atelierenfants-3ans6ans-momentsmusicaux.php':
	case 'page-atelierenfants-3ans6ans-theatre.php':
	case 'page-atelierenfants-3ans6ans-yogakids.php':
		require_once('backend/functions.page-atelierenfants.php');
		break;

	case 'page-atelieradultes-chantprenatal.php':
	case 'page-atelieradultes-portagebebe.php':
	case 'page-atelieradultes-sophrologie.php':
	case 'page-atelieradultes-yogapostnatal.php':
	case 'page-atelieradultes-yogaprenatal.php':
		require_once('backend/functions.page-atelieradultes.php');
		break;

	case 'page-planningettarifs-3a6ans.php':
	case 'page-planningettarifs-6a10ans.php':
	case 'page-planningettarifs-adultebebe.php':
		require_once('backend/functions.page-planningettarifs.php');
		break;

	case 'page-anniversaire.php':
	case 'page-happymercredi.php':
	case 'page-sortiedecole.php':
	case 'page-vacancesscolaires.php':
		require_once('backend/functions.page-activites-extra.php');
		break;

	case 'page-presse.php':
	case 'page-jouetsetaccessoires.php':
	case 'page-planetcontact.php':
	case 'page-mentionslegales.php':
	case 'page-recrutement.php':
		require_once('backend/functions.page-sections-extra.php');
		break;

	case 'page-entreprises.php':
		require_once('backend/functions.page-entreprises.php');
		break;
}