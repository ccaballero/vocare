<div class="buttons">
    <ul>
    <?php if ($flags[0]): ?>
        <li>
            <?php echo link_to(
                image_tag('/img/eye.png'),
                'convocatorias_show',
                $object, array(
                    'target' => '_blank',
                    'alt' => 'Ver convocatoria completa',
                    'title' => 'Ver convocatoria completa',
                )) ?>
        </li>
    <?php endif; ?>
    <?php if ($flags[1]): ?>
        <li>
            <?php echo link_to(
                image_tag('/img/page_white_text.png'),
                'convocatorias_texto',
                $object, array(
                    'target' => '_blank',
                    'alt' => 'Generar documento TXT',
                    'title' => 'Generar documento TXT',
                )) ?>
        </li>
    <?php endif; ?>
    <?php if ($flags[2]): ?>
        <li>
            <?php echo link_to(
                image_tag('/img/page_code.png'),
                'convocatorias_latex',
                $object, array(
                    'target' => '_blank',
                    'alt' => 'Generar documento LATEX',
                    'title' => 'Generar documento LATEX',
                )) ?>
        </li>
    <?php endif; ?>
    <?php if ($flags[3]): ?>
        <li>
            <?php echo link_to(
                image_tag('/img/page_white_acrobat.png'),
                'convocatorias_pdf',
                $object, array(
                    'target' => '_blank',
                    'alt' => 'Generar documento PDF',
                    'title' => 'Generar documento PDF',
                )) ?>
        </li>
    <?php endif; ?>
    </ul>
</div>
<div class="clear"></div>
