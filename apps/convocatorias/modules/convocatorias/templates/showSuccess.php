<h1><?php echo $object->getGestion() ?></h1>
<p><?php echo '(' . $object->getEstado() . ')' ?></p>

<?php if ($sf_user->canChangeState($object)): ?>
<div class="states">
    <ul>
    <?php foreach ($object->getOperacionesPosibles() as $op => $pr): ?>
        <?php if ($object->hasOperacion($op) &&
                  $sf_user->hasCredential('convocatorias_' . $op) &&
                  $object->validateOperation($op) == 2): ?>
            <li><?php echo link_to(
                ucfirst($pr[0]), 'convocatorias_' . $op, $object, array(
                    'method' => 'post',
                    'confirm' => $pr[1]
                )) ?></li>
        <?php else: ?>
            <li><span class="disabled"><?php echo ucfirst($op) ?></span></li>
        <?php endif; ?>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div id="tabber">
    <?php include_partial('convocatorias/tabs', array(
        'object' => $object,
        'tabs' => $tabs,
    )) ?>

    <div class="tab_details">
    <?php if ($tabs['preview']): ?>
        <div id="preview" class="tab_contents">
            <a name="preview"></a>
            <?php include_partial('convocatorias/tasks', array(
                'object' => $object,
                'preview' => $preview,
                'flags' => array(false, true, true, true),
            )) ?>
            <?php include_partial('convocatorias/preview', array(
                'object' => $object,
                'preview' => $preview,
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($tabs['editor']
          && $sf_user->hasCredential('convocatorias_create')): ?>
    	<div id="editor" class="tab_contents">
            <a name="editor"></a>
            <?php echo form_tag_for($form, '@convocatorias') ?>
                <?php echo $form ?>
                <p class="submit"><input type="submit" value="Registrar" /></p>
            </form>
        </div>
    <?php endif; ?>
    <?php if ($tabs['redactions']): ?>
        <div id="redaction" class="tab_contents">
            <a name="redactions"></a>
            <?php include_partial('convocatorias/redactions', array(
                'object' => $object,
                'redactions' => $redactions['redactions'],
                'redaction' => $redactions['redaction'],
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($tabs['notifications']): ?>
        <div id="notifications" class="tab_contents">
            <a name="notifications"></a>
            <?php include_partial('convocatorias/notifications', array(
                'object' => $object,
                'signatures' => $notifications['signatures'],
                'notifications' => $notifications['notifications'],
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($tabs['users']): ?>
        <div id="users" class="tab_contents">
            <a name="users"></a>
            <?php include_partial('convocatorias/users', array(
                'object' => $object,
                'users'  => $users['users'],
                'groups' => $users['groups'],
                'roles'  => $users['roles'],
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($tabs['events']): ?>
        <div id="events" class="tab_contents">
            <a name="events"></a>
            <?php include_partial('convocatorias/events', array(
                'object' => $object,
                'events' => $events['events'],
                'tasks'  => $events['tasks'],
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($tabs['postulants']): ?>
        <div id="postulants" class="tab_contents">
            <a name="postulants"></a>
        <?php if ($object->checkEvent('end-postulations')): ?>
            <?php include_partial('postulantes/form', array(
                'object' => $object,
                'form' => $postulants['form'],
            )) ?>
        <?php else: ?>
            <?php include_partial('convocatorias/postulants', array(
                'convocatoria' => $postulants['convocatoria'],
                'postulantes' => $postulants['postulantes'],
                'requerimientos' => $postulants['requerimientos'],
                'requisitos' => $postulants['requisitos'],
                'documentos' => $postulants['documentos'],
            )) ?>
        <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ($tabs['results']): ?>
        <div id="results" class="tab_contents">
            <a name="results"></a>
        </div>
    <?php endif; ?>
    </div>
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
