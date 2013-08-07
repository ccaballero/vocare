<?php

class CargoTable extends Doctrine_Table
{
    public static function getInstance() {
        return Doctrine_Core::getTable('Cargo');
    }

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
}
