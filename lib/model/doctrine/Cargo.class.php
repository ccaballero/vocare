<?php

class Cargo extends BaseCargo
{
    private $encargadoActual;
    private $emailEncargado;
    
    private function getMax() {
        $q1 = Doctrine_Query::create()
            ->select('MAX(ce.fecha)')
            ->from('CargoEncargado ce')
            ->where('ce.cargo_id = ?', $this->getId());

        $array1 = $q1->fetchArray();
        $max_date = $array1[0]['MAX'];

        $q2 = Doctrine_Core::getTable('CargoEncargado')
          ->createQuery('ce')
          ->where('ce.cargo_id = ?', $this->getId())
          ->andWhere('ce.fecha = ?', $max_date)
          ->orderBy('ce.id DESC');

        $array2 = $q2->fetchArray();
        
        $this->encargadoActual = $array2[0]['encargado'];
        $this->emailEncargado = $array2[0]['email'];
    }
    
    public function getEncargadoActual() {
        if (empty($this->encargadoActual)) {
            $this->getMax();
        }
        return $this->encargadoActual;
    }

    public function getEmailEncargado() {
        if (empty($this->emailEncargado)) {
            $this->getMax();
        }
        return $this->emailEncargado;
    }
}
