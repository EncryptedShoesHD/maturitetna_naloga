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
  } else {
    $conn->set_charset("utf8");
  }

  function userExists($conn, $emailAddressOrUsername) {
    $sql = "SELECT c.CredentialsID FROM Credentials c JOIN User u ON c.CredentialsID = u.CredentialsID WHERE (c.Email = '$emailAddressOrUsername' OR c.Username = '$emailAddressOrUsername') AND u.Active = '1'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) return true;
    else return false;
  }

  function passwordsMatch($conn, $emailAddressOrUsername, $password) {
    $sql = "SELECT c.* FROM Credentials c JOIN User u ON c.CredentialsID = u.CredentialsID WHERE (c.Email = '$emailAddressOrUsername' OR c.Username = '$emailAddressOrUsername') AND u.Active = '1' AND c.Password = '" . hash("sha256", $password . getSalt($conn, $emailAddressOrUsername)) . "'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) return true;
    else return false;
  }

  function getUserID($conn, $emailAddressOrUsername) {
    $sql = "SELECT u.UserID FROM Credentials c JOIN User u ON c.CredentialsID = u.CredentialsID WHERE (c.Email = '$emailAddressOrUsername' OR c.Username = '$emailAddressOrUsername') AND u.Active = '1'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row['UserID'];
    }return null;
  }

  function getSalt($conn, $emailAddressOrUsername) {
    $sql = "SELECT c.Salt FROM Credentials c JOIN User u ON c.CredentialsID = u.CredentialsID WHERE (c.Email = '$emailAddressOrUsername' OR c.Username = '$emailAddressOrUsername') AND u.Active = '1'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row['Salt'];
    }return null;
  }

  function updateLastSeen($conn, $userID) {
    setcookie("lastSeen", time(), time() + (86400 * 30), "/");
    if(isset($_COOKIE['lastSeen']))$dt = new DateTime("@" . $_COOKIE['lastSeen']);
    else $dt = new DateTime();
    $sql = "UPDATE User u SET u.LastSeen = '" . $dt->format('Y-m-d H:i:s') . "' WHERE u.UserID = '$userID'";
    $conn->query($sql);
  }

  function storeUserData_Cookies($userID, $emailAddressOrUsername) {
    setcookie("lastSeen", time(), time() + (86400 * 30), "/");
    $_SESSION['UserID'] = $userID;
    $_SESSION['username'] = $emailAddressOrUsername;
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

  function createAccount($conn, $username, $email, $password, $name, $surname) {
    $dt = new DateTime("@" . time());
    $salt = bin2hex(random_bytes(32));
    $query = "INSERT INTO Credentials(Email, Username, Password, Salt) VALUES ('$email', '$username', '" . hash("sha256", $password . $salt) . "', '$salt')";
    if($conn->query($query)) {
      $lastID = $conn->insert_id;
      $query = "INSERT INTO User(CredentialsID, RoleID, Name, Surname, CreatedOn, Active) VALUES ($lastID, 2, '$name', '$surname', '" . $dt->format('Y-m-d H:i:s') . "', '1')";
      $conn->query($query);
    }
  }

  function getUserInfo($conn) {
    $sql = "SELECT Name, Surname, Email, Username FROM Credentials c JOIN User u ON c.CredentialsID = u.CredentialsID WHERE u.UserID = '" . $_SESSION['UserID'] . "'";
    return $conn->query($sql);
  }

  function changeNameAndSurname($conn, $userID, $name, $surname) {
    $sql = "UPDATE User u SET u.Name = '$name', u.Surname = '$surname' WHERE u.UserID = '$userID'";
    if($conn->query($sql)) {
      return true;
    }
    return false;
  }

  function changeUsername($conn, $userID, $username) {
    $sql = "UPDATE Credentials c JOIN User u ON c.CredentialsID = u.CredentialsID SET c.Username = '$username' WHERE u.UserID = '$userID'";
    if($conn->query($sql)) {
      return true;
    }
    return false;
  }

  function createSubject($conn, $title, $shortcode) {
    $sql = "INSERT INTO Subjects(CreatedBy, Title, Shortcode, Active) VALUES ('" . $_SESSION['UserID'] . "', '$title', '$shortcode', '1')";
    if($conn->query($sql)) {
      return true;
    }
    return false;
  }

  function getActiveSubjects($conn, $userID) {
    $sql = "SELECT SubjectID, Title FROM Subjects s WHERE (s.CreatedBy = '$userID' OR s.CreatedBy = 1) AND s.Active = 1 ORDER BY Title";
    return $conn->query($sql);
  }

  function getActiveExaminations($conn, $userID, $subjectID) {
    $sql = "SELECT ExaminationID, Date FROM Examinations e WHERE e.Active = 1 AND e.UserID = '$userID' AND e.SubjectID = '$subjectID' ORDER BY Date ASC";
    return $conn->query($sql);
  }

  function isFollowingSubject($conn, $userID, $subjectID) {
    $sql = "SELECT * FROM UnfollowedSubjects WHERE SubjectID = '$subjectID' AND UserID = '$userID'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) return false;
    else return true;
  }

  function followSubject($conn, $userID, $subjectID) {
    if(!isFollowingSubject($conn, $userID, $subjectID)) {
      $sql = "DELETE FROM UnfollowedSubjects WHERE UserID = '$userID' AND SubjectID = '$subjectID'";
      $conn->query($sql);
    }
  }

  function unfollowSubject($conn, $userID, $subjectID) {
    if(isFollowingSubject($conn, $userID, $subjectID)) {
      $sql = "INSERT INTO UnfollowedSubjects(SubjectID, UserID) VALUES ('$subjectID', '$userID')";
      $conn->query($sql);
    }
  }

  function getUnfollowedSubjects($conn, $userID) {
    $sql = "SELECT s.SubjectID, s.Title, s.Shortcode FROM UnfollowedSubjects us JOIN Subjects s ON us.SubjectID = s.SubjectID WHERE us.UserID = '$userID' AND s.Active = 1 ORDER BY s.Title";
    return $conn->query($sql);
  }

  function getSubjectTitleAndExaminations($conn, $userID, $subjectID) {
    $sql = "SELECT Title FROM Subjects WHERE SubjectID = '$subjectID'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      $data = array();
      $row = mysqli_fetch_assoc($result);
      $title = $row['Title'];
      $sql = "SELECT Type, Date, Active, ExaminationID FROM Examinations WHERE SubjectID = '$subjectID' AND UserID = '$userID' ORDER BY Date ASC";
      $result = $conn->query($sql);
      $exams = array();
      while($row = mysqli_fetch_assoc($result)) {
        $examData = array();
        array_push($examData, $row['Active'], $row['Type'], $row['Date'], $row['ExaminationID']);
        array_push($exams, $examData);
      }
      $data[$title] = $exams;
      return $data;
    }
    return null;
  }

  function updateExaminations($conn, $userID, $subject, $exams) {
    $subjectData = getSubjectTitleAndExaminations($conn, $userID, $subject);
    $subjects = $subjectData[array_keys($subjectData)[0]];
    $i = 1;
    foreach ($subjects as $key => $value) {
      $sql = "UPDATE Examinations SET Active = '0' WHERE ExaminationID = '$value[3]'";
      $conn->query($sql);
    }
    foreach ($exams as $exam) {
      $sql = "UPDATE Examinations SET Active = '1' WHERE ExaminationID = '$exam'";
      $conn->query($sql);
    }
  }

  function createExamination($conn, $userID, $subjectID, $type, $date) {
    $dt = new DateTime($date);
    $sql = "INSERT INTO Examinations (SubjectID, UserID, Type, Date, Active)
            VALUES ('$subjectID', '$userID', '$type', '" . $dt->format('Y-m-d H:i:s') . "', '1')";
    $conn->query($sql);
  }

?>
