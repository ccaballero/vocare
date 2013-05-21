<?php

class Convocatoria extends BaseConvocatoria
{
    public static $OPERACIONES_POSIBLES = 5;

    protected $_estados_posibles = array(
        'borrador',
        'emitido',
        'anulado',
        'vigente',
        'finalizado',
        'eliminado',
    );

    protected $_operaciones_posibles = array(
        'eliminar' => array(
            'eliminar',
            '¿Esta seguro que desea eliminar esta convocatoria?',
            'La convocatoria ha sido eliminada',
        ),
        'promover' => array(
            'promover',
            '¿Esta seguro que desea promover esta convocatoria?',
            'La convocatoria ha sido promovida',
        ),
        'anular' => array(
            'anular',
            '¿Esta seguro que desea anular la convocatoria?',
            'La convocatoria ha sido anulada',
        ),
        'finalizar' => array(
            'finalizar',
            '¿Esta seguro que desea finalizar esta convocatoria?',
            'La convocatoria ha sido finalizada',
        ),
    );

    protected $_operaciones_disponibles = array();

    public function __toString() {
        return '[' . $this->getEstado() . '] ' . $this->getGestion();
    }

    public function getOperacionesPosibles() {
        return $this->_operaciones_posibles;
    }

     public function getOperacionesDisponibles() {
        if ($this->_operaciones_disponibles == null) {
            switch ($this->getEstado()) {
                case 'borrador':
                    $this->_operaciones_disponibles = array(
                        'eliminar', 'promover');
                    break;
                case 'eliminado':
                    $this->_operaciones_disponibles = array();
                    break;
                case 'emitido':
                    $this->_operaciones_disponibles = array(
                        'promover', 'enmendar', 'anular');
                    break;
                case 'vigente':
                    $this->_operaciones_disponibles = array(
                        'anular', 'finalizar');
                    break;
                case 'anulado':
                    $this->_operaciones_disponibles = array();
                    break;
                case 'finalizado':
                    $this->_operaciones_disponibles = array();
                    break;
            }
        }

        return $this->_operaciones_disponibles;
    }

    public function hasOperacion($operacion) {
        return in_array($operacion, $this->getOperacionesDisponibles());
    }

    public function executeTransform($operacion) {
        switch ($operacion) {
            case 'eliminar':
                $this->estado = 'eliminado';
                break;
            case 'promover':
                if ($this->estado == 'emitido') {
                    $this->estado = 'vigente';
                } else if ($this->estado == 'borrador') {
                    $this->estado = 'emitido';
                }
                break;
            case 'enmendar':
                break;
            case 'anular':
                $this->estado = 'anulado';
                break;
            case 'finalizar':
                $this->estado = 'finalizado';
                break;
        }

        $this->save();
        return $this->_operaciones_posibles[$operacion][2];
    }

    public function listAll() {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Convocatoria c')
            ->where('estado <> ?', 'eliminado')
            ->orderBy('c.updated_at');

        return $q->execute();
    }

    public function getTotalRequerimientos() {
        $q = Doctrine_Query::create()
            ->select('SUM(cr.cantidad_requerida)')
            ->from('Requerimiento r')
            ->leftJoin('r.ConvocatoriaRequerimiento cr')
            ->where('cr.convocatoria_id = ?', $this->getId());

        $array = $q->fetchArray();
        return $array[0]['SUM'];
    }

    public function getConvocatoriaRequerimientos() {
        $q = Doctrine_Core::getTable('ConvocatoriaRequerimiento')
          ->createQuery('cr')
          ->where('cr.convocatoria_id = ?', $this->getId())
          ->orderBy('cr.numero_item ASC');

        return $q->execute();
    }

    public function getConvocatoriaRequisitos() {
        $q = Doctrine_Core::getTable('ConvocatoriaRequisito')
          ->createQuery('cr')
          ->where('cr.convocatoria_id = ?', $this->getId())
          ->orderBy('cr.numero_orden ASC');

        return $q->execute();
    }

    public function getConvocatoriaDocumentos() {
        $q = Doctrine_Core::getTable('ConvocatoriaDocumento')
          ->createQuery('cd')
          ->where('cd.convocatoria_id = ?', $this->getId())
          ->orderBy('cd.numero_orden ASC');

        return $q->execute();
    }

    public function getConvocatoriaEventos() {
        $q = Doctrine_Core::getTable('ConvocatoriaEvento')
          ->createQuery('ce')
          ->where('ce.convocatoria_id = ?', $this->getId())
          ->orderBy('ce.fecha ASC');

        return $q->execute();
    }

    public function getPublicacion() {
        include_once realpath(dirname(__FILE__)
            . '/../../../apps/convocatorias/lib/helper/PrettyDateHelper.php');
        return pretty_date($this->_get('publicacion'));
    }

    public function listRedactions() {
        $statement = Doctrine_Manager::getInstance()->connection();
        $resultset = $statement->execute(
            'SELECT c.id,
                   c.gestion,
                   c. estado,
                   r.numero_enmienda,
                   r.redaccion
            FROM convocatoria c
            RIGHT JOIN (
                SELECT convocatoria_id, numero_enmienda, redaccion
                FROM convocatoria_redaccion
                WHERE (convocatoria_id, numero_enmienda) IN (
                    SELECT convocatoria_id,
                           MAX(numero_enmienda)
                    FROM convocatoria_redaccion
                    GROUP BY convocatoria_id
                )
            ) AS r
            ON c.id = r.convocatoria_id
            WHERE c.estado <> \'eliminado\'
            ORDER BY c.updated_at DESC'
        );

        return $resultset->fetchAll();
    }

    public function removeNotifications() {
        $q = Doctrine_Query::create()
            ->delete('ConvocatoriaNotificacion cn')
            ->where('cn.convocatoria_id = ?', $this->getId());

        $q->execute();
    }

    public function getMaxEnmienda() {
        $q = Doctrine_Query::create()
            ->select('MAX(cr.numero_enmienda)')
            ->from('ConvocatoriaRedaccion cr')
            ->where('cr.convocatoria_id = ?', $this->getId());

        $array = $q->fetchArray();

        if (empty($array[0]['MAX'])) {
            return 0;
        } else {
            return $array[0]['MAX'];
        }
    }

    public function getEnmienda($numero_enmienda) {
        $q = Doctrine_Core::getTable('ConvocatoriaRedaccion')
          ->createQuery('cr')
          ->where('cr.convocatoria_id = ?', $this->getId())
          ->andWhere('cr.numero_enmienda = ?', $numero_enmienda);

        return $q->fetchOne();
    }

    public function getFirmas() {
        $cargos = new Cargo();
        $lista_cargos = $cargos->listAll($this);

        $firmas = array();
        foreach ($lista_cargos as $cargo) {
            if (!empty($cargo['numero_orden'])) {
                $firmas[] = new Firma($cargo['cargo'], $cargo['encargado']);
            }
        }

        return $firmas;
    }
}

class Firma {
    public $cargo;
    public $nombre;

    public function __construct($cargo, $nombre) {
        $this->cargo = $cargo;
        $this->nombre = $nombre;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function getNombre() {
        return $this->nombre;
    }
}
