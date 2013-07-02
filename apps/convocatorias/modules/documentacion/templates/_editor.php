<p>
    <label>Nombre del volumen:</label>
    <input type="text" name="volumen" value="<?php echo $object->getNombre() ?>" />
</p>
<p>
    <label>Variables globales:</label>
    <?php include_partial('documentacion/escape', array(
        'tpl' => $tpl,
        'vars' => $object->getObjectVars()
    )) ?>
</p>
<?php foreach ($object->getDocumentaciones() as $i => $documentacion): ?>
    <p>
        <label>Documentacion #<?php echo $i ?></label>
        <?php include_partial('documentacion/escape', array(
            'tpl' => $tpl,
            'vars' => $documentacion->getObjectVars()
        )) ?>
    </p>
<?php endforeach; ?>
