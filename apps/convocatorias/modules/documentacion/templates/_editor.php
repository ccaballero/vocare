<p>
    <label>Nombre del volumen:</label>
    <input type="text"
           name="volumen_"
           value="<?php echo $object->getNombre() ?>" />
    <input type="hidden"
           name="delete_docs"
           value="" />
</p>

<div id="redaction">
    <div class="tree">
        <h1>Documentos</h1>
        <ul></ul>
        <p class="right">
            <a onclick="return BoxManager.addDoc('Nuevo documento')">
                [agregar]
            </a>
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

        BoxManager.create('','tpl','Plantilla general',
            <?php include_partial('scape', array(
                'object' => $object->getTpl()
            )) ?>,false)
        BoxManager.create('','common','Globales',
            <?php include_partial('scape', array(
                'object' => $object->getVars()
            )) ?>,false)

    <?php foreach ($docs as $i => $doc): ?>
        BoxManager.create(<?php echo $doc->getId() ?>,
            'edit','Documento '+<?php echo $i ?>,
            <?php include_partial('scape', array(
                'object' => $doc->getVars()
            )) ?>,true)
    <?php endforeach; ?>

        BoxManager.render(0)
        BoxManager.menu()
    })
</script>
