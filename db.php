<?php
class DB
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "shopping_list_db";

    private $conn;

    function __construct()
    {
        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        // Create database if it doesn't exist
        $database_creation_query = "CREATE DATABASE IF NOT EXISTS $this->dbname";
        if ($this->conn->query($database_creation_query)) {
            // echo "Database created or already exists.\n";

            $this->conn->select_db($this->dbname);

            // Create table if it doesn't exist
            $table_creation_query = "CREATE TABLE IF NOT EXISTS shopping_list (
                            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(30) NOT NULL,
                            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                            )";
            if (!$this->conn->query($table_creation_query)) {
                // echo "Table created or already exists.\n";
                echo "Error  creating table: " . $this->conn->error;
            }
        } else {
            echo "Error creating database: " . $this->conn->error;
        }
    }

    function addData($item_name)
    {
        $item_insertion_query = "INSERT INTO shopping_list (name) VALUES ('$item_name')";

        if ($this->conn->query($item_insertion_query)) {
            header("location: index.php");
        } else {
            echo "Error: " . $item_insertion_query . "<br>" . $this->conn->error;
        }
    }

    function getAllData($offset, $limit)
    {
        $get_data_query = "SELECT * FROM `shopping_list` LIMIT $offset, $limit";

        $result = $this->conn->query($get_data_query);

        if ($result && $result->num_rows > 0) {
            return $result;
        } elseif ($result) {
            return [];
        } else {
            echo "Error: " . $get_data_query . "<br>" . $this->conn->error;
            return [];
        }
    }

    function getSingleData($id)
    {
        $get_data_query = "SELECT * FROM `shopping_list` WHERE `shopping_list`.`id` = $id";

        $result = $this->conn->query($get_data_query);

        if ($result && $result->num_rows > 0) {
            return $result;
        } elseif ($result) {
            return [];
        } else {
            echo "Error: " . $get_data_query . "<br>" . $this->conn->error;
            return [];
        }
    }

    function updateData($id, $name)
    {
        $update_data_query = "UPDATE `shopping_list` SET `name`='$name' WHERE `shopping_list`.`id` = $id";

        if ($this->conn->query($update_data_query)) {
            header("Location: index.php");
        } else {
            return $this->conn->error;
        }
    }

    function deleteData($id)
    {
        $deletion_query = "DELETE FROM shopping_list WHERE `shopping_list`.`id` = $id";

        if ($this->conn->query($deletion_query)) {
            header("location: index.php");
        } else {
            echo "Error: " . $deletion_query . "<br>" . $this->conn->error;
        }
    }

    function countData()
    {
        $count_query = "SELECT COUNT(*) as total FROM shopping_list";

        $result = $this->conn->query($count_query);

        if ($result) {
            return (int)$result->fetch_assoc()["total"];
        } else {
            echo "Error: " . $result . "<br>" . $this->conn->error;
        }
    }
}
