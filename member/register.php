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
    <?php include($rootFolder . 'includes/site-parts/navbar.php');?>
    <div id="page_body">
      <h1 id="body_title">Registracija</h1>
      <form id="register" method="post" action="./register.php">
        <p id="instruction">Za ustvarjanje novega računa izpolnite spodnji obrazec.</p>
        <?php
          include($rootFolder . "includes/database.php");
          if($_POST) {
            if(!userExists($conn, $_POST['username']) && !userExists($conn, $_POST['email'])) {
              if($_POST['password'] === $_POST['password2']) {
                createAccount($conn, $_POST['username'], $_POST['email'], $_POST['password'], $_POST['name'], $_POST['surname']);
                header('Location: ' . $rootFolder . 'member/login.php');
              } else echo '<p id="error">Gesli se ne ujemata.</p>';
            } else {
              echo '<p id="error">Ta uporabnik že obstaja.</p>';
            }
          }
        ?>
        <input type="text" id="name" name="name" placeholder="Ime" pattern="[a-žA-Ž]{3,30}" required><br>
        <input type="text" id="surname" name="surname" placeholder="Priimek" pattern="[a-žA-Ž]{3,30}" required><br>
        <input type="text" id="username" name="username" placeholder="Uporabniško ime" pattern="|[a-zA-Z0-9_-]{8,30}" title="Vnesite uporabniško ime, ki vsebuje najmanj 8 znakov. Vsebuje lahko male in velike črke, številke in vezaj ter podčrtaj."><br>
        <input type="text" id="email" name="email" placeholder="E-poštni naslov" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$|" title="Vnesite veljaven e-poštni naslov, saj boste nanj dobili potrditveno e-pošto."required><br>
        <input type="password" id="password" name="password" placeholder="Geslo" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="Vaše geslo mora vsebovati vsaj eno število, eno majhno in eno veliko črko. Vsebovati mora vsaj 8 znakov."><br>
        <input type="password" id="password2" name="password2" placeholder="Ponovno vnesite geslo" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="Vaše geslo mora vsebovati vsaj eno število, eno majhno in eno veliko črko. Vsebovati mora vsaj 8 znakov."><br>
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
