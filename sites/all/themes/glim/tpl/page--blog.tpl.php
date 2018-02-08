<?php require_once(drupal_get_path('theme','glim').'/tpl/header.tpl.php'); 

global $base_url;

if(!empty($_REQUEST["sidebar"])){
	$sidebar = $_REQUEST["sidebar"];
} else {
	$sidebar = theme_get_setting('sidebar', 'glim'); 
}
if(empty($sidebar)) $sidebar = '1';

if(!empty($_REQUEST["style_blog"])){
    $style_blog = $_REQUEST["style_blog"];
} else {
    $style_blog = theme_get_setting('style_blog', 'glim'); 
}
if(empty($style_blog)) $style_blog = '1';

$id_container = '';
if($style_blog == '2') {
    $id_container = 'id="singlepage-layout-two"';
}
?>
<?php if (arg(0) == 'node') { ?>
<div id="content" class="site-content">
    <div class="container" <?php print $id_container; ?>>
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

<?php } else { ?>
<div id="content" class="site-content">
    <div class="container">
        <div class="archive-page-title">
            <div class="row">
                <div class="col-md-12">                          
                    <div class="title-content">
                        <h1><span><?php print t('Browsing For'); ?></span><?php print drupal_get_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if($sidebar == '1') { ?>
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <?php print render($page['content']);?>
                    </main>
                </div>

            <?php } elseif($sidebar == '2') { ?>
                <div class="col-md-8">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <?php print render($page['content']);?>
                        </main>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php print render($page['sidebar']);?>
                </div>

            <?php } else { ?>
                <div class="col-md-4">
                    <?php print render($page['sidebar']);?>
                </div>
                <div class="col-md-8">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <?php print render($page['content']);?>
                        </main>
                    </div>
                </div>
                
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>



	
<?php require_once(drupal_get_path('theme','glim').'/tpl/footer.tpl.php'); ?>