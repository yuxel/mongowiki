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


    function setModuleContent($content) {
        $this->_view->assign("moduleContent", $content);
    }

    /**
     * all modules should implement run();
     */
    abstract function run();
}
