<?php

class Documentacion extends BaseDocumentacion
{
    public function getObjectVars() {
        return json_decode($this->getVars());
    }    
}
