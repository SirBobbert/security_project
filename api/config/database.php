<?php
$host = 'localhost';
$username = 'root'; // Change this to your MySQL username
$password = ''; // Change this to your MySQL password
$database = 'demo';

$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    echo "ayo";
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully to the database!";
mysqli_close($conn);
?>



<?php
class Database
{
    private $host = "127.0.0.1";
    private $database_name = "testdbsecurity";
    private $username = "root";
    public $conn;
    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>