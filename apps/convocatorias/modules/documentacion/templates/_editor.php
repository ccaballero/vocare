<p>
    <label>Nombre del volumen:</label>
    <input type="text" name="volumen" value="<?php echo $object->getNombre() ?>" />
</p>
<p>
    <label>Variables globales:</label>
    <?php echo std_render($object->getObjectVars()) ?>
</p>
<?php foreach ($object->getDocumentaciones() as $i => $documentacion): ?>
    <p>
        <label>Documentacion #<?php echo $i ?></label>
        <?php echo std_render(json_decode($documentacion->getVars())) ?>
    </p>
<?php endforeach; ?>
