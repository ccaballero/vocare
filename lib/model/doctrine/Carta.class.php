<?php

class Carta extends BaseCarta
{
    public function getTaxonomy() {
        $tpl = new myTemplate();

        $redaction = $this->getRedaccion();
        if (!empty($redaction)) {
            $tpl->setTemplate($redaction);
            return $tpl->getTaxonomy();
        }

        return array();
    }
}
