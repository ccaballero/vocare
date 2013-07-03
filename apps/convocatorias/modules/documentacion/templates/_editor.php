<p>
    <label>Nombre del volumen:</label>
    <input type="text" name="volumen" value="<?php echo $object->getNombre() ?>" />
</p>

<script type="text/javascript">
    var tpl = <?php echo $sf_data->getRaw('tpl') ?>;
</script>

<div class="box">
    <div class="title">
        <span class="text">#1</span>
        <div class="controls">
            <ul>
                <li><a class="shrink" href="">_</a></li>
                <li><a class="restore" href="">o</a></li>
                <li><a class="close" href="">x</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <p><label>i:</label><input type="text" /></p>
    </div>
</div>
<div class="box_controls">
    <ul>
        <li><a class="add" href="">+</a></li>
    </ul>
</div>
