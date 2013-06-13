<?php

class cartasActions extends PlantillasDefault
{
    public $_table = 'carta';
    public $_form = 'CartaForm';
    public $_route_list = 'cartas';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar documento',
            'edit' => 'Editar documento',
        ),
        'flash' => array(
            'new' => 'Documento agregada exitosamente',
            'edit' => 'Documento editada exitosamente',
            'delete' => 'Documento eliminada exitosamente',
        ),
    );
}
