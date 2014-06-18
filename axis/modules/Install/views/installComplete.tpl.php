<p>
    <strong>Installation Complete!!!</strong>
</p>

<?php if (!$dumpFileSuccess): ?>
    <div class="notice">
        <strong>Notice:</strong>
        <p>
            We were unable to successfully create your database configuration file. Please check the file owner/permission status of the 'zone' folder and sub-folders.
        </p>
    </div>
<?php endif; ?>

<?php if (!$chmodSuccess): ?>
    <div class="notice">
        <strong>Notice:</strong>
        <p>
            We were unable to successfully change the file permissions of the dbConnection.php file. Recommended permissions are '644' for unix/linux based systems.
        </p>
    </div>
<?php endif; ?>

<hr>

<p>
    Thank you for using AllianceCMS!!!
</p>

<div>
    <?php
        $formHelper->inputFormStart('/');
        $formHelper->inputSubmit('', 'Enter Site', array('class' => 'button'));
        $formHelper->inputFormEnd();
    ?>
</div>