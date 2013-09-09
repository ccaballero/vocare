<p>En esta página puede usted establecer el conjunto de personas encargadas de
supervisar el proceso de ejecución de su convocatoria. Estas personas no poseen
una cuenta en el sistema, y su rol es mas de ver documentos, y recepción de
notificaciones.</p>

<?php if ($object->getEstado() <> 'vigente'): ?>
<h2>Firmas</h2>
<p>Esta tabla define el orden en el que los campos de firmas aparecerán en los
documentos oficiales generados, si el cargo no esta marcado, entonces este no
aparecerá. Ademas el orden se toma de arriba hacia abajo, lo que en el documento
reflejará un orden de izquierda hacia derecha.</p>

<?php echo form_tag(
    url_for('convocatorias_firmas',
    array('id' => $object->getId()))) ?>
    <table class="draggable">
        <thead>
            <tr class="header">
                <td>&nbsp;</td>
                <td>Cargo</td>
                <td>Encargado</td>
                <td>&nbsp;</td>
            </tr>
        </thead>
    <?php foreach ($signatures as $i => $signature): ?>
        <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
            <td class="text-center">
                <input type="checkbox"
                       name="cargos[<?php echo $signature['id'] ?>]"
                       value="<?php echo $signature['numero_orden'] ?>"
                    <?php echo empty($signature['numero_orden']) ?
                        '' : 'checked="checked"' ?>
                />
            </td>
            <td><?php echo $signature['cargo'] ?></td>
            <td><?php echo $signature['encargado'] ?></td>
            <td>
                <ul>
                    <li><a class="up">Subir</a></li>
                    <li><a class="down">Bajar</a></li>
                </ul>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <p class="submit">
        <input type="submit" value="Registrar">
    </p>
</form>
<?php endif; ?>

<h2>Notificaciones</h2>

<p>En esta sección usted puede configurar el conjunto de notificaciones que han
de realizarse hacia los encargados, en el transcurso de esta convocatoria. Para
esto usted debe definir a la persona, su cargo y su correo electrónico. Estas
notificaciones serán enviadas por correo electrónico y en la mayoria de los
casos informan sobre cambios importantes durante el proceso.</p>

<?php echo form_tag(
    url_for('convocatorias_notificaciones',
    array('id' => $object->getId()))) ?>
    <table id="notifications">
        <thead>
            <tr class="header">
                <td>Cargo</td>
                <td>Nombre Completo</td>
                <td>Correo electrónico</td>
                <td>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($notifications as $i => $notification): ?>
            <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
                <td><input type="text"
                           style="width: 160px;"
                           name="notifications[cargo][]"
                           value="<?php echo $notification->cargo ?>" />
                </td>
                <td><input type="text"
                           style="width: 360px;"
                           name="notifications[encargado][]"
                           value="<?php echo $notification->encargado ?>" />
                </td>
                <td><input type="text"
                           style="width: 200px;"
                           name="notifications[email][]"
                           value="<?php echo $notification->email ?>" />
                </td>
                <td>
                    <ul>
                        <li><a onclick="return remove_row(this);">Remover</a></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
            <tr>
                <td><input type="text"
                           style="width: 160px;"
                           name="notifications[cargo][]"
                           value="" />
                </td>
                <td><input type="text"
                           style="width: 360px;"
                           name="notifications[encargado][]"
                           value="" />
                </td>
                <td><input type="text"
                           style="width: 200px;"
                           name="notifications[email][]"
                           value="" />
                </td>
                <td>
                    <ul>
                        <li><a onclick="return remove_row(this);">Remover</a></li>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
    <p class="submit">
        <input type="submit" value="Registrar">&nbsp;
        <a onclick="return add_row('#notifications');">Agregar nuevo</a>
    </p>
</form>
