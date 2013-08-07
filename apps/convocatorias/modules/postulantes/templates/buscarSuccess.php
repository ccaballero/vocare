
<div class="marco">
    <?php if ($postulante[0]->getNombre()==null){?>
        <h6 class="text-center">Usted aun no a Postulado a esta Convocatoria</h6>
        <br>
        <br>
        <h6 class="text-center"><a href=" <?php echo url_for('postulaciones/new?convocatoria=' . $convocatoria_id) ?>">postular</a></h6>
    <?php }else {?>
    <h3 class="text-center">Estado de Postulacion Actual</h3>
    <br>
    <table class="even">
    <tr class="header">
        <th>Nombre Completo</th>
        <th>Estado</th>
        <th>Observacion</th>
    </tr>
    <tr>
        <td><?php echo $postulante[0]->getNombre()." ".$postulante[0]->getApellidoPaterno()." ".$postulante[0]->getApellidoMaterno()?></td>
        <td><?php echo $postulante[0]->getEstado()?></td>
        <td><?php echo $postulante[0]->getObservacion()?></td>
    </tr>
    </table>
    <br>
    <h6 class="text-center">
    <a href=" <?php echo url_for('postulaciones/index=') ?>">Inicio</a>
    </h6>
    <?php }?>
</div>
