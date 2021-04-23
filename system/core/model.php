<?php

    /**
     *
     * model class is the main model used to access a database. It uses PDO to
     * connect. Extend this class in your models to access the DB. Raw Framework
     * provides three functions. A single fetch, a fetch all, and a general execution
     * function.
     *
     */
    class Model
    {

        /**
         * db function
         *
         * Database connection function. Grabs database info from system/database.php
         * and tries to establish a connection and returns queries.
         *
         * @return void
         */

        public $connect_pdo;

        protected function db($query_string)
        {

            require SYS_PATH."database.php";

            $servername = $db_host;
            $username = $db_username;
            $password = $db_password;
            $dbname = $db_database;

            try {
                $this->connect_pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $this->connect_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE); // Allow limit to take $var during binding
                $this->connect_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo $e->getMessage();
                die();
            }

            return $this->connect_pdo->prepare($query_string);

        }

        public function db_fetch($query_string, $bind_array = NULL) {


            $statement = $this->db($query_string);

            if($bind_array === NULL) {
                $statement->execute();
            } else {
                $statement->execute($bind_array);
            }
            
            $result = $statement->fetch(PDO::FETCH_ASSOC); 
            
            return $result;
            
        }
        
        public function db_fetch_all($query_string, $bind_array = NULL) {

            $statement = $this->db($query_string);
            
            if($bind_array === NULL) {
                $statement->execute();
            } else {
                $statement->execute($bind_array);            }
            
            $result = $statement->fetchAll(); 
            
            return $result;
            
        }
        
        public function db_execute($statement_string, $bind_array) {

            $statement = $this->db($statement_string);
            $statement->execute($bind_array);

        }

    }