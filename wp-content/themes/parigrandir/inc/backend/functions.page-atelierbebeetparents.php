<?php
/**
 * Atelier Bébé et Parents
 * ----------------------------------------
 * Has 10 main text fields:
 * - title (fr) is the main page title content used in WP by default, no need to create it
 * - title (en) 
 * - main (fr) is the main text content fields used in WP by default, no need to create it
 * - main (en)
 * - headerinfo (fr)
 * - headerinfo (en)
 * - schedule (fr)
 * - schedule (en)
 * - costs (fr)
 * - costs (en)
 */

/**
 * Setup the custom page's content boxes.
 */
add_action('add_meta_boxes', 'pg_add_meta_boxes');
function pg_add_meta_boxes() 
{
	global $post;

	add_meta_box('en_title', __('Page title in English'), 'create_en_title_field', 'page');
	add_meta_box('en_main', __('Main text - English text'), 'create_en_main_field', 'page');
	add_meta_box('fr_headerinfo', __('Header information ("3 mois - 2 ans") - French text'), 'create_fr_headerinfo_field', 'page');
	add_meta_box('en_headerinfo', __('Header information ("3 mois - 2 ans") - English text'), 'create_en_headerinfo_field', 'page');
	add_meta_box('fr_schedule', __('Horaires / Schedule - French text'), 'create_fr_schedule_field', 'page');
	add_meta_box('en_schedule', __('Horaires / Schedule - English text'), 'create_en_schedule_field', 'page');
	add_meta_box('fr_costs', __('Tarifs / Fees - French text'), 'create_fr_costs_field', 'page');
	add_meta_box('en_costs', __('Tarifs / Fees - English text'), 'create_en_costs_field', 'page');

	function create_en_title_field($post) 
	{
		$custom = get_post_custom($post->ID);

		// Use WP nonce token once for verification.
		wp_nonce_field(plugin_basename(__FILE__), 'pg-nonce');
		
		// Repopulate field with previous content if it exists.
		$en_title = $custom['en_title'][0];

		// Setup field.
		echo '<input type="text" id="admin-en-title" name="admin-en-title" value="' . $en_title . '" size="100" />';
	}

	function create_en_main_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$en_main = $custom['en_main'][0];
		wp_editor($en_main, 'admin-en-main', array('media_buttons' => true));
	}

	function create_fr_headerinfo_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$fr_headerinfo = $custom['fr_headerinfo'][0];
		wp_editor($fr_headerinfo, 'admin-fr-headerinfo', array('media_buttons' => true));
	}

	function create_en_headerinfo_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$en_headerinfo = $custom['en_headerinfo'][0];
		wp_editor($en_headerinfo, 'admin-en-headerinfo', array('media_buttons' => true));
	}

	function create_fr_schedule_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$fr_schedule = $custom['fr_schedule'][0];
		wp_editor($fr_schedule, 'admin-fr-schedule', array('media_buttons' => true));
	}

	function create_en_schedule_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$en_schedule = $custom['en_schedule'][0];
		wp_editor($en_schedule, 'admin-en-schedule', array('media_buttons' => true));
	}

	function create_fr_costs_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$fr_costs = $custom['fr_costs'][0];
		wp_editor($fr_costs, 'admin-fr-costs', array('media_buttons' => true));
	}

	function create_en_costs_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$en_costs = $custom['en_costs'][0];
		wp_editor($en_costs, 'admin-en-costs', array('media_buttons' => true));
	}
}

/**
 * Save content when user presses Publish.
 */
add_action('save_post', 'pg_save_accueil_postdata');
function pg_save_accueil_postdata()
{
	global $post;

	// Abort if currently auto-saving.
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	// Verify transaction authenticity.
	if (!wp_verify_nonce($_POST['pg-nonce'], plugin_basename(__FILE__))) return;

	// Check permissions.
	if ($_POST['post_type'] == 'page') {
		if (!current_user_can('edit_page', $post->ID)) return;
	} else {
		if (!current_user_can('edit_post', $post->ID)) return;
	}

	// Tags will be stripped in the rich text box if wpautop() function isn't used :(
	$en_title = $_POST['admin-en-title'];
	$en_main = $_POST['admin-en-main'];
	$fr_headerinfo = $_POST['admin-fr-headerinfo'];
	$en_headerinfo = $_POST['admin-en-headerinfo'];
	$fr_schedule = $_POST['admin-fr-schedule'];
	$en_schedule = $_POST['admin-en-schedule'];
	$fr_costs = $_POST['admin-fr-costs'];
	$en_costs = $_POST['admin-en-costs'];

	// Save
	add_post_meta($post->ID, 'en_title', $en_title, true) or update_post_meta($post->ID, 'en_title', $en_title);
	add_post_meta($post->ID, 'en_main', $en_main, true) or update_post_meta($post->ID, 'en_main', $en_main);
	add_post_meta($post->ID, 'fr_headerinfo', $fr_headerinfo, true) or update_post_meta($post->ID, 'fr_headerinfo', $fr_headerinfo);
	add_post_meta($post->ID, 'en_headerinfo', $en_headerinfo, true) or update_post_meta($post->ID, 'en_headerinfo', $en_headerinfo);
	add_post_meta($post->ID, 'fr_schedule', $fr_schedule, true) or update_post_meta($post->ID, 'fr_schedule', $fr_schedule);
	add_post_meta($post->ID, 'en_schedule', $en_schedule, true) or update_post_meta($post->ID, 'en_schedule', $en_schedule);
	add_post_meta($post->ID, 'fr_costs', $fr_costs, true) or update_post_meta($post->ID, 'fr_costs', $fr_costs);
	add_post_meta($post->ID, 'en_costs', $en_costs, true) or update_post_meta($post->ID, 'en_costs', $en_costs);
}