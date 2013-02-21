<h1>Plantillas de eventos</h1>

<div class="tasks"><?php echo link_to(
    'Crear nuevo evento', url_for('eventos_new')
) ?></div>

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
                <li><?php echo link_to(
                    'Editar', 'eventos_edit', $evento
                ) ?></li>
                <li><?php echo link_to(
                    'Eliminar', 'eventos_delete', $evento, array(
                        'method' => 'delete',
                        'confirm' => '¿Esta seguro que desea eliminar el evento?',
                    )
                ) ?></li>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
</table>
