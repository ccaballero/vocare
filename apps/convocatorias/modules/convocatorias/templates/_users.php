<p>En esta página puede usted establecer el conjunto de personas encargadas del
correcto desempeño en el proceso de ejecución de su convocatoria.</p>

<div class="clone" style="display: none;">
<?php foreach ($groups as $group): ?>
    <div class="g_<?php echo $group->getId() ?>">
        <?php echo user_selector($users, null,
            'roles[' . $group->getId() . '][]') ?>
    </div>
<?php endforeach; ?>
</div>

<?php echo form_tag(
    url_for('convocatorias_cargos',
    array('id' => $object->getId()))) ?>

    <table>
        <thead>
            <tr class="header">
                <th>Rol</th>
                <th>Personal</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($groups as $i => $group): ?>
            <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
                <td>
                    <span><?php echo $group->getNombre() ?></span>
                    <br />
                    <?php echo $group->getDescripcion() ?>
                </td>
                <td>
                    <ul class="list">
                    <?php foreach ($roles[$group->getId()] as $user): ?>
                        <li><?php echo user_selector($users, $user,
                            'roles[' . $group->getId() . '][]') ?></li>
                    <?php endforeach; ?>
                    </ul>
                    <a onclick="return add_li(this,'.clone div.g_<?php echo $group->getId() ?>');">Agregar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <p class="submit">
        <input type="submit" value="Registrar">
    </p>
</form>