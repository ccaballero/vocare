<h1><?php echo $object->getNombre() . ' (' . ucfirst($object->getEstado()) . ')' ?></h1>

<div id="tabber">
    <ul>
    	<li class="tab"><a class="active" href="#preview">Vista Previa</a></li>
    	<li class="tab"><a href="#editor">Edición</a></li>
    </ul>
    <div class="tab_details">
        <div id="preview" class="tab_contents">
            <?php include_partial('convocatorias/preview', array('convocatoria' => $object)) ?>
        </div>
    	<div id="editor" class="tab_contents">
            <?php include_partial('convocatorias/editor', array('convocatoria' => $object, 'form' => $form)) ?>
        </div>
    </div>
</div>
