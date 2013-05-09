<h1>Convocatorias</h1>

<div class="tasks">
    <ul>
    <?php if ($sf_user->hasCredential('convocatorias_create')): ?>
        <li><?php echo link_to('Crear nueva convocatoria',
            url_for('convocatorias_new'), array('accesskey' => 'n')
        ) ?></li>
    <?php endif; ?>
    <?php if ($sf_user->hasCredential('plantillas_list')): ?>
        <li><?php echo link_to('Administración de plantillas',
            url_for('portada/plantillas'), array('accesskey' => 'p')
        ) ?></li>
    <?php endif; ?>
    </ul>
</div>

<table>
    <tr class="header">
        <th>Convocatoria</th>
        <th>Estado</th>
        <th>&nbsp;</th>
        <th colspan="<?php echo Convocatoria::$OPERACIONES_POSIBLES ?>">&nbsp;</th>
    </tr>
<?php if (count($list) == 0): ?>
    <tr class="even"><td colspan="4">No existen convocatorias registradas.</td></tr>
<?php else: ?>
    <?php foreach ($list as $i => $convocatoria): ?>
        <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
            <td class="text-left">
                <?php echo $convocatoria->getGestion() ?>
            </td>
            <td class="text-center">
                <?php echo ucfirst($convocatoria->getEstado()) ?>
            </td>
            <td class="text-center">
            <?php if ($sf_user->hasCredential('convocatorias_view')): ?>
                <?php echo link_to(
                    'Examinar', 'convocatorias_show', $convocatoria
                ) ?>
            <?php endif; ?>
            </td>
        <?php foreach ($convocatoria->getOperacionesPosibles() as $operacion => $propiedades): ?>
            <td class="text-center">
            <?php if ($convocatoria->hasOperacion($operacion) &&
                      $sf_user->hasCredential('convocatorias_' . $operacion)): ?>
                <?php echo link_to(
                    ucfirst($propiedades[0]), 'convocatorias_' . $operacion, $convocatoria, array(
                        'method' => 'post',
                        'confirm' => $propiedades[1]
                    )) ?>
            <?php else: ?>
                <span class="disabled"><?php echo ucfirst($operacion) ?></span>
            <?php endif; ?>
            </td>
        <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>
</table>
