<?php

  	$subs = block_get_blocks_by_region('footer_top');

	print render($subs);

	if ($plugin = context_get_plugin('reaction', 'block'))
  		print render($plugin->block_get_blocks_by_region('my_region_name'));
	endif;

	//$block =  module_invoke('block', 'block_view', 20);

	//print render($block["content"]);

	

	//$block = module_invoke('search', 'block_view', 'search');

	//print render($block); 

?>

<?php

	$block = module_invoke('search', 'block_view', 'search');

	print render($block); 

?>

<?php

	require_once drupal_get_path('module', 'contact') .'/contact.pages.inc';

	$form = drupal_get_form('contact_site_form');

  	print render($form);

?>



<?php print $content['product:commerce_price']['#object']->sku; ?>
<?php print $content['product:commerce_price']['#object']->title; ?>
<?php print $content['product:commerce_price']['#object']->type; ?>


