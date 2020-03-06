<?php

class Database {
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname;

  private $conn;

  function __construct($dbname) {
    $this->dbname = $dbname;
  }

  // Create connection
  function connect() {
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

    // Check connection
    if ($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
    }
    echo "Connected successfully.<br>";
    return $this->conn;
  }

  function disconnect() {
    if($this->conn->ping()) {
      if($this->conn->close()) {
        echo 'Connection closed.<br>';
      }else echo 'Something went wrong while closing the database connection.<br>';
    }
  }

  function select() {

  }
}

?>
