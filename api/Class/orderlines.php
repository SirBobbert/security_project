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
}
?>