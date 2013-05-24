<?php

require_once(sfConfig::get('sf_plugins_dir')
    . '/sfDoctrineGuardPlugin/modules/sfGuardForgotPassword/'
    . 'lib/BasesfGuardForgotPasswordActions.class.php'
);

class sfGuardForgotPasswordActions extends BasesfGuardForgotPasswordActions
{
    public function executeIndex($request) {
        sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));

        $this->form = new RequestPasswordForm();

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $this->user = $this->form->user;
                $this->_deleteOldUserForgotPasswordRecords();

                $forgotPassword = new sfGuardForgotPassword();
                $forgotPassword->user_id = $this->form->user->id;
                $forgotPassword->unique_key = md5(rand() + time());
                $forgotPassword->expires_at = new Doctrine_Expression('NOW()');
                $forgotPassword->save();

                $message = Swift_Message::newInstance()
                    ->setFrom(
                        sfConfig::get('app_sf_guard_plugin_default_from_email'))
                    ->setTo($this->form->user->email_address)
                    ->setContentType('text/html')
                    ->setSubject(
                        sprintf(
                            __('Forgot Password Request for %s'),
                            $this->form->user->username))
                    ->setBody(
                        $this->getPartial(
                            'sfGuardForgotPassword/send_request', array(
                                'user' => $this->form->user,
                                'forgot_password' => $forgotPassword)));

                $this->getMailer()->send($message);

                $this->getUser()->setFlash('notice',
                    __('Check your e-mail! You should receive something shortly!'));
                $this->redirect('@sf_guard_signin');
            } else {
                $this->getUser()->setFlash('error',
                    __('Invalid e-mail address!'));
            }
        }
    }

    public function executeChange($request) {
        sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));

        try {
            $forgotPassword = $this->getRoute()->getObject();
        } catch (Exception $e) {
            $this->forward404Unless($forgotPassword);
        }

        $this->forgotPassword = $forgotPassword;
        $this->user = $this->forgotPassword->User;
        $this->form = new ChangePasswordForm($this->user);


        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $this->form->save();

                $this->_deleteOldUserForgotPasswordRecords();

                $message = Swift_Message::newInstance()
                    ->setFrom(
                        sfConfig::get('app_sf_guard_plugin_default_from_email'))
                    ->setTo($this->user->email_address)
                    ->setContentType('text/html')
                    ->setSubject(
                        sprintf(
                            __('New Password for %s'),
                            $this->user->username))
                    ->setBody(
                        $this->getPartial(
                            'sfGuardForgotPassword/new_password', array(
                                'user' => $this->user,
                                'password' => $request['sf_guard_user']['password'])));

                $this->getMailer()->send($message);

                $this->getUser()->setFlash('notice', __('Password updated successfully!'));
                $this->redirect('@sf_guard_signin');
            }
        }
    }

    private function _deleteOldUserForgotPasswordRecords() {
        Doctrine_Core::getTable('sfGuardForgotPassword')
            ->createQuery('p')
            ->delete()
            ->where('p.user_id = ?', $this->user->id)
            ->execute();
    }
}
