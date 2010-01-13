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
    function initModel(){
        try {
            $modelInstance = Model_Wiki::getInstance();
        }
        catch(Exception $e) {
            return false;
        }
        
        return true;
    }


    /**
     * get current module from controller 
     * then set view, db and controller to 
     * related module
     */
    function initModule () {

        $this->url = $this->controller->getPageUrl(); 
        $this->view->assign("ThemeDir", $this->url."/".$this->view->template_dir);
        $this->view->assign("URL", $this->url);

        if(!$this->initModel() ) {
            $this->view->assign("fatalError", "MONGODB_CONNECTION_FAILED");
        } 
        else{
            $moduleClass = "Modules_". $this->controller->getModule();
            $this->module = new $moduleClass;
        
            $this->module->setController ( $this->controller );
            $this->module->setView ( $this->view );
            $this->module->setGrid ( $this->grid );
          
            $this->module->run();
        }
        return $this;
    }

    function output(){
        $this->view->displayMainPage();
    }

}
