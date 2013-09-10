<h1>Postulantes</h1>

<p>En esta sección puedes hacer seguimiento de los procesos en los que estan
inmersos todos los postulantes.</p>

<p>Recuerda que si encuentras algo raro en tu postulación, debes apersonarte a
secretaria del departamento de Informática-Sistemas para la verificación de la
informacion.</p>

<?php switch ($convocatoria->findCurrentEvent()): ?>
<?php case 'end-postulations': ?>
    <?php include_partial('postulantes/list', array(
        'postulantes' => $postulantes,
        'requerimientos' => $requerimientos,
        'requisitos' => $requisitos,
        'documentos' => $documentos,
        'convocatoria' => $convocatoria,
        'shows' => array(
            'email' => false,
            'state' => true,
            'items' => true,
            'reception' => false,
            'requisitos' => false,
            'documentos' => false,
            'observacion' => false,
            'actions' => false,
        ),
        'operations' => array(),
    )) ?>
<?php break; ?>
<?php case 'end-documents': ?>
    <?php include_partial('postulantes/list', array(
        'postulantes' => $postulantes,
        'requerimientos' => $requerimientos,
        'requisitos' => $requisitos,
        'documentos' => $documentos,
        'convocatoria' => $convocatoria,
        'shows' => array(
            'email' => false,
            'state' => true,
            'items' => true,
            'reception' => true,
            'requisitos' => false,
            'documentos' => false,
            'observacion' => false,
            'actions' => false,
        ),
        'operations' => array(),
    )) ?>
<?php break; ?>
<?php case 'end-habilitations': ?>
    <?php include_partial('postulantes/list', array(
        'postulantes' => $postulantes,
        'requerimientos' => $requerimientos,
        'requisitos' => $requisitos,
        'documentos' => $documentos,
        'convocatoria' => $convocatoria,
        'shows' => array(
            'email' => false,
            'state' => true,
            'items' => true,
            'reception' => false,
            'requisitos' => true,
            'documentos' => true,
            'observacion' => true,
            'actions' => false,
        ),
        'operations' => array(),
    )) ?>
<?php break; ?>
<?php default: ?>
    <?php include_partial('postulantes/list', array(
        'postulantes' => $postulantes,
        'requerimientos' => $requerimientos,
        'requisitos' => $requisitos,
        'documentos' => $documentos,
        'convocatoria' => $convocatoria,
        'shows' => array(
            'email' => false,
            'state' => true,
            'items' => true,
            'reception' => false,
            'requisitos' => false,
            'documentos' => false,
            'observacion' => false,
            'actions' => false,
        ),
        'operations' => array(),
    )) ?>
<?php break; ?>
<?php endswitch; ?>

