<?php

class Model_Wiki{

    function __construct($db){
        $this->db = $db;
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
            $content['_time'] = $content['_id']->getTimestamp();
            $content['_id'] = $content['_id']->__toString();
            $history[] = $content;
        }

        return $history;
    }


    function setTitleContent($title, $content, $username, $comment){
        $data = array("title"=>$title, "content"=>$content, "author"=>$username, "comment"=>$comment);
        $this->db->insert ( $data );

    }

    function upsertTitleFile($file){

    }

    function getFileHistory($title, $file) {


    }

}
