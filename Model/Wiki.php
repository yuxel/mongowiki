<?php

class Model_Wiki{

    const MONGODB_CONNECTION_FAILED = "Mongodb connection failed";

    /**
     * singleton instance
     */
    private static $instance;

    private function __construct(){
        $hostAndPort = Config_Mongodb::HOST_PORT;
        $dbName      = Config_Mongodb::DB;
        $collection  = Config_Mongodb::COLLECTION;

        try{
            $connection = new Mongo($hostAndPort,true,true);
            $selectedDb = $connection->selectDB($dbName);

            $this->db   = $selectedDb->selectCollection($collection);
            $this->grid =  $selectedDb->getGridFS();
        }
        catch(Exception $e) {
            throw new Exception(self::MONGODB_CONNECTION_FAILED);
        }

        //$saveStatus = $this->grid->storeFile ("README", array("page"=>"_main"));

/*        
        $foo = $this->grid->find( array("page"=>"_main") );

        foreach($foo as $x) {
            var_dump ($x->getBytes());
        }
        
 */
    }


    public static function getInstance() 
    {
        if (!isset(self::$instance)) {
            $thisClass = __CLASS__;
            self::$instance = new $thisClass;
        }

        return self::$instance;
    }

    function checkIfTitleExists($title) {
        $search = array("title"=>$title);
        $result = $this->db->findOne($search);
        return $result ? true : false;
    }


    function getTitleContent($title, $revision=null) {

        if( $revision ) {
            $_id = new MongoId($revision);
            $search = array("_id"=>$_id, "title"=>$title);
            $content = $this->db->findOne($search);
        }
        else{
            $search = array("title"=>$title);
            $contents = $this->db->find($search)->sort( array('$natural'=>-1) )->limit(1);
            
            foreach($contents as $item) {
                $content = $item;
            }
        }

        if($content) {
            $content['_time'] = $content['_id']->getTimestamp();
            $content['_id'] = $content['_id']->__toString();
        }

        return $content;
    }

    function getTitleFiles($title){


    }

    function getHistory($title) {
        $search = array("title"=>$title);
        $contents = $this->db->find($search)->sort( array('$natural'=>-1) );

        foreach($contents as $content) {
            $content['comment'] = stripslashes($content['comment']);
            $content['author'] = stripslashes($content['author']);

            $content['_time'] = $content['_id']->getTimestamp();
            $content['_id'] = $content['_id']->__toString();
            $history[] = $content;
        }

        return $history;
    }


    function setTitleContent($title, $content, $username, $comment){
        $username = htmlspecialchars ( $username );
        $comment = htmlspecialchars( $comment );
        $data = array("title"=>$title, "content"=>$content, "author"=>$username, "comment"=>$comment);
        $this->db->insert ( $data );

    }

    function putFile($fileToPut, $filename, $page) {
        return $this->grid->storeFile ($fileToPut, array("name"=>$filename, "page"=>$page));
    }

    function getFileHistory($filename, $page) {
    
        $files = $this->grid->find(array("name"=>$filename, "page"=>$page) );

        foreach($files as $file) {
            
            $_id = $file->file['_id'];
            $time = $_id->getTimestamp();
            $revision = $_id->__toString();

            $fileArray[] = array("time"=>$time,
                          "revision"=>$revision);

        }
        
        return $fileArray;
    }


    function getFile($filename, $revision=null) {

    }

}
