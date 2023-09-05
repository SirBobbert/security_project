<?php
    class Employee{
        // Connection
        private $conn;
        // Table
        private $db_table = "Employee";
        // Columns
        public $id;
        public $name;
        public $email;
        public $age;
        public $designation;
        public $created;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
    
        //get all employees
        public function getEmployees() {
            $sqlQuery = "SELECT id, name, email, age, designation, created FROM {$this->db_table}";
            
            try {
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                // Handle the exception, log or return an error message
                return false;
            }
        }
        
        // CREATE
        public function createEmployee(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":designation", $this->designation);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single employee
    
        public function getSingleEmployee() {
            try {
                $sqlQuery = "SELECT
                                id, 
                                name, 
                                email, 
                                age, 
                                designation, 
                                created
                              FROM
                                {$this->db_table}
                            WHERE 
                               id = ?
                            LIMIT 0,1";
                               
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
                $stmt->execute();
                
                $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($dataRow) {
                    $this->name = $dataRow['name'];
                    $this->email = $dataRow['email'];
                    $this->age = $dataRow['age'];
                    $this->designation = $dataRow['designation'];
                    $this->created = $dataRow['created'];
                    
                    return true; // Employee data found and set
                } else {
                    return false; // No employee found
                }
            } catch (PDOException $e) {
                // Handle the exception, log or return an error message
                return false;
            }
        }
        
        // UPDATE
        public function updateEmployee() {
            try {
                $sqlQuery = "UPDATE {$this->db_table}
                            SET
                                name = :name, 
                                email = :email, 
                                age = :age, 
                                designation = :designation, 
                                created = :created
                            WHERE 
                                id = :id";
                
                $stmt = $this->conn->prepare($sqlQuery);
                
                $this->name = htmlspecialchars(strip_tags($this->name));
                $this->email = htmlspecialchars(strip_tags($this->email));
                $this->age = htmlspecialchars(strip_tags($this->age));
                $this->designation = htmlspecialchars(strip_tags($this->designation));
                $this->created = htmlspecialchars(strip_tags($this->created));
                $this->id = htmlspecialchars(strip_tags($this->id));
                
                // Bind data
                $stmt->bindParam(":name", $this->name);
                $stmt->bindParam(":email", $this->email);
                $stmt->bindParam(":age", $this->age);
                $stmt->bindParam(":designation", $this->designation);
                $stmt->bindParam(":created", $this->created);
                $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
                
                if ($stmt->execute()) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                // Handle the exception, log or return an error message
                return false;
            }
        }
        
        // DELETE
        function deleteEmployee() {
            try {
                $sqlQuery = "DELETE FROM {$this->db_table} WHERE id = ?";
                $stmt = $this->conn->prepare($sqlQuery);
                
                $this->id = htmlspecialchars(strip_tags($this->id));
                
                $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
                
                if ($stmt->execute()) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                // Handle the exception, log or return an error message
                return false;
            }
        }
        
    }
?>