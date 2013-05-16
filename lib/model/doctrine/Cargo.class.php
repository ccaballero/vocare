<?php

class Cargo extends BaseCargo
{
    private $encargadoActual;
    private $emailEncargado;

    public function listAll($convocatoria) {
        $statement = Doctrine_Manager::getInstance()->connection();
        $resultset = $statement->execute(
            'SELECT c.id,
                    c.cargo,
                    q1.encargado,
                    q1.email,
                    q2.numero_orden
            FROM cargo c
            LEFT JOIN (
                SELECT ce.cargo_id AS id,
                       ce.encargado,
                       ce.email,
                       ce.fecha
                FROM cargo_encargado ce
                INNER JOIN (
                    SELECT cargo_id,
                           max(fecha) as fecha
                    FROM cargo_encargado
                    GROUP BY cargo_id
                ) AS q
                ON ce.cargo_id = q.cargo_id
                AND q.fecha = ce.fecha
            ) AS q1
            ON c.id = q1.id
            LEFT JOIN (
                SELECT cc.cargo_id AS id,
                       numero_orden
                FROM convocatoria_cargo cc
                WHERE convocatoria_id = ' . $convocatoria->getId() .
            ') AS q2
            ON c.id = q2.id
            ORDER BY q2.numero_orden ASC'
        );

        return $resultset->fetchAll();
    }

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

        if (isset($array2[0])) {
            $this->encargadoActual = $array2[0]['encargado'];
            $this->emailEncargado = $array2[0]['email'];
        } else {
            $this->encargadoActual = 'No asignado aún';
        }
    }

    public function getEncargadoActual() {
        if (empty($this->encargadoActual)) {
            $this->getMax();
        }
        return $this->encargadoActual;
    }

    public function getEmailEncargado() {
        if (empty($this->encargadoActual)) {
            $this->getMax();
        }
        return $this->emailEncargado;
    }
}
