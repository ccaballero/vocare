<h1><?php echo $convocatoria->getGestion() ?></h1>
<p><?php echo '(' . $convocatoria->getEstado() . ')' ?></p>

<div id="tabber">
    <?php include_partial('postulantes/tabs', array(
        'tabs' => $tabs,
    )) ?>

    <div class="tab_details">
    <?php if ($tabs['all']): ?>
        <div id="all" class="tab_contents">
            <a name="all"></a>
            <?php include_partial('postulantes/list', array(
                'postulantes' => $all['postulantes'],
                'requerimientos' => $all['requerimientos'],
                'convocatoria' => $all['convocatoria'],
                'shows' => array(
                    'email' => true,
                    'state' => true,
                    'items' => true,
                    'reception' => false,
                    'requisitos' => false,
                    'documentos' => false,
                    'observacion' => false,
                ),
                'operations' => array(
                    'edit' => true,
                    'delete' => true,
                    'reception' => false,
                    'habilitation' => false,
                ),
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($tabs['reception']): ?>
        <div id="reception" class="tab_contents">
            <a name="reception"></a>
            <?php include_partial('postulantes/list', array(
                'postulantes' => $reception['postulantes'],
                'requerimientos' => $reception['requerimientos'],
                'convocatoria' => $reception['convocatoria'],
                'shows' => array(
                    'email' => false,
                    'state' => true,
                    'items' => false,
                    'reception' => true,
                    'requisitos' => false,
                    'documentos' => false,
                    'observacion' => false,
                ),
                'operations' => array(
                    'edit' => false,
                    'delete' => false,
                    'reception' => true,
                    'habilitation' => false,
                ),
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($tabs['habilitation']): ?>
        <div id="habilitation" class="tab_contents">
            <a name="habilitation"></a>
            <?php include_partial('postulantes/list', array(
                'postulantes' => $habilitation['postulantes'],
                'requisitos' => $habilitation['requisitos'],
                'documentos' => $habilitation['documentos'],
                'convocatoria' => $habilitation['convocatoria'],
                'shows' => array(
                    'email' => false,
                    'state' => true,
                    'items' => false,
                    'reception' => false,
                    'requisitos' => true,
                    'documentos' => true,
                    'observacion' => true,
                ),
                'operations' => array(
                    'edit' => false,
                    'delete' => false,
                    'reception' => false,
                    'habilitation' => true,
                ),
            )) ?>
        </div>
    <?php endif; ?>
</div>
<?php if (isset($tab_click)): ?>
<script>
$(document).ready(function(){
    $('#tabber ul#tabs li a').click(function(){
        var activeTab = $(this).attr('href')
        $('#tabber ul li a').removeClass('active')
        $(this).addClass('active')
        $('#tabber .tab_details .tab_contents').hide()
        $(activeTab).fadeIn()
        $(window).scrollTop(0)
        return false
    })
    $('.tab_contents').hide()
    $('.tab_contents:first').fadeIn()
    $('#tabber .tab a:first').addClass('active')

    var tab_needed='#<?php echo $tab_click; ?>'
    var hash=window.location.hash
    if(hash!==''){
        tab_needed=hash
    }
    $('a[href="'+tab_needed+'"]').click()
    $(window).scrollTop(0)
})
</script>
<?php endif; ?>
