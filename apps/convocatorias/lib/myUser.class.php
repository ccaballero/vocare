<?php

class myUser extends sfGuardSecurityUser
{
    public function getFirstName() {
        $guard = $this->getGuardUser();
        return $guard->first_name;
    }
    
    public function getLastName() {
        $guard = $this->getGuardUser();
        return $guard->last_name;
    }
    
    public function getEmailAddress() {
        $guard = $this->getGuardUser();
        return $guard->email_address;
    }    
    
    public function getFullname() {
        $guard = $this->getGuardUser();
        return $guard->getFullName();
    }
}
