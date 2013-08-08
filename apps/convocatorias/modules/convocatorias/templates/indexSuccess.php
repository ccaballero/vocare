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
        <th colspan="4">Operaciones</th>
        <th colspan="2">Acciones</th>
    </tr>
<?php if (count($list) == 0): ?>
    <tr class="even">
        <td colspan="4">No existen convocatorias registradas.</td>
    </tr>
<?php else: ?>
    <?php foreach ($list as $i => $convocatoria): ?>
        <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
            <td class="text-left">
                <?php echo $convocatoria->getGestion() ?>
            </td>
            <td class="text-center">
                <?php echo ucfirst($convocatoria->getEstado()) ?>
                <?php echo image_state($convocatoria->validateState()) ?>
            </td>
        <?php foreach ($convocatoria->getOperacionesPosibles()
                as $operacion => $propiedades): ?>
            <td class="text-center">
            <?php if ($convocatoria->hasOperacion($operacion) &&
                      $sf_user->hasCredential('convocatorias_' . $operacion) &&
                      $convocatoria->validateOperation($operacion) == 2): ?>
                <?php echo link_to(
                        ucfirst($propiedades[0]),
                        'convocatorias_' . $operacion,
                        $convocatoria,
                        array(
                            'method' => 'post',
                            'confirm' => $propiedades[1]
                        )) ?>
            <?php else: ?>
                <span class="disabled"><?php echo ucfirst($operacion) ?></span>
            <?php endif; ?>
            </td>
        <?php endforeach; ?>
            <td class="text-center">
            <?php if ($sf_user->canView($convocatoria)): ?>
                <?php echo link_to(
                    'Examinar', 'convocatorias_show', $convocatoria
                ) ?>
            <?php else: ?>
                <span class="disabled">Examinar</span>
            <?php endif; ?>
            </td>
            <td class="text-center">
            <?php if ($convocatoria->esVigente()): ?>
                <?php echo link_to('Postulaciones', url_for(
                        'postulantes',
                        array('convocatoria' => $convocatoria['id'])
                    )) ?>
            <?php else: ?>
                <span class="disabled">Postulaciones</span>
            <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>
</table>
