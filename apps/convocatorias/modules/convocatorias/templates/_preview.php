<?php if (!empty($preview)): ?>
    <?php echo specialEscape($sf_data->getRaw('preview')) ?>
<?php else: ?>
    <p>No se definió aún una redacción del texto para este borrador de
    convocatoria.</p>
<?php endif; ?>
