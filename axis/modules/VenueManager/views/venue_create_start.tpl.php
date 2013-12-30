<h2>Welcome to the <?php echo $venueTypeLabel; ?> Creation Wizard!</h2>

<?php $formHelper->inputFormStart('/venues/create/process/' . $requestedVenueLabel, 'POST', ['class' => 'pure-form pure-form-aligned']); ?>
    <fieldset>
        <legend>Create A New Venue!</legend>

        <div class="pure-control-group">
            <label for="venue_label"><?php echo $venueTypeLabel; ?> Name</label>
            <?php $formHelper->inputText('venue_label', $requestedVenueLabel); ?>
        </div>

        <div class="pure-control-group">
            <label for="venue_type"><?php echo $venueTypeLabel; ?> Type</label>
            <?php $formHelper->inputSelect('venue_type', $venueTypes); ?>
        </div>

        <div class="pure-controls">
            <button type="submit" class="pure-button pure-button-primary">Create</button>
        </div>
    </fieldset>
<?php $formHelper->inputFormEnd(); ?>