<p>
    <label>Nombre del volumen:</label>
    <input type="text"
           name="volumen"
           value="<?php echo $object->getNombre() ?>" />
</p>

<div id="redaction">
    <div class="tree">
        <h1>Documentos</h1>
        <ul></ul>
        <p style="text-align: right; padding-top: 10px;">
            <a onclick="return BoxManager.addDoc('Documento ')">[agregar]</a>
        </p>
    </div>
    <div id="box"></div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var h=$('.tree').css('height')
        $('#box').css('min-height',
            parseInt(h.substring(0, h.length-2)) + 30)

        BoxManager.selector='#box'
        BoxManager.selectorMenu='.tree ul'
        BoxManager.create('Plantilla general',
            <?php include_partial('scape', array(
                'object' => $object->getTpl()
            )) ?>,false)
        BoxManager.create('Globales',
            <?php include_partial('scape', array(
                'object' => $object->getVars()
            )) ?>,false)

    <?php foreach ($docs as $i => $doc): ?>
        BoxManager.create('Documento '+<?php echo $i ?>,
            <?php include_partial('scape', array(
                'object' => $doc->getVars()
            )) ?>,true)
    <?php endforeach; ?>

        BoxManager.render(0)
        BoxManager.menu()
    })
</script>
