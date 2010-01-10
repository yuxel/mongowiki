<?
include_once("AutoLoader.php");

/**
 * read url and run related module
 * then output page content
 */
$bootstrap = new Bootstrap();

$bootstrap->initController()
          ->initView()
          ->initDb()
          ->initModule()
          ->output();
