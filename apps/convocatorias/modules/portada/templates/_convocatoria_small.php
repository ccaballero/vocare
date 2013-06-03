<h3>
    <?php echo link_to(
        $convocatoria->getTitle(), 'convocatorias_show', $convocatoria) ?>
</h3>
<dl>
    <dt>Gestión:</dt>
    <dd><?php echo $convocatoria->getGestion() ?></dd>
    <dt>Estado:</dt>
    <dd><?php echo ucfirst($convocatoria->getEstado()) ?></dd>
    <dt>Publicación:</dt>
    <dd><?php echo $convocatoria->getPublicacion() ?></dd>
</dl>
