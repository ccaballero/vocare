<?php
/*
<h1><?php echo $object->getGestion() ?></h1>
<p><?php echo '(' . $object->getEstado() . ')' ?></p>

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
    <?php if ($tabs['redaction']): ?>
        <div id="redaction" class="tab_contents">
            <a name="redaction"></a>
            <?php include_partial('convocatorias/redactions', array(
                'object' => $object,
                'list' => $list,
                'redaction' => $redaction,
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($tabs['viewers']): ?>
        <div id="viewers" class="tab_contents">
            <a name="viewers"></a>
            <?php include_partial('convocatorias/notifications', array(
                'object' => $object,
                'signatures' => $signatures,
                'notifications' => $notifications,
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($tabs['users']): ?>
        <div id="users" class="tab_contents">
            <a name="users"></a>
            <?php include_partial('convocatorias/users', array(
                'object' => $object,
                'groups' => $groups,
                'users'  => $users,
                'roles'  => $roles,
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($tabs['letters']): ?>
        <div id="letters" class="tab_contents">
            <a name="letters"></a>
            <h1>Envio de cartas</h1>
        </div>
    <?php endif; ?>
    <?php if ($tabs['results']): ?>
        <div id="results" class="tab_contents">
            <a name="results"></a>
            <h1>Resultados</h1>
        </div>
    <?php endif; ?>
    </div>
</div>
*/