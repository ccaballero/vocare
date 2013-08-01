<h1>Convocatorias Vigentes</h1>
<table>
    <tr class ="header ">
        <th>Convocatoria</th>
        <th>Fecha de publicacion</th>
        <th>Fecha ultima de presentacion</th> 
        <th>Accion</th>
        <?php if (!($sf_user->hasCredential('documentacion_list'))) { ?>
            <th>Estado de Postulacion</th>
        <?php } else { ?>
            <th>Reporte Final</th>
        <?php } ?>
    </tr>
    <?php foreach ($convocatorias as $i => $convocatoria): ?>
        <tr class="even">
            <td class ="text-left">
                <?php
                echo $convocatoria->getGestion();
                $auxPu = true;
                $auxPre = true;
                ?>
            </td>
            <td class ="text-center">
                <?php
                while ($auxPu) {
                    echo $fechaPuEvento[$i]->getFecha($i);
                    $auxPu = false;
                }
                ?>
            </td>
            <td class ="text-center">
                <?php
                while ($auxPre) {
                    echo $fechaPreEvento[$i]->getFecha($i);
                    $auxPre = false;
                }
                ?>
            </td>
            <?php if (!($sf_user->hasCredential('documentacion_list'))) { ?>
                <td class ="text-center">
                    <a href=" <?php echo url_for('postulaciones/new?convocatoria=' . $convocatoria->getId()) ?>">postular</a>
                </td>
                <td class ="text-center">
                    <a href=" <?php echo url_for('postulaciones/buscar?convocatoria=' . $convocatoria->getId()) ?>">Revisar</a>
                </td>
            <?php } else { ?>

                <td class ="text-center">
                    <a href=" <?php echo url_for('postulaciones/list?convocatoria=' . $convocatoria->getId()) ?>">ver Postulantes</a>
                </td>
                <td class ="text-center">
                    <a href=" <?php echo url_for('postulaciones/pdf?convocatoria=' . $convocatoria->getId()) ?>">Generar</a>
                </td>
            <?php } ?>
        </tr>
    <?php endforeach; ?>
</table>



