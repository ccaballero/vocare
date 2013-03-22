<?php

class convocatoriasActions extends PlantillasDefault
{
    public $_table = 'convocatoria';
    public $_form = 'ConvocatoriaForm';
    public $_route_list = 'convocatorias';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar convocatoria',
            'edit' => 'Editar convocatoria',
        ),
        'flash' => array(
            'new' => 'Borrador de convocatoria agregado exitosamente',
            'edit' => 'Borrador de convocatoria editado exitosamente',
            'delete' => 'Borrador de convocatoria eliminado exitosamente',
        ),
    );

    public function executeIndex() {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Convocatoria c')
            ->orderBy('c.updated_at');

        $this->list = $q->execute();
    }

    public function executeShow() {
        $convocatorias = $this->getRoute()->getObject();
        $this->form = new ConvocatoriaForm($convocatorias);
        $this->form->removeFocus();

        $q1 = Doctrine_Query::create()
            ->from('ConvocatoriaRequerimiento cr')
            ->where('cr.convocatoria_id = ?', $convocatorias->id);
        $requerimientos = array();
        foreach ($q1->fetchArray() as $_requerimiento) {
            $requerimientos[0][$_requerimiento['requerimiento_id']] = $_requerimiento['numero_item'];
            $requerimientos[1][$_requerimiento['requerimiento_id']] = $_requerimiento['cantidad_requerida'];
        }
        $this->form->setRequerimientos($requerimientos);

        $q2 = Doctrine_Query::create()
            ->from('ConvocatoriaRequisito cr')
            ->where('cr.convocatoria_id = ?', $convocatorias->id);
        $requisitos = array();
        foreach ($q2->fetchArray() as $_requisito) {
            $requisitos[$_requisito['requisito_id']] = $_requisito['numero_orden'];
        }
        $this->form->setRequisitos($requisitos);

        $q3 = Doctrine_Query::create()
            ->from('ConvocatoriaDocumento cd')
            ->where('cd.convocatoria_id = ?', $convocatorias->id);
        $documentos = array();
        foreach ($q3->fetchArray() as $_documento) {
            $documentos[$_documento['documento_id']] = $_documento['numero_orden'];
        }
        $this->form->setDocumentos($documentos);

        $q4 = Doctrine_Query::create()
            ->from('ConvocatoriaEvento ce')
            ->where('ce.convocatoria_id = ?', $convocatorias->id);
        $eventos = array();
        foreach ($q4->fetchArray() as $_evento) {
            $eventos[$_evento['evento_id']] = $_evento['fecha'];
        }
        $this->form->setEventos($eventos);

        $this->object = $this->getRoute()->getObject();
        $this->forward404Unless($this->object);

        $tpl = new myTemplate();
        $tpl->setTemplateFile(realpath(
            APPLICATION_PATH . '/data/xml/convocatorias/' .
            $this->object->getId() . '.xml')
        );
        $tpl->setObject($this->object);

        $this->preview = $tpl->render();
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $flash = '') {
        $form->setRequerimientos($request->getParameter('requerimientos'));
        $form->setRequisitos($request->getParameter('requisitos'));
        $form->setDocumentos($request->getParameter('documentos'));
        $form->setEventos($request->getParameter('eventos'));

        return parent::processForm($request, $form, $flash);
    }

    public function executeTexto() {
        $object = $this->getRoute()->getObject();

        $tpl = new myTemplate();
        $tpl->setTemplateFile(realpath(
            APPLICATION_PATH . '/data/txt/convocatorias/' .
            $object->getId() . '.txt')
        );
        $tpl->setObject($object);

        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);

        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Pragma: public', true);
        $this->getResponse()->setContentType('text/plain; charset=utf-8');

        $this->getResponse()->sendHttpHeaders();
        $this->getResponse()->setContent($tpl->render());

        return sfView::NONE;
    }

    public function executePdf() {
        $object = $this->getRoute()->getObject();

        $latex_dir = realpath(APPLICATION_PATH . '/data/tex/convocatorias');
        $pdflatex_path = '/usr/bin/pdflatex';

        $tex_file = $latex_dir . DIRECTORY_SEPARATOR . $object->getId() . '.tex';
        $pdf_file = $latex_dir . DIRECTORY_SEPARATOR . $object->getId() . '.pdf';

        exec($pdflatex_path . ' -output-directory ' . $latex_dir . ' ' . $tex_file);

        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);

        $this->forward404Unless(file_exists($pdf_file));

        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Pragma: public', true);
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename="convocatoria.pdf' . '"');
        $this->getResponse()->setContentType('application/pdf');

        $this->getResponse()->sendHttpHeaders();
        $this->getResponse()->setContent(readfile($pdf_file));

        return sfView::NONE;
    }

    public function executePromover() {}
    public function executeEliminar() {}
    public function executeEnmendar() {}
    public function executeAnular() {}
    public function executeFinalizar() {}
}
