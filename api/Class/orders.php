<?php
class Order
{
    private $conn;
    private $db_table = "orders";
    public $order_id;
    public $user_id;
    public $order_date;
    public $total_amount;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createOrder($user_id, $order_date, $total_amount)
    {
        $query = "INSERT INTO " . $this->db_table . " (user_id, order_date, total_amount) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $order_date);
        $stmt->bindParam(3, $total_amount, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        } else {
            return false;
        }
    }

    public function getOrderById($order_id)
    {
        try {
            $query = "SELECT order_id, user_id, order_date FROM " . $this->db_table . " WHERE order_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $order_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }


    public function getOrders()
    {
        $sqlQuery = "SELECT order_id, user_id, order_date, total_amount FROM {$this->db_table}";

        try {
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Add a method to retrieve orders by user ID
    public function getOrdersByUserID($user_id)
    {
        $query = "SELECT * FROM orders WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }



    public function deleteOrder($order_id)
    {
        try {
            $this->conn->beginTransaction();

            // First, delete associated order lines
            $orderLineQuery = "DELETE FROM orderlines WHERE order_id_fk = ?";
            $stmtOrderLine = $this->conn->prepare($orderLineQuery);
            $stmtOrderLine->bindParam(1, $order_id, PDO::PARAM_INT);

            if (!$stmtOrderLine->execute()) {
                $this->conn->rollBack();
                $errorInfo = $stmtOrderLine->errorInfo();
                return "Error deleting associated order lines: " . $errorInfo[2];
            }

            // Next, delete the order itself
            $orderQuery = "DELETE FROM {$this->db_table} WHERE order_id = ?";
            $stmtOrder = $this->conn->prepare($orderQuery);
            $stmtOrder->bindParam(1, $order_id, PDO::PARAM_INT);

            if (!$stmtOrder->execute()) {
                $this->conn->rollBack();
                $errorInfo = $stmtOrder->errorInfo();
                return "Error deleting order: " . $errorInfo[2];
            }

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return "Database error: " . $e->getMessage();
        }
    }



}

?>