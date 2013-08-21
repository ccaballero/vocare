<h1><?php echo $convocatoria->getGestion() ?></h1>
<p><?php echo '(' . $convocatoria->getEstado() . ')' ?></p>

<div id="tabber">
    <?php include_partial('postulantes/tabs', array(
        'tabs' => $tabs,
    )) ?>

    <div class="tab_details">
    <?php if ($tabs['list']): ?>
        <div id="list" class="tab_contents">
            <a name="list"></a>
            <?php include_partial('postulantes/list', array(
                'postulantes' => $postulants['postulantes'],
                'requerimientos' => $postulants['requerimientos'],
                'convocatoria' => $postulants['convocatoria'],
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
