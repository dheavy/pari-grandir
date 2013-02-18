<?php
function pg_get_nav() 
{
	global $post;

	echo '<nav class="top">' . "\n";
	echo '<ul>' . "\n";
	
	$pages = get_pages(array(
		'sort_column' => 'menu_order'
	));
	$i = 0;
	foreach ($pages as $page) {
		// Parse content.
		$page_id = $page->ID;
		$page_title = array(
			'fr' => $page->post_title,
			'en' => ''
		);
		$page_content = array(
			'fr' => $page->post_content,
			'en' => ''
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
				$subpages = get_page_children($page_id, $pages);
				foreach ($subpages as $subpage) {
					$subpage_id = $subpage->ID;
					$subpage_permalink = get_permalink($subpage_id);
					$subpage_title = array(
						'fr' => $subpage->post_title,
						'en' => ''
					);
					$subpage_content = array(
						'fr' => $subpage->post_content,
						'en' => ''
					);
					echo '		<li>' . "\n";
					echo '			<span class="fr"><a href="' . $subpage_permalink . '" alt="Aller &agrave; la rubrique ' . $subpage_title['fr'] . '" title="Aller &agrave; la rubrique ' . $subpage_title['fr'] . '">' . $subpage_title['fr'] . '</a></span>' . "\n";
					echo '			<span class="en"><a href="' . $subpage_permalink . '" alt="Go to ' . $subpage_title['en'] . '" title="Go to ' . $subpage_title['en'] . '">' . $subpage_title['fr'] . '</a></span>' . "\n";
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

			$i++;
		}
	}

	/*echo '<li class="menu-1">Hello</li>' . "\n";
	echo '<li class="menu-2">Hello</li>' . "\n";
	echo '<li class="menu-3">Hello</li>' . "\n";
	echo '<li class="menu-4">Hello</li>' . "\n";
	echo '<li class="menu-5">Hello</li>' . "\n";
	echo '<li class="menu-6">Hello</li>' . "\n";
	echo '<li class="menu-7">Hello</li>' . "\n";
	echo '<li class="menu-8">Hello</li>' . "\n";
	echo '<li class="menu-9">Hello</li>' . "\n";*/

	echo '</ul>' . "\n";
	echo '</nav>' . "\n";
	echo '<nav id="flyout-container"></nav>' . "\n";

}

function pg_has_children($page_id) {
	$children = get_pages("child_of=$page_id");
	if (count($children) != 0) { return true; }
	else { return false; } 
}