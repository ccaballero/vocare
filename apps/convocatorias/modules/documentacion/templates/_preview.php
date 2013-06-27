<?php foreach ($sf_data->getRaw('previews') as $preview): ?>
<div id="letter">
    <?php echo specialEscape($preview) ?>
</div>
<?php endforeach; ?>
