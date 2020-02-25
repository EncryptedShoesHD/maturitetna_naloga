<?php
  $rootFolder = "../";
?>

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
      <form id="login">
        <p id="instruction">Za prijavo v vaš račun izpolnite spodnji obrazec.</p>
        <input type="text" id="username" name="username" placeholder="Uporabniško ime ali email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$|[a-zA-Z0-9_-]{8,30}" title="Vnesite e-poštni naslov ali uporabniško ime, ki vsebuje najmanj 8 znakov. Uporabniško ime lahko vsebuje male in velike črke, številke in vezaj ter podčrtaj."required><br>
        <input type="password" id="password" name="password" placeholder="Geslo" pattern=".{8,}" required><br>
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
