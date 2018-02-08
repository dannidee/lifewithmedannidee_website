<?php print render($title_prefix); ?>
<?php if ($rows): ?>

	<main id="main" class="site-main">
		<?php print $rows; ?>
	</main>
	<nav class="navigation paging-navigation">
		<?php print $pager; ?>
	</nav>


<?php endif; ?>
