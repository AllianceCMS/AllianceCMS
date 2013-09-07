<form class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Legend</legend>

        <div class="pure-g-r">
            <div class="pure-u-1-3">
                <label for="first-name">First Name</label>
                <input id="first-name" type="text">
            </div>

            <div class="pure-u-1-3">
                <label for="last-name">Last Name</label>
                <input id="last-name" type="text">
            </div>

            <div class="pure-u-1-3">
                <label for="email">E-Mail</label>
                <input id="email" type="email" required>
            </div>

            <div class="pure-u-1-3">
                <label for="city">City</label>
                <input id="city" type="text">
            </div>

            <div class="pure-u-1-3">
                <label for="state">State</label>
                <select id="state" class="pure-input-1-2">
                    <option>AL</option>
                    <option>CA</option>
                    <option>IL</option>
                </select>
            </div>
        </div>

        <label for="terms" class="pure-checkbox">
            <input id="terms" type="checkbox"> I've read the terms and conditions
        </label>

        <button type="submit" class="pure-button pure-button-primary">Submit</button>
    </fieldset>
</form>