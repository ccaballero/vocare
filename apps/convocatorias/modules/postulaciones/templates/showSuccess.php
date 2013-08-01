<div class="marco">
<h1 class="text-center">Datos del Postulante <h1>
<h3>Nombre del Postulante:</h3>
<?php echo $postulante->getNombre()." ".$postulante->getApellidoPaterno()." ".$postulante->getApellidoMaterno() ?>
<h3>Items a los que postula:</h3>

 <?php foreach ($id_requerimientos as $requerimientos): ?>
<li class="even">
        <?php echo $requerimientos->getNombre(); ?>
</li>
    <?php endforeach; ?>

<h3>Numero de hojas a presentar:</h3>
<?php echo $postulante->getNumeroHojas() ?>
<h3>Estado de Postulacion:</h3>
<?php echo $postulante->getEstado() ?>

<table>
    <tr class="even">
        <td class ="text-center">
            <a id ="show" href=" <?php echo url_for('postulaciones/index=')?>">Inicio</a> 
        </td>
    </tr>
 </table>
</div>