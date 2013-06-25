<h1>Gestión de documentación</h1>

<div class="tasks">
    <ul>
    <?php if ($sf_user->hasCredential('documentacion_create')): ?>
        <li><?php echo link_to('Crear nueva documentación',
            url_for('documentacion_new'), array('accesskey' => 'n')
        ) ?></li>
    <?php if ($sf_user->hasCredential('documentacion_plantilla_list')): ?>
    <?php endif; ?>
        <li><?php echo link_to('Plantillas de documentación',
            url_for('plantillas'), array('accesskey' => 'p')
        ) ?></li>
    <?php endif; ?>
    </ul>
</div>

<table>
    <tr class="header">
        <th>Nombre</th>
        <th>&nbsp;</th>
    </tr>
<?php if (count($list) != 0): ?>
<?php foreach ($list as $i => $documento): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $documento->getNombre() ?></td>
        <td>
            <ul>
            <?php if ($sf_user->hasCredential('documentacion_view')): ?>
                <li><?php echo link_to(
                    'Ver', 'documentacion_show', $documento
                ) ?></li>
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('documentacion_delete')): ?>
                <li><?php echo link_to(
                    'Eliminar', 'documentacion_delete', $documento,
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
<?php else: ?>
    <tr>
        <td>
            <p>No se encontraron documentos generados.</p>
        </td>
    </tr>
<?php endif; ?>
</table>
