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
        $sqlQuery = "SELECT
            orderlines.orderline_id,
            products.id AS product_id,
            products.name AS product_name,
            orderlines.product_price,
            orderlines.quantity,
            orders.total_amount AS total_price
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

    public function deleteOrderLine($orderline_id)
    {
        // Implement the logic to delete an order line by its ID
        // For example, you can perform a database query to delete the record
        // Make sure to handle any potential errors and return a success/failure status

        // Sample implementation (you'll need to adjust this to fit your database structure)
        $query = "DELETE FROM orderlines WHERE orderline_id = :orderline_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':orderline_id', $orderline_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true; // Order line deleted successfully
        } else {
            return false; // Failed to delete order line
        }
    }





}
?>