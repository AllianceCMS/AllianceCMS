<div class="pure-g-r">
    <div class="pure-u-3-4">
        <div class="pure-g-r">
            <div class="pure-u-1">
                <h1>Installed Plugins</h1>
                <hr>
            </div>
        </div>

        <?php foreach ($plugins as $plugin): ?>

            <div class="pure-g-r plugin-title">
                <div class="pure-u-23-24">
                    <p class="pull-left">
                        <strong><?php echo $plugin['name']; ?> v<?php echo $plugin['version']; ?></strong>
                    </p>
                    <p class="pull-right">
                        <a class="pure-button pure-button-active" href="#">Update Now!</a>
                        <a class="pure-button" href="#">Uninstall</a>
                    </p>
                </div>
            </div>
            <div class="pure-g-r plugin-body">
                <div class="pure-u-1-2 plugin-body-left">
                    <div class="pure-u-23-24 plugin-description">
                        <p>
                            <strong>Description:</strong>
                        </p>
                        <p>
                            <?php echo $plugin['description']; ?>
                        </p>
                    </div>
                </div>
                <div class="pure-u-1-2 plugin-body-right">
                    <div class="pure-u-1 plugin-links">
                        <div class="pure-u-23-24">
                            <p>
                                <strong>Developer:</strong> <?php echo $plugin['developer']; ?>
                            </p>
                        </div>
                        <div class="pure-u-23-24">
                            <p>
                                <strong>Developer Site:</strong> <?php echo $plugin['developer_email']; ?>
                            </p>
                        </div>
                        <div class="pure-u-23-24">
                            <p>
                                <strong>Developer Email:</strong> <?php echo $plugin['developer_site']; ?>
                            </p>
                        </div>
                        <div class="pure-u-23-24">
                            <p>
                                <strong>Installed On:</strong> <?php echo $plugin['created']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>