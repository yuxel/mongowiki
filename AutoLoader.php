<?php

/**
 * autoloader
 */
function __autoload($className) {
    //exception for smarty
    if($className == "Smarty"){
        require_once ("3rdParty/smarty/libs/Smarty.class.php");
    }
    else{
        $namespaces = explode("_",$className);
        $filePath   = implode("/",$namespaces);
        require_once( $filePath. ".php");
    }
}
