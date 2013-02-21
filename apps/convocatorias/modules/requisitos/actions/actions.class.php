<?php

class requisitosActions extends PlantillasDefault
{
    public $_table = 'requisito';
    public $_form = 'RequisitoForm';
    public $_route_list = 'requisitos';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar requisito',
            'edit' => 'Editar requisito',
        ),
        'flash' => array(
            'new' => 'Requisito agregado exitosamente',
            'edit' => 'Requisito editado exitosamente',
            'delete' => 'Requisito eliminado exitosamente',
        ),
    );
}
