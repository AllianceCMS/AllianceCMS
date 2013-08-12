<?php

    if (empty($venueName)) {
        $venueName = '';
    }

    if (empty($venueTitle)) {
        $venueTitle = '';
    }

    if (empty($venueTagline)) {
        $venueTagline = '';
    }

    if (empty($venueEmail)) {
        $venueEmail = '';
    }

    if (empty($venueEmailName)) {
        $venueEmailName = '';
    }

?>

<p>
    <strong>Please Confirm Main Venue Information, Then Install Venue</strong>
</p>

<hr>

<table class="data_table">
    <tr>
        <td>
            <strong>Main Venue Name:</strong>
        </td>
        <td>
            <?php echo $venueName; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Title:</strong>
        </td>
        <td>
            <?php echo $venueTitle; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Tagline:</strong>
        </td>
        <td>
            <?php echo $venueTagline; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Venue Email Address:</strong>
        </td>
        <td>
            <?php echo $venueEmail; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Venue Email Address Name:</strong>
        </td>
        <td>
            <?php echo $venueEmailName; ?>
        </td>
    </tr>
</table>

<div style="float: left; margin:0 5px 5px 0;">
    <?php
        $formHelper->inputFormStart('/install/venue-info');
        $formHelper->inputHidden('install', '7');

        foreach($formData as $attribute => $value) {
            $formHelper->inputHidden($attribute, $value);
        }

        $formHelper->inputSubmit('', 'Go Back', array('class' => 'button'));
        $formHelper->inputFormEnd();
    ?>
</div>

<div>
    <?php
        $formHelper->inputFormStart('/install/confirm-installation');
        $formHelper->inputHidden('install', '9');

        foreach($formData as $attribute => $value) {
            $formHelper->inputHidden($attribute, $value);
        }

        $formHelper->inputSubmit('', 'Continue', array('class' => 'button'));
        $formHelper->inputFormEnd();
    ?>
</div>
<div style="clear: left"></div>