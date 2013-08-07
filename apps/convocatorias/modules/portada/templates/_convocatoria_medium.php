<div class="convocatoria">
    <div class="title"><?php echo link_to($convocatoria->getTitle(),
        'convocatorias_show', $convocatoria) ?>
    </div>
    <div id="preview" class="redaction">
        <?php include_partial('convocatorias/preview', array(
                'object' => $convocatoria,
                'preview' => Xhtml::render(
                    $convocatoria->lastEnmienda(), $convocatoria, false
                )
        )) ?>
    </div>
    <div class="information">
        <?php include_partial('convocatorias/tasks', array(
                'object' => $convocatoria,
                'preview' => true,
                'flags' => array(true, true, false, true),
            )) ?>
        <p><label>Gestión:</label><?php echo $convocatoria->getGestion() ?></p>
        <p><label>Estado:</label><?php echo ucfirst($convocatoria->getEstado()) ?></p>
        <p><label>Publicación:</label><?php echo $convocatoria->getPublicacion() ?></p>
    <?php if ($convocatoria->esVigente()): ?>
        <div class="buttons">
            <ul>
                <li>
                    <a href="<?php echo url_for(
                        'convocatorias_show', array(
                            'id' => $convocatoria->getId()
                        )) ?>#postulant">Postularse ahora!!</a>
                </li>
            </ul>
        </div>
    <?php endif; ?>
    </div>
    <div class="clear"></div>
</div>
