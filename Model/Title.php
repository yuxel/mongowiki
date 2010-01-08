<?php

class Model_Title{

    function __construct(){
        $this->db = new DBAL_Mongo();
    }


    function getTitleContent($title) {
        $content = $this->db->findOneByTitle($title);


        return $content;
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
