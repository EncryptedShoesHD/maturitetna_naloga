<?php
  $rootFolder = "./";
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
      <h1 id="body_title">Kontakt</h1>
      <form id="contact">
        <p id="instruction">Izpolnite spodnji obrazec in nam pošljite sporočilo.</p>
        <input type="text" id="email" name="email" placeholder="E-poštni naslov" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$|" title="Vnesite veljaven e-poštni naslov, saj boste nanj dobili potrditveno e-pošto."required><br>
        <textarea id="message" name="message" placeholder="Vnesite sporočilo, vprašanje, pripombo ..." required cols="40" rows="10"></textarea><br>
        <input type="submit" value="POŠLJI">
      </form>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
