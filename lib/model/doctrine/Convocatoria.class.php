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

    public function getTitle() {
        return 'Convocatoria a auxiliares';
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
            ->orderBy('c.gestion ASC');

        return $q->execute();
    }

    public function listByState($state, $limit = -1) {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Convocatoria c')
            ->where('estado = ?', $state)
            ->orderBy('c.publicacion');
        if ($limit >= 0) {
            $q->limit($limit);
        }
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
        
        $publicacion = $this->_get('publicacion');
        if (empty($publicacion)) {
            $publicacion = date('Y-m-d');
        }
        return pretty_date($publicacion);
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

    public function validateRedaction() {
        $q = Doctrine_Query::create()
            ->select('COUNT(*)')
            ->from('ConvocatoriaRedaccion cr')
            ->where('cr.convocatoria_id = ?', $this->getId());

        $array = $q->fetchArray();

        if ($array[0]['COUNT'] == 0) {
            $result = 0;
            $message = 'No se ha establecido una redacción de convocatoria';
        } else {
            $result = 2;
            $message = '';
        }

        return array(
            'result' => $result,
            'message' => $message,
        );
    }

    public function removeNotifications() {
        $q = Doctrine_Query::create()
            ->delete('ConvocatoriaNotificacion cn')
            ->where('cn.convocatoria_id = ?', $this->getId());

        $q->execute();
    }

    public function validateNotification() {
        $q = Doctrine_Query::create()
            ->select('COUNT(*)')
            ->from('ConvocatoriaCargo cc')
            ->where('cc.convocatoria_id = ?', $this->getId());

        $array = $q->fetchArray();

        if ($array[0]['COUNT'] == 0) {
            $result = 1;
            $message = 'No se han establecido cargos para el campo de firmas';
        } else {
            $result = 2;
            $message = '';
        }

        return array(
            'result' => $result,
            'message' => $message,
        );
    }

    public function removeRoles() {
        $q = Doctrine_Query::create()
            ->delete('UsuarioGrupoConvocatoria us')
            ->where('us.convocatoria_id = ?', $this->getId());

        $q->execute();
    }

    public function validateEncargados() {
        $statement = Doctrine_Manager::getInstance()->connection();
        $resultset = $statement->execute(
            'SELECT g.nombre as nombre,
                    u.count AS count
            FROM grupo g
            LEFT JOIN (
                SELECT grupo_id AS id,
                       count(*) AS count
                FROM usuario_grupo_convocatoria
                WHERE convocatoria_id = ' . $this->getId() . '
                GROUP BY grupo_id
            ) AS u
            ON g.id = u.id');

        $encargados = $resultset->fetchAll();

        $valid = true;
        $messages = array();

        foreach ($encargados as $encargado) {
            $count = intval($encargado['count']);
            $grupo = $encargado['nombre'];

            $valid &= ($count <> 0);
            if ($count == 0) {
                $messages[] = "El rol $grupo no contiene ningun encargado";
            }
        }

        return array(
            'result' => ($valid) ? 2 : 0,
            'message' => implode(' - ', $messages),
        );
    }

    public function validateEmitido() {
        $result1 = $this->validateRedaction();
        $result2 = $this->validateNotification();
        $result3 = $this->validateEncargados();

        $_1 = $result1['result'];
        $_2 = $result2['result'];
        $_3 = $result3['result'];

        if ($_1 == 0 || $_2 == 0 || $_3 == 0) {
            $_t = 0;
        } else if ($_1 == 1 || $_2 == 1 || $_3 == 1) {
            $_t = 1;
        } else {
            $_t = 2;
        }

        return array(
            'result' => $_t,
            'message' => implode(' - ', array(
                $result1['message'],
                $result2['message'],
                $result3['message'],
            )),
        );
    }

    public function validateOperation($operation) {
        if ($operation == 'promover') {
            switch ($this->getEstado()) {
                case 'borrador':
                    $valid = $this->validateRedaction();
                    break;
                case 'emitido':
                    $valid = $this->validateEmitido();
                    break;
            }
            return $valid['result'];
        }

        return true;
    }

    public function validateState() {
        $state = $this->getEstado();
        switch ($state) {
            case 'borrador':
                return $this->validateRedaction();
            case 'emitido':
                return $this->validateEmitido();
        }

        return array(
            'result' => 2,
            'message' => '',
        );
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
