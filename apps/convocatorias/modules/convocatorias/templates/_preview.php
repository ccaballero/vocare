<?php if (!empty($preview)): ?>
    <?php echo $sf_data->getRaw('preview') ?>
<?php else: ?>
    <p>No se definió aún una redacción del texto para este borrador de
    convocatoria.</p>
<?php endif; ?>
