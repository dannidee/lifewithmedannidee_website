<?php require_once(drupal_get_path('theme','glim').'/tpl/header.tpl.php'); 

global $base_url;

?>
<?php 
	if (!empty($tabs['#primary']) || !empty($tabs['#secondary'])):
		print render($tabs);
	endif;
	print $messages;
	//unset($page['content']['system_main']['default_message']);
?>
<div id="content" class="site-content error-page">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<?php 
				print render($page['section_content']);?>
			</div>
		</div>
	</div>
</div>

<?php require_once(drupal_get_path('theme','glim').'/tpl/footer.tpl.php'); ?>