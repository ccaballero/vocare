<ul class="pestañas">
    <li class="active" style=""><a href="#pendiente">Pendientes</a></li>
    <li><a href="#inscrito">Recibidos</a></li>
    <li><a href="#habilitado">Habilitados</a></li>
    <li><a href="#inhabilitado">Inhabilitados</a></li>
    <li><a href="#reportes">Reportes</a></li>
</ul>

<div class="el_contenedor">
    <div id="pendiente" class="el_contenido" style="display: block;">
        <?php include_partial('postulaciones/list',array('lista' => $listaP,'estado'=>'Pendiente')) ?>
    </div>
    <div id="inscrito" class="el_contenido" style="display: none;">
        <?php include_partial('postulaciones/list',array('lista' => $listaR,'estado'=>'Inscrito')) ?>
    </div>
    <div id="habilitado" class="el_contenido" style="display: none;">
        <?php include_partial('postulaciones/list',array('lista' => $listaH,'estado'=>'Habilitado')) ?>
    </div>
    <div id="inhabilitado" class="el_contenido" style="display: none;">
        <?php include_partial('postulaciones/list',array('lista' => $listaI,'estado'=>'Inhabilitado')) ?>
    </div>
    <div id="reportes" class="el_contenido" style="display: none;">
        <?php //include_partial('postulaciones/',array('lista' => $listaI,'estado'=>'Inhabilitado')) ?>
        <ul>
            <h4>Reporte por Items</h4>
            <?php foreach ($requerimientos as $_requerimietos):?>
                <li><a href="<?php echo url_for('postulaciones/pdfItems?convocatoria=' . $convocatoria.'&requerimiento='.$_requerimietos->getID()) ?>"><?php echo $_requerimietos->getNombre()?></a></li>
            <?php endforeach;?>
            <h4>Reporte por Estado</h4>
            <li><a href="<?php echo url_for('postulaciones/pdfEstado?convocatoria=' . $convocatoria.'&estado=Pendiente') ?>">Pendientes</a> </li>
            <li><a href="<?php echo url_for('postulaciones/pdfEstado?convocatoria=' . $convocatoria.'&estado=Inscrito') ?>">Inscritos</a> </li>
            <li><a href="<?php echo url_for('postulaciones/pdfEstado?convocatoria=' . $convocatoria.'&estado=Habilitado') ?>">Habilitados</a> </li>
            <li><a href="<?php echo url_for('postulaciones/pdfEstado?convocatoria=' . $convocatoria.'&estado=Inhabilitado') ?>">Inhabilitados</a> </li>
            <h4>Reporte General</h4>
            <li><a href="<?php echo url_for('postulaciones/pdfGeneral?convocatoria=' . $convocatoria) ?>">Reporte General</a> </li>
        </ul>
    </div>
</div>
<?php if($sf_user->hasCredential('postulantes_list')){ ?>
        <form class="right" action="buscador.php" method="post">
            <br>
            Buscar Postulante <input type="text" id="postulante" name="postulante">
            <input type="submit" id="buscar" value="Buscar">
            <br>
            <br>
        </form>
        <?php //include_partial('postulaciones/buscador') ?>
<?php }?>
