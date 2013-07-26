<p>
    <strong>Please Enter The Main Administrators Information</strong>
</p>

<div class="content_separator"></div>

<?php
    if (isset($installData['adminFirstIteration'])) {
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

<?php if (!isset($firstIteration)): ?>
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
<?php endif; ?>

<?php $formHelper->inputFormStart('/install/confirm-admin-info'); ?>
    <table class="data_table">
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Login Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminLoginName', (isset($adminLoginName)) ? $adminLoginName : ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Display Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminDisplayName', (isset($adminDisplayName)) ? $adminDisplayName : ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Real Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminRealName', (isset($adminRealName)) ? $adminRealName : ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Password:</strong>
            </td>
            <td>
                <?php $formHelper->inputPassword('adminPassword', (isset($adminPassword)) ? $adminPassword : ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Confirm Password:</strong>
            </td>
            <td>
                <?php $formHelper->inputPassword('adminConfirmPassword', (isset($adminConfirmPassword)) ? $adminConfirmPassword : ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Email Address:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminEmail', (isset($adminEmail)) ? $adminEmail : ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Confirm Email Address:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminConfirmEmail', (isset($adminConfirmEmail)) ? $adminConfirmEmail : ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Hide Email Address:</strong>
            </td>
            <td>
                <?php $formHelper->inputRadio('adminHideEmail', '1', '', ($adminHideEmail != 2) ? '1' : NULL); ?>
                Yes
                <?php $formHelper->inputRadio('adminHideEmail', '2', '', ((isset($adminHideEmail)) && (($adminHideEmail == 2)) ? '1' : NULL)); ?>
                No
            </td>
        </tr>
        <tr>
            <td>
                <strong>Location:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminLocation', (isset($adminLocation)) ? $adminLocation : ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Website:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminWebsite', (isset($adminWebsite)) ? $adminWebsite : ''); ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">
                <strong>Bio:</strong>
            </td>
            <td>
                <?php $formHelper->inputTextArea('adminBio', (isset($adminBio)) ? $adminBio : '', '', 7, 25); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Avatar:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('adminAvatar', (isset($adminAvatar)) ? $adminAvatar : ''); ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">
                <strong>Signature:</strong>
            </td>
            <td>
                <?php $formHelper->inputTextArea('adminSignature', (isset($adminSignature)) ? $adminSignature : '', '', 7, 25); ?>
            </td>
        </tr>
    </table>

    <?php
        $formHelper->inputHidden('install', '6');

        foreach($installData as $attribute => $value) {
            if (((string)(strpos($attribute, 'admin')) !== ((string)0)) || ($attribute == 'language')) {
                $formHelper->inputHidden($attribute, $value);
            }
        }

        $formHelper->inputSubmit('submit', 'Continue', array('class' => 'button'));
    ?>

<?php $formHelper->inputFormEnd(); ?>

<p>
    <span style="color: red;">*</span> = Required Field
</p>