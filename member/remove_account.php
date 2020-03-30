<?php
  $rootFolder = "../";
  include($rootFolder . "includes/database.php");
  session_start();
  if(!isset($_SESSION) || !isset($_SESSION['UserID'])) {
    header('Location: ' . $rootFolder);
  }
?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href=<?php echo $rootFolder . "css/style.css"; ?>>
    <link rel="shortcut icon" type="image/png" href=<?php echo $rootFolder . "images/logo.png"; ?>>
    <title>Osebna redovalnica A+</title>
  </head>
  <body>
    <?php include($rootFolder . 'includes/site-parts/user_navbar.php'); ?>
    <div id="page_body">
      <h1 id="body_title">Izbris računa</h1>
      <form id="remove_account" method="post" action="./remove_account.php">
        <p id="instruction">Za potrditev izbrisa prosimo vnesite geslo. Z izbrisom boste izgubili vse podatke, ki ste jih tekom uporabe vnesli.</p>
        <?php
          if($_POST) {
            if(passwordsMatch($conn, $_SESSION['username'], $_POST['password'])) {
              $userID = getUserID($conn, $_SESSION['username']);
              removeAccount($conn);
              header('Location: ' . $rootFolder);
            } else {
              echo '<p id="error">Vpisali ste napačno geslo. Poskusite znova.</p>';
            }
          }
        ?>
        <input type="password" id="password" name="password" placeholder="Geslo" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="Vaše geslo mora vsebovati vsaj eno število, eno majhno in eno veliko črko. Vsebovati mora vsaj 8 znakov."><br>
        <input type="submit" value="IZBRIS">
      </form>
      <!-- Brez računa ali pa pozabljeno geslo. -->
      <div id="noacc_fp">
        <a href="./forgotten_password.php">Pozabljeno geslo</a>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
