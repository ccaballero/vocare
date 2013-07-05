<p>
    <label>Nombre del volumen:</label>
    <input type="text" name="volumen" value="<?php echo $object->getNombre() ?>" />
</p>

<script type="text/javascript" src="/js/boxes.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var empty_tpl=new Box(<?php echo $sf_data->getRaw('tpl') ?>)
        empty_tpl.printTpl()
    })
</script>

<div id="tpl"></div>
<div id="box"></div>
