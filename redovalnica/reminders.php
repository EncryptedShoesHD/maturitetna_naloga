<?php
  $rootFolder = "../";
  include($rootFolder . "includes/database.php");
  session_start();
  if(!isset($_SESSION['UserID'])) {
    header('Location: ' . $rootFolder . 'member/login.php');
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
      <div class="flexible_content">
        <?php include($rootFolder . 'includes/site-parts/profile_widget.php'); ?>
        <div id="upcoming_events_widget">

          <? php
            
          ?>

          <div class="reminder">
            <span class="reminder_title">Reminder 1
              <img src=<?php echo $rootFolder . "images/remove.png"; ?> width="18px" style="cursor: pointer;">
            </span>
            <div class="reminder_data">
              <span class="reminder_data_type">Datum:</span><span>21. september, 2020</span>
            </div>
            <div class="reminder_data">
              <span class="reminder_data_type">Ura:</span><span>18:00</span>
            </div>
            <div class="reminder_data">
              <span class="reminder_data_type">Opozorilo pred dogodkom:</span><span>10 minut</span>
            </div>
          </div>
          <div class="reminder">
            <span class="reminder_title">Reminder 2
              <img src=<?php echo $rootFolder . "images/remove.png"; ?> width="18px" style="cursor: pointer;">
            </span>
            <div class="reminder_data">
              <span class="reminder_data_type">Datum:</span><span>6. marec, 2020</span>
            </div>
            <div class="reminder_data">
              <span class="reminder_data_type">Ura:</span><span>14:22</span>
            </div>
            <div class="reminder_data">
              <span class="reminder_data_type">Opozorilo pred dogodkom:</span><span>1 ura</span>
            </div>
          </div>
          <div class="query_result">
            <img src=<?php echo $rootFolder . "images/remove.png"; ?> width="48px" style="transform:rotate(45deg); cursor: pointer;">
            <p>Nov opomnik lahko ustvariš s klikom na zgornji gumb.</p>
          </div>
        </div>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
