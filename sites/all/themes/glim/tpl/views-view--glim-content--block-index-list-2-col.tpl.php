<?php print render($title_prefix); ?>
<?php if ($rows): ?>

<main id="main" class="site-main">
	<div class="row">
		<?php print $header; ?>
		<div class="col-md-12 ">
			<div class="row" id="masonry-layout">  
				<?php print $rows; ?>
			</div>
		</div>
	</div>
</main>
<nav class="navigation paging-navigation">
	<?php print $pager; ?>
</nav>

<?php endif; ?>
