<?php
/**
 * Template Name: Atelier Bébé et Parents > Chanter avec Bébé
 * Description: Template for /atelier-bebe-parents/chanter-avec-bebe/
 *
 * @package WordPress
 * @subpackage Pari Grandir
 */
?>

<?php get_header() ?>

<?php pg_get_header() ?>

<?php pg_get_nav(2) ?>

<?php

if (have_posts()):
	while (have_posts()):
		the_post();
		$custom = get_post_custom($post->ID);
		$fr = array(
			'main' => $post->post_content,
			'headerinfo' => $custom['fr_headerinfo'][0],
			'schedule' => $custom['fr_schedule'][0],
			'costs' => $custom['fr_costs'][0]
		);
		$en = array(
			'main' => $custom['en_main'][0],
			'headerinfo' => $custom['en_headerinfo'][0],
			'schedule' => $custom['en_schedule'][0],
			'costs' => $custom['en_costs'][0]
		);
?>

	<section id="page-atelierbebeparents">
		<div class="top below-flyout-container"></div>
		<div class="content">
			<div class="content-area">
				<div class="headerinfo">
					<span class="fr"><?php echo $fr['headerinfo'] ?></span>
					<span class="en"><?php echo $en['headerinfo'] ?></span>
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
					<div class="illustration illustration-3"></div>
					<div class="table fr">
						<span class="schedule"><?php echo $fr['schedule'] ?></span>
						<span class="costs"><?php echo $fr['costs'] ?></span>
					</div>
					<div class="table en">
						<span class="schedule"><?php echo $en['schedule'] ?></span>
						<span class="costs"><?php echo $en['costs'] ?></span>
					</div>
				</section>			
			</div>
		</div>
		<div class="footer"></div>
	</section>

<?php pg_get_social() ?>

</div>

<?php endwhile; endif; ?>

<?php get_footer() ?>