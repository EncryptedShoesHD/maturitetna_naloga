<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "redovalnica";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  function userExists($conn, $emailAddressOrUsername) {
    $sql = "SELECT c.CredentialsID FROM Credentials c JOIN User u ON c.CredentialsID = u.CredentialsID WHERE (c.Email = '$emailAddressOrUsername' OR c.Username = '$emailAddressOrUsername') AND u.Active = 1";
    $result = $conn->query($sql);
    if($result->num_rows > 0) return true;
    else return false;
  }

  function passwordsMatch($conn, $emailAddressOrUsername, $password) {
    $sql = "SELECT c.* FROM Credentials c JOIN User u ON c.CredentialsID = u.CredentialsID WHERE (c.Email = '$emailAddressOrUsername' OR c.Username = '$emailAddressOrUsername') AND u.Active = 1 AND c.Password = '" . hash("sha256", $password) . "'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) return true;
    else return false;
  }

  function getUserID($conn, $emailAddressOrUsername) {
    $sql = "SELECT u.UserID FROM Credentials c JOIN User u ON c.CredentialsID = u.CredentialsID WHERE (c.Email = '$emailAddressOrUsername' OR c.Username = '$emailAddressOrUsername') AND u.Active = 1";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row['UserID'];
    }return null;
  }

  function updateLastSeen($conn, $userID) {
    $dt = new DateTime("@" . $_COOKIE['lastSeen']);
    $sql = "UPDATE User u SET u.LastSeen = '" . $dt->format('Y-m-d H:i:s') . "' WHERE u.UserID = '$userID'";
    $conn->query($sql);
  }

  function storeUserData_Cookies($userID) {
    setcookie("lastSeen", time(), time() + (86400 * 30), "/");
    $_SESSION['UserID'] = $userID;
  }

  function logout($conn) {
    $userID = $_SESSION['UserID'];
    updateLastSeen($conn, $userID);
    session_unset();
    session_destroy();
  }

  function removeAccount($conn) {
    $userID = $_SESSION['UserID'];
    updateLastSeen($conn, $userID);
    $sql = "UPDATE User u SET u.Active = '0' WHERE u.UserID = '$userID'";
    $conn->query($sql);
    session_unset();
    session_destroy();
  }

?>
