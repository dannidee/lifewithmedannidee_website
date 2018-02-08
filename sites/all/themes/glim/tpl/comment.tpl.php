<?php 

global $base_url;

?>

<li class="comment">
    <div class="comment-body">
        <div class="comment-meta">
            <div class="comment-author vcard">
                <div class="author-img">
                    <?php
                        if($picture){
                            print strip_tags($picture,'<img>') ; 
                        }  else {
                          print '<img class="avatar photo" src="'.$base_url.'/'.path_to_theme().'/images/author/comment-one.jpg'.'" alt="Default User Picture"/>';
                        }
                    ?>
                </div>              
            </div>

            <div class="comment-metadata">
                <b class="author"><?php print $author;?></b>                 
                <span class="date"><?php print format_date($node->created, 'custom', 'F d, Y').' at '.format_date($node->created, 'custom', 'h:i a'); ?></span>
            </div>
        </div>
        
        <div class="comment-details">
            <div class="comment-content">
                <p><?php print strip_tags(render($content['comment_body']));?></p>
            </div>
            <div class="reply">
                <?php if(!empty($content['links']['comment']['#links']['comment-reply'])):?>

                    <a href="<?php print url($content['links']['comment']['#links']['comment-reply']['href']); ?>" class="comment-reply-link" title="Reply">Reply</a>

                <?php endif; ?>
            </div>
        </div>
    </div>
</li>



