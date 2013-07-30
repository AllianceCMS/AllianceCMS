<?php

    // NEED TO FINISH WORKING ON "EXISTING SITE NAME" AND "REQUIRED FIELDS" ERROR MESSAGES
    // NEED TO FINISH CODE IN THE ACTION AND VIEW

    /*
    if (empty($dbHost)) {
        $dbHost = "";
    }

    if (empty($dbUserName)) {
        $dbUserName = "";
    }

    if (empty($dbDatabase)) {
        $dbDatabase = "";
    }

    if (empty($dbDatabasePrefix)) {
        $dbDatabasePrefix = "";
    }
    */

?>

<!--
<?php if (!isset($firstIteration)): ?>
    <?php if ($dbHost == ""): ?>
        <p>
            <span style="color: red;">Error: Please Enter A Host Name</span>
        </p>
    <?php endif; ?>
    <?php if ($dbUserName == ""): ?>
        <p>
            <span style="color: red;">Error: Please Enter A User Name</span>
        </p>
    <?php endif; ?>
    <?php if ($dbDatabase == ""): ?>
        <p>
            <span style="color: red;">Error: Please Enter A Database Name</span>
        </p>
    <?php endif; ?>
<?php endif; ?>
-->

<h1>Create A New Site</h1>

<?php echo $formHelper->inputFormStart("index.php"); ?>

    <p>
        <table class="data_table">
            <tr>
                <td>
                    <span style="color: red;">*</span><strong>Site Name:</strong>
                </td>
                <td>
                    <?php echo $formHelper->inputText("requested_site_name", (isset($_GET['requested_site_name'])) ? $_GET['requested_site_name'] : ""); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Site Tagline:</strong>
                </td>
                <td>
                    <?php echo $formHelper->inputText("tagline"); ?>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top">
                    <strong>Site Description:</strong>
                </td>
                <td>
                    <?php echo $formHelper->inputTextArea("description", "", "", 7, 25); ?>
                </td>
            </tr>
        </table>
    </p>

    <p>
        <?php echo $formHelper->inputSubmit("create_site_submit", "Create Site"); ?>
    </p>

<?php echo $formHelper->inputFormEnd(); ?>

<p>
    <span style="color: red;">*</span> = Required Field
</p>