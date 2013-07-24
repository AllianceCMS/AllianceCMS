<?php
    if (empty($adminLoginName)) {
        $adminLoginName = '';
    }

    if (empty($adminDisplayName)) {
        $adminDisplayName = '';
    }

    if (empty($adminRealName)) {
        $adminRealName = '';
    }

    if (empty($adminEmail)) {
        $adminEmail = '';
    }

    if (empty($adminHideEmail)) {
        $adminHideEmail = '';
    }

    if (empty($adminLocation)) {
        $adminLocation = '';
    }

    if (empty($adminWebsite)) {
        $adminWebsite = '';
    }

    if (empty($adminBio)) {
        $adminBio = '';
    }

    if (empty($adminAvatar)) {
        $adminAvatar = '';
    }

    if (empty($adminSignature)) {
        $adminSignature = '';
    }
?>
<p>
    <strong>Please Confirm The Main Administrators Information</strong>
</p>

<div class='content_separator'></div>

<table class='data_table'>
    <tr>
        <td>
            <strong>Login Name:</strong>
        </td>
        <td>
            <?php echo $adminLoginName; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Display Name:</strong>
        </td>
        <td>
            <?php echo $adminDisplayName; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Real Name:</strong>
        </td>
        <td>
            <?php echo $adminRealName; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Email Address:</strong>
        </td>
        <td>
            <?php echo $adminEmail; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Hide Email Address:</strong>
        </td>
        <td>
            <?php echo (($adminHideEmail == 1) ? 'Yes' : 'No'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Location:</strong>
        </td>
        <td>
            <?php echo $adminLocation; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Website:</strong>
        </td>
        <td>
            <?php echo $adminWebsite; ?>
        </td>
    </tr>
    <tr>
        <td style='vertical-align: top;'>
            <strong>Bio:</strong>
        </td>
        <td>
            <?php $formHelper->inputTextArea('adminBio', $adminBio, '', 7, 25, '', 1); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Avatar:</strong>
        </td>
        <td>
            <?php echo $adminAvatar; ?>
        </td>
    </tr>
    <tr>
        <td style='vertical-align: top;'>
            <strong>Signature:</strong>
        </td>
        <td>
            <?php $formHelper->inputTextArea('adminSignature', $adminSignature, '', 7, 25, '', 1); ?>
        </td>
    </tr>
</table>

<div style='float: left; margin:0 5px 5px 0;'>

    <?php
        $formHelper->inputFormStart('/install/admin-info');
        $formHelper->inputHidden('install', '5');

        foreach($installData as $attribute => $value) {
            $formHelper->inputHidden($attribute, $value);
        }

        $formHelper->inputSubmit('', 'Go Back', array('class' => 'button'));
        $formHelper->inputFormEnd();
    ?>

</div>

<div>
    <?php
        $formHelper->inputFormStart('/install/site-info');
        $formHelper->inputHidden('install', '7');

        foreach($installData as $attribute => $value) {
            $formHelper->inputHidden($attribute, $value);
        }

        $formHelper->inputSubmit('', 'Continue', array('class' => 'button'));
        $formHelper->inputFormEnd();
    ?>

</div>
<div style='clear: left'></div>