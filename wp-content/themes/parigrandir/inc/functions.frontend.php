<?php
/**
 * Bilinguism across the website needs session for state management.
 * The wp-config.php file at the root of the PHP install has been hacked 
 * with a couple of line at its very beginning to enable session management.
 */
add_action('init', 'start_session', 1);
add_action('wp_logout', 'stop_session');
add_action('wp_login', 'stop_session');

function start_session() {
  if(!session_id()) {
    session_start();
  }
}

function stop_session() {
  session_destroy ();
}

/**
 * BILINGUALISM FUNCTIONS
 * =================================================================================================
 */
if (!isset($_SESSION['current_lang'])) 
	$_SESSION['current_lang'] = 'fr';

$requested_lang = $_GET['lang'];
if ($requested_lang == 'fr' || $requested_lang == 'en') {
	$_SESSION['current_lang'] = $requested_lang;
	//$result = array('success' => $_SESSION['current_lang']);
} else {
	//$result = array('error' => 'fr or en only');
}

/*
add_action('wp_ajax_switch', 'ajax_switch_lang');
add_action('wp_ajax_nopriv_switch', 'ajax_switch_lang');
function ajax_switch_lang()
{
	$result = array();
	$requested_lang = $_GET['lang'];
	if ($requested_lang == 'fr' || $requested_lang == 'en') {
		$_SESSION['current_lang'] = $requested_lang;
		$result = array('success' => $_SESSION['current_lang']);
	} else {
		$result = array('error' => 'fr or en only');
	}
	header("Content-Type: text/json");
	die(json_encode($result));
}
*/

/**
 * LAYOUT FUNCTIONS
 * =================================================================================================
 */
function pg_get_header()
{
	echo <<<EOT
	<div id="wrapper">

	<header>
		<h1 class="fr"><a href="/" alt="Cliquez ici pour retourner &agrave; l'accueil" title="Retourner &agrave; l'accueil">Pari-Grandir | Centre ludo-&eacute;ducatif bilingue</a></h1>
		<h1 class="en"><a href="/" alt="Click here to go back to homepage" title="Back to homepage">Pari-Grandir | Centre ludo-&eacute;ducatif bilingue</a></h1>
		<div class="header-links">		
			<div id="lang-switchers">
				<div class="lang-switch"><a href="?lang=fr" class="to-fr" data-lang="fr">fran&ccedil;ais</a></div>
				<div class="lang-switch"><a href="?lang=en" class="to-en" data-lang="en">english</a></div>
			</div>
			<span class="fr to-blog"><a href="http://pari-grandir.blogspot.fr/" alt="Cliquer ici pour d&eacute;couvrir notre blog" title="D&eacute;couvrir notre blog">The Blog</a></span>
			<span class="en to-blog"><a href="http://pari-grandir.blogspot.fr/" alt="Click here to read our blog" title="Read our blog">The Blog</a></span>
		</div>
	</header>
EOT;
}

function pg_get_nav() 
{
	// Declare global $all_pages here. Used later for other nav elements.
	global $all_pages;

	// Already existing $post global.
	global $post;

	echo '<nav class="top">' . "\n";
	echo '<ul>' . "\n";
	
	$all_pages = get_pages(array(
		'sort_column' => 'menu_order'
	));

	//var_dump(count($all_pages));
	$i = 0;
	foreach ($all_pages as $key => $page) {
		// Parse content.
		$page_id = $page->ID;
		$custom = get_post_custom($page_id);
		$page_title = array(
			'fr' => $page->post_title,
			'en' => $custom['en_title'][0]
		);
		$permalink = get_permalink($page_id);

		// Display and arrange hierarchical menu:
		// if page has subpage(s), clicking on it doesn't change current URL,
		// and a submenu is set up. Poll only if page isn't a subpage so
		// that we don't verify pages deeper than root and root+1 level.
		if ($page->post_parent == 0) {
			if (pg_has_children($page_id)) {
				echo '<li class="menu menu-item menu-item-' . $i . '">' . "\n";
				echo '	<span class="fr"><a class="has-flyout-menu" href="#" rel="nofollow" data-submenu="submenu-item-' . $i . '">' . $page_title['fr'] . '</a></span>' . "\n";
				echo '	<span class="en"><a class="has-flyout-menu" href="#" rel="nofollow" data-submenu="submenu-item-' . $i . '">' . $page_title['en'] . '</a></span>' . "\n";
				echo '	<ul class="submenu submenu-item-' . $i .'">' . "\n";

				// Go one level deep and build submenu.
				$subpages = get_page_children($page_id, $all_pages);
				foreach ($subpages as $subkey => $subpage) {
					$subpage_id = $subpage->ID;
					$subpage_permalink = get_permalink($subpage_id);
					$subpage_title = array(
						'fr' => $subpage->post_title,
						'en' => ''
					);
					echo '		<li>' . "\n";
					echo '			<span class="fr"><a href="' . $subpage_permalink . '" alt="Aller &agrave; la rubrique ' . $subpage_title['fr'] . '" title="Aller &agrave; la rubrique ' . $subpage_title['fr'] . '">' . $subpage_title['fr'] . '</a></span>' . "\n";
					echo '			<span class="en"><a href="' . $subpage_permalink . '" alt="Go to ' . $subpage_title['en'] . '" title="Go to ' . $subpage_title['en'] . '">' . $subpage_title['en'] . '</a></span>' . "\n";
					echo '		</li>' . "\n";
				}

				echo '	</ul>' . "\n";
				echo '</li>' . "\n";
			} else {
				echo '<li class="menu menu-item menu-item-' . $i . '">' . "\n";
				echo '<span class="fr"><a href="' . $permalink . '" alt="Aller &agrave; la rubrique ' . $page_title['fr'] . '" title="Aller &agrave; la rubrique ' . $page_title['fr'] . '">' . $page_title['fr'] . '</a></span>' . "\n";
				echo '<span class="en"><a href="' . $permalink . '" alt="Go to ' . $page_title['en'] . '" title="Go to ' . $page_title['en'] . '">' . $page_title['en'] . '</a></span>' . "\n";
				echo '</li>' . "\n";
			}

			// Remove element from array.
			unset($all_pages[$key]);

			$i++;

			if ($i == 10) break;
		}
	}

	echo '</ul>' . "\n";
	echo '</nav>' . "\n";
	echo '<nav id="flyout-container"></nav>' . "\n";
}

function pg_get_extra_links() 
{
	global $all_pages;

	$terms = null;
	$jobs = null;

	foreach ($all_pages as $page) {
		if ($page->post_parent == 0) {
			if ($page->post_name == "mentions-legales") $terms = $page;
			else if ($page->post_name == "recrutement") $jobs = $page;
		}
	}

	$terms_permalinks = get_permalink($terms->ID);
	$jobs_permalinks = get_permalink($jobs->ID);

	$terms_title_fr = $terms->post_title;
	$terms_title_en = 'Terms &amp; Conditions';
	$jobs_title_fr = $jobs->post_title;
	$jobs_title_en = 'Jobs';

	echo <<<EOT
	<div class="extra-links">
		<ul class="fr">
			<li><a href="$terms_permalinks" alt="" title="">$terms_title_fr</a></li>
			<li><a href="$jobs_permalinks" alt="" title="">$jobs_title_fr</a></li>
		</ul>
		<ul class="en">
			<li><a href="$terms_permalinks" alt="" title="">$terms_title_en</a></li>
			<li><a href="$jobs_permalinks" alt="" title="">$jobs_title_en</a></li>
		</ul>
	</div>
EOT;
}

function pg_get_footer_tabs() 
{
	global $all_pages;
	$i = 0;

	echo '<section class="tabs">' . "\n";
	echo '	<ul>' . "\n";

	foreach ($all_pages as $key => $page) {
		if ($page->post_parent == 0) {

			// Parse content.
			$page_id = $page->ID;
			$page_title = array(
				'fr' => $page->post_title,
				'en' => ''
			);
			$permalink = get_permalink($page_id);

			echo '		<li><a href="' . $permalink . '" alt="" title="" class="fr tab-' . $i . '">' . $page_title['fr'] . '</a><a href="' . $permalink . '" alt="" title="" class="en tab-' . $i . '">' . $page_title['en'] . '</a></li>' . "\n";
			
			unset($all_pages[$key]);
			$i++;

			if ($i == 4) break;
		}
	}

	echo '	</ul>' . "\n";
	echo '</section>' . "\n";
}

function pg_get_social() 
{
	echo <<<EOT
	<div class="social">
		<span class="fb">
				<a class="fr" href="https://www.facebook.com/pages/Pari-Grandir/190695747698973" target="_blank" alt="Cliquez ici pour nous retrouver sur Facebook" title="Retrouvez-nous sur Facebook">Retrouvez-nous sur Facebook</a>
				<a class="en" href="https://www.facebook.com/pages/Pari-Grandir/190695747698973" target="_blank" alt="Click here to join us on Facebook" title="Join us on Facebook">Join us on Facebook</a>
		</span>
	</div>
EOT;
}

/**
 * UTILS
 * =================================================================================================
 */
function pg_has_children($page_id) 
{
	$children = get_pages("child_of=$page_id");
	if (count($children) != 0) { return true; }
	else { return false; } 
}