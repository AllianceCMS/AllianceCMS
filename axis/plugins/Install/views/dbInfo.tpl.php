<p>
    <strong>Please Enter Your Database Connection Information</strong>
</p>

<div class="content_separator"></div>

<?php

    if (isset($installData['dbFirstIteration'])) {
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

<?php if (isset($dbInfoError)): ?>
    <?php if ($dbHost == ''): ?>
        <p>
            <span style="color: red;">Error: Please Enter A Host Name</span>
        </p>
    <?php endif; ?>
    <?php if ($dbUserName == ''): ?>
        <p>
            <span style="color: red;">Error: Please Enter A User Name</span>
        </p>
    <?php endif; ?>
    <?php if ($dbDatabase == ''): ?>
        <p>
            <span style="color: red;">Error: Please Enter A Database Name</span>
        </p>
    <?php endif; ?>
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
                <?php $formHelper->inputText('dbHost', ((isset($installData['dbHost'])) ? $installData['dbHost'] : $dbHost)); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Database:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('dbDatabase', (isset($installData['dbDatabase'])) ? $installData['dbDatabase'] : $dbDatabase); ?>
                <?php $formHelper->inputCheckBox('dbCreateDatabase', '1', '', ((isset($installData['dbCreateDatabase'])) && ($installData['dbCreateDatabase'] == '1') ? '1' : NULL)); ?>
                Create?
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>User Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('dbUserName', ((isset($installData['dbUserName'])) ? $installData['dbUserName'] : $dbUserName)); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Password:</strong>
            </td>
            <td>
                <?php $formHelper->inputPassword('dbPassword', (isset($dbPassword)) ? $dbPassword : ''); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Database Prefix:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('dbDatabasePrefix', ((isset($installData['dbDatabasePrefix'])) ? $installData['dbDatabasePrefix'] : $dbDatabasePrefix)); ?>
            </td>
        </tr>
    </table>

    <?php
        $formHelper->inputHidden('install', '3');

        foreach($installData as $attribute => $value) {
            if (((string)(strpos($attribute, 'db')) !== ((string)0)) || ($attribute == 'language')) {
                $formHelper->inputHidden($attribute, $value);
            }
        }

        $formHelper->inputSubmit('submit', 'Continue', array('class' => 'button'));
    ?>

<?php $formHelper->inputFormEnd(); ?>

<p>
    <span style="color: red;">*</span> = Required Field
</p>