<p>
    <strong>Please Enter Main Venue Information</strong>
</p>

<div class="content_separator"></div>

<?php

    if (isset($installData['venueFirstIteration'])) {
        $firstIteration = 1;
    }

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

    if (empty($venueConfirmEmail)) {
        $venueConfirmEmail = '';
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

<?php if (!isset($firstIteration)): ?>
    <?php if (isset($venueEmailMatchError) && $venueEmailMatchError == 1): ?>
        <p>
            <span style='color: red;'>Error: Email Addresses Do Not Match</span>
        </p>
    <?php endif; ?>
    <?php if ($venueName == ''): ?>
        <p>
            <span style="color: red;">Error: Please Enter A Venue Name</span>
        </p>
    <?php endif; ?>
    <?php if ($venueEmail == ''): ?>
        <p>
            <span style="color: red;">Error: Please Enter An Email Address</span>
        </p>
    <?php endif; ?>
    <?php if ($venueConfirmEmail == ''): ?>
        <p>
            <span style="color: red;">Error: Please Confirm Your Email Address</span>
        </p>
    <?php endif; ?>
<?php endif; ?>

<?php $formHelper->inputFormStart('/install/confirm-venue-info'); ?>
    <table class="data_table">
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Venue Name:</strong><br />
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
                <span style="color: red;">*</span> <strong>Venue Email Address:</strong><br />
                Email Address That Users Will Receive Emails From (admin@yoursite.com)
            </td>
            <td>
                <?php $formHelper->inputText('venueEmail', $venueEmail); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Confirm Venue Email Address:</strong><br />
                Email Address That Users Will Receive Emails From (admin@yoursite.com)
            </td>
            <td>
                <?php $formHelper->inputText('venueConfirmEmail', $venueConfirmEmail); ?>
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