<?php

    /**
     * Create Main Nav Menu
     *
     */
    
    $sql->dbSelect("links", "label, url", "link_area = 1 AND active = 2 ORDER BY link_order");
    $row = $sql->dbFetch();
    
    $nav1 = "<ul>";
    
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
    
    $nav1 .= "</ul>";
    