<p>
    <strong>Please Confirm That This Database Information Is Correct</strong>
</p>

<div class="content_separator"></div>

<table class="data_table">
    <tr>
        <td>
            <strong>Database Adapter:</strong>
        </td>
        <td>
            <?php echo (isset($dbAdapter)) ? $dbAdapter : ''; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Host Name:</strong>
        </td>
        <td>
            <?php echo (isset($dbHost)) ? $dbHost : ''; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Database:</strong>
        </td>
        <td>
            <?php echo (isset($dbDatabase)) ? $dbDatabase : ''; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>User Name:</strong>
        </td>
        <td>
            <?php echo (isset($dbUserName)) ? $dbUserName : ''; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Password:</strong>
        </td>
        <td>
            <?php echo (((isset($dbPassword))) ? 'Yes' : 'No'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Database Prefix:</strong>
        </td>
        <td>
            <?php echo (isset($dbDatabasePrefix)) ? $dbDatabasePrefix : ''; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Create Database:</strong>
        </td>
        <td>
            <?php echo (((isset($dbCreateDatabase)) && ($dbCreateDatabase == '1')) ? 'Yes' : 'No'); ?>
        </td>
    </tr>
</table>

<div style="float: left; margin:0 5px 5px 0;">
    <?php
        $formHelper->inputFormStart('/install/database-info');
        $formHelper->inputHidden('install', '2');

        foreach($installData as $attribute => $value) {
            $formHelper->inputHidden($attribute, $value);
        }

        $formHelper->inputSubmit('submit', 'Go Back', array('class' => 'button'));
        $formHelper->inputFormEnd();
    ?>
</div>

<div>
    <?php
        $formHelper->inputFormStart('/install/test-database-connection');
        $formHelper->inputHidden('install', '4');

        foreach($installData as $attribute => $value) {
            $formHelper->inputHidden($attribute, $value);
        }

        $formHelper->inputSubmit('submit', 'Continue', array('class' => 'button'));
        $formHelper->inputFormEnd();
    ?>
</div>
<div style="clear: left"></div>