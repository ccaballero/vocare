<h3>Lista de Postulantes <?php echo $estado ?>s</h3>
<table>
    <tr class="header">
        <th class="text-left">Nro:</th>
        <th class="text-left" >Nombre Completo:</th>
        <th class="text-left">Estado</th>
        <?php if($estado == 'Inhabilitado' || $estado == 'Habilitado' ){?>
        <th class="text-left">Observacion</th>
        <?php }else { ?>
               <th>Accion</th> 
            <?php }?>
    </tr>
    <?php foreach ($lista as $key => $postulant): ?>
        <tr>
            <td><?php echo $key + 1 ?></td>
            <td><?php echo $postulant->getNombre() . " " . $postulant->getApellidoPaterno()." ".$postulant->getApellidoMaterno() ?></td>
            <td><?php echo $estado ?></td>
            <?php
            switch ($estado) {
                case 'Pendiente':
                    ?>
                    <td class = "text-center">
                        <a href = " <?php echo url_for('postulaciones/edit?id=' . $postulant->getId()) ?>">Editar</a>
                    </td>
                    <?php
                    break;
                case 'Inscrito':
                    ?>
                    <td class = "text-center">
                        <a href = " <?php echo url_for('postulaciones/edit?id=' . $postulant->getId()) ?>">Revisar Documentos</a>
                    </td>
                    <?php
                    break;
                case 'Inhabilitado':
                    ?>
                    <td class = "text-left">
                    <?php echo $postulant->getObservacion() ?>
                    </td>
                    <?php
                    break;
                case 'Habilitado':
                    ?>
                    <td class = "text-center">

                    </td>
                    <?php
                    break;
                default:
                    break;
            }
            ?>
            </tr>
<?php endforeach; ?>


</table>
