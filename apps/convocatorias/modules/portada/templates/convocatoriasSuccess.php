<h1>Convocatorias del sitio</h1>

<h2>Convocatorias vigentes</h2>
<?php if (count($vigentes) <> 0): ?>
<?php foreach ($vigentes as $convocatoria): ?>
    <?php include_partial('convocatoria_medium', array(
        'convocatoria' => $convocatoria,
        'preview' => $convocatoria->renderLastXHTML(),
    )) ?>
<?php endforeach; ?>
<?php else: ?>
    <p>No se encontraron convocatorias vigentes.</p>
<?php endif; ?>

<h2>Convocatorias finalizadas</h2>
<?php if (count($vigentes) <> 0): ?>
<?php foreach ($finalizadas as $convocatoria): ?>
    <?php include_partial('convocatoria_medium', array(
        'convocatoria' => $convocatoria,
        'preview' => $convocatoria->renderLastXHTML(),
    )) ?>
<?php endforeach; ?>
<?php else: ?>
    <p>No se encontraron convocatorias finalizadas.</p>
<?php endif; ?>
