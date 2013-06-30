<?php if ($thisPage != "login.php"): ?>
    <?php if ($loginStatus == 1): ?>
        <div class="box_title"><?php echo $menuTitle; ?></div>

        <div class="box_content">
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
    		<p><?php $htmlHelper->htmlLink(BASEDIR."#", "Forgot Password"); ?></p>
    		<p><?php $htmlHelper->htmlLink(BASEDIR."users/register.php", "Register"); ?></p>
        </div>
	<?php elseif ($loginStatus == 2): ?>
        <div class="box_title"><?php echo $menuTitle." ".$userDisplayName; ?></div>

        <div class="box_content">
            <p>
                <a href="<?php echo $basedir."users/logout.php?login_stage=logout"; ?>">Logout</a>
            </p>
        	<p>Profile</p>
    		<p>Edit Profile</p>
        </div>
	<?php endif; ?>
<?php endif; ?>