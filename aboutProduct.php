<?php
  // Fixed variables
  $rootFolder = "./";
?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" type="image/png" href="images/logo.png"/>
    <title>Osebna redovalnica A+</title>
  </head>
  <body>
    <?php include($rootFolder . 'includes/site-parts/navbar.php'); ?>
    <div id="page_body">
      <h1 id="body_title">O produktu</h1>
      <p>Spletna redovalnica A+ je nastajala v šolskem letu 2019/2020.</p>
      <p>Nastala je z namenom izboljšanja šolske spletne redovalnice, saj ta večkrat ni bila dosegljiva, ali pa ocene niso bile vpisane pravi čas.</p>
      <p>S tem projektom smo želeli sovrstnikom olajšati pregled nad šolskimi ocenami in omogočiti boljšo organiziranost.</p>
      <p>Osebna redovalnica A+ je brezplačna in od uporabnika zahteva le registracijo.</p>
      <p>Poleg vpisovanja ocen pa omogoča tudi urejanje napovedanih preverjanj znanja, ustvarjanje opomnikov in izdelavo urnikov.</p>
      <p style="padding-bottom: 150px;">Če želite osebno redovalnico preizkusiti še danes, se registrirajte <a style="padding: 0; color: #4744ff" href="<?php echo $rootFolder . 'member/register.php'; ?>">tukaj</a>.</p>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
