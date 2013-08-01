<?php if ((!$validConnection) && $dbCreateDatabase): ?>

    <p>
            <span style="color: red;">
                <strong>Error: Can Not Connect To The Database Server!!!</strong>
            </span>
    </p>

    <div class="content_separator"></div>

    <p>
        Please Review The Database Connection Information You Entered And Try Again
    </p>

    <div style="float: left; margin:0 5px 5px 0;">
        <?php
            $formHelper->inputFormStart('/install/database-info');
            $formHelper->inputHidden('install', '2');

            foreach($installData as $attribute => $value) {
                $formHelper->inputHidden($attribute, $value);
            }

            $formHelper->inputSubmit('', 'Go Back', array('class' => 'button'));
            $formHelper->inputFormEnd();
        ?>
    </div>

<?php elseif ((!$validConnection) && (!$dbCreateDatabase)): ?>

    <p>
        <span style="color: red;">
            <strong>Error: Can Not Connect To The Database!!!</strong>
        </span>
    </p>
    <p>
        <span style="color: red;">
            (Hint: Verify that you're database credentials are correct)<br />
            (Hint: Make sure that the specified Database exists)
        </span>
    </p>

    <div class="content_separator"></div>

    <p>
        Please Review The Database Connection Information You Entered And Try Again
    </p>

    <div style="float: left; margin:0 5px 5px 0;">
        <?php
            $formHelper->inputFormStart('/install/database-info');
            $formHelper->inputHidden('install', '2');

            foreach($installData as $attribute => $value) {
                $formHelper->inputHidden($attribute, $value);
            }

            $formHelper->inputSubmit('', 'Go Back', array('class' => 'button'));
            $formHelper->inputFormEnd();
        ?>
    </div>

<?php else: ?>

    <p>
        <strong>Database Connection Successful!!!</strong>
    </p>

    <div class="content_separator"></div>

    <p>
        Please Continue With The Installation Process
    </p>

    <div>
        <?php
            $formHelper->inputFormStart('/install/admin-info');
            $formHelper->inputHidden('install', '5');

            foreach($installData as $attribute => $value) {
                $formHelper->inputHidden($attribute, $value);
            }

            $formHelper->inputSubmit('', 'Continue', array('class' => 'button'));
            $formHelper->inputFormEnd();
        ?>
    </div>

<?php endif; ?>

<div style="clear: left"></div>