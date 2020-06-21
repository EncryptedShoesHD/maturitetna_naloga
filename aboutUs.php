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
      <h1 id="body_title">O nas</h1>
      <p>Snovalci te spletne osebne redovalnice smo trojica dijakov iz Srednje šole za kemijo, elektrotehniko in računalništvo.</p>
      <p>V prostem času radi programiramo in se učimo računalniških veščin.</p>
      <p>Če želite izvedeti več o tem, kaj počnemo v prostem času, vas vabimo k ogledu povezav v nogi te strani.</p>
      <p style="padding-bottom: 150px;">Če pa želite izvedeti več o samem produktu, pa kliknite <a style="padding: 0; color: #4744ff" href="<?php echo $rootFolder . 'aboutProduct.php'; ?>">tukaj</a>.</p>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
