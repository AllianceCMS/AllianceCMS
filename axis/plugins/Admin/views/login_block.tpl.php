<?php if (empty($logged_in)): ?>
    <?php $form_helper->inputFormStart('/user/login-attempt'); ?>
    <p>
    	Login Name:<br />
    	<?php $form_helper->inputText('login_name'); ?>
    </p>
    <p>
    	Password:<br />
    	<?php $form_helper->inputPassword('password'); ?>
    </p>
    <p>
        <?php $form_helper->inputHidden('login_stage', 'request_login'); ?>
    	<?php $form_helper->inputSubmit('submit', 'Sign In'); ?>
    </p>
    <?php $form_helper->inputFormEnd(); ?>
    <p>
        <?php $html_helper->htmlLink('/user/password-reset', 'Forgot Password'); ?>
    </p>
    <p>
        <?php $html_helper->htmlLink('/user/register', 'Register'); ?>
    </p>
<?php else: ?>
    <?php $form_helper->inputFormStart('/user/logout'); ?>
    <p>
    	<?php $form_helper->inputSubmit('submit', 'Logout'); ?>
    </p>
    <?php $form_helper->inputFormEnd(); ?>
<?php endif; ?>