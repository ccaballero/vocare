<?php
if ($enHora) {
    if (!$yaPostulo) {
        ?>
        <?php include_partial('form', array('form' => $form,'gestion'=>$list[0]->getGestion())) ?>
    <?php } else { ?>
        <div class="marco">
            <table class="text-left">
                <tr class="even">  
                <h3 class="text-center"> No puede postular 2 veces a la misma convocatoria</h3>
                <br>
                <h6 class="text-center">Revise el Estado de su Postulacion</h6>
                <br>
                <td class ="text-center">
                    <a href=" <?php echo url_for('postulaciones/buscar?convocatoria=' . $idc) ?>">Revisar</a> 
                </td>
                </tr>
            </table>
        </div>
    <?php } ?>

<?php } else { ?>
<div class="marco">
    <table class="text-left">
        <tr class="even">  
        <h3 class="text-center"> El tiempo para la presentacion de formularios a terminado</h3>
        <br>
        <td class ="text-center">
            <a href=" <?php echo url_for('postulaciones/index=') ?>">Inicio</a> 
        </td>
    </tr>
    </table>
</div>
<?php } ?>
