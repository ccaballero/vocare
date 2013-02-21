<?php

class requerimientosActions extends PlantillasDefault
{
    public $_table = 'requerimiento';
    public $_form = 'RequerimientoForm';
    public $_route_list = 'requerimientos';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar requerimiento',
            'edit' => 'Editar requerimiento',
        ),
        'flash' => array(
            'new' => 'Requerimiento agregado exitosamente',
            'edit' => 'Requerimiento editado exitosamente',
            'delete' => 'Requerimiento eliminado exitosamente',
        ),
    );
}
