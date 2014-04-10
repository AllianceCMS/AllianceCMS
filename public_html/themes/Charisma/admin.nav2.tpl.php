<?php $countIteration = 0; ?>
<?php foreach ($adminNavLinks as $categoryLabel => $linkList):?>
    <?php if (0 === $countIteration): ?>
        <?php $inElement = ' in'; ?>
    <?php else: ?>
        <?php $inElement = ''; ?>
    <?php endif; ?>
    <?php if (isset($linkList['count'])): ?>
        <li class="nav-header hidden-tablet accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $countIteration; ?>">
            <?php echo $categoryLabel; ?>
            <!-- <span class="badge pull-right"> -->
                <?php /*echo $linkList['count'];*/ ?>
            <!-- </span> -->
        </li>
        <!-- <div id="collapse<?php /*echo $countIteration;*/ ?>" class="collapse"> -->
        <?php foreach ($linkList as $itemLabel => $itemLink): ?>
            <?php if (('catLink' !== $itemLabel) && ('count' !== $itemLabel) && ('activeLink' !== $itemLabel)): ?>
                <?php $icon = ('Admin Home' === $itemLabel) ? 'icon-home' : 'icon-cog'; ?>
                <li><a href="<?php echo $itemLink; ?>"><i class="<?php echo $icon; ?>"></i><span class="hidden-tablet"><?php echo $itemLabel; ?></span></a></li>
            <?php endif; ?>
        <?php endforeach;?>
        <!-- </div> -->
    <?php endif; ?>
    <?php ++$countIteration; ?>
<?php endforeach; ?>