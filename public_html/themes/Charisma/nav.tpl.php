<?php
$navString = '';

foreach ($links as $link) {

    if (THIS_QUERY_STRING == $link['url']) {
        $activeLink = ' class="active"';
    } else {
        $activeLink = '';
    }

    if (((string)(strpos($link['url'], 'http')) === ((string)0)) || ((string)(strpos($link['url'], 'www')) === ((string)0))) {
        $navString .= '<li' . $activeLink . '><a href="' . $link['url'].'">' . $link['label'] . '</a></li>';
    } else {
        $navString .= '<li' . $activeLink . '><a href="' . BASE_URL . '/' . $currentVenue . $link['url'] . '">' . $link['label'] . '</a></li>';
    }
}

echo $navString;
