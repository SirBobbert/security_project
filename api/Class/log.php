<?php
class log
{
    // Connection
    private $conn;
    // Table
    private $db_table = "log";
    // Columns
    public $log_id;
    public $timestamp;
    public $event;
    public $source;
    public $message;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create
    public function createLog()
    {
        $sqlQuery = "INSERT INTO " . $this->db_table . "
        (timestamp, event, source, message)
        VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sqlQuery);

        //sanitize
        $this->timestamp=htmlspecialchars(strip_tags($this->timestamp));
        $this->event=htmlspecialchars(strip_tags($this->event));
        $this->source=htmlspecialchars(strip_tags($this->source));
        $this->message=htmlspecialchars(strip_tags($this->message));

        //bind data
        $stmt->bind_param("ssss", $this->timestamp, $this->event, $this->source, $this->message);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>