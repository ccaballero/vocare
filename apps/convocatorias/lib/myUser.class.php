<?php

class myUser extends sfGuardSecurityUser
{
    private $_guard;
    
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
}
