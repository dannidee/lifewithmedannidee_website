<?php 

global $base_url;

$out = '';



if ($block->region == 'footer_middle') {	
	if(!empty($block->css_class)) {		
		$out .= '<div class="contextual-links-region '.$block->css_class.'">';
	
	} else {
		$out .= '<div class="contextual-links-region">';	
	}
	$out .= render($title_suffix);
	$out .= '<div class="widget widget_text clearfix">';
	if ($block->subject):
		$out .= '<div class="widget-title-area"><h5 class="widget-title"><span>'.$block->subject.'</span></h5></div>';
	endif;
	$out .= $content;
	$out .= '</div>';
	$out .= '</div>';

} elseif ($block->region == 'sidebar') {	
	if(!empty($block->css_class)) {		
		$out .= '<aside class="contextual-links-region widget clearfix '.$block->css_class.'">';
	
	} else {
		$out .= '<aside class="contextual-links-region widget clearfix">';	
	}
	$out .= render($title_suffix);
	if ($block->subject):
		$out .= '<div class="widget-title-area"><h5 class="widget-title"><span>'.$block->subject.'</span></h5></div>';
	endif;
	$out .= $content;
	$out .= '</aside>';

} elseif ($block->region == 'sidebar_homepage') {	
	if(!empty($block->css_class)) {		
		$out .= '<aside class="contextual-links-region widget clearfix '.$block->css_class.'">';
	
	} else {
		$out .= '<aside class="contextual-links-region widget clearfix">';	
	}
	$out .= render($title_suffix);
	if ($block->subject):
		$out .= '<div class="widget-title-area"><h5 class="widget-title"><span>'.$block->subject.'</span></h5></div>';
	endif;
	$out .= $content;
	$out .= '</aside>';

} elseif ($block->region == 'content') {	
	$out .= $content;

} elseif ($block->region == 'bot_content') {	
	if(!empty($block->css_class)) {		
		$out .= '<div class="contextual-links-region '.$block->css_class.'">';
	
	} else {
		$out .= '<div class="contextual-links-region">';	
	}
	$out .= render($title_suffix);
	if ($block->subject):
		$out .= '<h3 class="related-post-title"><span>'.$block->subject.'</span></h3>';
	endif;
	$out .= '<div class="row">';
	$out .= $content;
	$out .= '</div>';
	$out .= '</div>';

} else {
	if(!empty($block->css_class)) {		
		$out .= '<div class="contextual-links-region '.$block->css_class.'">';
	
	} else {
		$out .= '<div class="contextual-links-region">';	
	}
	$out .= render($title_suffix);
	$out .= $content;
	$out .= '</div>';

}





print $out;



?>

