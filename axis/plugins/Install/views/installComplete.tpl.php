<p>
    <strong>Installation Complete!!!</strong>
</p>

<div class="content_separator"></div>

<p>
    Thank you for using AllianceCMS!!!
</p>

<div>
    <?php
        $formHelper->inputFormStart(BASEDIR);
        
        /*
        $formHelper->inputHidden("install", "10");
        
        for ($i = 0; $i < count($installData); $i++) {
            foreach($installData[$i] as $attribute => $value) {
                $formHelper->inputHidden($attribute, $value);
            }
        }
        //*/
        
        $formHelper->inputSubmit("", "Enter Site", array("class" => "button"));
        $formHelper->inputFormEnd();
    ?>
</div>