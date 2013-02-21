<h1>Convocatorias</h1>

<div class="tasks"><?php echo link_to(
    'Crear nueva convocatoria', url_for('convocatorias_new')
) ?></div>

<table>
    <tr class="header">
        <th>Convocatoria</th>
        <th>Estado</th>
        <th>&nbsp;</th>
    </tr>
<?php foreach($list as $i => $convocatoria): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td class="left"><?php echo $convocatoria->getNombre() ?></td>
        <td class="center"><?php echo ucfirst($convocatoria->getEstado()) ?></td>
        <td class="right">
            <ul>
                <li><?php echo link_to(
                    'Examinar', 'convocatorias_show', $convocatoria
                ) ?></li>
                <li><?php echo link_to(
                    'Eliminar', 'convocatorias_delete', $convocatoria, array(
                        'method' => 'delete',
                        'confirm' => '¿Esta seguro que desea eliminar la convocatoria?'
                    )
                ) ?></li>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
</table>
