<?php

class DocumentacionVolumen extends BaseDocumentacionVolumen
{
    public function getNombre() {
        return 'Volumen #' . $this->getId();
    }
}
