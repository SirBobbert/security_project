<?php
class User
{
    // Connection
    private $conn;
    // Table
    private $db_table = "users";
    // Columns
    public $id;
    public $name;
    public $email;
    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all users
    public function getUsers()
    {
        $sqlQuery = "SELECT id, email, password, typeID FROM {$this->db_table}";

        try {
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            // Handle the exception, log, or return an error message
            return false;
        }
    }


    // CREATE
    public function createUser()
    {
        $sqlQuery = "INSERT INTO
                    " . $this->db_table . "
                SET
                    email = :email, 
                    password = :password, 
                    typeID = :typeID";

        $stmt = $this->conn->prepare($sqlQuery);

        // Sanitize
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->typeID = htmlspecialchars(strip_tags($this->typeID));

        // Bind data
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":typeID", $this->typeID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    // READ single user
    public function getSingleUser()
    {
        try {
            $sqlQuery = "SELECT
                        id, 
                        email, 
                        password, 
                        typeID
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
                $this->email = $dataRow['email'];
                $this->password = $dataRow['password'];
                $this->typeID = $dataRow['typeID'];

                return true; // User data found and set
            } else {
                return false; // No user found
            }
        } catch (PDOException $e) {
            // Handle the exception, log, or return an error message
            return false;
        }
    }


    // UPDATE
    public function updateUser()
    {
        try {
            $sqlQuery = "UPDATE {$this->db_table}
                        SET
                            email = :email, 
                            password = :password, 
                            typeID = :typeID
                        WHERE 
                            id = :id";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->typeID = htmlspecialchars(strip_tags($this->typeID));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":typeID", $this->typeID);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            // Handle the exception, log, or return an error message
            return false;
        }
    }


    // DELETE
    function deleteUser()
    {
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
            // Handle the exception, log, or return an error message
            return false;
        }
    }
}
?>