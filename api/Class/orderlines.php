<?php
class OrderLine
{
    private $conn;
    private $table_name = "orderlines";

    public $orderline_id;
    public $product_id;
    public $product_price;
    public $order_id_fk;
    public $quantity;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createOrderLine($product_id, $product_price, $order_id, $quantity)
    {
        $query = "INSERT INTO " . $this->table_name . " (product_id, product_price, order_id_fk, quantity) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $product_id);
        $stmt->bindParam(2, $product_price);
        $stmt->bindParam(3, $order_id);
        $stmt->bindParam(4, $quantity);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrderlinesByOrderID($orderID)
    {
        $sqlQuery = "SELECT products.name AS product_name, orderlines.product_price, orderlines.quantity, orders.total_amount AS total_price
                 FROM orderlines
                 JOIN products ON orderlines.product_id = products.id
                 JOIN orders ON orderlines.order_id_fk = orders.order_id
                 WHERE orderlines.order_id_fk = :order_id";

        try {
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(':order_id', $orderID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            // Handle the exception, log, or return an error message
            return false;
        }
    }





}
?>