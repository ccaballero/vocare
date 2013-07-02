<p>
    <label>Nombre del volumen:</label>
    <input type="text" name="volumen" value="<?php echo $object->getNombre() ?>" />
</p>

<?php /*
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
*/ ?>

<div class="box">
    <div class="title">
        <span>Documento #1</span>
        <div class="controls">
            <ul>
                <li><a href="">_</a></li>
                <li><a href="">o</a></li>
                <li><a href="">x</a></li>
            </ul>
        </div>
    </div>
    <table>
        <tr>
            <th>i:</th>
            <td><input type="text" /></td>
        </tr>
    </table>
</div>
<div class="box_controls">
    <ul>
        <li><a href="">+</a></li>
    </ul>
</div>
