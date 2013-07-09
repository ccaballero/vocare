<?php

class DocumentacionVolumen extends BaseDocumentacionVolumen
{
    public function __toString() {
        return $this->getNombre();
    }

    public function getTpl() {
        $plantilla = $this->getDocumentacionPlantilla();

        $tpl = new myTemplate();
        $tpl->setTemplate($plantilla->getRedaccion());

        $taxonomy = $tpl->getTaxonomy();
        $json_taxonomy = json_encode($taxonomy);

        // transform the taxonomy in a concrete structure
        $search = array('{', '}');
        $replace = array('[{', '}]');
        $transform = str_replace($search, $replace, $json_taxonomy);

        $transform = substr($transform, 1);
        $transform = substr($transform, 0, -1);

        return $transform;
    }

    public function renderXHTML() {
        $redaccion = $this->getDocumentacionPlantilla()->redaccion;
        $documentos = $this->getDocumentaciones();

        $compile = array();
        $vars = json_decode($this->vars);

        $tpl = new myTemplate();
        if (!empty($redaccion)) {
            $tpl->setTemplate($redaccion);

            foreach ($documentos as $documento) {
                $json = $documento->getVars();
                $obj = json_decode($json);

                $merge = (object)array_merge((array)$vars, (array)$obj);

                $tpl->setObject($merge);
                $compile[] = $tpl->render();
            }
        }

        return $compile;
    }

    public function getObjectVars() {
        return json_decode($this->getVars());
    }
    
    public function getVars() {
        $vars = $this->_get('vars');
        if (empty($vars)) {
            $vars = $this->getTpl();
        }
        return $vars;
    }
}
