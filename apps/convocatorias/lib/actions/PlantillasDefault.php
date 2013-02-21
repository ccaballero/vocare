<?php

class PlantillasDefault extends sfActions
{
    public function executeIndex() {
        $this->list = Doctrine_Core::getTable($this->_table)
            ->createQuery('r')
            ->execute();
    }

    public function executeNew() {
        $this->title = $this->_messages['form']['new'];
        $this->form = new $this->_form();

        $this->setTemplate('form');
    }

    public function executeCreate(sfWebRequest $request) {
        $this->form = $this->processForm(
            $request,
            new $this->_form(),
            $this->_messages['flash']['new']
        );

        $this->setTemplate('form');
    }

    public function executeEdit() {
        $this->title = $this->_message['form']['edit'];
        $this->form = new $this->_form($this->getRoute()->getObject());

        $this->setTemplate('form');
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->form = new $this->_form($this->getRoute()->getObject());
        $this->processForm(
            $request,
            $this->form,
            $this->_messages['flash']['edit']
        );
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $object = $this->getRoute()->getObject();
        $object->delete();

        $this->getUser()->setFlash('notice', $this->_messages['flash']['delete']);
        $this->redirect($this->_route_list);
    }

    public function executeShow() {
        $this->object = $this->getRoute()->getObject();
        $this->forward404Unless($this->object);
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $flash = '') {
        $form->bind(
            $request->getParameter($form->getName()),
            $request->getFiles($form->getName())
        );
        if ($form->isValid()) {
            $form->save();

            if (!empty($flash)) {
                $this->getUser()->setFlash('notice', $flash);
            }

            $this->redirect($this->_route_list);
        }
        return $form;
    }
}
