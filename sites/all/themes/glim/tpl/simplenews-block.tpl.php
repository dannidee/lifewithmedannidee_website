<?php if ($use_form): ?>
<div class="newsletter-area">
	<?php if ($message): ?>
		<p><?php print $message; ?></p>	
	<?php endif; ?>
	<div class="form-newsletter">
		<?php print render($form); ?>
	</div>
</div>
<?php endif; ?>

