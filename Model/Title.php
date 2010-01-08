<?php

class Model_Title{

    function __construct(){
        $db = new Mongo();
        $database = "wiki";
        $collection = "pages";
        $this->model = $db->$database->$collection;
    }


    function getTitleContent($title) {
        

    }

    function getTitleFiles($title){


    }

    function getModelHistory($title) {


    }


    function setTitleContent($title){


    }

    function upsertTitleFile($file){

    }

    function getFileHistory($title, $file) {


    }

}
