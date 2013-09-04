<div class="row-fluid">
    <div class="span12">
        <div class="tabbable">
            <ul class="nav nav-tabs">

                <?php $countLabels = 1;?>
                <?php foreach ($tabLabels as $index => $label): ?>
                    <?php if ((int) $index === 0): ?>
                        <li class="active"><a href="#tab<?php echo $countLabels; ?>" data-toggle="tab"><?php echo $label; ?></a></li>
                    <?php else: ?>
                        <li><a href="#tab<?php echo ++$index; ?>" data-toggle="tab"><?php echo $label; ?></a></li>
                    <?php endif; ?>
                    <?php ++$countLabels?>
                <?php endforeach; ?>

            </ul>
            <div class="tab-content">

                <?php $countContent = 1;?>
                <?php foreach ($tabContent as $index => $content): ?>
                    <?php if ((int) $index === 0): ?>
                        <div class="tab-pane active" id="tab<?php echo $countContent; ?>">
                            <?php echo $content; ?>
                        </div>
                    <?php else: ?>
                        <div class="tab-pane" id="tab<?php echo $countContent; ?>">
                            <?php echo $content; ?>
                        </div>
                    <?php endif; ?>
                    <?php ++$countContent?>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>