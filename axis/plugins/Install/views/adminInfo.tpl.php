<p>
    <strong>Please Enter The Main Administrator's Information</strong>
</p>

<hr>

<?php
    if (isset($formData['firstIteration'])) {
        $firstIteration = 1;
    }

    if (empty($adminLoginName)) {
        $adminLoginName = '';
    }

    if (empty($adminDisplayName)) {
        $adminDisplayName = '';
    }

    if (empty($adminRealName)) {
        $adminRealName = '';
    }

    if (empty($adminPassword)) {
        $adminPassword = '';
    }

    if (empty($adminConfirmPassword)) {
        $adminConfirmPassword = '';
    }

    if (empty($adminEmail)) {
        $adminEmail = '';
    }

    if (empty($adminConfirmEmail)) {
        $adminConfirmEmail = '';
    }

    if (empty($adminHideEmail)) {
        $adminHideEmail = 1;
    }
?>

<?php if (isset($formErrors)): ?>
    <div class="error">
    <?php if ($adminLoginName == ''): ?>
        <p>
            Error: Please Enter A Login Name
        </p>
    <?php endif; ?>
    <?php if ($adminPassword == ''): ?>
        <p>
            Error: Please Enter A Password
        </p>
    <?php endif; ?>
    <?php if ($adminConfirmPassword == ''): ?>
        <p>
            Error: Please Confirm Your Password
        </p>
    <?php endif; ?>
    <?php if ($adminEmail == ''): ?>
        <p>
            Error: Please Enter An Email Address
        </p>
    <?php endif; ?>
    <?php if ($adminConfirmEmail == ''): ?>
        <p>
            Error: Please Confirm Your Email Address
        </p>
    <?php endif; ?>
    <?php if (isset($adminPasswordMatchError) && $adminPasswordMatchError == 1): ?>
        <p>
            Error: Passwords Do Not Match
        </p>
    <?php endif; ?>
    <?php if (isset($adminEmailMatchError) && $adminEmailMatchError == 1): ?>
        <p>
            Error: Email Addresses Do Not Match
        </p>
    <?php endif; ?>
    <?php if (isset($adminEmailMatchError) && $adminEmailMatchError == 1): ?>
        <p>
            Error: Please Enter A Valid Email Address
        </p>
    <?php endif; ?>
    </div>
<?php endif; ?>

<?php $formHelper->inputFormStart('/install/confirm-admin-info'); ?>
    <table class="data_table">
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Login Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminLoginName', (isset($formData['adminLoginName'])) ? $formData['adminLoginName'] : $adminLoginName); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Password:</strong>
            </td>
            <td>
                <?php $formHelper->inputPassword('adminPassword', ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Confirm Password:</strong>
            </td>
            <td>
                <?php $formHelper->inputPassword('adminConfirmPassword', ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Email Address:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminEmail', (isset($formData['adminEmail'])) ? $formData['adminEmail'] : $adminEmail); ?>
                <strong>Hide:</strong> 
                <?php $formHelper->inputRadio('adminHideEmail', '1', '', ((((isset($formData['adminHideEmail'])) ? $formData['adminHideEmail'] : $adminHideEmail) != 2) ? '1' : NULL)); ?>
                Yes
                <?php $formHelper->inputRadio('adminHideEmail', '2', '', ((((isset($formData['adminHideEmail'])) ? $formData['adminHideEmail'] : $adminHideEmail) == 2) ? '1' : NULL)); ?>
                No
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Confirm Email Address:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminConfirmEmail', (isset($formData['adminConfirmEmail'])) ? $formData['adminConfirmEmail'] : $adminConfirmEmail); ?>
            </td>
        </tr>
    </table>

    <?php
        $formHelper->inputHidden('install', '6');

        foreach($formData as $attribute => $value) {
            if (((string)(strpos($attribute, 'admin')) !== ((string)0))) {
                $formHelper->inputHidden($attribute, $value);
            }
        }

        $formHelper->inputSubmit('submit', 'Continue', array('class' => 'button'));
    ?>

<?php $formHelper->inputFormEnd(); ?>

<p>
    <span style="color: red;">*</span> = Required Field
</p>