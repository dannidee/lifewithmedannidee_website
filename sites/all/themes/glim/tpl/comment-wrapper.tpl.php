<?php

	if ($content['#node']->comment and !($content['#node']->comment == 1 and $content['#node']->comment_count)) { ?>


<h2 class="comments-title">
    <span><?php print $content['#node']->comment_count.' Comments';?></span>
</h2>

<ol class="comment-list">
    <?php print render($content['comments']); ?>
</ol>
<div class="comment-respond" id="respond">
    <h3 class="comment-reply-title"><span><?php print t('Leave a Reply');?></span></h3>
    <?php print render($content['comment_form'])?>
</div>



<?php

	}

?>

