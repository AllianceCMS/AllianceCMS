<p>
    <strong>You Are Now Ready To Install Your New Website!!!</strong>
</p>

<div class="content_separator"></div>

<p>
    Click the button below to complete the installation of your new website.
</p>

<div>
    <?php
        $formHelper->inputFormStart("index.php");
        $formHelper->inputHidden("install", "10");
        
        for ($i = 0; $i < count($installData); $i++) {
            foreach($installData[$i] as $attribute => $value) {
                $formHelper->inputHidden($attribute, $value);
            }
        }
        
        $formHelper->inputSubmit("", "Install Site", array("class" => "button"));
        $formHelper->inputFormEnd();
    ?>
</div>