<?php

class myUser extends sfGuardSecurityUser
{
    private $_guard;
    private $_convocatoria_permisos;

    public function getGuard() {
        if (!isset($this->_guard)) {
            $this->_guard = $this->getGuardUser();
        }

        return $this->_guard;
    }

    public function getId() {
        return $this->getGuard()->id;
    }

    public function getFirstName() {
        return $this->getGuard()->first_name;
    }

    public function getLastName() {
        return $this->getGuard()->last_name;
    }

    public function getEmailAddress() {
        return $this->getGuard()->email_address;
    }

    public function getFullname() {
        return $this->getGuard()->getFullName();
    }

    public function canView($convocatoria) {
        $state = $convocatoria->getEstado();
        $permission = 'convocatorias_view_' . strtolower($state);
        return $this->hasCredential($permission);
    }

    public function canChangeState($convocatoria) {
        return $this->hasCredential('convocatorias_eliminar')
            || $this->hasCredential('convocatorias_promover')
            || $this->hasCredential('convocatorias_finalizar')
            || $this->hasCredential('convocatorias_anular');
    }

    public function signIn($user, $remember = false, $con = null) {
        parent::signIn($user, $remember, $con);

        // captura de permisos para una convocatoria especifica
        $convocatorias_grupos = $user->getUsuarioGrupoConvocatoria();
        $convocatorias = array();

        foreach ($convocatorias_grupos as $convocatoria_grupo) {
            $convocatoria = $convocatoria_grupo->getConvocatoria();
            $grupo = $convocatoria_grupo->getGrupo();

            $permisos = $grupo->getPermisos();
            $_permisos = array();
            foreach ($permisos as $permiso) {
                $_permisos[] = $permiso;
            }

            if (isset($convocatorias[$convocatoria->getId()])) {
                $convocatorias[$convocatoria->getId()][$grupo->getId()] = $_permisos;
            } else {
                $convocatorias[$convocatoria->getId()] = array($grupo->getId() => $_permisos);
            }
        }

        var_dump($convocatorias);
        die;
        $this->_convocatoria_permisos = $convocatorias;
    }
}
