<?php require_once(drupal_get_path('theme','glim').'/tpl/header.tpl.php'); 

global $base_url;

?>
<div id="content" class="site-content about-me">
	<div class="container">
		<div class="row">
            <div class="col-md-12">
                <div class="header-title">
                    <h2 class="section-title"><span><?php print drupal_get_title(); ?></span></h2>
                </div>
            </div>
        </div>
        <div class="row">
			<?php print render($page['content']);?>
		</div>
	</div>
</div>


<?php require_once(drupal_get_path('theme','glim').'/tpl/footer.tpl.php'); ?>