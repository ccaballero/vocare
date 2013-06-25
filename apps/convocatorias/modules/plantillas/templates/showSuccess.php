<h1><?php echo $object->getNombre() ?></h1>

<p>[<?php echo link_to('Editar redacción',
    url_for('plantillas_edit', array('id' => $object->getId()))
) ?>]</p>

<div id="letter">
    <?php echo specialEscape($sf_data->getRaw('redaccion')) ?>
</div>

<div class="right widget">
    <h1>Variables establecidas</h1>
    <?php echo renderFormTypes(
        $sf_data->getRaw('taxonomy'),
        url_for('plantillas_types', array('id' => $object->getId()))
    ) ?>
</div>

<div class="clear"></div>

<p>[<?php echo link_to('Volver a la lista', url_for('plantillas')) ?>]</p>
