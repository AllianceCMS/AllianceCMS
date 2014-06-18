<p>
    <strong>Please Enter Main Venue Information</strong>
</p>

<hr>

<?php

    if (isset($formData['firstIteration'])) {
        $firstIteration = 1;
    }

    /*
    if (empty($venueLabel)) {
        $venueLabel = '';
    }
    //*/

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

?>

<?php if (isset($formErrors)): ?>
    <div class="error">
    <!--
    <?php /* if ($venueLabel == ''): */ ?>
        <p>
            Error: Please Enter A Venue Name
        </p>
    <?php /* endif; */ ?>
    <?php /* if (isset($venueLabelRegexError) && $venueLabelRegexError == 1): */ ?>
        <p>
            Error: Please Enter A Valid Venue Name
        </p>
    <?php /* endif; */ ?>
    -->
    <?php if ($venueEmail == ''): ?>
        <p>
            Error: Please Enter An Email Address
        </p>
    <?php endif; ?>
    <?php if ($venueConfirmEmail == ''): ?>
        <p>
            Error: Please Confirm Your Email Address
        </p>
    <?php endif; ?>
    <?php if (isset($venueEmailMatchError) && $venueEmailMatchError == 1): ?>
        <p>
            Error: Email Addresses Do Not Match
        </p>
    <?php endif; ?>
    <?php if (isset($venueEmailRegexError) && $venueEmailRegexError == 1): ?>
        <p>
            Error: Please Enter A Valid Email Address
        </p>
    <?php endif; ?>
    </div>
<?php endif; ?>

<?php $formHelper->inputFormStart('/install/confirm-venue-info'); ?>
    <table class="data_table">
        <!--
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Venue Name:</strong><br />
                Must not contain numbers or symbols<br />
                (Spaces will be converted into dashes)<br />
                (i.e. AllianceCMS, My-Venue-Name)
            </td>
            <td>
                <?php /* $formHelper->inputText('venueLabel', ((isset($formData['venueLabel'])) ? $formData['venueLabel'] : $venueLabel), 'required'); */ ?>
            </td>
        </tr>
        -->
        <tr>
            <td>
                <strong>Title:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('venueTitle', (isset($formData['venueTitle'])) ? $formData['venueTitle'] : $venueTitle); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Tagline:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('venueTagline', (isset($formData['venueTagline'])) ? $formData['venueTagline'] : $venueTagline); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Venue Email Address:</strong><br />
                Email Address That Users Will Receive Emails From (admin@yoursite.com)
            </td>
            <td>
                <?php $formHelper->inputText('venueEmail', ((isset($formData['venueEmail'])) ? $formData['venueEmail'] : $venueEmail), 'required'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Confirm Venue Email Address:</strong><br />
                Email Address That Users Will Receive Emails From (admin@yoursite.com)
            </td>
            <td>
                <?php $formHelper->inputText('venueConfirmEmail', ((isset($formData['venueConfirmEmail'])) ? $formData['venueConfirmEmail'] : $venueConfirmEmail), 'required'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Venue Email Address Name:</strong><br />
                Title Of Email Address That Users Will Receive Emails From (Venue Admin)
            </td>
            <td>
                <?php $formHelper->inputText('venueEmailName', (isset($formData['venueEmailName'])) ? $formData['venueEmailName'] : $venueEmailName); ?>
            </td>
        </tr>
    </table>

    <?php
        $formHelper->inputHidden('install', '8');

        foreach($formData as $attribute => $value) {
            if (((string)(strpos($attribute, 'venue')) !== ((string)0))) {
                $formHelper->inputHidden($attribute, $value);
            }
        }

        $formHelper->inputSubmit('', 'Continue', array('class' => 'button'));
    ?>

<?php $formHelper->inputFormEnd(); ?>