<?php

class Postulante extends BasePostulante
{
    public function getFullName() {
        return implode(' ', array(
            $this->getApellidoPaterno(),
            $this->getApellidoMaterno(),
            $this->getNombres(),
        ));
    }
}
