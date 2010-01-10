<?php

class Controller_IndexController{
    private $_page;
    private $_action;

    /**
     * explode query string
     * and detect page and action
     *
     * http://mongowiki/this/is/page/@action
     *
     * default action is show, default page is _main
     */
    function __construct(){

        $queryStrings = explode( "/", $_GET['q'] );

        //detect if last string is empty or an action
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

        $page = implode("/",array_slice($queryStrings, 0, $queryCount) );
        $this->_page = $page ? $page : "_main";

    }

    /**
     * returns base url of mongowiki
     */
    function getPageUrl(){
        $host = "http://".$_SERVER['HTTP_HOST'];
        $baseDir = substr($_SERVER['PHP_SELF'],0,-9);
        $url = trim($host. $baseDir, "/");

        return $url;
    }
    

    /**
     * return related module
     * if user logged in module is Wiki
     * else module is Auth
     */
    function getModule () {
        //@todo if user not logged this should change
        return "Wiki";
    }


    /**
     * get page
     */
    function getPage() {
        return $this->_page;
    }

    /**
     * get action
     */
    function getAction() {
        return $this->_action;
    }

}
