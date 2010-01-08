<?php

class Modules_Title extends ModulesAbstract{

    function run() {
        $this->model = new Model_Title();
        $page = $this->_controller->getPage();
        $action = $this->_controller->getAction();

        switch($action) {
            case "show":
                        $this->showPage($page);        
                        break;

        }

    }


    function showPage($page) {
        $pageContent = $this->model->getTitleContent($page);

        var_dump ( $pageContent );
        return $pageContent;
    } 

    function showDeletePage($page){
        
    }




}
