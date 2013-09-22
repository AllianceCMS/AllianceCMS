<?php if (isset($installationSuccessful)): ?>
    <div class="sortable row-fluid">
        <div class="alert alert-success">
            <strong>Plugin Successfully Installed!</strong>
            <a href="#" data-dismiss="alert" class="close">&times;</a>
        </div>
    </div>
<?php endif; ?>
<div class="pure-g-r">
    <div class="pure-u-3-4">
        <div class="pure-g-r">
            <div class="pure-u-1">
                <h1>Install Plugins</h1>
                <hr>
            </div>
        </div>

        <div class="pure-g-r">
            <div class="pure-u-1">
                <h2>Domain Wide Plugins</h2>
            </div>
        </div>
        <?php if (!empty($zoneAllPlugins)): ?>
            <?php foreach ($zoneAllPlugins as $plugin): ?>
                <div class="pure-g-r plugin-title">
                    <div class="pure-u-23-24">
                        <div class="pull-left">
                            <strong><?php echo $plugin['name']; ?> v<?php echo $plugin['version']; ?></strong>
                        </div>
                        <div class="pull-right">
                            <?php $formHelper->inputFormStart('/admin/plugin-manager/install-plugin'); ?>
                                <?php
                                foreach($plugin as $attribute => $value) {
                                    if (((string)(strpos($attribute, 'admin')) !== ((string)0))) {
                                        $formHelper->inputHidden($attribute, $value);
                                    }
                                }
                                $formHelper->inputSubmit('submit', 'Install', array('class' => 'pure-button'));
                                ?>
                            <?php $formHelper->inputFormEnd(); ?>
                        </div>
                    </div>
                </div>
                <div class="pure-g-r plugin-body">
                    <div class="pure-u-1-2 plugin-body-left">
                        <div class="pure-u-23-24 plugin-description">
                            <p>
                                <strong>Description:</strong>
                            </p>
                            <p>
                                <?php echo urldecode($plugin['description']); ?>
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
                                    <strong>Developer Site:</strong> <a href="<?php echo $plugin['developer_site']; ?>"><?php echo $plugin['developer_site']; ?></a>
                                </p>
                            </div>
                            <div class="pure-u-23-24">
                                <p>
                                    <strong>Developer Email:</strong> <a href="mailto:<?php echo $plugin['developer_email']; ?>"><?php echo $plugin['developer_email']; ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="pure-g-r plugin-title">
                <div class="pure-u-23-24">
                    <h3>No Domain Wide Plugins Available</h3>
                </div>
            </div>
        <?php endif; ?>

        <div class="pure-g-r">
            <div class="pure-u-1">
                <h2>Domain Specific Plugins</h2>
            </div>
        </div>
        <?php if (!empty($zoneSpecificPlugins)): ?>
            <?php foreach ($zoneSpecificPlugins as $plugin): ?>
                <div class="pure-g-r plugin-title">
                    <div class="pure-u-23-24">
                        <div class="pull-left">
                            <strong><?php echo $plugin['name']; ?> v<?php echo $plugin['version']; ?></strong>
                        </div>
                        <div class="pull-right">
                            <?php $formHelper->inputFormStart('/admin/plugin-manager/install-plugin'); ?>
                                <?php
                                foreach($plugin as $attribute => $value) {
                                    if (((string)(strpos($attribute, 'admin')) !== ((string)0))) {
                                        $formHelper->inputHidden($attribute, $value);
                                    }
                                }
                                $formHelper->inputSubmit('submit', 'Install', array('class' => 'pure-button'));
                                ?>
                            <?php $formHelper->inputFormEnd(); ?>
                        </div>
                    </div>
                </div>
                <div class="pure-g-r plugin-body">
                    <div class="pure-u-1-2 plugin-body-left">
                        <div class="pure-u-23-24 plugin-description">
                            <p>
                                <strong>Description:</strong>
                            </p>
                            <p>
                                <?php echo urldecode($plugin['description']); ?>
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
                                    <strong>Developer Site:</strong> <a href="<?php echo $plugin['developer_site']; ?>"><?php echo $plugin['developer_site']; ?></a>
                                </p>
                            </div>
                            <div class="pure-u-23-24">
                                <p>
                                    <strong>Developer Email:</strong> <a href="mailto:<?php echo $plugin['developer_email']; ?>"><?php echo $plugin['developer_email']; ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="pure-g-r plugin-title">
                <div class="pure-u-23-24">
                    <h3>No Domain Specific Plugins Available</h3>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>