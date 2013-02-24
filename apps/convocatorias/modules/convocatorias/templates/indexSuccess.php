<h1>Convocatorias</h1>

<div class="tasks"><?php echo link_to(
    'Crear nueva convocatoria', url_for('convocatorias_new')
) ?></div>

<table>
    <tr class="header">
        <th>Convocatoria</th>
        <th>Estado</th>
        <th colspan="6">&nbsp;</th>
    </tr>
<?php foreach($list as $i => $convocatoria): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td class="left"><?php echo $convocatoria->getNombre() ?></td>
        <td class="center"><?php echo ucfirst($convocatoria->getEstado()) ?></td>
        <td>
            <?php echo link_to(
                'Examinar', 'convocatorias_show', $convocatoria
            ) ?>
        </td>
    <?php foreach($convocatoria->getAcciones() as $accion): ?>
        <td>
        <?php if ($convocatoria->tieneAccion($accion)): ?>
            <?php echo link_to(
                ucfirst($accion), 'convocatorias_delete', $convocatoria, array(
                    'method' => 'delete',
                    'confirm' => '¿Esta seguro que desea eliminar la convocatoria?'
                )
            ) ?>
        <?php endif; ?>
        </td>
    <?php endforeach; ?>
        </td>
    </tr>
<?php endforeach; ?>
</table>
