<?php

class Controller_IndexController{

    function __construct(){
        $queryStrings = explode( "/", $_GET['q'] );

        $totalCount = $queryCount = count($queryStrings);

        $lastString = end ($queryStrings );

        if( empty($lastString) ) {
            $this->_action = "show";
            $queryCount--;
        }
        elseif( preg_match("/^@/", $lastString) ) {
            $this->_action = substr($lastString,1);
            $queryCount--;
        }
        else{
            $this->_action = "show";
        }

        $page = implode("::",array_slice($queryStrings, 0, $queryCount) );

        $this->page = $page;

    }

    function getModule () {
        return "Title";
    }


    function getPage() {
        return $this->_page;
    }


}
