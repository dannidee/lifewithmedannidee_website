<!DOCTYPE html>
<html class="no-js" lang="<?php print $language->language; ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Titles
================================================== -->
<title><?php print $head_title; ?></title>
<?php global $base_url; ?>
<!-- Favicons
================================================== -->
<link rel="shortcut icon" href="<?php print $base_url.'/'.path_to_theme(); ?>/images/favicon.png">
<link rel="apple-touch-icon" href="<?php print $base_url.'/'.path_to_theme(); ?>/images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php print $base_url.'/'.path_to_theme(); ?>/images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php print $base_url.'/'.path_to_theme(); ?>/images/apple-touch-icon-114x114.png"> 

<?php print $head; ?><?php print $styles; ?>


<?php
//Tracking code
$tracking_code = theme_get_setting('general_setting_tracking_code', 'glim');
print $tracking_code;
//Custom css
$custom_css = theme_get_setting('custom_css', 'glim');
if(!empty($custom_css)):

?>
<style type="text/css" media="all">
	<?php print $custom_css;?>
</style>

<?php endif; ?>

</head>

<?php
$class_body = '';
if(arg(0) == 'node') {
	$node = node_load(arg(1));
	if(!empty($node->type) && $node->type == 'blog') {
		$class_body = 'single single-post';
	}
} elseif(arg(0) == 'taxonomy' || arg(0) == 'blog') {
	$class_body = 'archive category';
}

if(!empty($_REQUEST["load"])){
	$pre_load = $_REQUEST["load"];
} else {
	$pre_load = theme_get_setting('load', 'glim'); 
}
if(empty($pre_load)) $pre_load = '2';

?>
<body class="<?php print $class_body; ?>">
	<?php if($pre_load == 1):?>
	<div class="preloader">
        <div class="preloader-logo">
            <img src="<?php print $base_url.'/'.path_to_theme();?>/images/logo.png" class="img-responsive" alt="preloader">
        </div> <!-- /.preloader-logo -->

        <div class="loader">
            <i class="fa fa-spinner fa-pulse"></i>
        </div> <!-- /.loader -->
    </div>
	<?php endif;?>
	<?php print $page_top; ?><?php print $page; ?><?php print $page_bottom; ?>
	<?php print $scripts; ?>
</body>
</html>

