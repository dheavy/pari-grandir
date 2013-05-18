<?php define('WP_USE_THEMES', false) ?>

<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"><!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="index, follow">
	<meta name="current_lang" content="<?php echo $_SESSION['current_lang'] ?>">
	<link href="<?php bloginfo('atom_url') ?>" rel="alternate" type="application/rss+xml" title="RSS 2.0">
	<link href="<?php bloginfo('rss2_url') ?>" rel="alternate" type="application/atom+xml" title="Atom 1.0">
	<meta name="viewport" content="width=1200">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?>">
	<link href="<?php bloginfo('template_directory') ?>/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
	
	<!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script>
  <![endif]-->
  <link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="//use.typekit.net/qxe3ftn.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<title>
	<?php 
	bloginfo('name');
	$site_description = get_bloginfo( 'description', 'display' );
	if ($site_description) echo " | $site_description"; 
	?></title>
</head>
<body>
	<!--[if lt IE 7]>
  <p class=chromeframe>Your browser is <em>ancient!</em> 
  <a href="http://browsehappy.com/">Upgrade to a different browser</a> or 
  <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> 
  to experience this site.</p>
  <![endif]-->