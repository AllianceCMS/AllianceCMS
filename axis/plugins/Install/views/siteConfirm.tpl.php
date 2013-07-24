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
    <strong>Please Confirm This Site Information, Then Install Site</strong>
</p>

<div class='content_separator'></div>

<table class='data_table'>
    <tr>
        <td>
            <strong>Website Name:</strong>
        </td>
        <td>
            <?php echo $siteName; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Title:</strong>
        </td>
        <td>
            <?php echo $siteTitle; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Tagline:</strong>
        </td>
        <td>
            <?php echo $siteTagline; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Site Email Address:</strong>
        </td>
        <td>
            <?php echo $siteEmail; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Site Email Address Name:</strong>
        </td>
        <td>
            <?php echo $siteEmailName; ?>
        </td>
    </tr>
    <tr>
        <td style='vertical-align: top;'>
            <strong>Description:</strong>
        </td>
        <td>
            <?php $formHelper->inputTextArea('siteDescription', $siteDescription, '', 7, 25, '', 1); ?>
        </td>
    </tr>
    <tr>
        <td style='vertical-align: top;'>
            <strong>Keywords:</strong>
        </td>
        <td>
            <?php $formHelper->inputTextArea('siteKeywords', $siteKeywords, '', 7, 25, '', 1); ?>
        </td>
    </tr>
</table>

<div style='float: left; margin:0 5px 5px 0;'>
    <?php
        $formHelper->inputFormStart('/install/site-info');
        $formHelper->inputHidden('install', '7');

        foreach($installData as $attribute => $value) {
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

        foreach($installData as $attribute => $value) {
            $formHelper->inputHidden($attribute, $value);
        }

        $formHelper->inputSubmit('', 'Continue', array('class' => 'button'));
        $formHelper->inputFormEnd();
    ?>
</div>
<div style='clear: left'></div>