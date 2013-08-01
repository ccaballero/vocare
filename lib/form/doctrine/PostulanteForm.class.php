<?php

/**
 * Postulante form.
 *
 * @package    .
 * @subpackage form
 * @author     LOV
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PostulanteForm extends BasePostulanteForm {

    public function configure() {
        unset(
                $this['fecha_entrega'], $this['created_at'], $this['updated_at']
        );

        /*
         * El resultado de getRequerimeintos es un Doctrine_Collection el cual funciona de forma
         * similar a un array, lo cual no es tan optimo al manejar los id's de los requerimeintos 
         * por ello es q se hace el for para reaccicnar los objetos del doctrine_collecion a un 
         * array, pero los elementos de estes array se le asignan apartir del 1 y no del 0 ya no no hya id's 0 
         * lo mismo sucede con requisitos y documentos
         */

        $requerimiento = Doctrine::getTable('ConvocatoriaRequerimiento')->getRequerimientos();
        $requerimientos = array();
        for ($i = 0; $i < count($requerimiento); $i++) {
            $requerimientos[$i + 1] = $requerimiento[$i];
        }

        $requisito = Doctrine::getTable('ConvocatoriaRequisito')->getRequisitos();
        $requisitos = array();
        for ($i = 0; $i < count($requisito); $i++) {
            $requisitos[$i + 1] = $requisito[$i];
        }

        $documento = Doctrine::getTable('ConvocatoriaDocumento')->getDocumentos();
        $documentos = array();
        for ($i = 0; $i < count($documento); $i++) {
            $documentos[$i + 1] = $documento[$i];
        }

        $this->widgetSchema['requerimiento_list'] = new sfWidgetFormChoice(array('choices' => $requerimientos, 'multiple' => true, 'expanded' => true,));
        $this->widgetSchema['requisito_list'] = new sfWidgetFormChoice(array('choices' => $requisitos, 'multiple' => true, 'expanded' => true,));
        $this->widgetSchema['documento_list'] = new sfWidgetFormChoice(array('choices' => $documentos, 'multiple' => true, 'expanded' => true,));

        $this->widgetSchema->setLabels(array(
            'nombre' => '<h6>Nombre:',
            'apellido_paterno' => '<h6>Apellido Paterno:',
            'apellido_materno' => '<h6>Apellido Materno:',
            'ci' => '<h6>Nro de carnet de Identidad:',
            'cod_sis' => '<h6>Codigo Sis:',
            'email' => '<h6>Email:',
            'telefono' => '<h6>Telefono:',
            'direccion' => '<h6>Direccion:',
            'numero_hojas' => '<h6>Numero de hojas:',
            'estado' => '<h6>Estado:',
            'requerimiento_list' => '<h6>Items a Postular:',
            'documento_list' => '<h6>Documentos:',
            'requisito_list' => '<h6>Requisitos:',
            'observacion' => '<h6>Observacion</h6>',
        ));
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['convocatoria_id'] = new sfWidgetFormInputHidden();

        

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $decorator);
        $this->widgetSchema->setFormFormatterName('custom');
    }

}

