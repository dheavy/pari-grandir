<?php
/**
 * Template Name: Plan et Contact
 * Description: Template for /plan-contact
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
			'headerinfo' => $custom['fr_headerinfo'][0]
		);
		$en = array(
			'main' => $custom['en_main'][0],
			'headerinfo' => $custom['en_headerinfo'][0]
		);
?>

	<section id="page-extras">
		<div class="top below-flyout-container"></div>
		<div class="content contact-form">
			<div class="content-area">
				<div class="headerinfo">
					<span class="fr"><?php echo $fr['headerinfo'] ?></span>
					<span class="en"><?php echo $en['headerinfo'] ?></span>
				</div>
				<section class="one-col">
					<div class="main fr">
						<?php echo do_shortcode($fr['main']) ?>
					</div>
					<div class="main en">
						<?php echo do_shortcode($en['main']) ?>
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