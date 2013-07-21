<?php
/**
 * Create Main Nav Links
 *
 */

$sql->dbSelect('links',
    'label, url',
    'location = :location AND active = :active',
    ['location' => intval(1), 'active' => intval(2)],
    'ORDER BY link_order');
$links = $sql->dbFetch();

$nav1 = "<ul>";

foreach ($links as $link) {

    if (THIS_QUERY_STRING == $link['url']) {
        $activeLink = ' class="current_page_item"';
    } else {
        $activeLink = '';
    }

    if (((string)(strpos($link['url'], 'http')) === ((string)0)) || ((string)(strpos($link['url'], 'www')) === ((string)0))) {
        $nav1 .= '<li' . $activeLink . '><a href="'.$link['url'].'">'.$link['label'].'</a></li>';
    } else {
        $nav1 .= '<li' . $activeLink . '><a href="'.BASE_URL.$link['url'].'">'.$link['label'].'</a></li>';
    }
}

$nav1 .= "</ul>";

unset($links);
unset($link);
unset($activeLink);
