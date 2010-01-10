<?

class View extends Smarty{

    public function __construct($theme){

        $this->template_dir = "View/Templates/$theme";
        $this->compile_dir = "View/_Compiled";
        $this->cache_dir = "View/_Cache";
       
        $this->plugins_dir[] = "View/Plugins";

        //$this->view->compile_id = implode("_",(array)$this->url->urlStrings);
        //$this->view->cache_id = implode("_",(array)$this->url->urlStrings);

        //$this->view->force_compile = true;
        //$this->view->compile_check = true;
        //$smarty->debugging = true;

    }

    /**
     * display mainContent.html
     */
    function displayMainPage(){
        $this->display ( "mainContent.html");
    }
}
