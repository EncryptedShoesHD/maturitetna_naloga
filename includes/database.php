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

  // Close connection
  function disconnect() {
    if($this->conn->ping()) {
      if($this->conn->close()) {
        echo 'Connection closed.<br>';
      }else echo 'Something went wrong while closing the database connection.<br>';
    }
  }

  /*
    $dataToSelect:

    This array variable is used to specify what table columns have to be selected using a query.
    In case of ambiguous column names, make sure to specify the name of the table in front of the column name, like this:

    array(
      "tableName.coloumnName"
    )

    If you would like to use the AS keyword, you can achieve it by doing that:

    array(
      "columnName" => "customColumnName"
    )


    $tableName:

    This variable is used to store the table name from which we are going to select the specified columns.


    $joins

    This array variable is used to specify table joins. You have to use key => value type of arrays!

    array(
      "inner" => array("Table1.Column1 = Table2.Column2", "Table3.Column3 = Table4.Column4"),
      "right" => array(), // Optional, if you don't want or need other joins than inner ones.
    )

    Key must always match the type of join you would like to create. It is not required to use all types of joins.
  */
  function select($dataToSelect, $tableName, $joins) {
    if(!$this->conn->ping()) {
      connect();
    }

    $query = "SELECT ";

    foreach($dataToSelect as $i => $value) {
      if($i == null) $query = $query . $dataToSelect[$i] . ", ";
      else $query = $query . $i . " as $dataToSelect[$i], ";
    }

    $query = substr($query, 0, -2) . " FROM $tableName ";

    if($joins != null) {
      foreach($joins as $i => $value) {
        switch(strtolower($i)) {
          case "inner":
            $query = $query . " INNER JOIN "
        }
      }
    }

    echo $query;
  }
}

?>
