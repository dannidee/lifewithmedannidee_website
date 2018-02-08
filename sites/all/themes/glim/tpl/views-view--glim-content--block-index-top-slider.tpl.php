<?php print render($title_prefix); ?>
<?php if ($rows): ?>
<div id="featured-slider" class="owl-carousel">
    <?php print $rows; ?>
</div>

<?php endif; ?>
