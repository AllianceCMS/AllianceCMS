<h2>Welcome to the <?php echo $venueTypeName; ?> Creation Wizard!</h2>

<?php if ((isset($invalidVenueName)) && ($invalidVenueName)): ?>
    <div class="error">Error: Invalid Venue Name.</div>
<?php endif; ?>

<?php if ((isset($venueNameExists)) && ($venueNameExists)): ?>
    <div class="error">Error: Requested Venue Name Exists.</div>
<?php endif; ?>

<?php if ((isset($blankVenueName)) && ($blankVenueName)): ?>
    <div class="error">Error: Blank Venue Name Submitted.</div>
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
            <!-- <button type="submit" class="pure-button pure-button-primary">Create</button> -->
            <input class="button" type="submit" value="Create" name="submit"></input>
        </div>
    </fieldset>
<?php $formHelper->inputFormEnd(); ?>