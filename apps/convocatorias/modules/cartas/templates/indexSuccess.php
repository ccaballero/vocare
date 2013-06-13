<h1>Gestión de documentación</h1>

<?php if ($sf_user->hasCredential('cartas_create')): ?>
<div class="tasks">
    <ul>
        <li><?php echo link_to('Crear nueva carta',
            url_for('cartas_new'), array('accesskey' => 'n')
        ) ?></li>
    </ul>
</div>
<?php endif; ?>

<table>
    <tr class="header">
        <th>Nombre</th>
        <th>&nbsp;</th>
    </tr>
<?php foreach ($list as $i => $carta): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $carta->getNombre() ?></td>
        <td>
            <ul>
            <?php if ($sf_user->hasCredential('cartas_view')): ?>
                <li><?php echo link_to(
                    'Ver', 'cartas_show', $carta
                ) ?></li>
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('cartas_edit')): ?>
                <li><?php echo link_to(
                    'Editar', 'cartas_edit', $carta
                ) ?></li>
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('cartas_delete')): ?>
                <li><?php echo link_to(
                    'Eliminar', 'cartas_delete', $carta,
                    array(
                        'method' => 'delete',
                        'confirm' => '¿Esta seguro que desea eliminar '
                            . 'el documento?',
                    )
                ) ?></li>
            <?php endif; ?>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
</table>
