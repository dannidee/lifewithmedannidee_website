<?php
global $base_url;

//remove superfish css files.
function glim_css_alter(&$css) {
	unset($css[drupal_get_path('module', 'system') . '/system.menus.css']);
	unset($css[drupal_get_path('module', 'system') . '/system.theme.css']);
	//unset($css[drupal_get_path('module', 'system') . '/system.base.css']);
}

function glim_preprocess_page(&$vars){
	//add js to special page
	/*
	if (isset($vars['node']) && $vars['node']->type != 'page_not_found' && $vars['node']->type != 'under_construction') {
		drupal_add_js(path_to_theme().'/assets/js/SmoothScroll.js', array('type' => 'file', 'scope' => 'header'));
	}
	*/
	if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
		$term = taxonomy_term_load(arg(2));
		$vars['theme_hook_suggestions'][] = 'page__vocabulary__' . $term->vocabulary_machine_name;
	}
	
	if (isset($vars['node'])) {
		$vars['theme_hook_suggestions'][] = 'page__'. $vars['node']->type;
	}
	if (isset($vars['node'])) {
		$vars['theme_hook_suggestions'][] = 'page__node__'. $vars['node']->nid;
	}
	if (isset($vars['node'])) :
		//print $vars['node']->type;
        if($vars['node']->type == 'page'):
            $node = node_load($vars['node']->nid);
            $output = field_view_field('node', $node, 'field_show_page_title', array('label' => 'hidden'));
            $vars['field_show_page_title'] = $output;
			//sidebar
			$output = field_view_field('node', $node, 'field_sidebar', array('label' => 'hidden'));
            $vars['field_sidebar'] = $output;
        endif;
    endif;

	//404 page
	$status = drupal_get_http_header("status");
	if($status == "404 Not Found") {
		$vars['theme_hook_suggestions'][] = 'page__404';
	}
	
	if(isset($vars['page']['content']['system_main']['no_content'])) {
		unset($vars['page']['content']['system_main']['no_content']);
	}

}

//alter menu
function glim_menu_tree__main_menu($variables) {
	return '<ul class="menu-submenu">' . $variables['tree'] . '</ul>';
}

function glim_menu_tree__menu_main_menu_2($variables) {
  	return '<ul class="menu-submenu">' . $variables['tree'] . '</ul>';
}
//breadcrumb
function glim_breadcrumb($variables) {
	$crumbs ='';
	$breadcrumb = $variables['breadcrumb'];
	if (!empty($breadcrumb)) {
		$crumbs .= '';
		foreach($breadcrumb as $value) {
			$crumbs .= $value.' / ';
		}
		$crumbs .= drupal_get_title();
		return $crumbs;
	}else{
		return NULL;
	}
}

//to get field of page in page.tpl
function drupal_get_subtitle() {
	$subtitle = '';
	if (arg(0) == 'node' && is_numeric(arg(1))){
		$nid = arg(1);
		$node = node_load($nid);
		if(!empty($node->field_subtitle)) {
			$subtitle = $node->field_subtitle['und'][0]['value'];
			return ' / '.$subtitle;
		}
	}
}
function drupal_get_count_post() {
	$return_string = '';
	$counters = db_query("	SELECT COUNT(0) FROM {node} n 
				   		WHERE n.uid = :nid
				   		AND n.type = :type",
				   		array(':nid' => '1', ':type' => 'blog'))->fetchCol();
	if (!empty($counters)):
		foreach ($counters as $counter) :
			$return_string .= $counter;
		endforeach;
	endif;
	return $return_string;
}

//alter search form
function glim_form_search_block_form_alter(&$form, &$form_state) {
	$form['#attributes'] = array('class' => array('search-form'));
	$form['search_block_form']['#theme_wrappers'] = array();
	$form['actions']['#theme_wrappers'] = array();
	$form['search_block_form']['#attributes'] = array(	'placeholder' => 'Search...',
														'id' => 'dsearch',
														'class' => array('form-controller'));

	$form['actions']['submit']['#element_type'] = 'button';
 	$form['actions']['submit']['#attributes'] = array('id' => 'submit-btn',
											'class' => array('btn','btn-search'));
	
	$form['search_block_form']['#prefix'] = '<div class="input-group">';

	$form['actions']['submit']['#prefix'] = '<span class="input-group-btn">';
	$form['actions']['submit']['#suffix'] = '</span></div>';
}

function glim_button($variables) {
  $element = $variables['element'];
  $element ['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));
  $element_type = isset($element['#element_type']) ? $element['#element_type'] : 'submit';

  if ($element_type === 'button') {
    return '<button' . drupal_attributes($element['#attributes']) . '><i class="fa fa-search"></i></button>';
  } else {
    return '<input' . drupal_attributes($element['#attributes']) . ' />';
  }
}

//alter contact site
function glim_form_contact_site_form_alter(&$form, &$form_state) {
	unset($form['name']['#title']);
	unset($form['mail']['#title']);
	unset($form['message']['#title']);
	unset($form['subject']['#title']);
	unset($form['copy']);
	
	
	$form['name']['#attributes'] = array(
					'placeholder' => 'Name*',
					'class' => array('form-controller')
						   );
	$form['name']['#theme_wrappers'] = array();

	$form['subject']['#attributes'] = array(
					'placeholder' => 'Subject*',
					'class' => array('form-controller')
						   );
	$form['subject']['#theme_wrappers'] = array();

	$form['mail']['#attributes'] = array(
					'placeholder' => 'Email*',
					'class' => array('form-controller')
						   );
	$form['mail']['#theme_wrappers'] = array();

	$form['message']['#attributes'] = array(
					'placeholder' => 'Write a Comment....',
					'class' => array('form-controller')
						   );
	$form['message']['#theme_wrappers'] = array();
	$form['message']['#resizable'] = False;
	
	$form['actions']['#theme_wrappers'] = array();
	$form['actions']['submit']['#attributes'] = array('value' => 'Submit Message','class' => array('w-button','button','no-margin'));
	
	$form['name']['#prefix'] = '<div class="row"><div class="col-md-4 padding-right"><p>';
	$form['name']['#suffix'] = '</p></div>';
	$form['mail']['#prefix'] = '<div class="col-md-4 padding-left"><p>';
	$form['mail']['#suffix'] = '</p></div>';
	$form['subject']['#prefix'] = '<div class="col-md-4 padding-right"><p>';
	$form['subject']['#suffix'] = '</p></div>';
	$form['message']['#prefix'] = '<div class="col-md-12"><p>';
	$form['message']['#suffix'] = '</p></div>';
	$form['actions']['#prefix'] = '<div class="col-md-12"><p class="form-submit">';
	$form['actions']['#suffix'] = '</p></div></div>';
	
	$order = array(
    'name',
	'mail',
	'subject',
	'message',
	'actions'
  	);
 
  	foreach ($order as $key => $field) {
    	$form[$field]['#weight'] = $key;
  	}
	  
}

//alter comment form
function glim_form_comment_form_alter(&$form, &$form_state) {
	global $user;
	unset($form['author']);
	unset($form['subject']);
	unset($form['actions']['preview']);
	unset($form['comment_body'][LANGUAGE_NONE][0]['#title']);
	

	$form['comment_body'][LANGUAGE_NONE][0]['#resizable'] = false ;
	$form['comment_body'][LANGUAGE_NONE][0]['#rows'] = 8 ;
	$form['comment_body'][LANGUAGE_NONE][0]['#cols'] = 45 ;
	$form['comment_body']['#after_build'][] = 'glim_customize_comment_form';
	$form['comment_body'][LANGUAGE_NONE][0]['#attributes']['placeholder'] = t('Write a Comment....');
	$form['comment_body'][LANGUAGE_NONE][0]['#attributes']['class'] = array('form-controller');
	$form['comment_body'][LANGUAGE_NONE][0]['#attributes']['id'] = 'message';

	$user_fields = user_load($user->uid);
	
	$form['name'] = array(
    '#type'     => 'textfield',
	'#default_value' => $user->uid ? format_username($user) : '',
    '#required' => TRUE,
	'#attributes' => array(
					'placeholder' => 'Name*',
					'id' => 'name',
					'class' => array('form-controller')
						   ),
  	);
  	$form['name']['#prefix'] = '<div class="col-md-6 pd-right">';
	$form['name']['#suffix'] = '</div>';

  	$form['mail'] = array(
	'#type' => 'textfield',
	'#default_value' => $user->uid ? $user->mail : '',
	'#required' => TRUE,
	'#attributes' => array(
					'placeholder' => 'Email*',
					'id' => 'email-comments',
					'class' => array('form-controller')
						   ),
	);
	$form['mail']['#prefix'] = '<div class="col-md-6 pd-left">';
	$form['mail']['#suffix'] = '</div>';
	

	$form['url'] = array(
	'#type' => 'textfield',
	'#default_value' => $user->uid ? $user_fields->field_website['und']['0']['value'] : '',
	'#required' => TRUE,
	'#attributes' => array(
					'placeholder' => 'Website*',
					'id' => 'url',
					'class' => array('form-controller')
						   ),
	);
	$form['url']['#prefix'] = '<div class="col-md-12">';
	$form['url']['#suffix'] = '</div>';

	$form['comment_body']['#prefix'] = '<div class="col-md-12">';
	$form['comment_body']['#suffix'] = '</div>';

	$form['actions']['submit']['#attributes'] = array('id' => 'submit','value' => 'Post Comment','class' => array('w-button','button','no-spc'));
	$form['actions']['submit']['#prefix'] = '<p class="form-submit">';
	$form['actions']['submit']['#suffix'] = '</p>';

	$form['actions']['#prefix'] = '<div class="col-md-12">';
	$form['actions']['#suffix'] = '</div>';	


	$order = array(
    'name',
    'mail',
    'url',
	'comment_body',
	'actions'
  	);

  	foreach ($order as $key => $field) {
    	$form[$field]['#weight'] = $key;
  	}

}
function glim_customize_comment_form(&$form) {  
  $form[LANGUAGE_NONE][0]['format']['#access'] = FALSE;
  return $form;  
}

//alter simplenews form
function glim_form_simplenews_block_form_alter(&$form, &$form_state, $tid) {
	global $user;
	
	unset($form['mail']);

	$form['name'] = array(
	'#type' => 'textfield',
	'#default_value' => $user->uid ? format_username($user) : '',
	'#required' => TRUE,
	'#theme_wrappers' => array(),
	'#attributes' => array(
					'placeholder' => 'Your Name',
					'class' => array('form-controller'),
					'id' => 'fullname'
						   ),
	);
	
	$form['mail'] = array(
	'#type' => 'textfield',
	'#default_value' => $user->uid ? $user->mail : '',
	'#required' => TRUE,
	'#theme_wrappers' => array(),
	'#attributes' => array(
					'placeholder' => 'Your Email',
					'class' => array('form-controller'),
					'id' => 'email'
						   ),
	);

	$form['name']['#prefix'] = '<div class="row"><div class="col-md-12"><p>';
	$form['name']['#suffix'] = '</p></div>';

	$form['mail']['#prefix'] = '<div class="col-md-12"><p>';
	$form['mail']['#suffix'] = '</p></div>';

	$form['submit']['#prefix'] = '<div class="col-md-12 text-center">';
	$form['submit']['#suffix'] = '</div></div>';
	
	$form['submit']['#attributes'] = array('id' => 'mc-embedded-subscribe', 'value' => 'Subscribe', 'class' => array('mail-chip-button'));
	if ($user->uid) {
		
		$val_tid = substr($tid,22);
		
		if ( simplenews_user_is_subscribed($user->mail,$val_tid) ) {
      		$form['submit']['#attributes'] = array('id' => 'mc-embedded-unsubscribe', 'value' => 'Unsubscribe', 'class' => array('mail-chip-button'));
			
    	}
		
	}
	
	$order = array(
    'name',
	'mail',
	'submit'
  	);
	foreach ($order as $key => $field) {
    	$form[$field]['#weight'] = $key;
  	}
}


//next and prev button
function glim_prev_next($nid = null, $ntype = null, $op = 'p') {
	$sql_op = '';
	$order = '';
	$icon ='';
	$text = '';

	if ($op == 'p') {
		$sql_op = '<';
		$order = 'DESC';
		$icon = 'left';
		$text = 'Previous Post';

	} else{
		$sql_op = '>';
		$order = 'ASC';
		$icon = 'right';
		$text = 'Next Post';
	}
	$return_string = '';
	$nids = db_query("SELECT n.nid FROM {node} n 
				   WHERE n.nid $sql_op :nid 
				   AND n.status = 1
				   AND n.type = :type
				   ORDER BY n.nid $order
				   LIMIT 1",array(':nid' => $nid, ':type' => $ntype))->fetchCol();
	$nodes = node_load_multiple($nids);
	if (!empty($nodes)):
		foreach ($nodes as $node) :
			
			$return_string .= '<a rel="prev" href="'.url("node/" . $node->nid).'"><i class="fa fa-angle-double-'.$icon.'"></i><h3><span>'.$text.'</span>'.$node->title.'</h3></a>';
		endforeach;
	endif;
	return $return_string;
	
}

function glim_preprocess_search_results(&$variables){
  	//$teaser = node_view($variables['result']['node'], 'title');
    //$variables['teaser'] = drupal_render($teaser);
    //$result = $variables['result'];
   
  	$variables['a'] = 'aaaaa';
}

//add js and css
function glim_preprocess_html(&$variables) {
	//add css
	drupal_add_css('https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic%7CLato:400,400italic,700,700italic', array('type' => 'external','media' => 'all'));
	drupal_add_css(path_to_theme().'/fonts/font-awsome/css/font-awesome.min.css', array('type' => 'file', 'scope' => 'header'));
	drupal_add_css(path_to_theme().'/fonts/glim/shape.css', array('type' => 'file', 'scope' => 'header'));
	drupal_add_css(path_to_theme().'/lib/bootstrap/css/bootstrap.min.css', array('type' => 'file', 'scope' => 'header'));
	drupal_add_css(path_to_theme().'/lib/magnific-popup/magnific-popup.css', array('type' => 'file', 'scope' => 'header'));
	drupal_add_css(path_to_theme().'/lib/justifiedgallery/justifiedGallery.min.css', array('type' => 'file', 'scope' => 'header'));
	drupal_add_css(path_to_theme().'/css/owl.carousel.css', array('type' => 'file', 'scope' => 'header'));
	drupal_add_css(path_to_theme().'/style.css', array('type' => 'file', 'scope' => 'header'));
	drupal_add_css(path_to_theme().'/colors/color-schemer.css', array('type' => 'file', 'scope' => 'header'));
	drupal_add_css(path_to_theme().'/css/navi-update.css', array('type' => 'file', 'scope' => 'header'));
	
	//add js
	drupal_add_js(path_to_theme().'/js/navi-update.js', array('type' => 'file', 'scope' => 'header'));
	drupal_add_js(path_to_theme().'/js/vendor/modernizr-2.8.3.min.js', array('type' => 'file', 'scope' => 'header'));
	drupal_add_js(path_to_theme().'/js/vendor/jquery-1.11.3.min.js', array('type' => 'file', 'scope' => 'header'));
	drupal_add_js(path_to_theme().'/js/vendor/jquery-migrate.min.js', array('type' => 'file', 'scope' => 'header'));
	drupal_add_js(path_to_theme().'/lib/bootstrap/js/bootstrap.min.js', array('type' => 'file', 'scope' => 'header'));
	drupal_add_js(path_to_theme().'/js/owl.carousel.min.js', array('type' => 'file', 'scope' => 'header'));
	drupal_add_js(path_to_theme().'/lib/magnific-popup/jquery.magnific-popup.min.js', array('type' => 'file', 'scope' => 'header'));
	drupal_add_js(path_to_theme().'/lib/justifiedgallery/jquery.justifiedGallery.min.js', array('type' => 'file', 'scope' => 'header'));
	drupal_add_js(path_to_theme().'/js/plugins.js', array('type' => 'file', 'scope' => 'header'));
	drupal_add_js(path_to_theme().'/js/masonry.pkgd.js', array('type' => 'file', 'scope' => 'header'));
	drupal_add_js('http://maps.googleapis.com/maps/api/js?sensor=true', array('type' => 'external', 'scope' => 'header'));
	drupal_add_js(path_to_theme().'/js/gmaps.js', array('type' => 'file', 'scope' => 'header'));
	drupal_add_js(path_to_theme().'/js/custom.js', array('type' => 'file', 'scope' => 'header'));
	//drupal_add_js(path_to_theme().'/js/navi-update.js', array('type' => 'file', 'scope' => 'header'));

}

