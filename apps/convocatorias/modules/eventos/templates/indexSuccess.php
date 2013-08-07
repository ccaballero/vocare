<h1>Plantillas de eventos</h1>

<?php if ($sf_user->hasCredential('plantillas_create')): ?>
<div class="tasks">
    <ul>
        <li><?php echo link_to('Crear nuevo evento',
            url_for('eventos_new'), array('accesskey' => 'n')
        ) ?></li>
        <li><?php echo link_to('Administración de plantillas',
            url_for('portada/plantillas'), array('accesskey' => 'p')
        ) ?></li>
    </ul>
</div>
<?php endif; ?>

<table>
    <tr class="header">
        <th>Evento</th>
        <th>&nbsp;</th>
    </tr>
<?php foreach($list as $i => $evento): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $evento->getDescripcion() ?></td>
        <td>
            <ul>
            <?php if ($sf_user->hasCredential('plantillas_edit')): ?>
                <li><?php echo link_to(
                    'Editar', 'eventos_edit', $evento
                ) ?></li>
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('plantillas_delete')): ?>
                <li><?php echo link_to(
                    'Eliminar', 'eventos_delete', $evento,
                    array(
                        'method' => 'delete',
                        'confirm' => '¿Esta seguro que desea eliminar '
                            . 'el evento?',
                    )
                ) ?></li>
            <?php endif; ?>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
</table>
