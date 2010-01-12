<?php

class Modules_Wiki extends Modules{

    function run() {
        
        $this->model = new Model_Wiki($this->_db);

        $page = $this->_controller->getPage();
        $action = $this->_controller->getAction();

        $this->_view->assign("pageUri", $page );
        $this->_view->assign("action", $action );


        $revision = $_GET['revision'];
        switch($action) {
            case "show":
                        $output = $this->showPage($page, $revision);        
                        break;
            case "save":
                        $content  = $_POST['elm1'];
                        $comment  = $_POST['comment'];
                        $username = $_POST['username'];

                        $this->savePage($page, $content, $username, $comment);        
                       
                        //redirect to show page 
                        $showUrl = $this->_controller->getPageUrl()."/".$page;
                        $this->redirect( $showUrl );

                        break;

            case "history":
                        $output = $this->showHistory($page);        
                        break;
            case "edit":
                        $output = $this->showEditPage($page, $revision);        
                        break;

        }

        $this->setModuleContent ( $output );
    }


    /**
     * show page
     * 
     * @param string $page page title
     * @param string $revision revision
     */
    function showPage($page, $revision=null) {

        $titleContent = $this->model->getTitleContent($page, $revision);

        if($titleContent) {
            //highligtcode
            $titleContent['content'] = $this->highlightCode( $titleContent['content'] );
            
            //url handler, which switchs {|url/to/go|} for this site
            $titleContent['content'] = $this->fixInnerURLs( $titleContent['content'] );

            //tidy up this code
            $titleContent['content'] = $this->tidy ( $titleContent['content'] );
        }

        $this->_view->assign("titleContent", $titleContent );
        $pageContent = $this->_view->fetch("title/show.html");
        
        return $pageContent;
    } 


    /**
     * tidy up $pageContent and return XHTML valid code
     */
    function tidy($pageContent) {

        if( function_exists("tidy_parse_string"))  {
            $config = array('indent' => TRUE,
                            'output-xhtml' => TRUE,
                            'wrap' => 200);

            $tidy = tidy_parse_string($pageContent, $config, 'UTF8');

            $tidy->cleanRepair();

            $pageContent = $tidy->Body()->value;

            $search = '/\<body>(.*?)\<\/body\>/is';
            $pageContent = preg_replace($search,"\\1", $pageContent);
        }
        return $pageContent;
    }

    /**
     * save page to database
     */
    function savePage($page, $content, $username, $comment) {
       
        if(!$page || !$content || !$username || !$comment ) {
            return false;
        }
        $content = $this->safeHtml($content);       

        $this->model->setTitleContent($page, $content, $username, $comment);
    }


    
    /**
     * scans string for codeExample and put this between <pre><code>
     */
    function highlightCode($pageContent) {
        $pageContent = stripslashes($pageContent);

        //@todo this should reduced to one expression
        $search = '/\<p class=\"codeExample\"\>(.*?)\<\/p\>/is';
        $pageContent = preg_replace_callback($search, array( &$this, 'pregReplaceCallbackForHightlight') , $pageContent);

        $search = '/\<span class=\"codeExample\"\>(.*?)\<\/span\>/is';
        $pageContent = preg_replace_callback($search, array( &$this, 'pregReplaceCallbackForHightlight') , $pageContent);

        return $pageContent;
    }
    
    /**
     * preg replace callback for highlighting
     */
    function pregReplaceCallbackForHightlight($string) {
        $text = $string[1]; //found string
        $text =  preg_replace('/\<br(\s*)?\/?\>/i', "\n", $text);
        $return = "<pre><code class=\"codeExample\">".$text."</code></pre>";
        return $return;
    }

    /**
     * editing page
     */
    function showEditPage($page, $revision=null) {

        $titleContent = $this->model->getTitleContent($page, $revision);
        $titleContent['content'] = htmlspecialchars ( $titleContent['content'] );

        $this->_view->assign("titleContent", $titleContent );
        $pageContent = $this->_view->fetch("title/edit.html");

        return $pageContent;
    } 


    /**
     * secure html before save
     *
     * @todo security is not implemented yet
     */
    function safeHtml($content) {
        //@todo we should check magic_quotess
        $content = stripslashes($content);
        return $content;
    }

    /**
     * fixs {|url/to/go|} for web sites' url
     */
    function fixInnerURLs($string){
        $search = '/\{\|(.*?)\|\}/is';
        $url = $this->_controller->getPageUrl();
        $replace =  $url.'/\\1'; 

        $string = preg_replace($search,$replace, $string);

        return $string;
    }


    /**
     * show history
     */
    function showHistory($page) {
        $history = $this->model->getHistory($page);

        $this->_view->assign("history", $history );
        $pageContent = $this->_view->fetch("title/history.html");

        return $pageContent;
    }
}
