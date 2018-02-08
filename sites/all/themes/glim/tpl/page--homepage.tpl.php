<?php require_once(drupal_get_path('theme','glim').'/tpl/header.tpl.php'); 

global $base_url;

$node = node_load(arg(1));

if(!empty($_REQUEST["sidebar"])){
	$sidebar = $_REQUEST["sidebar"];
} elseif(!empty($node->field_style)) {
    $sidebar = $node->field_style['und'][0]['value'];
} else {
	$sidebar = theme_get_setting('sidebar', 'glim'); 
}
if(empty($sidebar)) $sidebar = '1';



?>
<div id="featured" class="feature-area">
	<div id="featured-overlay"></div>
	<div id="featured-content">
		<div class="container">
			<div class="row">
			<?php print render($page['top_content']);?>
			</div>
		</div>
	</div>
</div>
<div id="content" class="site-content">
	<div class="container"  <?php if($sidebar == '2'): print 'id="blog-content"'; endif;?>>
		<div class="row">
			<?php if($sidebar == '1') { ?>
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-12" id="blog-content">
                        <div id="primary" class="content-area">
                            <?php print render($page['content']);?>
                        </div>
                    </div>
                </div>
            </div>

            <?php } elseif($sidebar == '2') { ?>
                <div class="col-md-8">
                    <div id="primary" class="content-area">
                        <?php print render($page['content']);?>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php print render($page['sidebar_homepage']);?>
                </div>

            <?php } else { ?>
                <div class="col-md-4">
                    <?php print render($page['sidebar_homepage']);?>
                </div>
                <div class="col-md-8">
                    <div id="primary" class="content-area">
                        <?php print render($page['content']);?>
                    </div>
                </div>
            <?php } ?>
		</div>
	</div>
</div>

<?php require_once(drupal_get_path('theme','glim').'/tpl/footer.tpl.php'); ?>