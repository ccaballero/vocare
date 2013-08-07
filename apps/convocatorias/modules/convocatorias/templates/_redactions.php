<p>La redacción del documento, le permite modificar partes del texto resultante
de la creación de una convocatoria, para modificar el texto, este debe
escribirse en formato xhtml, y usarse comodines para la inserción dinamica de
sus componentes. Como ya de entrada se ve complejo, se escribio ademas un
ayudante, para que se pueda copiar el texto de una convocatoria anterior, y asi
de esa forma no complicarse tanto la vida, y aun tener toda la potencia de un
generador de plantillas muy versatil.</p>

<div class="tree">
    <h1>Modelos de redacción</h1>
    <script type="text/javascript">var redacciones = {};</script>
<?php if (count($redactions) == 0): ?>
    <p>No se encontro ningun modelo de redacción utilizable.</p>
<?php else: ?>
    <ul>
    <?php foreach ($redactions as $convocatoria): ?>
        <li>
            <span class="title">
                <?php echo $convocatoria['gestion'] ?>
            <?php if (!empty($convocatoria['numero_enmienda'])): ?>
                (#<?php echo $convocatoria['numero_enmienda'] ?>)
            <?php endif; ?>
            </span>
            <ul class="options">
                <li><?php echo link_to('Ver',
                    url_for('convocatorias_show',
                        array('id' => $convocatoria['id'])
                    ),
                    array('target' => '_blank')
                ) ?></li>
                <li>
                    <a class="clipboard"
            name="red<?php echo $convocatoria['id'] ?>">Copiar</a>
                    <script type="text/javascript">
            redacciones["red<?php echo $convocatoria['id'] ?>"]=
            <?php echo json_encode($convocatoria['redaccion']) ?>;
                    </script>
                </li>
            </ul>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>

<?php echo form_tag(
    url_for('convocatorias_redaccion',
    array('id' => $object->getId()))) ?>
    <p><textarea name="redaction"
       class="middle-area"><?php echo $redaction ?></textarea></p>
    <p class="submit"><input type="submit" value="Registrar" /></p>
</form>
