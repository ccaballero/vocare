<?php

class documentacionActions extends PlantillasDefault
{
    public $_table = 'DocumentacionVolumen';
    public $_form = 'DocumentacionVolumenForm';
    public $_route_list = 'documentacion';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar volumen de documentación',
            'edit' => 'Editar propiedades del volumen',
        ),
        'flash' => array(
            'new' => 'Volumen agregado exitosamente',
            'edit' => 'Volumen editado exitosamente',
            'delete' => 'Volumen eliminado exitosamente',
        ),
    );

    public function executeShow(\sfWebRequest $request) {
        $volumen = $this->getRoute()->getObject();
        $this->forward404Unless($volumen);

        $this->object = $volumen;
        $this->docs = $volumen->getDocumentaciones();
        $this->previews = $volumen->renderXHTML();
    }

    public function executeEditar(sfWebRequest $request) {
        $volumen = $this->getRoute()->getObject();

        $holder = $request->getParameterHolder();
        $all = $holder->getAll();

        $model = new Documentacion();

        foreach ($all as $key => $element) {
            list($type, $code) = explode('_', $key);
            switch ($type) {
                case 'volumen':
                    $volumen->setNombre($request->getParameter($key));
                    break;
                case 'common':
                    $json = $request->getParameter($key);
                    unset($json['_doc']);
                    $common = json_encode($json);
                    $volumen->setVars($common);
                    break;
                case 'edit':
                    $json = $request->getParameter($key);
                    $id = $json['_doc'];
                    unset($json['_doc']);

                    $documentation = $model->getByIdAndVolumen(
                        $id, $volumen->getId());

                    $doc = json_encode($json);
                    $documentation->setVars($doc);
                    $documentation->save();
                    break;
                case 'new':
                    $json = $request->getParameter($key);
                    $id = $json['_doc'];
                    unset($json['_doc']);

                    $documentation = new Documentacion();
                    $documentation->plantilla_id = $volumen->plantilla_id;
                    $documentation->volumen_id = $volumen->id;
                    $documentation->vars = json_encode($json);
                    $documentation->save();

                    break;
            }
        }

        $volumen->save();

        $this->getUser()->setFlash('success',
            'La información de documentación ha sido registrada');
        $this->redirect($this->generateUrl('documentacion_show', array(
            'id' => $volumen->getId())));
    }
}
