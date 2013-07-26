<?php

class DocumentacionPlantilla extends BaseDocumentacionPlantilla
{
    public function __toString() {
        return $this->getLabel();
    }

    public function save(Doctrine_Connection $conn = null) {
        $taxonomy = Xhtml::taxonomy($this->getRedaction());
        $json_taxonomy = json_encode($taxonomy);
        $this->setTypes($json_taxonomy);

        parent::save($conn);
    }
}
