<?php
session_start();
$rootFolder = "../";
include("conn.php");
include($rootFolder . "includes/database.php");
//echo $user_name." ".$user_pass;
if($_POST){
  if(userExists($conn, $user_name)) {
    if(passwordsMatch($conn, $user_name, $user_pass)) {
      $userID = getUserID($conn, $user_name);
      storeUserData_Cookies($userID, $user_name);
      updateLastSeen($conn, $userID);
      echo "Pozdravljeni, $user_name";
    } else {
      echo "Vpisali ste napacno geslo. Poskusite znova.";
    }
  } else {
    echo "Ta uporabnik ne obstaja.";
  }
}
?> 