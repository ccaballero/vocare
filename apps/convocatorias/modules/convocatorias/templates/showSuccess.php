<h1><?php echo $object->getNombre() ?></h1>
<p style="font-size: 18px; margin-bottom: 10px;"><?php echo '(' . $object->getEstado() . ')' ?></p>

<div id="tabber">
    <ul>
    	<li class="tab"><a href="#preview">Vista Previa</a></li>
    	<li class="tab"><a href="#editor">Edición</a></li>
    </ul>
    <div class="tab_details">
        <a name="preview"></a>
        <div id="preview" class="tab_contents">
            <?php include_partial('convocatorias/preview', array('convocatoria' => $object)) ?>
        </div>
    	<div id="editor" class="tab_contents">
            <a name="editor"></a>
            <?php include_partial('convocatorias/editor', array('convocatoria' => $object, 'form' => $form)) ?>
        </div>
    </div>
</div>
