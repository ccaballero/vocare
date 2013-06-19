<h1><?php echo $object->getNombre() ?></h1>

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

[<?php echo link_to('Volver a la lista', url_for('plantillas')) ?>]
