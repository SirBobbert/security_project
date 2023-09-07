<?php
class Order
{
    private $conn;
    private $table_name = "orders";

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
        $query = "INSERT INTO " . $this->table_name . " (user_id, order_date, total_amount) VALUES (?, ?, ?)";
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
            $query = "SELECT * FROM " . $this->table_name . " WHERE order_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $order_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>