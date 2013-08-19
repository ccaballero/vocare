<h1>Lista de postulantes</h1>
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
        <?php foreach ($requerimientos as $requerimiento): ?>
            <td class="text-center">
                <?php echo $postulante->isPostulant($requerimiento) ? 'x':'' ?>
            </td>
        <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
