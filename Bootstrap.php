<?php
class Bootstrap{

    /**
     * Init index controller
     */
    function initController(){
        $this->controller = new Controller_IndexController();
        return $this;
    }
    
    /**
     * init view which extends Smarty
     */
    function initView(){
        //@todo this should read from a config
        $theme = "Default";
        $this->view = new View($theme);

        
        return $this;
    }


    /**
     * init mongo
     */
    function initDb(){
        //@todo db and collection should read
        //@todo from an config file
        //@todo exception should be handled
       
        $hostAndPort = "localhost:27017";
        $dbName      = "foo";
        $collection  = "bar";
        $connection = new Mongo($hostAndPort,true,true);
        $selectedDb = $connection->selectDB($dbName);

        $this->db   = $selectedDb->selectCollection($collection);
        $this->grid =  $selectedDb->getGridFS();
        
        return $this;
    }


    /**
     * get current module from controller 
     * then set view, db and controller to 
     * related module
     */
    function initModule () {
        $moduleClass = "Modules_". $this->controller->getModule();
        $this->module = new $moduleClass;
    
        $this->url = $this->controller->getPageUrl(); 
        $this->view->assign("ThemeDir", $this->url."/".$this->view->template_dir);
        $this->view->assign("URL", $this->url);

        $this->module->setController ( $this->controller );
        $this->module->setView ( $this->view );
        $this->module->setDb ( $this->db );
        $this->module->setGrid ( $this->grid );
      
        $this->module->run();
        return $this;
    }

    function output(){
        $this->view->displayMainPage();
    }

}
