<h1>Plantillas de requerimientos</h1>

<?php if ($sf_user->hasCredential('plantillas_create')): ?>
<div class="tasks">
    <ul>
        <li><?php echo link_to('Crear nuevo requerimiento',
            url_for('requerimientos_new'), array('accesskey' => 'n')
        ) ?></li>
        <li><?php echo link_to('Administración de plantillas',
            url_for('portada/plantillas'), array('accesskey' => 'p')
        ) ?></li>
    </ul>
</div>
<?php endif; ?>

<table>
    <tr class="header">
        <th>Código</th>
        <th>Nombre</th>
        <th>Hrs. Académicas</th>
        <th>&nbsp;</th>
    </tr>
<?php foreach ($list as $i => $requerimiento): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td class="right"><?php echo $requerimiento->getCodigo() ?></td>
        <td><?php echo $requerimiento->getNombre() ?></td>
        <td class="center">
            <?php echo $requerimiento->getHorasAcademicas() ?> Hrs/mes</td>
        <td>
            <ul>
            <?php if ($sf_user->hasCredential('plantillas_edit')): ?>
                <li><?php echo link_to(
                    'Editar', 'requerimientos_edit', $requerimiento
                ) ?></li>
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('plantillas_delete')): ?>
                <li><?php echo link_to(
                    'Eliminar', 'requerimientos_delete', $requerimiento,
                    array(
                        'method' => 'delete',
                        'confirm' => '¿Esta seguro que desea eliminar '
                            . 'el requerimiento?',
                    )
                ) ?></li>
            <?php endif; ?>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
</table>
