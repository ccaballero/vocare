<h1>Convocatorias del sitio</h1>

<h2>Convocatorias vigentes</h2>
<?php foreach ($vigentes as $convocatoria): ?>
    <?php include_partial('convocatoria_medium', array(
        'convocatoria' => $convocatoria,
        'preview' => $convocatoria->renderLastXHTML(),
    )) ?>
<?php endforeach; ?>

<h2>Convocatorias finalizadas</h2>
<?php foreach ($finalizadas as $convocatoria): ?>
    <?php include_partial('convocatoria_medium', array(
        'convocatoria' => $convocatoria,
        'preview' => $convocatoria->renderLastXHTML(),
    )) ?>
<?php endforeach; ?>
