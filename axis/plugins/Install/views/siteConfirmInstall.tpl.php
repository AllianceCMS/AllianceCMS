<p>
    <strong>You Are Now Ready To Install Your New Website!!!</strong>
</p>

<div class='content_separator'></div>

<p>
    Click the button below to complete the installation of your new website.
</p>

<div>
    <?php
        $formHelper->inputFormStart('/install/complete-installation');
        $formHelper->inputHidden('install', '10');

        foreach($installData as $attribute => $value) {
            $formHelper->inputHidden($attribute, $value);
        }

        $formHelper->inputSubmit('', 'Install Site', array('class' => 'button'));
        $formHelper->inputFormEnd();
    ?>
</div>