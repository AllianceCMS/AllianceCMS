<?php if (isset($installationSuccessful)): ?>
    <div class="pure-g-r">
        <div class="pure-u-1">
            <div class="acms-alert alert-success fade in">
                <strong>Module Successfully Installed!</strong>
                <a href="#" data-dismiss="alert" class="close">&times;</a>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="pure-g-r">
    <div class="pure-u-3-4">
        <div class="pure-g-r">
            <div class="pure-u-1">
                <h1>Install Modules</h1>
                <hr>
            </div>
        </div>

        <div class="pure-g-r">
            <div class="pure-u-1">
                <h2>Domain Wide Modules</h2>
            </div>
        </div>
        <?php if (!empty($zoneAllModules)): ?>
            <?php foreach ($zoneAllModules as $module): ?>
                <div class="pure-g-r module-title">
                    <div class="pure-u-23-24">
                        <div class="pull-left">
                            <strong><?php echo $module['name']; ?> v<?php echo $module['version']; ?></strong>
                        </div>
                        <div class="pull-right">
                            <?php $formHelper->inputFormStart('/admin/module-manager/install-module'); ?>
                                <?php
                                foreach($module as $attribute => $value) {
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
                <div class="pure-g-r module-body">
                    <div class="pure-u-1-2 module-body-left">
                        <div class="pure-u-23-24 module-description">
                            <p>
                                <strong>Description:</strong>
                            </p>
                            <p>
                                <?php echo urldecode($module['description']); ?>
                            </p>
                        </div>
                    </div>
                    <div class="pure-u-1-2 module-body-right">
                        <div class="pure-u-1 module-links">
                            <div class="pure-u-23-24">
                                <p>
                                    <strong>Developer:</strong> <?php echo $module['developer']; ?>
                                </p>
                            </div>
                            <div class="pure-u-23-24">
                                <p>
                                    <strong>Developer Site:</strong> <a href="<?php echo $module['developer_site']; ?>"><?php echo $module['developer_site']; ?></a>
                                </p>
                            </div>
                            <div class="pure-u-23-24">
                                <p>
                                    <strong>Developer Email:</strong> <a href="mailto:<?php echo $module['developer_email']; ?>"><?php echo $module['developer_email']; ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="pure-g-r module-title">
                <div class="pure-u-23-24">
                    <h3>No Modules Available</h3>
                </div>
            </div>
        <?php endif; ?>

        <div class="pure-g-r">
            <div class="pure-u-1">
                <h2>Domain Specific Modules</h2>
            </div>
        </div>
        <?php if (!empty($zoneSpecificModules)): ?>
            <?php foreach ($zoneSpecificModules as $module): ?>
                <div class="pure-g-r module-title">
                    <div class="pure-u-23-24">
                        <div class="pull-left">
                            <strong><?php echo $module['name']; ?> v<?php echo $module['version']; ?></strong>
                        </div>
                        <div class="pull-right">
                            <?php $formHelper->inputFormStart('/admin/module-manager/install-module'); ?>
                                <?php
                                foreach($module as $attribute => $value) {
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
                <div class="pure-g-r module-body">
                    <div class="pure-u-1-2 module-body-left">
                        <div class="pure-u-23-24 module-description">
                            <p>
                                <strong>Description:</strong>
                            </p>
                            <p>
                                <?php echo urldecode($module['description']); ?>
                            </p>
                        </div>
                    </div>
                    <div class="pure-u-1-2 module-body-right">
                        <div class="pure-u-1 module-links">
                            <div class="pure-u-23-24">
                                <p>
                                    <strong>Developer:</strong> <?php echo $module['developer']; ?>
                                </p>
                            </div>
                            <div class="pure-u-23-24">
                                <p>
                                    <strong>Developer Site:</strong> <a href="<?php echo $module['developer_site']; ?>"><?php echo $module['developer_site']; ?></a>
                                </p>
                            </div>
                            <div class="pure-u-23-24">
                                <p>
                                    <strong>Developer Email:</strong> <a href="mailto:<?php echo $module['developer_email']; ?>"><?php echo $module['developer_email']; ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="pure-g-r module-title">
                <div class="pure-u-23-24">
                    <h3>No Modules Available</h3>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>