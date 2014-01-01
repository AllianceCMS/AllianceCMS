<?php $formHelper->inputFormStart('/install/confirm-venue-info', 'POST', ['class' => 'pure-form pure-form-aligned']); ?>
    <fieldset>
        <legend>Find An Existing Venue!</legend>

        <div class="pure-control-group">
            <label for="venue_name"><?php echo $venueName; ?> Name</label>
            <?php $formHelper->inputText('venue_name'); ?>
        </div>

        <div class="pure-controls">
            <button type="submit" class="pure-button pure-button-primary">Search</button>
        </div>
    </fieldset>
<?php $formHelper->inputFormEnd(); ?>