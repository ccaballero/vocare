<h1><?php echo $object->getCargo() ?></h1>

<div class="tasks">
    <ul>
        <li><a onclick="showbox('.hidden-box')">Asignar nuevo encargado</a></li>
    </ul>
</div>

<table>
    <tr class="header">
        <th>Encargado</th>
        <th>Correo electrónico</th>
        <th>Fecha de registro</th>
    </tr>
<?php if (count($list) == 0): ?>
    <tr class="even">
        <td colspan="4">No existen asignaciones registradas.</td>
    </tr>
<?php else: ?>
    <?php foreach ($list as $i => $encargado): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $encargado->getEncargado() ?></td>
        <td><?php echo $encargado->getEmail() ?></td>
        <td class="text-center"><?php echo $encargado->getFecha() ?></td>
    </tr>
    <?php endforeach; ?>
<?php endif; ?>
</table>

<div class="hidden-box">
    <?php echo form_tag(
        url_for('cargos_agregar', array(
            'id' => $object->getId())
    )) ?>
        <?php echo $form ?>
        <p class="submit">
            <input type="submit" value="Registrar" />
        </p>
    </form>
</div>

[<?php echo link_to('Volver a la lista', '@cargos') ?>]
