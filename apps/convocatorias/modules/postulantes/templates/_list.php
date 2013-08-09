<table>
    <tr class="header">
        <th>#</th>
        <th>Nombre Completo</th>
        <th>Correo Electrónico</th>
    <?php foreach ($requerimientos as $requerimiento): ?>
        <th><?php echo $requerimiento->getNumeroItem() ?></th>
    <?php endforeach; ?>
    </tr>
    <?php foreach ($postulantes as $key => $postulante): ?>
        <tr>
            <td class="text-right"><?php echo $key + 1 ?></td>
            <td><?php echo $postulante->getFullname() ?></td>
            <td><?php echo $postulante->getCorreoElectronico() ?></td>
            <td></td>
        </tr>
    <?php endforeach; ?>
</table>
