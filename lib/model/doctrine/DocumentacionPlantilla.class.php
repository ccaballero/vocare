<?php

class DocumentacionPlantilla extends BaseDocumentacionPlantilla
{
    public function getTaxonomy() {
        $tpl = new myTemplate();

        $redaction = $this->getRedaccion();
        if (!empty($redaction)) {
            $tpl->setTemplate($redaction);

            $taxonomy = $tpl->getTaxonomy();
            $types = $this->getTypes();

            return $this->fillTypes($taxonomy, json_decode($types));
        }

        return array();
    }

    private function fillTypes($taxonomy, $types) {
        foreach ($taxonomy as $attribute => $value) {
            if (is_object($value)) {
                if (isset($types->$attribute)) {
                    $taxonomy->$attribute = $this->fillTypes(
                        $taxonomy->$attribute, $types->$attribute);
                } else {
                    $taxonomy->$attribute = $this->fillTypes(
                        $taxonomy->$attribute, new stdClass());
                }
            } else {
                if (isset($types->$attribute)) {
                    $taxonomy->$attribute = $types->$attribute;
                } else {
                    $taxonomy->$attribute = 'string';
                }
            }
        }

        return $taxonomy;
    }
}
