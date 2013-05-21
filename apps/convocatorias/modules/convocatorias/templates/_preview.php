<div class="buttons">
    <ul>
        <li>
            <?php echo link_to(
                image_tag('/img/page_white.png'),
                'convocatorias_texto',
                $object, array('target' => '_blank')) ?>
        </li>
        <li>
            <?php echo link_to(
                image_tag('/img/page_white_acrobat.png'),
                'convocatorias_pdf',
                $object, array('target' => '_blank')) ?>
        </li>
    </ul>
</div>
<div class="clear"></div>
<?php if ($preview <> null): ?>
    <?php echo $sf_data->getRaw('preview') ?>
<?php else: ?>
    <p>No se definió aún una redacción del texto para este borrador de
    convocatoria.</p>
<?php endif; ?>
