<?php

class myUser extends sfGuardSecurityUser
{
    public function getFullname() {
        $guard = $this->getGuardUser();
        return $guard->getFirstName() . ' ' . $guard->getLastName();
    }
}
