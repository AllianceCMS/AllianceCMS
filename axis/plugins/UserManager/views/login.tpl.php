<?php

    if (empty($login_name)) {
        $login_name = '';
    }

    if (empty($password)) {
        $password = '';
    }

    if (empty($remember_me)) {
        $remember_me = '';
    }

    if (empty($invalid_login_name)) {
        $invalid_login_name = '';
    }

    if (empty($invalid_password)) {
        $invalid_password = '';
    }
?>

<?php if (isset($formErrors)): ?>
    <?php if ($login_name == ''): ?>
            <div class="error">Error: Please Enter A Login Name</div>
    <?php endif; ?>
    <?php if ($password == ''): ?>
            <div class="error">Error: Please Enter A Password</div>
    <?php endif; ?>
    <?php if (($invalid_login_name == '1') || ($invalid_password == '1')): ?>
            <div class="error">Login Failed: Incorrect Login/Password Combination</div>
    <?php endif; ?>
<?php endif; ?>

<?php $form_helper->inputFormStart('/user/login-attempt'); ?>
<p>
    Login Name:<br />
    <?php $form_helper->inputText('login_name', ((isset($login_name)) ? $login_name : $login_name)); ?>
</p>
<p>
    Password:<br />
    <?php $form_helper->inputPassword('password', ((isset($password)) ? $password : $password)); ?>
</p>
<p>
    <?php $form_helper->inputHidden('login_stage', 'attempt_login'); ?>
    <?php $form_helper->inputSubmit('submit', 'Sign In'); ?>
</p>
<?php $form_helper->inputFormEnd(); ?>
