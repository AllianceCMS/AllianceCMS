<?php if (isset($adminNavigation['submenu'])): ?>
<li class="<?php echo $active; ?> submenu">
    <a href="<?php echo $adminNavigation['link']; ?>">

        <?php if($pluginFolder === 'Admin'): ?>
            <i class="icon icon-home"></i>
        <?php else: ?>
            <i class="icon icon-wrench"></i>
        <?php endif; ?>

        <span><?php echo $adminNavigation['title']; ?></span> <span class="label"><?php echo $numberOfItems; ?></span>
    </a>
    <ul>
        <?php foreach($adminNavigation['submenu'] as $title => $link): ?>

            <?php
            $classActive = '';
            if (isset($adminNavigation['activeSublink'])) {
                if ($adminNavigation['activeSublink'] === $link) {
                    $classActive = ' class="active"';
                }
            }
            ?>

            <li<?php echo $classActive; ?>><a href="<?php echo $link; ?>"><?php echo $title; ?></a></li>

        <?php endforeach; ?>
    </ul>
</li>
<?php else: ?>
<li class="<?php echo $active; ?>">
    <a href="<?php echo $adminNavigation['link']; ?>">

        <?php if($pluginFolder === 'Admin'): ?>
            <i class="icon icon-home"></i>
        <?php else: ?>
            <i class="icon icon-wrench"></i>
        <?php endif; ?>

        <span><?php echo $adminNavigation['title']; ?></span>
    </a>
</li>
<?php endif; ?>