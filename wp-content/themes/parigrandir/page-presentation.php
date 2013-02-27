<?php
/**
 * Template Name: Presentation
 * Description: Template for /presentation
 *
 * @package WordPress
 * @subpackage Pari Grandir
 */
?>

<?php get_header() ?>

<?php pg_get_header() ?>

<?php pg_get_nav(1) ?>

<?php

if (have_posts()):
	while (have_posts()):
		the_post();
		$custom = get_post_custom($post->ID);
		$fr = array(
			'quisommesnous' => $post->post_content,
			'lecentre' => $custom['fr_lecentre'][0],
			'lequipe' => $custom['fr_lequipe'][0],
			'sponsors' => $custom['fr_sponsors'][0]
		);
		$en = array(
			'quisommesnous' => $custom['en_quisommesnous'][0],
			'lecentre' => $custom['en_lecentre'][0],
			'lequipe' => $custom['en_lequipe'][0],
			'sponsors' => $custom['en_sponsors'][0]
		);
?>

	<section id="page-presentation">
		<div class="top below-flyout-container"></div>
		<div class="content">
			<div class="content-area">

				<section class="left-col">
					<article class="quisommesnous fr">
						<h2>Qui sommes-nous ?</h2>
						<?php echo $fr['quisommesnous'] ?>
					</article>
					<article class="quisommesnous en">
						<h2>Who are we?</h2>
						<?php echo $en['quisommesnous'] ?>
					</article>

					<article class="lecentre fr">
						<h2>Le centre</h2>
						<?php echo $fr['lecentre'] ?>
					</article>
					<article class="lecentre en">
						<h2>Pari-Grandir center</h2>
						<?php echo $en['lecentre'] ?>
					</article>

					<article class="lequipe fr">
						<h2>L'Equipe</h2>
						<?php echo $fr['lequipe'] ?>
					</article>
					<article class="lequipe en">
						<h2>The Team</h2>
						<?php echo $en['lequipe'] ?>
					</article>
				</section>

				<section class="right-col">
					<article class="sponsors fr">
						<?php echo $fr['sponsors'] ?>
					</article>
					<article class="sponsors en">
						<?php echo $en['sponsors'] ?>
					</article>
					<div class="images"></div>
				</section>				
		</div>
		<div class="footer"></div>
	</section>

<?php pg_get_social() ?>

</div>

<?php endwhile; endif; ?>

<?php get_footer() ?>