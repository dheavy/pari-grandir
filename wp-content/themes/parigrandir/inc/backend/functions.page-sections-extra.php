<?php
/**
 * Template for "Presse", "Jouets et accessoires", "Plan & contact", "Mentions légales", "Recrutement"
 * ---------------------------------------------------------------------------------------------------
 * Has 4 main text fields:
 * - title (fr) is the main page title content used in WP by default, no need to create it
 * - title (en) 
 * - main (fr) is the main text content fields used in WP by default, no need to create it
 * - main (en)
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

	// Save
	add_post_meta($post->ID, 'en_title', $en_title, true) or update_post_meta($post->ID, 'en_title', $en_title);
	add_post_meta($post->ID, 'en_main', $en_main, true) or update_post_meta($post->ID, 'en_main', $en_main);
}