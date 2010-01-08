<?php

function __autoload($className) {
    $namespaces = explode("_",$className);
    $filePath   = implode("/",$namespaces);
    require_once( $filePath. ".php");
}
