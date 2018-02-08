// JavaScript Document


jQuery(function(){

	jQuery('#submit-btn').html('<i class="fa fa-search"></i>');
	jQuery('.menu-content > .menu-submenu').addClass('menu-list').removeClass('menu-submenu');
	jQuery('figure.format-audio').each(function(){
		jQuery(this).html('<iframe width="100%" height="166" src="' + jQuery('.invisible.audio').html() + '"></iframe>')
	});
	jQuery('figure.format-video').each(function(){
		jQuery(this).html('<iframe src="' + jQuery('.invisible.video').html() + '"  allowfullscreen="allowfullscreen"></iframe>')
	});
});