<?php
/**
 * Template Name: Sortie d'Ecole
 * Description: Template for /sorte-decole
 *
 * @package WordPress
 * @subpackage Pari Grandir
 */
?>

<?php get_header() ?>

<?php pg_get_header() ?>

<?php pg_get_nav(6) ?>

<?php

if (have_posts()):
	while (have_posts()):
		the_post();
		$custom = get_post_custom($post->ID);
		$fr = array(
			'main' => $post->post_content,
			'title' => $post->post_title,
			'costs' => $custom['fr_costs'][0]
		);
		$en = array(
			'main' => $custom['en_main'][0],
			'title' => $custom['en_title'][0],
			'costs' => $custom['en_costs'][0]
		);
?>

	<section id="page-sortiedecole">
		<div class="top below-flyout-container"></div>
		<div class="content">
			<div class="content-area">
				<div class="headerinfo">
					<span class="fr"><p><?php echo $fr['title'] ?></p></span>
					<span class="en"><p><?php echo $en['title'] ?></p></span>
				</div>
				<section class="left-col">
					<div class="main fr">
						<?php echo $fr['main'] ?>
					</div>
					<div class="main en">
						<?php echo $en['main'] ?>
					</div>
				</section>

				<section class="right-col">
					<span class="costs fr"><?php echo $fr['costs'] ?></span>
					<span class="costs en"><?php echo $en['costs'] ?></span>
				</section>			
			</div>
		</div>
		<div class="footer"></div>
	</section>

<?php pg_get_social() ?>

</div>

<?php endwhile; endif; ?>

<?php get_footer() ?>