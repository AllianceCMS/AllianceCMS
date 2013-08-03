<p>
    <strong>Please Enter The Main Administrators Information</strong>
</p>

<div class="content_separator"></div>

<?php
    if (isset($formData['firstIteration'])) {
        $firstIteration = 1;
    }

    if (empty($adminLoginName)) {
        $adminLoginName = '';
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
        $adminHideEmail = '';
    }
?>

<?php if (isset($formErrors)): ?>
    <?php if ($adminLoginName == ''): ?>
        <p>
            <span style="color: red;">Error: Please Enter A Login Name</span>
        </p>
    <?php endif; ?>
    <?php if ($adminPassword == ''): ?>
        <p>
            <span style="color: red;">Error: Please Enter A Password</span>
        </p>
    <?php endif; ?>
    <?php if ($adminConfirmPassword == ''): ?>
        <p>
            <span style="color: red;">Error: Please Confirm Your Password</span>
        </p>
    <?php endif; ?>
    <?php if ($adminEmail == ''): ?>
        <p>
            <span style="color: red;">Error: Please Enter An Email Address</span>
        </p>
    <?php endif; ?>
    <?php if ($adminConfirmEmail == ''): ?>
        <p>
            <span style="color: red;">Error: Please Confirm Your Email Address</span>
        </p>
    <?php endif; ?>
    <?php if (isset($adminPasswordMatchError) && $adminPasswordMatchError == 1): ?>
        <p>
            <span style="color: red;">Error: Passwords Do Not Match</span>
        </p>
    <?php endif; ?>
    <?php if (isset($adminEmailMatchError) && $adminEmailMatchError == 1): ?>
        <p>
            <span style='color: red;'>Error: Email Addresses Do Not Match</span>
        </p>
    <?php endif; ?>
    <?php if (isset($adminEmailMatchError) && $adminEmailMatchError == 1): ?>
        <p>
            <span style='color: red;'>Error: Please Enter A Valid Email Address</span>
        </p>
    <?php endif; ?>
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
                <strong>Display Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminDisplayName', (isset($formData['adminDisplayName'])) ? $formData['adminDisplayName'] : $adminDisplayName); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Real Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminRealName', (isset($formData['adminRealName'])) ? $formData['adminRealName'] : $adminRealName); ?>
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
        <tr>
            <td>
                <strong>Hide Email Address:</strong>
            </td>
            <td>
                <?php $formHelper->inputRadio('adminHideEmail', '1', '', (($formData['adminHideEmail'] != 2) ? '1' : NULL)); ?>
                Yes
                <?php $formHelper->inputRadio('adminHideEmail', '2', '', ((isset($formData['adminHideEmail'])) && (($formData['adminHideEmail'] == 2)) ? '1' : NULL)); ?>
                No
            </td>
        </tr>
        <tr>
            <td>
                <strong>Location:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminLocation', (isset($formData['adminLocation'])) ? $formData['adminLocation'] : $adminLocation); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Personal Website:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminWebsite', (isset($formData['adminWebsite'])) ? $formData['adminWebsite'] : $adminWebsite); ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">
                <strong>Bio:</strong>
            </td>
            <td>
                <?php $formHelper->inputTextArea('adminBio', (isset($formData['adminBio'])) ? $formData['adminBio'] : '', '', 7, 25); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Avatar:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminAvatar', (isset($formData['adminAvatar'])) ? $formData['adminAvatar'] : $adminAvatar); ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">
                <strong>Signature:</strong>
            </td>
            <td>
                <?php $formHelper->inputTextArea('adminSignature', (isset($formData['adminSignature'])) ? $formData['adminSignature'] : '', '', 7, 25); ?>
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