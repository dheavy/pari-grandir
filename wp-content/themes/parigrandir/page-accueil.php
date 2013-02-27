<?php
/**
 * Template Name: Accueil (Homepage)
 * Description: Template for the homepage: / or /accueil
 *
 * @package WordPress
 * @subpackage Pari Grandir
 */
?>

<?php get_header() ?>

<?php pg_get_header() ?>

<?php pg_get_nav(0) ?>

<?php

if (have_posts()):
	while (have_posts()):
		the_post();
		$custom = get_post_custom($post->ID);
		$fr = array(
			'bienvenue' => $post->post_content,
			'news' => $custom['fr_news'][0]
		);
		$en = array(
			'welcome' => $custom['en_welcome'][0],
			'news' => $custom['en_news'][0]
		);
?>

	<section id="page-accueil">
		<div class="top below-flyout-container"></div>
		<div class="content">
			<div class="content-area">


				<article class="slideshow">
				
				</article>


				<article class="newsbox">
					
					<div class="news fr">
						<?php echo $fr['news'] ?>
					</div>
					<div class="news en">
						<?php echo $en['news'] ?>
					</div>

				</article>


				<article class="welcome">
					
					<h2 class="fr">Bienvenue</h2>
					<div class="fr welcome-text">
						<?php echo $fr['bienvenue'] ?>
					</div>

					<h2 class="en">Welcome</h2>
					<div class="en welcome-text">
						<?php echo $en['welcome'] ?>
					</div>

				</article>


				<article class="banner">
					<a href="/plan-contact" alt="Plan et contact" title="O&ugrave; nous trouver" class="fr">O&ugrave; nous trouver</a>
					<a href="/plan-contact" alt="Map and contacts" title="Where to find us" class="en">Where to find us</a>
				</article>


			</div>
			<div class="footer"></div>
		</div>
	</section>

<?php pg_get_social() ?>

</div>

<?php endwhile; endif; ?>

<?php get_footer() ?>