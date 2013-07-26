<?php

class documentacionActions extends PlantillasDefault {

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

        $previews = array();
        $redaccion = $volumen->getRedaccion();
        $common = json_decode($volumen->vars);

        foreach ($volumen->getDocumentaciones() as $doc) {
            $obj = json_decode($doc->getVars());
            $vars = Meld::join($common, $obj);
            $previews[] = Xhtml::render($redaccion, $vars, true);
        }

        $this->object = $volumen;
        $this->docs = $volumen->getDocumentaciones();
        $this->previews = $previews;
    }

    public function executeEditar(sfWebRequest $request) {
        $volumen = $this->getRoute()->getObject();

        $docs = array();
        $_docs = $volumen->getDocumentaciones();
        foreach ($_docs as $_doc) {
            $docs[$_doc->getId()] = $_doc;
        }

        $holder = $request->getParameterHolder();
        $all = $holder->getAll();
        foreach ($all as $key => $element) {
            if (preg_match('/.+_.*/', $key)) {
                list($type, $code) = explode('_', $key);

                $param = $element;
                if (is_array($param) && isset($param['_doc'])) {
                    $id = intval($param['_doc']);
                    unset($param['_doc']);
                }
                switch ($type) {
                    case 'volumen':
                        $volumen->setNombre($param);
                        break;
                    case 'common':
                        $volumen->setVars(JsonTransform::transform($param));
                        break;
                    case 'edit':
                        $doc = $docs[$id];
                        $doc->setVars(JsonTransform::transform($param));
                        $doc->save();
                        break;
                    case 'new':
                        $documentation = new Documentacion();
                        $documentation->plantilla_id = $volumen->plantilla_id;
                        $documentation->volumen_id = $volumen->id;
                        $documentation->vars = JsonTransform::transform($param);
                        $documentation->save();
                        break;
                    case 'delete':
                        if (!empty($param)) {
                            $ids = explode('|', $param);
                            foreach ($ids as $id) {
                                $doc = $docs[$id];
                                $doc->delete();
                            }
                        }
                        break;
                }
            }
        }

        $volumen->save();

        $this->getUser()->setFlash('success', 'La información de documentación ha sido registrada');
        $this->redirect($this->generateUrl('documentacion_show', array(
                    'id' => $volumen->getId())));
    }

    public function executeTexto() {
        $volumen = $this->getRoute()->getObject();
//        return $this->sendContent(
//            Xslt::render(
//                'transform-txt',
//                Xhtml::render($text, $vars, $scape)
//                $convocatoria->getXmlMaxEnmienda()
//            )
//        );
    }
}
