<h1>Convocatorias</h1>

<dl>
<?php foreach ($convocatorias as $convocatoria): ?>
    <dt><a href=""><?php echo $convocatoria->getGestion() ?></a></dt>
    <dd>
        <dl>
            <dt>Estado:</dt>
            <dd><?php echo $convocatoria->getEstado() ?></dd>
            <dt>Fecha de Publicación:</dt>
            <dd><?php echo $convocatoria->getEstado() ?></dd>
        </dl>
    </dd>
<?php endforeach; ?>
</dl>
