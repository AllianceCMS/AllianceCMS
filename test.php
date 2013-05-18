<?php

    require_once("handlers/fileSystem/const.fileSystem.php");
    
    require_once("handlers/db/connections/dbconnections.php");
    
    require_once("handlers/db/db.php");
    
    //$sql = new Db;
    
    echo "Date: ".$sql->getDbConn()->DBDate(time())."<br /><br />";
    
    /*
    $sql->debug(1);
    
    $sql->dbSelect("users", "*", "id < 10");
    
    $row = $sql->dbFetch();
    echo var_dump($row);
    
    while(!$row->EOF) {
        echo "User Name: ".$row->fields['display_name']."<br /><br />";
        echo "Real Name: ".$row->fields['real_name']."<br /><br />";
        $row->MoveNext();
    }
    */