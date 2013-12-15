<h2>Welcome to the <?php echo $venueLabel; ?> Creation Wizard!</h2>

<?php $formHelper->inputFormStart('/install/confirm-venue-info', 'POST', ['class' => 'pure-form pure-form-aligned']); ?>
    <fieldset>
        <legend>Create A New Venue!</legend>
        <div class="pure-control-group">
            <label for="venue_name"><?php echo $venueLabel; ?> Name</label>
            <?php $formHelper->inputText('venue_name'); ?>
        </div>
    </fieldset>
<?php $formHelper->inputFormEnd(); ?>

<?php $formHelper->inputFormStart('/install/confirm-venue-info', 'POST', ['class' => 'pure-form pure-form-aligned']); ?>
    <fieldset>
        <legend>Find An Existing Venue!</legend>
        <div class="pure-control-group">
            <label for="venue_name"><?php echo $venueLabel; ?> Name</label>
            <?php $formHelper->inputText('venue_name'); ?>

            <label for="state">State</label>
            <select id="state">
                <option>AL</option>
                <option>CA</option>
                <option>IL</option>
            </select>
        </div>
    </fieldset>
<?php $formHelper->inputFormEnd(); ?>