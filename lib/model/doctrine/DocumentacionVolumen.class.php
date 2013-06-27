<?php

class DocumentacionVolumen extends BaseDocumentacionVolumen
{
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
}
