<div id="sidebar">
	<h1 id="logo"><a href="index.php"></a></h1>
	<a href="<?php echo $basePath; ?>/admin/dashboard" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
	<ul>

        <?php foreach ($adminNavLinks as $categoryLabel => $linkList):?>

            <?php
            $activeCategorySingle = ((isset($linkList['activeLink'])) || (isset($linkList['activeCategoryLink']))) ? ' class="active"' : '';
            $activeCategoryMulti = ((isset($linkList['activeLink'])) || (isset($linkList['activeCategoryLink']))) ? 'active ' : '';
            ?>

            <?php $icon = ('Dashboard' === $categoryLabel) ? 'icon-home' : 'icon-wrench'; ?>

            <?php if (!isset($linkList['count'])): ?>

                <li<?php echo $activeCategorySingle; ?>><a href="<?php echo $linkList['catLink']; ?>"><i class="icon <?php echo $icon; ?>"></i> <span><?php echo $categoryLabel; ?></span></a></li>

            <?php else: ?>

                <?php
                if(isset($linkList['activeLink']))
                    $active = ($linkList['activeLink'] == $linkList['catLink']) ? 'active ' : '';
                ?>

                <li class="<?php echo $activeCategoryMulti; ?>submenu">
                    <a href="<?php echo $linkList['catLink']; ?>"><i class="icon <?php echo $icon; ?>"></i> <span><?php echo $categoryLabel; ?></span> <span class="label"><?php echo $linkList['count']; ?></span></a>
                    <ul>

                        <?php foreach ($linkList as $itemLabel => $itemLink): ?>

                            <?php if (('catLink' !== $itemLabel) && ('count' !== $itemLabel) && ('activeLink' !== $itemLabel)): ?>

                                <?php
                                if(isset($linkList['activeLink']))
                                    $active = ($linkList['activeLink'] == $itemLink) ? ' class="active"' : '';
                                ?>

                                <li<?php echo $active; ?>><a href="<?php echo $itemLink; ?>"><?php echo $itemLabel; ?></a></li>

                            <?php endif; ?>

                        <?php endforeach;?>

        			</ul>
        		</li>

            <?php endif; ?>

        <?php endforeach; ?>

	</ul>
</div>