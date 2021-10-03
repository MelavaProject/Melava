<?php
 
 //	echo " i am in database page"; 

require_once('config.php'); 

define('server_name','localhost');
define('username','adidg');
define('password','qfdZTrgakHzAa');
define('database','adidg_SandaW92');

class Database{
    
    private $connection;
    
    function __construct(){
        $this->open_db_connection();
    }
    private function open_db_connection(){
        
        $this->connection=new mysqli(server_name, username, password, database);
        if ($this->connection->connect_error){
            $this->connection=null;
        }
    }
    public function get_connection(){
        return $this->connection;
    }
    public function query($sql){
        
        $result=$this->connection->query($sql);
        if (!$result){
            return null;

        }
        else{
            return $result;
        }
    }
    
    
   
}
$database=new Database();


?>