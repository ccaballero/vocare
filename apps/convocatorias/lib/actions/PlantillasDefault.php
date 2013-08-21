<?php

class PlantillasDefault extends sfActions
{
    public function executeIndex(sfWebRequest $request) {
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
        $this->title = $this->_messages['form']['new'];
        $this->form = $this->processForm(
            $request,
            new $this->_form(),
            $this->_messages['flash']['new']
        );

        $this->setTemplate('form');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->object = $this->getRoute()->getObject();
        $this->title = $this->_messages['form']['edit'];
        $this->form = new $this->_form($this->object);

        $this->setTemplate('form');
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->form = new $this->_form($this->getRoute()->getObject());
        $this->form = $this->processForm(
            $request,
            $this->form,
            $this->_messages['flash']['edit']
        );

        $this->setTemplate('form');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $object = $this->getRoute()->getObject();
        $object->delete();

        $this->getUser()->setFlash('success',
            $this->_messages['flash']['delete']);
        $this->redirect($this->_route_list);
    }

    public function executeShow(sfWebRequest $request) {
        $this->object = $this->getRoute()->getObject();
        $this->forward404Unless($this->object);
    }

    protected function processForm(sfWebRequest $request,
        sfForm $form, $flash = '') {
        $form->bind(
            $request->getParameter($form->getName()),
            $request->getFiles($form->getName())
        );

        if ($form->isValid()) {
            $form->save();

            if (!empty($flash)) {
                $this->getUser()->setFlash('success', $flash);
            }

            $this->redirect($this->_route_list);
        } else {
            $this->getUser()->setFlash('error',
                'Se encontraron algunos errores en el formulario');
        }

        return $form;
    }

    protected function sendContent($content,
            $mime = 'text/plain; charset=utf-8',
            $filename = '') {
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);

        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Pragma: public', true);
        if (!empty($mime)) {
            $this->getResponse()->setContentType($mime);
        }
        if (!empty($filename)) {
            $this->getResponse()->setHttpHeader('Content-Disposition',
                'attachment; filename="' . $filename . '"');
        }

        $this->getResponse()->sendHttpHeaders();
        $this->getResponse()->setContent($content);

        return sfView::NONE;
    }
}
