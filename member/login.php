<?php
  $rootFolder = "../";
  session_start();
  if(isset($_SESSION['UserID'])) {
    header('Location: ' . $rootFolder . 'redovalnica/');
  }
?>
<!-- redovalnica_admin, Admin123 -->
<html>
  <head>
    <link rel="stylesheet" type="text/css" href=<?php echo $rootFolder . "css/style.css"; ?>>
    <link rel="shortcut icon" type="image/png" href=<?php echo $rootFolder . "images/logo.png"; ?>>
    <title>Osebna redovalnica A+</title>
  </head>
  <body>
    <?php include($rootFolder . 'includes/site-parts/navbar.php'); ?>
    <div id="page_body">
      <h1 id="body_title">Prijava</h1>
      <form id="login" method="post" action="./login.php">
        <p id="instruction">Za prijavo v vaš račun izpolnite spodnji obrazec.</p>
        <?php
          include($rootFolder . "includes/database.php");
          if($_POST) {
            if(userExists($conn, $_POST['username'])) {
              if(passwordsMatch($conn, $_POST['username'], $_POST['password'])) {
                $userID = getUserID($conn, $_POST['username']);
                storeUserData_Cookies($userID, $_POST['username']);
                updateLastSeen($conn, $userID);
                header('Location: ' . $rootFolder . 'redovalnica/');
              } else {
                echo '<p id="error">Vpisali ste napačno geslo. Poskusite znova.</p>';
              }
            } else {
              echo '<p id="error">Ta uporabnik ne obstaja.</p>';
            }
          }
        ?>
        <input type="text" id="username" name="username" placeholder="Uporabniško ime ali email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$|[a-zA-Z0-9_-]{8,30}" title="Vnesite e-poštni naslov ali uporabniško ime, ki vsebuje najmanj 8 znakov. Uporabniško ime lahko vsebuje male in velike črke, številke in vezaj ter podčrtaj."required><br>
        <input type="password" id="password" name="password" placeholder="Geslo" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="Vaše geslo mora vsebovati vsaj eno število, eno majhno in eno veliko črko. Vsebovati mora vsaj 8 znakov."><br>
        <input type="submit" value="PRIJAVA">
      </form>
      <!-- Brez računa ali pa pozabljeno geslo. -->
      <div id="noacc_fp">
        <a href="./forgotten_password.php">Pozabljeno geslo</a>
        <a href="./register.php">Ustvari nov račun</a>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
