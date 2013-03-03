<?php
/**
 * Template Name: Entreprises
 * Description: Template for /entreprises
 *
 * @package WordPress
 * @subpackage Pari Grandir
 */
?>

<?php get_header() ?>

<?php pg_get_header() ?>

<?php pg_get_nav(-1) ?>

<?php

if (have_posts()):
	while (have_posts()):
		the_post();
		$custom = get_post_custom($post->ID);
		$fr = array(
			'main' => $post->post_content,
			'headerinfo' => $custom['fr_headerinfo'][0],
			'familyday' => $custom['fr_familyday'][0]
		);
		$en = array(
			'main' => $custom['en_main'][0],
			'headerinfo' => $custom['en_headerinfo'][0],
			'familyday' => $custom['en_familyday'][0]
		);
?>

	<section id="page-extras">
		<div class="top below-flyout-container"></div>
		<div class="content">
			<div class="content-area">
				<div class="headerinfo">
					<span class="fr"><?php echo $fr['headerinfo'] ?></span>
					<span class="en"><?php echo $en['headerinfo'] ?></span>
				</div>
				<section class="left-col" style="margin-top:-38px">
					<div class="main fr"><?php echo $fr['main'] ?></div>
					<div class="main en"><?php echo $en['main'] ?></div>
				</section>

				<section class="right-col">
					<div class="fr familyday"><?php echo $fr['familyday'] ?></div>
					<div class="en familyday"><?php echo $en['familyday'] ?></div>
				</section>			
			</div>
		</div>
		<div class="footer"></div>
	</section>

<?php pg_get_social() ?>

</div>

<?php endwhile; endif; ?>

<?php get_footer() ?>