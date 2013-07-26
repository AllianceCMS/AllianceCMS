<p>
    <strong>Please Choose A Language</strong>
</p>

<div class="content_separator"></div>

<?php $formHelper->inputFormStart('/install/database-info'); ?>

    <table class="data_table">
        <tr>
            <td>
                <strong>Language:</strong>
            </td>
            <td>
                <?php $formHelper->inputSelect('language', array(array('English', '1'))); ?>
            </td>
        </tr>
    </table>
    <p>
        <?php $formHelper->inputHidden('install', '2'); ?>
        <?php $formHelper->inputSubmit('submit', 'Continue', array('class' => 'button')); ?>
    </p>
<?php $formHelper->inputFormEnd(); ?>