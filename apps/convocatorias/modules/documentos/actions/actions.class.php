<?php

class documentosActions extends PlantillasDefault
{
    public $_table = 'documento';
    public $_form = 'DocumentoForm';
    public $_route_list = 'documentos';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar documento requisito',
            'edit' => 'Editar documento requisito',
        ),
        'flash' => array(
            'new' => 'Documento requisito agregado exitosamente',
            'edit' => 'Documento requisito editado exitosamente',
            'delete' => 'Documento requisito eliminado exitosamente',
        ),
    );
}
