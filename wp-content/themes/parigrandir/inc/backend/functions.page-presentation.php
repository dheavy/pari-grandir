<?php
/**
 * Presentation
 * ------------------
 * Has 8 main text fields:
 * - title (fr) is the main page title content used in WP by default, no need to create it
 * - title (en) 
 * - quisommesnous (fr) is the main text content fields used in WP by default, no need to create it
 * - quisommesnous (en)
 * - lecentre (fr)
 * - lecentre (en)
 * - sponsors (fr)
 * - sponsors (en)
 */

/**
 * Setup the custom page's content boxes.
 */
add_action('add_meta_boxes', 'pg_add_meta_boxes');
function pg_add_meta_boxes() 
{
	global $post;

	add_meta_box('en_title', __('Page title in English'), 'create_en_title_field', 'page');
	add_meta_box('en_quisommesnous', __('Qui sommes nous - English text'), 'create_en_quisommesnous_field', 'page');
	add_meta_box('fr_lecentre', __('Le Centre Pari Grandir - French text'), 'create_fr_lecentre_field', 'page');
	add_meta_box('en_lecentre', __('Le Centre Pari Grandir - English text'), 'create_en_lecentre_field', 'page');
	add_meta_box('fr_sponsors', __('Partenaires et sponsors - French text'), 'create_fr_sponsors_field', 'page');
	add_meta_box('en_sponsors', __('Partenaires et sponsors - English text'), 'create_en_sponsors_field', 'page');

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

	function create_en_quisommesnous_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$en_quisommesnous = $custom['en_quisommesnous'][0];
		wp_editor($en_quisommesnous, 'admin-en-quisommesnous', array('media_buttons' => false));
	}

	function create_fr_lecentre_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$fr_lecentre = $custom['fr_lecentre'][0];
		wp_editor($fr_lecentre, 'admin-fr-lecentre', array('media_buttons' => true));
	}

	function create_en_lecentre_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$en_lecentre = $custom['en_lecentre'][0];
		wp_editor($en_lecentre, 'admin-en-lecentre', array('media_buttons' => true));
	}

	function create_fr_sponsors_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$fr_sponsors = $custom['fr_sponsors'][0];
		wp_editor($fr_sponsors, 'admin-fr-sponsors', array('media_buttons' => true));
	}

	function create_en_sponsors_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$en_sponsors = $custom['en_sponsors'][0];
		wp_editor($en_sponsors, 'admin-en-sponsors', array('media_buttons' => true));
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
	$en_quisommesnous = $_POST['admin-en-quisommesnous'];
	$fr_lecentre = $_POST['admin-fr-lecentre'];
	$en_lecentre = $_POST['admin-en-lecentre'];
	$fr_sponsors = $_POST['admin-fr-sponsors'];
	$en_sponsors = $_POST['admin-en-sponsors'];

	// Save
	add_post_meta($post->ID, 'en_title', $en_title, true) or update_post_meta($post->ID, 'en_title', $en_title);
	add_post_meta($post->ID, 'en_quisommesnous', $en_quisommesnous, true) or update_post_meta($post->ID, 'en_quisommesnous', $en_quisommesnous);
	add_post_meta($post->ID, 'fr_lecentre', $fr_lecentre, true) or update_post_meta($post->ID, 'fr_lecentre', $fr_lecentre);
	add_post_meta($post->ID, 'en_lecentre', $en_lecentre, true) or update_post_meta($post->ID, 'en_lecentre', $en_lecentre);
	add_post_meta($post->ID, 'fr_sponsors', $fr_sponsors, true) or update_post_meta($post->ID, 'fr_sponsors', $fr_sponsors);
	add_post_meta($post->ID, 'en_sponsors', $en_sponsors, true) or update_post_meta($post->ID, 'en_sponsors', $en_sponsors);
}