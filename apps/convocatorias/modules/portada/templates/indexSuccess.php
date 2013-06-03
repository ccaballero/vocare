<div style="max-width: 660px; float: left;">
    <h1>Sistema para la administración de convocatorias</h1>
    <p>Bienvenido al sistema para el seguimiento de convocatorias en las
    carreras de informática y sistemas.</p>
    <h2>¿Que puedes hacer?</h2>
    <dl>
        <dt><strong>Como postulante</strong></dt>
        <dd>
            <p>Puedes pedir una cuenta en la secretaria de la carrera de
            informática y sistemas, de modo que puedas realizar seguimiento de
            todo el proceso de convocatoria a la que fuiste asignado.</p>
            <p>Si ya participaste de una convocatoria anterior, puedes ir a la
            secretaria de la carrera de informática y sistemas, y pedir la
            asignación de tu cuenta a una nueva convocatoria.</p>
            <p>Según la etapa en la que se encuentra la convocatoria, tu puedes
            ir viendo un conjunto de opciones, que fueron construidas para
            facilitar el proceso para todos los postulantes.</p>
        </dd>
        <dt><strong>Como parte de una comisión</strong></dt>
        <dd>
            <p>Si formas parte de una comision, la cuenta que te ha sido
            asignada, servirá para facilitar los procesos en los cuales se
            requiere información fiable, completa, veráz, y al dia.</p>
            <p>Si perteneces a la comisión de meritos, podrás ir marcando las
            condicionales requeridas segun las especificaciones de la
            convocatoria, ademas de ver e imprimir reportes de este proceso en
            multiples formatos.</p>
            <p>Si perteneces a una comisión de evaluación de conocimientos,
            puedes subir las calificaciones de los postulantes, ademas de
            generar tales reportes en multiples formatos.</p>
        </dd>
        <dt><strong>Como parte del departamento de informática y
            sistemas</strong></dt>
        <dd>
            <p>Si eres parte del departamento de informática y sistemas, puedes
            administrar un gran conjunto de configuraciones sobre las
            convocatorias.</p>
            <p>Es tambien atribución de este rol, el manejo de usuarios, y la
            gestión de permisos.</p>
        </dd>
    </dl>
</div>
<div class="right widget">
    <h2>Convocatorias vigentes</h2>
    <?php if (count($vigentes) == 0): ?>
        <p>No existe ninguna convocatoria vigente.</p>
    <?php else: ?>
        <?php foreach ($vigentes as $convocatoria): ?>
            <?php include_partial('convocatoria_small', array(
                'convocatoria' => $convocatoria,
            )) ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <h2>Convocatorias finalizadas</h2>
    <?php if (count($finalizadas) == 0): ?>
        <p>No existe ninguna convocatoria finalizada.</p>
    <?php else: ?>
        <?php foreach ($finalizadas as $convocatoria): ?>
            <?php include_partial('convocatoria_small', array(
                'convocatoria' => $convocatoria,
            )) ?>
        <?php endforeach; ?>
        <p><?php echo link_to(__('View all'), 'portada/convocatorias') ?></p>
    <?php endif; ?>
</div>
