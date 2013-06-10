<p><label>Gestión:</label><?php echo $convocatoria->getGestion() ?></p>
<p><label>Estado:</label><?php echo ucfirst($convocatoria->getEstado()) ?></p>
<p><label>Publicación:</label><?php echo $convocatoria->getPublicacion() ?></p>
<?php include_partial('convocatorias/tasks', array(
    'object' => $convocatoria,
    'flags' => array(true, true, false, true),
)) ?>
