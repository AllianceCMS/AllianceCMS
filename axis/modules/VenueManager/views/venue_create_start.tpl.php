<h2>Welcome to the <?php echo $venueTypeName; ?> Creation Wizard!</h2>

<?php if ((isset($invalidVenueName)) && ($invalidVenueName)): ?>
    <div class="error">Error: Invalid Venue Name. We have suggested a valid Venue Name.</div>
<?php endif; ?>

<?php $formHelper->inputFormStart('/venues/create/process/' . $requestedVenueName, 'POST', ['class' => 'pure-form pure-form-aligned']); ?>
    <fieldset>
        <legend>Create A New Venue!</legend>

        <div class="pure-control-group">
            <label for="venue_name"><?php echo $venueTypeName; ?> Name</label>
            <?php $formHelper->inputText('venue_name', $requestedVenueName); ?>
        </div>

        <div class="pure-control-group">
            <label for="venue_type"><?php echo $venueTypeName; ?> Type</label>
            <?php $formHelper->inputSelect('venue_type', $venueTypes); ?>
        </div>

        <div class="pure-controls">
            <button type="submit" class="pure-button pure-button-primary">Create</button>
        </div>
    </fieldset>
<?php $formHelper->inputFormEnd(); ?>