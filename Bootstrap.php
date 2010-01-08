<?php
class Bootstrap{

    function initController(){
        $this->controller = new Controller_IndexController();
        return $this;
    }

    function initModule () {
        $moduleClass = "Modules_". $this->controller->getModule();
        $this->module = new $moduleClass;
        $this->module->setController ( $this->controller );
        $this->module->run();
        return $this;
    }

}
