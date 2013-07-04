<p>
    <label>Nombre del volumen:</label>
    <input type="text" name="volumen" value="<?php echo $object->getNombre() ?>" />
</p>

<script type="text/javascript" src="/js/boxes.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var root=new Box(<?php echo $sf_data->getRaw('tpl') ?>)
        root.show()
    })
</script>

<div id="box"></div>
