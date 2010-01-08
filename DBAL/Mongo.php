<?
class DBAL_Mongo {

    function __construct(){
          $connection = new Mongo();
          $this->db = $connection->foo->bar; 
    }
        

   public function __call($name, $arguments) {
        if( preg_match("/^findOneBy/", $name) ) {
            $key = substr($name, 9);
            $value = $arguments[0];
            return $this->findOneByKey($key, $value);
        }
   }

   
   function findOneByKey($key, $value){
        $key = strtolower($key);
        $search = array($key=>$value);
        return $this->db->findOne($search);
    }
  

   function upsert($keys, $values){


    } 

}
