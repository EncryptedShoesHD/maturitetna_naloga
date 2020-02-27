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
      <h1 id="body_title">Registracija</h1>
      <form id="register">
        <p id="instruction">Za ustvarjanje novega računa izpolnite spodnji obrazec.</p>
        <input type="text" id="username" name="username" placeholder="Uporabniško ime" pattern="|[a-zA-Z0-9_-]{8,30}" title="Vnesite uporabniško ime, ki vsebuje najmanj 8 znakov. Vsebuje lahko male in velike črke, številke in vezaj ter podčrtaj."><br>
        <input type="text" id="email" name="email" placeholder="E-poštni naslov" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$|" title="Vnesite veljaven e-poštni naslov, saj boste nanj dobili potrditveno e-pošto."required><br>
        <input type="password" id="password" name="password" placeholder="Geslo" pattern=".{8,}" required><br>
        <input type="password" id="password2" name="password2" placeholder="Ponovno vpišite geslo" pattern=".{8,}" required><br>
        <input type="submit" value="REGISTRACIJA">
      </form>
      <!-- Uporabnik račun že ima. -->
      <div id="noacc_fp">
        <a href="./login.php">Račun že imam!</a>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
