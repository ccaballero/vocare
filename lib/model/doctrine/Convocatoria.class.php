<?php

class Convocatoria extends BaseConvocatoria
{
    public function __toString() {
        return '[' . $this->getId() . '] ' . $this->getNombre();
    }
}
