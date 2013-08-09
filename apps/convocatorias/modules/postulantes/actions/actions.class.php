<?php

class postulantesActions extends sfActions
{
    protected function getConvocatoria(sfWebRequest $request) {
        $id_convocatoria = $request->getParameter('convocatoria');
        $convocatoria =
            Doctrine::getTable('Convocatoria')->find($id_convocatoria);

        // Existence validation
        $this->forward404Unless($convocatoria);

        // State validation
        if (!$this->getUser()->canView($convocatoria)
            || !$convocatoria->esVigente()) {
            $this->forward404();
        }

        return $convocatoria;
    }

    public function executeIndex(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);
        
        // tabs renderization
        $this->tabs = array(
            'list' => true,
            'reception' => true,
            'habilitation' => true,
        );
        $this->tab_click = 'list';
        
        if ($this->tabs['list']) {
            $this->postulants =
                $this->_renderListPostulants($this->convocatoria);
        }
    }

    protected function _renderListPostulants($convocatoria) {
        return array(
            'postulantes' => $convocatoria->getPostulantes(),
            'requerimientos' => $convocatoria->getConvocatoriaRequerimientos(),
        );
    }
    
    public function _executeIndex(sfWebRequest $request) {
        $qCv = Doctrine_Query::create()
                ->from('Convocatoria c')
                ->where('c.estado=?', 'vigente');
        $this->convocatorias = $qCv->execute();

        $this->auxPu;
        $this->auxPre;

        $qCepu = Doctrine_Query::create()
                ->from('ConvocatoriaEvento ce')
                ->innerJoin('ce.Evento e')
                ->innerJoin('ce.Convocatoria c')
                ->where('e.nombre=?', 'publicacion')
                ->andWhere('c.estado=?', 'vigente');
        $this->fechaPuEvento = $qCepu->execute();

        $qCepre = Doctrine_Query::create()
                ->from('ConvocatoriaEvento ce')
                ->innerJoin('ce.Evento e')
                ->innerJoin('ce.Convocatoria c')
                ->where('e.nombre=?', 'presentacion')
                ->andWhere('c.estado=?', 'vigente');
        $this->fechaPreEvento = $qCepre->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->idc = $request->getParameter('convocatoria');

        //$this->executeIndex($request);
        $q = Doctrine_Query::create()
                ->select('c.gestion')
                ->from('Convocatoria c')
                ->where('c.id = ?', $this->idc);
        $this->list = $q->execute();

        $fecha_actual = strtotime(date("Y-m-d H:i:00", time()));

        //para obtener la fecha de finalizacion del evento
        $q1 = Doctrine_Query::create()
                ->from('ConvocatoriaEvento ce')
                ->leftJoin('ce.Evento e')
                ->leftJoin('ce.Convocatoria c')
                ->where('ce.convocatoria_id = ?', $this->idc)
                ->andwhere('e.nombre=?', 'presentacion')
                ->andwhere('c.id=?', $this->idc);
        $fechaLimite = $q1->execute();

        $fecha_entrada = strtotime($fechaLimite[0]->getFecha());
        $this->f = $fecha_entrada;

        $this->enHora = false;
        //var_dump($fechaLimite);
        /* var_dump($fecha_actual);
          var_dump($fecha_entrada);
          die; */
        if ($fecha_entrada > $fecha_actual) {
            $this->enHora = true;
        } else {
            $this->enHora = false;
        }

//        var_dump($this->enHora) ;
//        die;

        //se obtine el usuario en sesion
        $user = $this->getUser()->getGuardUser();
        $idUser = $user->getId();

        $this->nombreUsr = $user->getFirstName();
        $this->ApellidoUsr = $user->getLastName();
        $this->ApellidoMUsr = $user->getLastName2();

        // $idConvocatoria = $request->getParameter('convocatoria');

        $postulante = new Postulante();

        //Se establece valores por defecto para el formulario
        $postulante->setUserId($idUser);
        $postulante->setConvocatoriaId($this->idc);
        $postulante->setNombre($this->nombreUsr);
        $postulante->setApellidoPaterno($this->ApellidoUsr);
        $postulante->setApellidoMaterno($this->ApellidoMUsr);

        /* Este valor se usa para filtrar los requerimientos, requisitos y documentos
         * pertenecientes a la convocatoria
         */
        global $c;
        $c = $this->idc;

        /* Control de q un usuario no postule varias veces a la misma convocatoria */
        $this->yaPostulo = false;
        $postulanteB = Doctrine::getTable('Postulante')->findByUserId($idUser);
        if (count($postulanteB)==0) {
            $this->form = new PostulanteForm($postulante);
        }else{
            foreach ($postulanteB as $buscado) {
                if ($buscado->getConvocatoriaId() == $this->idc) {
                    $this->yaPostulo = true;
                } else {
                    $this->form = new PostulanteForm($postulante);
                }
            }
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $this->form = new PostulanteForm();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    }

    //Editar los campos de un postulante
    public function executeEdit(sfWebRequest $request) {

        /*Seleccion de la convocatoria para establecer el parametro global
         * que se usara para filtrar los requerimientos, requisitos y documentos
         */
        global $c;
        $q = Doctrine_Query::create()
                ->select('p.convocatoria_id')
                ->from('Postulante p')
                ->where('id=?', $request->getParameter('id'));
        $con = $q->execute();
        $c = $con[0]->getConvocatoriaId();

        //Establecemos el valor por defecto de campo de observacion en el formulario
        $postulante = new Postulante();
        $postulante->setObservacion("Ninguna");


        $this->form = new PostulanteForm($this->getRoute()->getObject());
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->form = new PostulanteForm($this->getRoute()->getObject());
        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
    }

    //Aun no funciona
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();
        $job = $this->getRoute()->getObject();
        $job->delete();
        $this->redirect('postulaciones/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName())
        );
        if ($form->isValid()) {
            $postulante = $form->save();
            echo "SATISFACTORIO!!!";
            $this->redirect($this->generateUrl('postulaciones_show', $postulante));
        }else
            echo "formulario no valido";
    }

    public function executeShow(sfWebRequest $request) {
        $this->postulante = Doctrine::getTable('Postulante')->find($request->getParameter('id'));
        $q = Doctrine_Query::create()
                ->from('Requerimiento r')
                ->leftJoin('r.PostulanteRequerimiento pr')
                ->where('pr.postulante_id=?', $this->postulante->getId());
        $this->id_requerimientos = $q->execute();

        $this->forward404Unless($this->postulante);
    }

    public function executeList(sfWebRequest $request) {
        $this->convocatoria = $request->getParameter('convocatoria');
        $q = Doctrine_Query::create()
                ->from('Postulante p')
                ->where('p.estado=?', 'Pendiente')
                ->addwhere('p.convocatoria_id = ?', $this->convocatoria);
        $this->listaP = $q->execute();

        $q = Doctrine_Query::create()
                ->from('Postulante p')
                ->where('p.estado=?', 'Inscrito')
                ->addwhere('p.convocatoria_id = ?', $this->convocatoria);
        $this->listaR = $q->execute();

        $q = Doctrine_Query::create()
                ->from('Postulante p')
                ->where('p.estado=?', 'Habilitado')
                ->addwhere('p.convocatoria_id = ?', $this->convocatoria);
        $this->listaH = $q->execute();

        $q = Doctrine_Query::create()
                ->from('Postulante p')
                ->where('p.estado=?', 'Inhabilitado')
                ->addwhere('p.convocatoria_id = ?', $this->convocatoria);
        $this->listaI = $q->execute();

        //obteniendo los items
        $q = Doctrine_Query::create()
                ->from('Requerimiento r')
                ->leftJoin('r.ConvocatoriaRequerimiento cr')
                ->where('cr.convocatoria_id=?',  $this->convocatoria);
        $this->requerimientos = $q->execute();
    }

    public function executeBuscar(sfWebRequest $request) {
        $user = $this->getUser()->getGuardUser();

        $this->convocatoria_id = $request->getParameter('convocatoria');

        $q = Doctrine_Query::create()
                ->from('Postulante')
                ->where('user_id=?', $user->getId())
                ->addwhere('convocatoria_id=?', $this->convocatoria_id);
        $this->postulante = $q->execute();
    }

    public function executeBuscarPostulante(sfWebRequest $request){

        /*Datos necesarios para buscar a un postulante
         * solo disponible para el ambito de la recepcion de Sobres
         */

        $nombre = $request->getParameter('nombre');
        $apellido = $request->getParameter('apellido');
        $id_convocatoria = $request->getParameter('convocatoria');

        $q = Doctrine_Query::create()
                ->from('Postulante p')
                ->where('p.nombre=?',$nombre)
                ->addwhere('p.apellido=?',$apellido)
                ->addwhere('p.convocatoria_id=?',$id_convocatoria);
        $this->buscado = $q->execute();

    }

    public function executePdfGeneral(sfWebRequest $request) {
        $id_convocatoria = $request->getParameter('convocatoria');
        $q = Doctrine_Query::create()
                ->from('Postulante p')
                ->where('convocatoria_id=?', $id_convocatoria);
        $postulantes = $q->execute();
        $nro = count($postulantes);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // add a page
        $pdf->AddPage();
        $pdf->SetFont('times', 'B', 16);
        $pdf->Write(0, 'Lista General de Postulantes'.$id_convocatoria, '', 0, 'C', true, 0, false, false, 0);

        $pdf->Ln();

        $textN = "Nombre";
        $textE = "Estado";
        $textO = "Observacion";
        $text_nro = "Nro";
        $i = 0;



        do {

            $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->MultiCell(12, 4, $text_nro, 1, 'L', 1, 0);
            $pdf->MultiCell(50, 4, $textN, 1, 'L', 1, 0);
            $pdf->MultiCell(25, 4, $textE, 1, 'C', 1, 0);
            $pdf->MultiCell(100, 4, $textO, 1, 'L', 1, 1);

            $pdf->SetFont('times', '', 12);

            $text_nro = $i + 1;
            $textN = $postulantes[$i]->getNombre() . " " . $postulantes[$i]->getApellidoPaterno()." ".$postulantes[$i]->getApellidoMaterno();
            $textE = $postulantes[$i]->getEstado();
            $textO = $postulantes[$i]->getObservacion();
            $i++;
            $nro--;
        } while ($nro > 0 || $nro == 0);

        $pdf->Output();

        $this->redirect('postulaciones/index');
    }

     public function executePdfItems(sfWebRequest $request) {
        $id_convocatoria = $request->getParameter('convocatoria');
        $id_requerimiento = $request->getParameter('requerimiento');

        $requerimiento = Doctrine::getTable('Requerimiento')->findById($id_requerimiento);

        $q = Doctrine_Query::create()
                ->from('Postulante p')
                ->leftJoin('p.PostulanteRequerimiento pr')
                //->leftJoin('')
                ->where('p.convocatoria_id=?', $id_convocatoria)
                ->addwhere('pr.requerimiento_id=?',$id_requerimiento);
        $postulantes = $q->execute();
        $nro = count($postulantes);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // add a page
        $pdf->AddPage();
        $pdf->SetFont('times', 'B', 16);
        $pdf->Write(0, 'Lista de Postulantes a: '.$requerimiento[0], '', 0, 'C', true, 0, false, false, 0);

        $pdf->Ln();

        $textN = "Nombre";
        $textE = "Estado";
        $textO = "Observacion";
        $text_nro = "Nro";
        $i = 0;



        do {

            $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->MultiCell(12, 4, $text_nro, 1, 'L', 1, 0);
            $pdf->MultiCell(50, 4, $textN, 1, 'L', 1, 0);
            $pdf->MultiCell(25, 4, $textE, 1, 'C', 1, 0);
            $pdf->MultiCell(100, 4, $textO, 1, 'L', 1, 1);

            $pdf->SetFont('times', '', 12);

            $text_nro = $i + 1;
            $textN = $postulantes[$i]->getNombre() . " " . $postulantes[$i]->getApellidoPaterno()." ".$postulantes[$i]->getApellidoMaterno();
            $textE = $postulantes[$i]->getEstado();
            $textO = $postulantes[$i]->getObservacion();
            $i++;
            $nro--;
        } while ($nro > 0 || $nro == 0);

        $pdf->Output();

        $this->redirect('postulaciones/list');
    }

    public function executePdfEstado(sfWebRequest $request) {
        $id_convocatoria = $request->getParameter('convocatoria');
        $estado = $request->getParameter('estado');

        $q = Doctrine_Query::create()
                ->from('Postulante p')
                ->where('p.convocatoria_id=?', $id_convocatoria)
                ->addwhere('p.estado=?',$estado);
        $postulantes = $q->execute();
        $nro = count($postulantes);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // add a page
        $pdf->AddPage();
        $pdf->SetFont('times', 'B', 16);
        $pdf->Write(0, 'Lista oficial de Postulantes '.$estado.'s', '', 0, 'C', true, 0, false, false, 0);

        $pdf->Ln();

        $textN = "Nombre";
        $textE = "Estado";
        $textO = "Observacion";
        $text_nro = "Nro";
        $i = 0;



        do {

            $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->MultiCell(12, 4, $text_nro, 1, 'L', 1, 0);
            $pdf->MultiCell(50, 4, $textN, 1, 'L', 1, 0);
            $pdf->MultiCell(25, 4, $textE, 1, 'C', 1, 0);
            $pdf->MultiCell(100, 4, $textO, 1, 'L', 1, 1);

            $pdf->SetFont('times', '', 12);

            $text_nro = $i + 1;
            $textN = $postulantes[$i]->getNombre() . " " . $postulantes[$i]->getApellidoPaterno()." ".$postulantes[$i]->getApellidoMaterno();
            $textE = $postulantes[$i]->getEstado();
            $textO = $postulantes[$i]->getObservacion();
            $i++;
            $nro--;
        } while ($nro > 0 || $nro == 0);

        $pdf->Output();

        $this->redirect('postulaciones/list');
    }
}
