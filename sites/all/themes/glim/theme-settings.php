<?php

function glim_form_system_theme_settings_alter(&$form, $form_state) {
	$theme_path = drupal_get_path('theme', 'glim');
  	$form['settings'] = array(
      '#type' =>'vertical_tabs',
      '#title' => t('Theme settings'),
      '#weight' => 2,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
	  '#attached' => array(
					'css' => array(drupal_get_path('theme', 'glim') . '/css/drupalet_base/admin.css'),
					'js' => array(
						drupal_get_path('theme', 'glim') . '/js/drupalet_admin/admin.js',
					),
			),
  	);
	
	// Tracking code & Css custom
	//==============================
	$form['settings']['general_setting'] = array(
		'#type' => 'fieldset',
		'#title' => t('General Settings'),
		'#collapsible' => TRUE,
		'#collapsed' => FALSE,
	);
	$form['settings']['general_setting']['general_setting_tracking_code'] = array(
		'#type' => 'textarea',
		'#title' => t('Tracking Code'),
		//'#default_value' => theme_get_setting('general_setting_tracking_code', 'glim'),
	);
	$form['settings']['custom_css'] = array(
		'#type' => 'fieldset',
		'#title' => t('Custom CSS'),
		'#collapsible' => TRUE,
		'#collapsed' => FALSE,
	);
	$form['settings']['custom_css']['custom_css'] = array(
		'#type' => 'textarea',
		'#title' => t('Custom CSS'),
		//'#default_value' => theme_get_setting('custom_css', 'glim'),
		'#description'  => t('<strong>Example:</strong><br/>h1 { font-family: \'Metrophobic\', Arial, serif; font-weight: 400; }')
	);
	//========= End ================
	
	
	$form['settings']['footer'] = array(
      '#type' => 'fieldset',
      '#title' => t('Footer settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  	);
	$form['settings']['footer']['footer_copyright_message'] = array(
      '#type' => 'textarea',
      '#title' => t('Copyright message'),
      '#default_value' => theme_get_setting('footer_copyright_message','glim'),
  	);

	
	$form['settings']['style'] = array(
      '#type' => 'fieldset',
      '#title' => t('Style Settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  	);
	$form['settings']['style']['sidebar'] = array(
      '#type' => 'select',
      '#title' => t('Sidebar'),
	  '#description' => t('Default Sidebar of single blog entry and blog entry list'),
      '#options' => array('1' => t('None'), '2' => t('Right Sidebar'), '3' => t('Left Sidebar')),
      '#default_value' => theme_get_setting('sidebar','glim'),
	  
  	);
  	$form['settings']['style']['load'] = array(
      '#type' => 'select',
      '#title' => t('Preloader'),
	  '#description' => t('On / Off preloader'),
      '#options' => array('1' => t('On'), '2' => t('Off')),
      '#default_value' => theme_get_setting('load','glim'),
	  
  	);


  	$form['settings']['blog'] = array(
      '#type' => 'fieldset',
      '#title' => t('Blog Settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  	);
	$form['settings']['blog']['style_blog'] = array(
      '#type' => 'select',
      '#title' => t('Style Blog'),
	  '#description' => t('Style of Single Blog Entry'),
      '#options' => array('1' => t('Style 1'), '2' => t('Style 2')),
      '#default_value' => theme_get_setting('style_blog','glim'),
	  
  	);
	$form['settings']['blog']['style_list'] = array(
      '#type' => 'select',
      '#title' => t('Style Blogs List'),
	  '#description' => t('Style of Blog List'),
      '#options' => array('1' => t('1 Column'), '2' => t('2 Columns')),
      '#default_value' => theme_get_setting('style_list','glim'),
	  
  	);
	
}