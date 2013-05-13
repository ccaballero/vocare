<?php

class cargosActions extends PlantillasDefault
{
    public $_table = 'cargo';
    public $_form = 'CargoForm';
    public $_route_list = 'cargos';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar cargo',
            'edit' => 'Editar cargo',
        ),
        'flash' => array(
            'new' => 'Cargo agregado exitosamente',
            'edit' => 'Cargo editado exitosamente',
            'delete' => 'Cargo eliminado exitosamente',
        ),
    );
}
