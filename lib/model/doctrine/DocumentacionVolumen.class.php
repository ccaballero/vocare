<?php

class DocumentacionVolumen extends BaseDocumentacionVolumen
{
    public function __toString() {
        return $this->getLabel();
    }

    public function getTpl() {
        $plantilla = $this->getDocumentacionPlantilla();
        $taxonomy = Xhtml::taxonomy($plantilla->getRedaction());
        $json_taxonomy = json_encode($taxonomy);

        // transform the taxonomy in a concrete structure
        $search = array('{', '}');
        $replace = array('[{', '}]');

        $transform = str_replace($search, $replace, $json_taxonomy);
        $transform = substr($transform, 1);
        $transform = substr($transform, 0, -1);

        return $transform;
    }
    
    public function getPreview() {
        $previews = array();
        $redaction = $this->getRedaction();
        $common = json_decode($this->vars);

        foreach ($this->getDocuments() as $document) {
            $obj = json_decode($document->getVars());
            $vars = Meld::join($common, $obj);
            $previews[] = Xhtml::render($redaction, $vars, true);
        }

        return $previews;
    }

    public function getRedaction() {
        return $this->getDocumentacionPlantilla()->redaction;
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
