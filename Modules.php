<?php
/**
 * Abstract class which all Modules should extend
 */
abstract class Modules{
    
    function setController($controller) {
        $this->_controller = $controller;
    }

    function setView($view) {
        $this->_view = $view;
    }

    function setDb($db) {
        $this->_db = $db;
    }

    function setGrid($grid) {
        $this->_grid = $grid;
    }



    function setModuleContent($content) {
        $this->_view->assign("moduleContent", $content);
    }


    function redirect($url) {
        //$this->_view->assign("otherContent", "<script type=\"text/javascript\">window.location='$url';</script>");
        header("Location: $url");
    }


    /**
     * all modules should implement run();
     */
    abstract function run();
}
