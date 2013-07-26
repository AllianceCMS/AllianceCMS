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

    if (empty($venueDescription)) {
        $venueDescription = '';
    }

    if (empty($venueKeywords)) {
        $venueKeywords = '';
    }
?>

<p>
    <strong>Please Enter Main Venue Information</strong>
</p>

<div class="content_separator"></div>

<?php $formHelper->inputFormStart('/install/confirm-venue-info'); ?>
    <table class="data_table">
        <tr>
            <td>
                <strong>Venue Name:</strong><br />
                Must not contain spaces, numbers or symbols<br />
                (i.e. AllianceCMS, MyVenueName)
            </td>
            <td>
                <?php $formHelper->inputText('venueName', $venueName); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Title:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('venueTitle', $venueTitle); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Tagline:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('venueTagline', $venueTagline); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Venue Email Address:</strong><br />
                Email Address That Users Will Receive Emails From (admin@yoursite.com)
            </td>
            <td>
                <?php $formHelper->inputText('venueEmail', $venueEmail); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Venue Email Address Name:</strong><br />
                Title Of Email Address That Users Will Receive Emails From (Venue Admin)
            </td>
            <td>
                <?php $formHelper->inputText('venueEmailName', $venueEmailName); ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">
                <strong>Description:</strong>
            </td>
            <td>
                <?php $formHelper->inputTextArea('venueDescription', $venueDescription, '', 7, 25); ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">
                <strong>Keywords:</strong>
            </td>
            <td>
                <?php $formHelper->inputTextArea('venueKeywords', $venueKeywords, '', 7, 25); ?>
            </td>
        </tr>
    </table>

    <?php
        $formHelper->inputHidden('install', '8');

        foreach($installData as $attribute => $value) {
            if (((string)(strpos($attribute, 'venue')) !== ((string)0)) || ($attribute == 'language')) {
                $formHelper->inputHidden($attribute, $value);
            }
        }

        $formHelper->inputSubmit('', 'Continue', array('class' => 'button'));
    ?>

<?php $formHelper->inputFormEnd(); ?>