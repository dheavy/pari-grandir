<?php
/**
 * Accueil (homepage)
 * ------------------
 * Has 6 main text fields:
 * - title (fr) is the main page title content used in WP by default, no need to create it
 * - title (en) 
 * - bienvenue (fr) is the main text content fields used in WP by default, no need to create it
 * - welcome (en)
 * - news (fr)
 * - news (en)
 * 
 * Inserting images in "bienvenue" (fr) makes them appear 
 * as an image slideshow on the homepage.
 */

/**
 * Setup the custom page's content boxes.
 */
add_action('add_meta_boxes', 'pg_add_meta_boxes');
function pg_add_meta_boxes() 
{
	global $post;

	add_meta_box('en_title', __('Page title in English'), 'create_en_title_field', 'page');
	add_meta_box('en_welcome', __('Bienvenue / Welcome English text'), 'create_en_welcome_field', 'page');
	add_meta_box('fr_news', __('News text in French'), 'create_fr_news_field', 'page');
	add_meta_box('en_news', __('News text in English'), 'create_en_news_field', 'page');

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

	function create_en_welcome_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$en_welcome = $custom['en_welcome'][0];
		echo '<label for="wp-admin-en-welcome-wrap">';
			_e("Bienvenue / Welcome English text");
		echo '</label>';
		wp_editor($en_welcome, 'admin-en-welcome', array('media_buttons' => false));
	}

	function create_fr_news_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$fr_news = $custom['fr_news'][0];
		echo '<label for="wp-admin-fr-news-wrap">';
			_e("Bienvenue / Welcome English text");
		echo '</label>';
		wp_editor($fr_news, 'admin-fr-news', array('media_buttons' => false));
	}

	function create_en_news_field($post) 
	{
		$custom = get_post_custom($post->ID);
		$en_news = $custom['en_news'][0];
		echo '<label for="wp-admin-en-news-wrap">';
			_e("Bienvenue / Welcome English text");
		echo '</label>';
		wp_editor($en_news, 'admin-en-news', array('media_buttons' => false));
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
	$en_welcome = $_POST['admin-en-welcome'];
	$fr_news = $_POST['admin-fr-news'];
	$en_news = $_POST['admin-en-news'];

	// Save
	add_post_meta($post->ID, 'en_title', $en_title, true) or update_post_meta($post->ID, 'en_title', $en_title);
	add_post_meta($post->ID, 'en_welcome', $en_welcome, true) or update_post_meta($post->ID, 'en_welcome', $en_welcome);
	add_post_meta($post->ID, 'fr_news', $fr_news, true) or update_post_meta($post->ID, 'fr_news', $fr_news);
	add_post_meta($post->ID, 'en_news', $en_news, true) or update_post_meta($post->ID, 'en_news', $en_news);
}