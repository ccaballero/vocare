<?php

class DocumentacionPlantilla extends BaseDocumentacionPlantilla
{
    public function __toString() {
        return $this->getNombre();
    }

    public function save(Doctrine_Connection $conn = null) {
        $taxonomy = Xhtml::taxonomy($this->getRedaccion());
        $json_taxonomy = json_encode($taxonomy);
        $this->setTypes($json_taxonomy);

        parent::save();
    }

//    private function fillTypes($taxonomy, $types) {
//        foreach ($taxonomy as $attribute => $value) {
//            if (is_object($value)) {
//                if (isset($types->$attribute)) {
//                    $taxonomy->$attribute = $this->fillTypes(
//                        $taxonomy->$attribute, $types->$attribute);
//                } else {
//                    $taxonomy->$attribute = $this->fillTypes(
//                        $taxonomy->$attribute, new stdClass());
//                }
//            } else {
//                if (isset($types->$attribute)) {
//                    $taxonomy->$attribute = $types->$attribute;
//                } else {
//                    $taxonomy->$attribute = 'string';
//                }
//            }
//        }
//
//        return $taxonomy;
//    }
}
