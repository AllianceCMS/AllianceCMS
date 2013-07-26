<?php

    require_once("../header.php");
    
    echo var_dump($_POST);
    
    $body = new Template("adminSubmit.tpl.php");
    
    function customHeaders() {
        return "
        <script type=\"text/javascript\" src=\"".HANDLERS."jquery/jquery.js\"></script>
        <script type=\"text/javascript\" src=\"".HANDLERS."wymeditor/jquery.wymeditor.pack.js\"></script>
        <script type=\"text/javascript\">
        
        jQuery(function() {
			jQuery('.wymeditor').wymeditor({
				skin: 'default'
			});
        });
        
        </script>";
    }
    
    require_once("../footer.php");
    
?>