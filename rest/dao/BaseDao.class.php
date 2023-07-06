<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once __DIR__. '/../Config.class.php';

    class BaseDao {

        private $conn;
        private $table_name;

        public function __construct($table_name){
            $this->table_name = $table_name;
            $servername = Config::DB_HOST();
            $username = Config::DB_USERNAME();
            $password = Config::DB_PASSWORD();
            $schema = Config::DB_SCHEME();
            $port = Config::DB_PORT();

            $this->conn = new PDO("mysql:host = $servername;dbname=$schema;port=$port, $username, $password");

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function getAll(){
            $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getByID($id){
            $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name."WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return reset($result);
        }

        public function delete($id){
            $stmt = $this->conn->prepare("DELETE FROM".$this->table_name."WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

        protected function exec_add($params){
            $stmt = "INSERT INTO ".$this->table_name. "(";
            foreach($params as $key->$value){
                $stmt .= " ".$key.",";
            }
            $stmt = substr($stmt,0,-1);
            $stmt .= ") VALUES (" ;
            foreach($params as $key=>$value){
                $stmt .= " :".$key.",";
            }
            $stmt = substr($stmt,0,-1);
            $stmt .= ")";
            $this->conn->prepare($stmt)->execute($params);
            $params['id'] = $this->conn->lastInsertId();
            return $params;
        }

        protected function execUpdate($params,$id){
            
            $stmt = "UPDATE ".$this->table_name." SET ";
            foreach($params as $key=>$value){
                $stmt .= " " .$key ." = :". $key .",";
            }
            $stmt = substr($stmt,0,-2);
            $stmt .= " WHERE id=$id";
            $result = $this->conn->prepare($stmt);
            $result->execute($params);
        }

        public function add($params){
            return $this->exec_add($params);
        }

        public function update($params, $id){
            $this->execUpdate($params, $id);
        }

        protected function query($query,$params){
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        protected function queryUnique($query, $params){
            $result = $this->query($query,$params);
            return reset($result);
        }
    }

?>