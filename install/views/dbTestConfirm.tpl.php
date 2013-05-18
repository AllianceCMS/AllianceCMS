<?php if (!$validConnection): ?>

<p>
    <strong>
        <span style="color: red;">
            Error: Can Not Connect To The Database!!!
        </span>
    </strong>
</p>

<div class="content_separator"></div>

<p>
    Please Review The Database Connection Information You Entered And Try Again
</p>

<div style="float: left; margin:0 5px 5px 0;">
    <?php
        $formHelper->inputFormStart("index.php");
        $formHelper->inputHidden("install", "2");
        
        for ($i = 0; $i < count($installData); $i++) {
            foreach($installData[$i] as $attribute => $value) {
                $formHelper->inputHidden($attribute, $value);
            }
        }
        
        $formHelper->inputSubmit("", "Go Back", array("class" => "button"));
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
        $formHelper->inputFormStart("index.php");
        $formHelper->inputHidden("install", "5");
        
        for ($i = 0; $i < count($installData); $i++) {
            foreach($installData[$i] as $attribute => $value) {
                $formHelper->inputHidden($attribute, $value);
            }
        }
        
        $formHelper->inputSubmit("", "Continue", array("class" => "button"));
        $formHelper->inputFormEnd(); 
    ?>
</div>

<?php endif; ?>

<div style="clear: left"></div>