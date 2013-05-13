<h1>Cargos administrativos</h1>

<p>En esta página, usted puede configurar los nombres del personal, segun su
respectivo cargo, esta información es utilizada en los campos de firmas
principalmente, y en la generación de otros documentos.</p>

<?php if ($sf_user->hasCredential('cargos_create')): ?>
<div class="tasks">
    <ul>
        <li><?php echo link_to(
        'Crear nuevo cargo', url_for('cargos_new')) ?></li>
    </ul>
</div>
<?php endif; ?>

<table>
    <tr class="header">
        <th>Cargo</th>
        <th>Encargado</th>
        <th>Correo electrónico</th>
        <th>&nbsp;</th>
    </tr>
<?php foreach ($list as $i => $cargo): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $cargo->getCargo() ?></td>
        <td><?php echo $cargo->getEncargadoActual() ?></td>
        <td><?php echo $cargo->getEmailEncargado() ?></td>
        <td>
            <ul>
            <?php if ($sf_user->hasCredential('cargos_view')): ?>
                <?php echo link_to(
                    'Examinar', 'cargos_show', $cargo
                ) ?>
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('cargos_edit')): ?>
                <li><?php echo link_to(
                    'Editar', 'cargos_edit', $cargo
                ) ?></li>
            <?php endif; ?>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
</table>
