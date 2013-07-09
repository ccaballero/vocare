<p>
    <label>Nombre del volumen:</label>
    <input type="text" name="volumen" value="<?php echo $object->getNombre() ?>" />
</p>

<div id="redaction">
    <div class="tree">
        <h1>Documentos</h1>
        <ul></ul>
        <p style="text-align: right; padding-top: 10px;">
            <a href="">Agregar documento</a>
        </p>
    </div>
    <div id="box"></div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var h=$('.tree').css('height')
        $('#box').css('min-height',
            parseInt(h.substring(0, h.length-2)) + 30);

        BoxManager.add('Plantilla general',
            <?php include_partial('scape', array(
                'object' => $object->getTpl()
            )) ?>)
        BoxManager.add('Globales',
            <?php include_partial('scape', array(
                'object' => $object->getVars()
            )) ?>)

    <?php foreach ($docs as $i => $doc): ?>
        BoxManager.add('Documento '+<?php echo $i ?>,
            <?php include_partial('scape', array(
                'object' => $doc->getVars()
            )) ?>)
    <?php endforeach; ?>

        BoxManager.render('#box',0)
        BoxManager.render_menu('.tree ul', '#box')
        Behaviors.set()
    })
</script>
