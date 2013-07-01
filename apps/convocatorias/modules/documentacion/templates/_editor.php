<p>
    <label>Nombre del volumen:</label>
    <input type="text" name="volumen" value="<?php echo $object->getNombre() ?>" />
</p>
<p>
    <label>Variables globales:</label>
    <textarea><?php echo $object->getVars() ?></textarea>
</p>
<?php foreach ($object->getDocumentaciones() as $i => $documentacion): ?>
<p>
    <label>documentacion #<?php echo $i ?></label>
    <textarea><?php echo $documentacion->getVars() ?></textarea>
</p>
<?php endforeach; ?>
