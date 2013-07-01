<?php if (count($sf_data->getRaw('previews')) <> 0): ?>
<?php foreach ($sf_data->getRaw('previews') as $preview): ?>
<div id="letter">
    <?php echo specialEscape($preview) ?>
</div>
<?php endforeach; ?>
<?php else: ?>
<p>No se definio ningun documento aun.</p>
<?php endif; ?>
