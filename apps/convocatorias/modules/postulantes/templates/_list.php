<h1>Lista de postulantes</h1>
<table>
    <tr class="header">
        <th>#</th>
        <th>Nombre Completo</th>
        <th>Correo Electrónico</th>
    <?php foreach ($requerimientos as $requerimiento): ?>
        <th><?php echo $requerimiento->getNumeroItem() ?></th>
    <?php endforeach; ?>
        <th>Estado</th>
        <th>Operaciones</th>
    </tr>
    <?php foreach ($postulantes as $key => $postulante): ?>
        <tr class="<?php echo fmod($key, 2) ? 'even' : 'odd' ?>">
            <td class="text-right"><?php echo $key + 1 ?></td>
            <td><?php echo $postulante->getFullname() ?></td>
            <td><?php echo $postulante->getCorreoElectronico() ?></td>
        <?php foreach ($requerimientos as $requerimiento): ?>
            <td class="text-center">
                <?php echo $postulante->isPostulant($requerimiento) ? 'x':'' ?>
            </td>
        <?php endforeach; ?>
            <td class="text-center"><?php echo $postulante->getEstado() ?></td>
            <td class="text-center">
                <ul>
                    <li>[<?php echo link_to('Editar',
                        url_for('postulantes_edit',
                            array(
                                'convocatoria' => $convocatoria->getId(),
                                'id' => $postulante->getId(),
                            ))) ?>]</li>
                    <li>[<?php echo link_to('Recepción',
                        url_for('postulantes_reception',
                            array(
                                'convocatoria' => $convocatoria->getId(),
                                'id' => $postulante->getId(),
                            ))) ?>]</li>
                    <li>[<?php echo link_to('Habilitación',
                        url_for('postulantes_habilitation',
                            array(
                                'convocatoria' => $convocatoria->getId(),
                                'id' => $postulante->getId(),
                            ))) ?>]</li>
                </ul>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
