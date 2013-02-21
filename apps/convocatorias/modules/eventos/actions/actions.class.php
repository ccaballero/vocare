<?php

class eventosActions extends PlantillasDefault
{
    public $_table = 'evento';
    public $_form = 'EventoForm';
    public $_route_list = 'eventos';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar evento',
            'edit' => 'Editar evento',
        ),
        'flash' => array(
            'new' => 'Evento agregado exitosamente',
            'edit' => 'Evento editado exitosamente',
            'delete' => 'Evento eliminado exitosamente',
        ),
    );
}
