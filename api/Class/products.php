<?php
    class Product{
        // Connection
        private $conn;
        // Table
        private $db_table = "products";
        //Columns

        public $id;
        public $name;
        public $price; 
        public $description;
        // db connection
        public function __construct($db){
            $this->conn = $db;
    }

        // Get all Products
    public function getProducts() {
        $sqlQuery = "SELECT id, name, price, description FROM {$this->db_table}";

        try {
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            // Handle the exception, log or return an error message
            return false;
        }
    }

        //Create Product
        public function createProduct(){
            $sqlQuery = "INSERT INTO
            ". $this->db_table ."
        SET
            name = :name,
            price = :price,
            description = :description";

            $stmt = $this->conn->prepare($sqlQuery);
            //sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->price=htmlspecialchars(strip_tags($this->price));
            $this->description=htmlspecialchars(strip_tags($this->description));
            
            //bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":description", $this->description);
            
            if($stmt->execute()){
                return true;
            }
            return false;
        }

         //read single product

         public function getSingleProduct() {
            try {
                $sqlQuery = "SELECT id, name, price, description FROM {$this->db_table} Where id = ? LIMIT 0,1";

                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
                $stmt->execute();

                $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

                if($dataRow){
                    $this->name = $dataRow['name'];
                    $this->price = $dataRow['price'];
                    $this->description = $dataRow['description'];
                    
                    return true; // product data found and set
                }else {
                    return false; // no products found
                }
                } catch (PDOException $e) {
                    // Handle the exception, log or return an error message
                    return false;
                }
            }

            //UPDATE
            public function updateProduct() {
                try {
                    $sqlQuery = "UPDATE {$this->db_table}
                                SET
                                    name = :name, 
                                    price = :price, 
                                    description = :description  
                                WHERE 
                                    id = :id";
                    
                    $stmt = $this->conn->prepare($sqlQuery);
                    
                      // sanitize
                    $this->name = htmlspecialchars(strip_tags($this->name));
                    $this->price = htmlspecialchars(strip_tags($this->price));
                    $this->description = htmlspecialchars(strip_tags($this->description));
                    $this->id = htmlspecialchars(strip_tags($this->id));

                          // Bind data
                    $stmt->bindParam(":name", $this->name);
                    $stmt->bindParam(":price", $this->price);
                    $stmt->bindParam(":description", $this->description);
                    $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        return true;
                    }
                    return false;
                } catch (PDOException $e) {
                    // Handle the exception, log or return an error message
                    error_log("Error updating product: " . $e->getMessage());
                    return false;
                }
            }

            // DELETE
        function deleteProduct() {
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