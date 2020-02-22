<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
</html>

<?php

include('includes/site-parts/navbar.php');

/*include('includes/database.php');

$database = new Database("redovalnica");
$database->connect();
$database->select(
  array(
    "person_id" => "pid",
    'name'),
  'People',
  array(
    "inner" => array(
      "Employed" => "People.person_id = Employed.person_id",
      "Employer" => "Employed.person_id = Employer.employer_id"
    )
  ),
  "name LIKE 'a%'"
);
echo '<br>';
$database->disconnect();*/

?>
