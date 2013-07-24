<?php

    if (empty($siteName)) {
        $siteName = '';
    }

    if (empty($siteTitle)) {
        $siteTitle = '';
    }

    if (empty($siteTagline)) {
        $siteTagline = '';
    }

    if (empty($siteEmail)) {
        $siteEmail = '';
    }

    if (empty($siteEmailName)) {
        $siteEmailName = '';
    }

    if (empty($siteDescription)) {
        $siteDescription = '';
    }

    if (empty($siteKeywords)) {
        $siteKeywords = '';
    }
?>

<p>
    <strong>Please Enter Your Site Information</strong>
</p>

<div class='content_separator'></div>

<?php $formHelper->inputFormStart('/install/confirm-site-info'); ?>
    <table class='data_table'>
        <tr>
            <td>
                <strong>Website Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('siteName', $siteName); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Title:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('siteTitle', $siteTitle); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Tagline:</strong>
            </td>
            <td>
                <?php $formHelper->inputText('siteTagline', $siteTagline); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Site Email Address:</strong><br />
                Email Address That Users Will Receive Emails From (admin@yoursite.com)
            </td>
            <td>
                <?php $formHelper->inputText('siteEmail', $siteEmail); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Site Email Address Name:</strong><br />
                Title Of Email Address That Users Will Receive Emails From (Site Admin)
            </td>
            <td>
                <?php $formHelper->inputText('siteEmailName', $siteEmailName); ?>
            </td>
        </tr>
        <tr>
            <td style='vertical-align: top;'>
                <strong>Description:</strong>
            </td>
            <td>
                <?php $formHelper->inputTextArea('siteDescription', $siteDescription, '', 7, 25); ?>
            </td>
        </tr>
        <tr>
            <td style='vertical-align: top;'>
                <strong>Keywords:</strong>
            </td>
            <td>
                <?php $formHelper->inputTextArea('siteKeywords', $siteKeywords, '', 7, 25); ?>
            </td>
        </tr>
    </table>

    <?php
        $formHelper->inputHidden('install', '8');

        foreach($installData as $attribute => $value) {
            if (((string)(strpos($attribute, 'site')) !== ((string)0)) || ($attribute == 'language')) {
                $formHelper->inputHidden($attribute, $value);
            }
        }

        $formHelper->inputSubmit('', 'Continue', array('class' => 'button'));
    ?>

<?php $formHelper->inputFormEnd(); ?>