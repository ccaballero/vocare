<ul>
<?php if ($sf_user->isAuthenticated()): ?>
    <li><a href=""><?php echo $sf_user->getFullname() ?></a></li>
    <li><?php echo link_to(
            __('Logout'), '@sf_guard_signout', array('accesskey' => '0')
            ) ?></li>
<?php else: ?>
    <li><?php echo link_to(
            __('Login'), '@sf_guard_signin', array('accesskey' => '0')
            ) ?></li>
<?php endif; ?>
</ul>
