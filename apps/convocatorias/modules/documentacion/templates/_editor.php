<p>
    <label>Nombre del volumen:</label>
    <input type="text" name="volumen" value="<?php echo $object->getNombre() ?>" />
</p>

<script type="text/javascript" src="/js/boxes.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        boxes=[]
        boxes.push(<?php include_partial('scape', array('object' => $object->getTpl())) ?>)
        boxes.push(<?php include_partial('scape', array('object' => $object->getVars())) ?>)

        str_boxes=''
        for(i=0;i<boxes.length;i++){
            box = new Box(boxes[i])
            str_boxes+='<hr/>'+box.render()
        }

        $('#box').append(str_boxes)
        Behaviors.set()
    })
</script>

<div id="box"></div>
