<?php require_once(drupal_get_path('theme','glim').'/tpl/header.tpl.php'); 

global $base_url;


if(!empty($_REQUEST["sidebar"])){
	$sidebar = $_REQUEST["sidebar"];
} else {
	$sidebar = theme_get_setting('sidebar', 'glim'); 
}
if(empty($sidebar)) $sidebar = '1';

?>
<?php 
	if (!empty($tabs['#primary']) || !empty($tabs['#secondary'])):
		print render($tabs);
	endif;
	print $messages;
	//unset($page['content']['system_main']['default_message']);
?>
<div id="content" class="site-content">
	<div class="container">
		<div class="row">
            <div class="col-md-12">
                <div class="header-title">
                    <h2 class="section-title"><span><?php print drupal_get_title(); ?></span></h2>
                </div>
            </div>
        </div>
        <div class="row">
			<?php if($sidebar == '1') { ?>
                <?php print render($page['content']);?>

            <?php } elseif($sidebar == '2') { ?>
                <div class="col-md-8">
                    <?php print render($page['content']);?>
                </div>
                <div class="col-md-4">
                    <?php print render($page['sidebar']);?>
                </div>

            <?php } else { ?>
                <div class="col-md-4">
                    <?php print render($page['sidebar']);?>
                </div>
                <div class="col-md-8">
                    <?php print render($page['content']);?>
                </div>
            <?php } ?>
		</div>
	</div>
</div>

<?php require_once(drupal_get_path('theme','glim').'/tpl/footer.tpl.php'); ?>