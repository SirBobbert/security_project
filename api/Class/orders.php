<?php


Class Order{
    //connection
    private $conn;
    // Table
    private $table_name = "orders";
    
    // Columns

      // Db connection
      public function __construct($db){
        $this->conn = $db;
    }
    public function getListOfOrders() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }


    public function createOrder($employee_id, $total_amount, $payment_status, $shipping_address, $order_details) {
    try {
        // Database connection
        $database = new Database();
        $db = $database->getConnection();

        // Prepare the INSERT statement
        $query = "INSERT INTO orders (employee_id, total_amount, payment_status, shipping_address, order_details) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(1, $employee_id);
        $stmt->bindParam(2, $total_amount);
        $stmt->bindParam(3, $payment_status);
        $stmt->bindParam(4, $shipping_address);
        $stmt->bindParam(5, $order_details);
        
        // Execute the query
        if ($stmt->execute()) {
            return "Order created successfully";
        } else {
            return "Error creating order";
        }
    } catch (PDOException $e) {
        // Handle the exception, log, or return an error message
        return "Database error: " . $e->getMessage();
    }
}

public function getOrderById($order_id) {
    try {
        // Prepare the SELECT query
        $query = "SELECT * FROM " . $this->table_name . " WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);
        
        // Bind the order_id parameter
        $stmt->bindParam(1, $order_id, PDO::PARAM_INT);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the order data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Check if the order exists
        if ($row) {
            return $row;
        } else {
            return "Order not found";
        }
    } catch (PDOException $e) {
        // Handle the exception, log, or return an error message
        return "Database error: " . $e->getMessage();
    }
}

public function deleteOrder($order_id) {
    try {
        // Prepare the DELETE query
        $query = "DELETE FROM " . $this->table_name . " WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);
        
        // Bind the order_id parameter
        $stmt->bindParam(1, $order_id, PDO::PARAM_INT);
        
        // Execute the query
        if ($stmt->execute()) {
            return "Order deleted successfully";
        } else {
            return "Error deleting order";
        }
    } catch (PDOException $e) {
        // Handle the exception, log, or return an error message
        return "Database error: " . $e->getMessage();
    }
}

public function updateOrder($order_id, $employee_id, $total_amount, $payment_status, $shipping_address, $order_details) {
    try {
        // Prepare the UPDATE query
        $query = "UPDATE " . $this->table_name . " 
                  SET employee_id = ?, total_amount = ?, payment_status = ?, shipping_address = ?, order_details = ?
                  WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(1, $employee_id);
        $stmt->bindParam(2, $total_amount);
        $stmt->bindParam(3, $payment_status);
        $stmt->bindParam(4, $shipping_address);
        $stmt->bindParam(5, $order_details);
        $stmt->bindParam(6, $order_id, PDO::PARAM_INT);
        
        // Execute the query
        if ($stmt->execute()) {
            return "Order updated successfully";
        } else {
            return "Error updating order";
        }
    } catch (PDOException $e) {
        // Handle the exception, log, or return an error message
        return "Database error: " . $e->getMessage();
    }
}


}

?>


