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

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?>">
	<link href="<?php bloginfo('template_directory') ?>/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
	
	<title><?php bloginfo('name') ?></title>
</head>
<body>