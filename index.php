<?php

include('includes/database.php');

$database = new Database("redovalnica");
$database->connect();
$database->close();
$database->disconnect();

?>
