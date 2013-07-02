<?php

class DocumentacionPlantilla extends BaseDocumentacionPlantilla
{
    public function __toString() {
        return $this->getNombre();
    }

    public function save(Doctrine_Connection $conn = null) {
        $tpl = new myTemplate();
        $tpl->setTemplate($this->getRedaccion());

        $taxonomy = $tpl->getTaxonomy();
        $json_taxonomy = json_encode($taxonomy);
        $this->setTypes($json_taxonomy);

        parent::save();
    }

    public function getTaxonomy() {
        $tpl = new myTemplate();

        $redaction = $this->getRedaccion();
        if (!empty($redaction)) {
            $tpl->setTemplate($redaction);

            return $tpl->getTaxonomy();
        }

        return array();
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
