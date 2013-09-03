<style>
    h1 { text-align: center; }
    .left { text-align: left; }
    .center { text-align: center; }
    .right { text-align: right; }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid #000000;
    }
    th { font-weight: bold; }
    .odd { background-color: #e0e0e0; }
</style>

<h1>Lista de Postulantes - <?php echo $convocatoria->getGestion() ?></h1>

<table>
    <tr>
    <?php if ($columns['number']): ?>
        <th <?php echo $second ? 'rowspan="2"' : '' ?>
            class="center" style="width:25pt;">#</th>
    <?php endif; ?>
    <?php if ($columns['fullname']): ?>
        <th <?php echo $second ? 'rowspan="2"' : '' ?>
            class="center" style="width:180pt;">Nombre Completo</th>
    <?php endif; ?>
    <?php if ($columns['email']): ?>
        <th <?php echo $second ? 'rowspan="2"' : '' ?>
            class="center" style="width:90pt;">Correo</th>
    <?php endif; ?>
    <?php if ($columns['status']): ?>
        <th <?php echo $second ? 'rowspan="2"' : '' ?>
            class="center" style="width:70pt;">Estado</th>
    <?php endif; ?>
    <?php if ($columns['numero_hojas']): ?>
        <th <?php echo $second ? 'rowspan="2"' : '' ?>
            class="center" style="width:35pt;">Hojas</th>
    <?php endif; ?>
    <?php if ($columns['fecha_entrega']): ?>
        <th <?php echo $second ? 'rowspan="2"' : '' ?>
            class="center" style="width:65pt">Fecha</th>
    <?php endif; ?>
    <?php if ($columns['hora_entrega']): ?>
        <th <?php echo $second ? 'rowspan="2"' : '' ?>
            class="center" style="width:65pt;">Hora</th>
    <?php endif; ?>
    <?php if ($columns['requerimientos']): ?>
        <th style="width:<?php echo count($requerimientos) * 20 ?>pt;"
            colspan="<?php echo count($requerimientos) ?>"
            class="center">Requerimientos</th>
    <?php endif; ?>
    <?php if ($columns['requisitos']): ?>
        <th style="width:<?php echo count($requisitos) * 20 ?>pt;"
            colspan="<?php echo count($requisitos) ?>"
            class="center">Requisitos</th>
    <?php endif; ?>
    <?php if ($columns['documentos']): ?>
        <th style="width:<?php echo count($documentos) * 20 ?>pt;"
            colspan="<?php echo count($documentos) ?>"
            class="center">Documentos</th>
    <?php endif; ?>
    <?php if ($columns['observaciones']): ?>
        <th <?php echo $second ? 'rowspan="2"' : '' ?>
            class="center" style="width:70pt;">Observacion</th>
    <?php endif; ?>
    </tr>
<?php if ($second): ?>
    <tr>
<?php if ($columns['requerimientos']): ?>
    <?php foreach ($requerimientos as $requerimiento): ?>
        <th style="width:20pt;" class="center">
            <?php echo $requerimiento->getNumeroItem() ?></th>
    <?php endforeach; ?>
<?php endif; ?>
<?php if ($columns['requisitos']): ?>
    <?php foreach ($requisitos as $key => $requisito): ?>
        <th style="width:20pt;" class="center">
            <?php echo literals($key) ?></th>
    <?php endforeach; ?>
<?php endif; ?>
<?php if ($columns['documentos']): ?>
    <?php foreach ($documentos as $key => $documento): ?>
        <th style="width:20pt;" class="center">
            <?php echo literals($key) ?></th>
    <?php endforeach; ?>
<?php endif; ?>
    </tr>
<?php endif; ?>
<?php foreach ($postulantes as $key => $postulante): ?>
    <tr class="<?php echo fmod($key, 2) ? 'even' : 'odd' ?>">
    <?php if ($columns['number']): ?>
        <td class="right"><?php echo $key + 1 ?></td>
    <?php endif; ?>
    <?php if ($columns['fullname']): ?>
        <td><?php echo $postulante->getFullname() ?></td>
    <?php endif; ?>
    <?php if ($columns['email']): ?>
        <td class="center">
            <?php echo $postulante->getCorreoElectronico() ?>
        </td>
    <?php endif; ?>
    <?php if ($columns['status']): ?>
        <td class="center"><?php echo $postulante->getEstado() ?></td>
    <?php endif; ?>
    <?php if ($columns['numero_hojas']): ?>
        <td class="center">
            <?php echo $postulante->displayNumeroHojas() ?></td>
    <?php endif; ?>
    <?php if ($columns['fecha_entrega']): ?>
        <td class="center">
            <?php echo $postulante->displayFechaEntrega() ?></td>
    <?php endif; ?>
    <?php if ($columns['hora_entrega']): ?>
        <td class="center">
            <?php echo $postulante->displayHoraEntrega() ?></td>
    <?php endif; ?>
    <?php if ($columns['requerimientos']): ?>
        <?php foreach ($requerimientos as $requerimiento): ?>
            <td style="width:20pt;" class="center">
                <?php echo $postulante->hasRequerimiento($requerimiento) ?
                        'x' : '' ?>
            </td>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($columns['requisitos']): ?>
        <?php foreach ($requisitos as $requisito): ?>
            <td style="width:20pt;" class="center">
                <?php echo $postulante->hasRequisito($requisito) ?
                        'x' : '' ?>
            </td>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($columns['documentos']): ?>
        <?php foreach ($documentos as $documento): ?>
            <td style="width:20pt;" class="center">
                <?php echo $postulante->hasDocumento($documento) ?
                        'x' : '' ?>
            </td>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($columns['observaciones']): ?>
        <td><?php echo $postulante->getObservacion() ?></td>
    <?php endif; ?>
    </tr>
<?php endforeach; ?>
</table>
