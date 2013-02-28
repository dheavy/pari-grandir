<?php
/**
 * Template Name: Planning et Tarifs > 6 à 10 ans
 * Description: Template for /planning-tarifs/6-10-ans
 *
 * @package WordPress
 * @subpackage Pari Grandir
 */
?>

<?php get_header() ?>

<?php pg_get_header() ?>

<?php pg_get_nav(5) ?>

<?php

if (have_posts()):
	while (have_posts()):
		the_post();
		$custom = get_post_custom($post->ID);
		$fr = array(
			'main' => $post->post_content,
			'headerlinks' => $custom['fr_headerlinks'][0]
		);
		$en = array(
			'main' => $custom['en_main'][0],
			'headerlinks' => $custom['en_headerlinks'][0]
		);
?>

	<section id="page-planningettarifs">
		<div class="top below-flyout-container"></div>
		<div class="content">
			<div class="content-area">
				<div class="headerlinks">
					<span class="fr"><?php echo $fr['headerlinks'] ?></span>
					<span class="en"><?php echo $en['headerlinks'] ?></span>
				</div>
				<section class="one-col">
					<h1 class="fr">Planning &amp; tarifs</h1>
					<h1 class="en">Schedule &amp; prices</h1>
					<div class="main fr">
						<?php echo $fr['main'] ?>
					</div>
					<div class="main en">
						<?php echo $en['main'] ?>
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