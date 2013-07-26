<h1>Invalid Login</h1>

<hr />

<br />

<?php $formHelper->inputFormStart(BASEDIR."users/login.php"); ?>
<p>
    Login Name:<br />
    <?php $formHelper->inputText("login_name"); ?>
</p>
<p>
    Password:<br />
    <?php $formHelper->inputPassword("password"); ?>
</p>
<p>
    <?php $formHelper->inputCheckbox("remember_me"); ?> Remember Me<br />
</p>
<p>
    <?php $formHelper->inputHidden("login_stage", "attempt_login"); ?>
    <?php $formHelper->inputSubmit("submit", "Login"); ?>
</p>
<?php $formHelper->inputFormEnd(); ?>
<p>Forgot Password</p>
<p>Register</p>