<?php
  // Fixed variables
  $rootFolder = "./";
  session_start();
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
      <h1 id="body_title">Osebna redovalnica A+</h1>
      <img src="images/screenshot.png" width="80%" style="display: block; margin-left: 10%; margin-bottom: 20px;">
      <a href='aboutProduct.php'><button>VEČ O PRODUKTU</button><br><br></a>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
