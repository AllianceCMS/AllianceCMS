<?php foreach ($adminNavLinks as $categoryLabel => $linkList):?>

    <?php if (isset($linkList['count'])): ?>

        <li class="nav-header hidden-tablet">
            <?php echo $categoryLabel; ?>
        </li>

            <?php foreach ($linkList as $itemLabel => $itemLink): ?>

                <?php if (('catLink' !== $itemLabel) && ('count' !== $itemLabel) && ('activeLink' !== $itemLabel)): ?>

                    <?php $icon = ('Home' === $itemLabel) ? 'icon-home' : 'icon-wrench'; ?>

                    <li<?php echo $active; ?>><a href="<?php echo $itemLink; ?>"><i class="<?php echo $icon; ?>"></i><span class="hidden-tablet"><?php echo $itemLabel; ?></span></a></li>

                <?php endif; ?>

            <?php endforeach;?>

    <?php endif; ?>

<?php endforeach; ?>
