<?php require_once(drupal_get_path('theme','glim').'/tpl/header.tpl.php'); 

global $base_url;

?>
<div id="content" class="site-content contact-page">
	<div class="container">
		<div class="row">
            <div class="col-md-12">
                <div class="header-title">
                    <h2 class="section-title"><span><?php print drupal_get_title(); ?></span></h2>
                </div>
            </div>
        </div>
        <div class="row">
			<div class="col-md-10 col-md-offset-1">
                <div class="gmaps-area">
                    <div id="gmaps"></div>                                   
                </div>
                <div class="clear"></div>
                <div class="contact-details">
                    <?php print render($page['section_content']);?>
                    <div class="row" id="contact-form-wrap">
                        <div class="col-md-12">
                            <div class="contact-respond" id="respond">                       
                                <?php print render($page['content']);?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>


<?php require_once(drupal_get_path('theme','glim').'/tpl/footer.tpl.php'); ?>