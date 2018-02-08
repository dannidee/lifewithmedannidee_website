<?php

$node = $variables['result']['node']; 

$content = drupal_render($node->content);

global $base_url, $base_root;
$node_author = user_load($node->uid);
if(!empty($_REQUEST["style_blog"])){
	$style_blog = $_REQUEST["style_blog"];
} else {
	$style_blog = theme_get_setting('style_blog', 'glim'); 
}
if(empty($style_blog)) $style_blog = '1';

if(!empty($_REQUEST["style_list"])){
	$style_list = $_REQUEST["style_list"];
} else {
	$style_list = theme_get_setting('style_list', 'glim'); 
}
if(empty($style_list)) $style_list = '1';

if(isset($node->field_images)){
	$img_uri = @$node->field_images['und'][0]['uri'];
	$img_url = file_create_url($img_uri);

	$img_uri_1 = @$node->field_images['und'][1]['uri'];
}


$class_gallery = 'gallery-one owl-carousel';
if(!empty($node->field_gallery_style)) {
	$gallery = $node->field_gallery_style['und'][0]['value'];
	
}

$class_art = '';
if(!empty($node->field_chat)) {
	$class_art .= 'format-chat ';
}
if(!empty($node->field_video_url)) {
	$class_art .= 'format-video ';
}
if(!empty($node->field_audio_url)) {
	$class_art .= 'format-audio ';
}
if(!empty($img_uri_1)) {
	$class_art .= 'format-gallery ';
}
if(empty($img_uri)) {
	$class_art .= 'no-image ';
}

?>
<?php if($node->type == 'blog'): ?>
<article class="post <?php print $class_art; ?> hentry">
	<?php if( !empty($node->field_video_url) ) { ?>
		<figure class="post-media">
			<iframe src="<?php print $node->field_video_url['und'][0]['value']?>" width="500" height="281" allowfullscreen="allowfullscreen"></iframe>
		</figure>
	<?php } elseif ( !empty($node->field_audio_url) ) { ?>
		<figure class="post-media">
			<iframe width="100%" height="166" src="<?php print $node->field_audio_url['und'][0]['value']?>"></iframe>
		</figure>
	<?php } elseif ( !empty($node->field_link) ) { ?>
			<div class="post-link">
				<div class="post-link-wrapper">
					<div class="tb">
						<div class="icon-area tb-cell">
                            <i class="fa fa-link"></i>
                        </div>
                        <div class="link-content tb-cell">
                        	<h2>
                        		<?php 
									$link = field_get_items('node', $node, 'field_link');
									$teaser = field_view_value('node', $node, 'field_link', $link[0],'teaser');
									print render($teaser);
								?>
                        	</h2>
                        </div>
					</div>
				</div>	
				<div class="images">
					<img alt="link post" src="<?php print $base_url.'/'.path_to_theme();?>/images/link.jpg">
                </div>
			</div>
	<?php } elseif( !empty($node->field_quote) ) { ?>
		<figure class="post-media format-quote">
			<div class="quote-content">
				<div class="quote-icon">
                    <a href="#">
                        <span>
                            <i class="fa fa-quote-left"></i>
                        </span>
                    </a>
                </div>
                <blockquote>
                	<span class="screen-reader-text"></span>
                		<p><?php print $node->field_quote['und'][0]['value']?></p>
                	<footer class="author">
                		<a href="#"><?php print $node->field_quote_author['und'][0]['value']?></a>
                	</footer>
                </blockquote>
			</div>
		</figure>
	<?php } elseif( !empty($node->field_images) ) { ?>
		<figure class="post-thumb">
			<?php if(empty($img_uri_1)) { ?>
                
                	<img src="<?php print $img_url; ?>" class="img-responsive" alt="<?php print $title; ?>">
               	

            <?php } else { ?>
            	<?php if($gallery == '3') { ?>
					<div class="glim-tiled-gallery">
                		<?php
							foreach($node->field_images['und'] as $key => $value) {
								$image_uri = $node->field_images['und'][$key]['uri'];
								$image_url = file_create_url($image_uri);
						?>  
                            <a class="item" href="<?php print $image_url; ?>">
                                <img src="<?php print $image_url; ?>" alt="<?php print $title.' - '.$key; ?>">
                            </a>
                        <?php
                        	} 
                        ?>
                    </div>

				<?php } elseif($gallery == '2') { ?>
					<div class="gallery-two">
						<div class="full-view owl-carousel">
							<?php
								foreach($node->field_images['und'] as $key => $value){
									$image_uri = $node->field_images['und'][$key]['uri'];
									$image_url = file_create_url($image_uri);
							?>  
                                <a class="item" href="<?php print $image_url; ?>">
                                    <img src="<?php print $image_url; ?>" alt="<?php print $title.' - '.$key; ?>">
                                </a>
                            <?php
                            	} 
                            ?>
						</div>
						<div class="list-view owl-carousel">
							<?php
								foreach($node->field_images['und'] as $key => $value){
									$image_uri = $node->field_images['und'][$key]['uri'];
									$image_url = file_create_url($image_uri);
							?>  
                                <div class="item">
                                    <img src="<?php print $image_url; ?>" alt="<?php print $title.' - '.$key; ?>">
                                </div>
                            <?php
                            	} 
                            ?>
						</div>
					</div>
				<?php } else { ?>
					<div class="gallery-one owl-carousel">
                		<?php
							foreach($node->field_images['und'] as $key => $value) {
								$image_uri = $node->field_images['und'][$key]['uri'];
								$image_url = file_create_url($image_uri);
						?>  
                            <a class="item" href="<?php print $image_url; ?>">
                                <img src="<?php print $image_url; ?>" alt="<?php print $title.' - '.$key; ?>">
                            </a>
                        <?php
                        	} 
                        ?>
                    </div>
				<?php } ?>
            	
            <?php } ?>

        </figure>
    <?php } ?> <!-- /.post-thumb -->

    <header class="entry-header">
        
    		<?php if(empty($node->field_video_url) && empty($node->field_audio_url) && empty($node->field_link) && empty($node->field_quote)) { ?>
        		<?php if( !empty($node->field_chat)) { ?>
	        		<div class="post-format">
	                    <i class="fa fa-weixin"></i>
	                </div>
	            <?php } elseif ( !empty($node->field_images)) { ?>
	        		<div class="post-format">
	                    <i class="fa fa-image"></i>
	                </div>
	            <?php } else { ?>
	        		<div class="post-format">
	                    <i class="fa fa-file-text"></i>
	                </div>
	            <?php } ?>
            <?php } ?>
        
        <h2 class="entry-title">
        	<a href="<?php print url("node/$node->nid"); ?>" rel="bookmark"><?php print $node->title; ?></a>
        </h2>
        <div class="entry-meta">
            <span class="cat-links">
                <?php 
	        		$cate = field_get_items('node', $node, 'field_categories');
	        		foreach($cate as $key => $value) {
						$teaser = field_view_value('node', $node, 'field_categories', $cate[$key],'teaser');			
						print render($teaser);
					}
        		?>
            </span>
            <span class="devider">/</span>
            <span class="entry-date"><?php print format_date($node->created, 'custom', 'F d, Y');?></span>
            <span class="devider">/</span>
            <span class="byline">
                <span class="author vcard">
                    By: <?php print $node->name; ?>
                </span>
            </span>
        </div> <!-- .entry-meta -->
    </header> <!-- /.entry-header -->

    <div class="entry-content">
        <span class="screen-reader-text"></span>

        <?php 
        if(!empty($node->field_chat)) {
        	print render($node->content['field_chat']);
        } else {
        ?>
		<?php 
			$body = field_get_items('node', $node, 'body');
			$teaser = field_view_value('node', $node, 'body', $body[0],'teaser');
			print render($teaser);
		?>
        <?php } ?>
    </div> <!-- .entry-content -->

    <footer class="entry-footer clearfix"> 
    	<?php if ($style_list == '2' ): ?>
		<div class="more-wraper">
            <a href="<?php print url("node/$node->nid"); ?>" class="more-link">Continue</a>    
        </div>                            
		<?php endif;?> 
    	
        <div class="footer-meta clearfix">  
            <div class="post-comment">
                <a href="#" class="comments-link">
                    <span><?php print $node->comment_count.' Comments'; ?></span>
                </a>
            </div>
            <div class="share-area">
                <div> 
                    <a href="https://twitter.com/share?url=<?php print $base_root.url("node/$node->nid"); ?>&text=<?php print $title; ?>"><span class="fa fa-twitter"></span></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php print $base_root.url("node/$node->nid"); ?>"><span class="fa fa-facebook"></span></a>
                    <a href="https://plus.google.com/share?url=<?php print $base_root.url("node/$node->nid"); ?>"><span class="fa fa-google-plus"></span></a>
                    <a href="https://www.instagram.com/share?url=<?php print $base_root.url("node/$node->nid"); ?>"><span class="fa fa-instagram"></span></a>
                    <a href="https://dribbble.com/share?url=<?php print $base_root.url("node/$node->nid"); ?>"><span class="fa fa-dribbble"></span></a>
                </div>
            </div>
            <div class="post-view">
                <a href="#" class="view-link">
                    <span>
                       	<?php 
							$statistics = statistics_get($node->nid);
							if ($statistics) {
								print $statistics['totalcount'].' Views';
							} else {
								print t('0 View');
							}
						?>
					</span>
                </a>
            </div>
        </div> <!-- /.footer-meta -->
    </footer> <!-- .entry-footer -->
</article>
<?php endif; ?>