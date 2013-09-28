<?php
    if (empty($adminLoginName)) {
        $adminLoginName = '';
    }

    if (empty($adminEmail)) {
        $adminEmail = '';
    }

    if (empty($adminHideEmail)) {
        $adminHideEmail = '';
    }
?>
<p>
    <strong>Please Confirm The Main Administrator's Information</strong>
</p>

<hr>

<table class="data_table">
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
</table>

<div style="float: left; margin:0 5px 5px 0;">

    <?php
        $formHelper->inputFormStart('/install/admin-info');
        $formHelper->inputHidden('install', '5');

        foreach($formData as $attribute => $value) {
            $formHelper->inputHidden($attribute, $value);
        }

        $formHelper->inputSubmit('', 'Go Back', array('class' => 'button'));
        $formHelper->inputFormEnd();
    ?>

</div>

<div>
    <?php
        $formHelper->inputFormStart('/install/venue-info');
        $formHelper->inputHidden('install', '7');

        foreach($formData as $attribute => $value) {
            $formHelper->inputHidden($attribute, $value);
        }

        $formHelper->inputSubmit('', 'Continue', array('class' => 'button'));
        $formHelper->inputFormEnd();
    ?>

</div>
<div style="clear: left"></div>