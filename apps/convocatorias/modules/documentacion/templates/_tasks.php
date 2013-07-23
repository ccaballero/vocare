<?php if (count($sf_data->getRaw('previews')) <> 0): ?>
<div class="buttons">
    <ul>
        <li>
            <?php echo link_to(
                image_tag('/img/page_white_text.png'),
                'documentacion_texto',
                $object, array(
                    'target' => '_blank',
                    'alt' => 'Generar documento TXT',
                    'title' => 'Generar documento TXT',
                )) ?>
        </li>
        <li>
            <?php echo link_to(
                image_tag('/img/page_code.png'),
                'documentacion_latex',
                $object, array(
                    'target' => '_blank',
                    'alt' => 'Generar documento LATEX',
                    'title' => 'Generar documento LATEX',
                )) ?>
        </li>
        <li>
            <?php echo link_to(
                image_tag('/img/page_white_acrobat.png'),
                'documentacion_pdf',
                $object, array(
                    'target' => '_blank',
                    'alt' => 'Generar documento PDF',
                    'title' => 'Generar documento PDF',
                )) ?>
        </li>
    </ul>
</div>
<div class="clear"></div>
<?php endif; ?>
