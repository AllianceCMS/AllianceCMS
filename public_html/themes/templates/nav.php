<?php

/**
 * Create Main Nav Menu
 *
 */

/*
$select = $connection->newSelect();
$select->cols(['label, url'])
->from('a_links')
->where('location = :location')
->where('active = :active')
->orderBy(['link_order']);
$bind = ['location' => intval(1), 'active' => intval(2)];
$links = $connection->fetchAll($select, $bind);
//*/

$sql->dbSelect('links',
    'label, url',
    'location = :location AND active = :active',
    ['location' => intval(1), 'active' => intval(2)],
    'ORDER BY link_order');
$links = $sql->dbFetch();

/*
echo '<br />$links: ';
echo print_r($links);
echo '<br />';
exit;
//*/


/*
$sql->dbSelect("links", "label, url", "link_area = 1 AND active = 2 ORDER BY link_order");
$row = $sql->dbFetch();
//*/

$nav1 = "<ul>";

foreach ($links as $link) {
    /*
    echo '<br />$link: ';
    echo print_r($link);
    echo '<br />';
    //exit;
    //*/

    if (THIS_PATH == $link['url']) {
        $activeLink = " class=\"current_page_item\"";
    } else {
        $activeLink = "";
    }

    if (((string)(strpos($link['url'], "http")) === ((string)0)) || ((string)(strpos($link['url'], "www")) === ((string)0))) {
        $nav1 .= "<li{$activeLink}><a href=\"".$link['url']."\">".$link['label']."</a></li>";
    } else {
        $nav1 .= "<li{$activeLink}><a href=\"".BASE_URL.$link['url']."\">".$link['label']."</a></li>";
    }
}
/*
while (!$row->EOF) {

    if (THIS_PATH == $row->fields['url']) {
        $activeLink = " class=\"current_page_item\"";
    } else {
        $activeLink = "";
    }

    if (((string)(strpos($row->fields['url'], "http")) === ((string)0)) || ((string)(strpos($row->fields['url'], "www")) === ((string)0))) {
        $nav1 .= "<li{$activeLink}><a href=\"".$row->fields['url']."\">".$row->fields['label']."</a></li>";
    } else {
        $nav1 .= "<li{$activeLink}><a href=\"".BASEDIR.$row->fields['url']."\">".$row->fields['label']."</a></li>";
    }

    $row->MoveNext();
}
//*/

$nav1 .= "</ul>";
