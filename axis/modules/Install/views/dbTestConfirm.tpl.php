<?php if ((!$validConnection) && $dbCreateDatabase): ?>

    <div class="error">Error: Can Not Connect To The Database Server!!!</div>

    <div class="notice">
        Please Review The Database Connection Information You Entered And Try Again
    </div>

    <hr>
    
    <div style="float: left; margin:0 5px 5px 0;">
        <?php
            $formHelper->inputFormStart('/install/database-info');
            $formHelper->inputHidden('install', '2');

            foreach($formData as $attribute => $value) {
                $formHelper->inputHidden($attribute, $value);
            }

            $formHelper->inputSubmit('', 'Go Back', array('class' => 'button'));
            $formHelper->inputFormEnd();
        ?>
    </div>

<?php elseif ((!$validConnection) && (!$dbCreateDatabase)): ?>

    <div class="error">Error: Can Not Connect To The Database!!!</div>
    
    <div class="notice">
        <p>
            Hint: Verify that your database credentials are correct!<br />
            Hint: Verify that the specified database exists!
        </p>
        <p>
            Please Review The Database Connection Information You Entered And Try Again
        </p>
    </div>

    <hr>
    
    <div style="float: left; margin:0 5px 5px 0;">
        <?php
            $formHelper->inputFormStart('/install/database-info');
            $formHelper->inputHidden('install', '2');

            foreach($formData as $attribute => $value) {
                $formHelper->inputHidden($attribute, $value);
            }

            $formHelper->inputSubmit('', 'Go Back', array('class' => 'button'));
            $formHelper->inputFormEnd();
        ?>
    </div>

<?php else: ?>

    <div class="success">Database Connection Successful!!!</div>

    <hr>

    <p>
        Please Continue With The Installation Process
    </p>

    <div>
        <?php
            $formHelper->inputFormStart('/install/admin-info');
            $formHelper->inputHidden('install', '5');

            foreach($formData as $attribute => $value) {
                $formHelper->inputHidden($attribute, $value);
            }

            $formHelper->inputSubmit('', 'Continue', array('class' => 'button'));
            $formHelper->inputFormEnd();
        ?>
    </div>

<?php endif; ?>

<div style="clear: left"></div>