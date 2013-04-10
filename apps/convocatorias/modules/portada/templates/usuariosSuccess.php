<h1>Administración de usuarios</h1>

<dl>
    <dt><?php echo link_to(__('Users'), url_for('@sf_guard_user')) ?></dt>
    <dd>Administración de usuarios.</dd>
    <dt><?php echo link_to(__('Groups'), url_for('@sf_guard_group')) ?></dt>
    <dd>Administración de grupos.</dd>
    <dt><?php echo link_to(__('Permissions'), url_for('@sf_guard_permission')) ?></dt>
    <dd>Administración de permisos.</dd>
</dl>
