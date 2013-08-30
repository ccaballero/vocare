<table>
    <tr class="header">
        <th rowspan="2">#</th>
        <th rowspan="2">Nombre Completo</th>
    <?php if ($shows['email']): ?>
        <th rowspan="2">Correo Electrónico</th>
    <?php endif; ?>
    <?php if ($shows['state']): ?>
        <th rowspan="2">Estado</th>
    <?php endif; ?>
    <?php if ($shows['items']): ?>
        <th colspan="<?php echo count($requerimientos) ?>">Requerimientos</th>
    <?php endif; ?>
    <?php if ($shows['reception']): ?>
        <th>Nº de hojas</th>
        <th>Fecha de entrega</th>
        <th>Hora de entrega</th>
    <?php endif; ?>
    <?php if ($shows['requisitos']): ?>
        <th colspan="<?php echo count($requisitos) ?>">Requisitos</th>
    <?php endif; ?>
    <?php if ($shows['documentos']): ?>
        <th colspan="<?php echo count($documentos) ?>">Documentos</th>
    <?php endif; ?>
    <?php if ($shows['observacion']): ?>
        <th rowspan="2" style="width: 160px;">Observacion</th>
    <?php endif; ?>
        <th rowspan="2">Operaciones</th>
    </tr>
    <tr class="header">
    <?php if ($shows['items']): ?>
        <?php foreach ($requerimientos as $requerimiento): ?>
            <th><?php echo $requerimiento->getNumeroItem() ?></th>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($shows['requisitos']): ?>
        <?php foreach ($requisitos as $key => $requisito): ?>
            <th><?php echo literals($key) ?></th>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($shows['documentos']): ?>
        <?php foreach ($documentos as $key => $documento): ?>
            <th><?php echo literals($key) ?></th>
        <?php endforeach; ?>
    <?php endif; ?>
    </tr>
<?php foreach ($postulantes as $key => $postulante): ?>
    <tr class="<?php echo fmod($key, 2) ? 'even' : 'odd' ?>">
        <td class="text-right"><?php echo $key + 1 ?></td>
        <td><?php echo $postulante->getFullname() ?></td>
    <?php if ($shows['email']): ?>
        <td class="text-center">
            <?php echo $postulante->getCorreoElectronico() ?>
        </td>
    <?php endif; ?>
    <?php if ($shows['state']): ?>
        <td class="text-center"><?php echo $postulante->getEstado() ?></td>
    <?php endif; ?>
    <?php if ($shows['items']): ?>
        <?php foreach ($requerimientos as $requerimiento): ?>
            <td class="text-center">
                <?php echo $postulante->hasRequerimiento($requerimiento) ?
                        '&#10003;' :'' ?>
            </td>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($shows['reception']): ?>
        <td class="text-center">
            <?php echo $postulante->displayNumeroHojas() ?></td>
        <td class="text-center">
            <?php echo $postulante->displayFechaEntrega() ?></td>
        <td class="text-center">
            <?php echo $postulante->displayHoraEntrega() ?></td>
    <?php endif; ?>
    <?php if ($shows['requisitos']): ?>
        <?php foreach ($requisitos as $requisito): ?>
            <td class="text-center">
                <?php echo $postulante->hasRequisito($requisito) ?
                        '&#10003;' : '<span class="bad">&#10007;</span>' ?>
            </td>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($shows['documentos']): ?>
        <?php foreach ($documentos as $documento): ?>
            <td class="text-center">
                <?php echo $postulante->hasDocumento($documento) ?
                        '&#10003;' : '&#10007;' ?>
            </td>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($shows['observacion']): ?>
        <td><?php echo $postulante->getObservacion() ?></td>
    <?php endif; ?>
        <td class="text-center">
            <ul>
            <?php if ($operations['edit']): ?>
                <li><?php echo link_to('Editar',
                    url_for('postulantes_edit',
                        array(
                            'convocatoria' => $convocatoria->getId(),
                            'id' => $postulante->getId(),
                        ))) ?></li>
            <?php endif; ?>
            <?php if ($operations['delete']): ?>
                <li><?php echo link_to('Eliminar',
                    'postulantes_delete',
                    array(
                        'convocatoria' => $convocatoria->getId(),
                        'id' => $postulante->getId(),
                    ),
                    array(
                        'method' => 'delete',
                        'confirm' => '¿Esta seguro que desea eliminar '
                        . 'al postulante?',
                    )) ?></li>
            <?php endif; ?>
            <?php if ($operations['reception']): ?>
                <li><?php echo link_to('Recepcionar',
                    url_for('postulantes_reception',
                        array(
                            'convocatoria' => $convocatoria->getId(),
                            'id' => $postulante->getId(),
                        ))) ?></li>
            <?php endif; ?>
            <?php if ($operations['habilitation']): ?>
                <li><?php echo link_to('Evaluar',
                    url_for('postulantes_habilitation',
                        array(
                            'convocatoria' => $convocatoria->getId(),
                            'id' => $postulante->getId(),
                        ))) ?></li>
            <?php endif; ?>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
</table>
