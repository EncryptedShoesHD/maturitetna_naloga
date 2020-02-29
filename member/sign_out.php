<?php
  $rootFolder = "../";
  include($rootFolder . "includes/database.php");
  session_start();
  if(isset($_SESSION) && isset($_SESSION['UserID'])) {
    logout($conn);
  }
  header('Location: ' . $rootFolder);
?>
