<p>
    <strong>Please Enter Your Database Connection Information</strong>
</p>

<hr>

<?php

    if (isset($formData['firstIteration'])) {
        $firstIteration = 1;
    }

    if (empty($dbHost)) {
        $dbHost = '';
    }

    if (empty($dbUserName)) {
        $dbUserName = '';
    }

    if (empty($dbDatabase)) {
        $dbDatabase = '';
    }

    if (empty($dbDatabasePrefix)) {
        $dbDatabasePrefix = '';
    }
?>

<?php if (isset($formErrors)): ?>
    <div class="error">
    <?php if ($dbHost == ''): ?>
        <p>
            Error: Please Enter A Host Name
        </p>
    <?php endif; ?>
    <?php if ($dbUserName == ''): ?>
        <p>
            Error: Please Enter A User Name
        </p>
    <?php endif; ?>
    <?php if ($dbDatabase == ''): ?>
        <p>
            Error: Please Enter A Database Name
        </p>
    <?php endif; ?>
    </div>
<?php endif; ?>

<?php $formHelper->inputFormStart('/install/confirm-database-info'); ?>
    <table class="data_table">
        <tr>
            <td>
                <strong>Database Adapter:</strong>
            </td>
            <td>
                <!-- <?php $formHelper->inputSelect('dbAdapter', array(array('MySQL', 'mysql'), array('PostgreSQL', 'postgres'), array('MsSQL', 'mssql'))); ?> -->
                <?php $formHelper->inputSelect('dbAdapter', array(array('MySQL', 'mysql'))); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Host Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('dbHost', ((isset($formData['dbHost'])) ? $formData['dbHost'] : $dbHost)); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Database:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('dbDatabase', (isset($formData['dbDatabase'])) ? $formData['dbDatabase'] : $dbDatabase); ?>
                <?php $formHelper->inputCheckBox('dbCreateDatabase', '1', '', ((isset($formData['dbCreateDatabase'])) && ($formData['dbCreateDatabase'] == '1') ? '1' : NULL)); ?>
                Create?
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>User Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('dbUserName', ((isset($formData['dbUserName'])) ? $formData['dbUserName'] : $dbUserName)); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Password:</strong>
            </td>
            <td>
                <?php $formHelper->inputPassword('dbPassword', ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Database Prefix:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('dbDatabasePrefix', ((isset($formData['dbDatabasePrefix'])) ? $formData['dbDatabasePrefix'] : $dbDatabasePrefix)); ?>
            </td>
        </tr>
    </table>

    <?php
        $formHelper->inputHidden('install', '3');

        foreach($formData as $attribute => $value) {
            if (((string)(strpos($attribute, 'db')) !== ((string)0))) {
                $formHelper->inputHidden($attribute, $value);
            }
        }

        $formHelper->inputSubmit('submit', 'Continue', array('class' => 'button'));
    ?>

<?php $formHelper->inputFormEnd(); ?>

<p>
    <span style="color: red;">*</span> = Required Field
</p>