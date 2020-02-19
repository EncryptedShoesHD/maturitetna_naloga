<?php

include('includes/database.php');

$database = new Database("redovalnica");
$database->connect();
$database->select(array("person_id" => "pid", 'name'), 'People', array("inner" => array("People.person_id = Employed.person_id")));
echo '<br>';
$database->disconnect();

?>
