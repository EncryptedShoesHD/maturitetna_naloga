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
    <?php include($rootFolder . 'includes/site-parts/user_navbar.php'); ?>
    <div id="page_body">
      <div class="flexible_content">
        <div id="profile_widget">
          <div id="greeting">
            <span class="section_title">Pozdravljen, Tomaž Bizjak!</span> <?php // TODO: Namesto imena in priimka vstavi username. Če tudi ta ni na voljo, naj bo pozdrav samo: Pozdravljeni! ?>
          </div>
          <div class="user_info_section">
            <span class="subsection_title">Ime in priimek</span>
            <div class="user_info">
              <img src=<?php echo $rootFolder . "images/user.png"; ?> width="24px" align="left">
              <span>Tomaž Bizjak</span>
              <img src=<?php echo $rootFolder . "images/edit.png"; ?> width="24px" align="right">
            </div>
          </div>
          <div class="user_info_section">
            <span class="subsection_title">E-poštni naslov</span>
            <div class="user_info">
              <img src=<?php echo $rootFolder . "images/email.png"; ?> width="24px" align="left">
              <span>bizjaktomaz72@gmail.com</span>
            </div>
          </div>
          <div class="user_info_section">
            <span class="subsection_title">Uporabniško ime</span>
            <div class="user_info">
              <img src=<?php echo $rootFolder . "images/user.png"; ?> width="24px" align="left">
              <span>tomazbizjak</span>
              <img src=<?php echo $rootFolder . "images/edit.png"; ?> width="24px" align="right">
            </div>
          </div>
          <div class="user_info_section">
            <span class="subsection_title">Geslo</span>
            <div class="user_info">
              <img src=<?php echo $rootFolder . "images/password.png"; ?> width="24px" align="left">
              <span>Zaradi varnosti ga ne prikazujemo</span>
              <img src=<?php echo $rootFolder . "images/edit.png"; ?> width="24px" align="right">
            </div>
          </div>
          <div id="profile_action">
            <button>
              <img src=<?php echo $rootFolder . "images/signout.png"; ?> width="24px" align="left">
              Odjava
            </button>
            <br>
            <button>
              <img src=<?php echo $rootFolder . "images/remove_acc.png"; ?> width="24px" align="left">
              Izbriši račun
            </button>
          </div>
        </div>
        <div id="upcoming_events_widget">
          <div class="upcoming_events_section">
            <span class="section_title">Napovedana preverjanja znanja</span>
            <div class="query_result">
              <img src=<?php echo $rootFolder . "images/exam.png"; ?> width="48px">
              <p>Vnešenega nimaš nobenega preverjanja znanja. Vnesi ga <a class="text_hyperlink" href="./examinations.php">tukaj</a>.</p>
              <!-- <p>Nimaš prihajajočih preverjanj znanja. Nove lahko vneseš <a class="text_hyperlink" href="./examinations.php">tukaj</a>.</p> -->
            </div>
          </div>
          <div class="upcoming_events_section">
            <span class="section_title">Prihajajoči opomniki</span>
            <div class="query_result">
              <img src=<?php echo $rootFolder . "images/reminder.png"; ?> width="48px">
              <p>Nimaš prihajajočih opomnikov. Novega lahko ustvariš <a class="text_hyperlink" href="./reminders.php">tukaj</a>.</p>
            </div>
          </div>
          <div class="upcoming_events_section">
            <span class="section_title">Zamujeni opomniki</span>
            <div class="query_result">
              <img src=<?php echo $rootFolder . "images/like.png"; ?> width="48px">
              <p>V času odsotnosti nisi zamudil nobenega opomnika!</p>
            </div>
          </div>
          <div class="upcoming_events_section">
            <span class="section_title">Tvoj šolski uspeh</span>
            <div class="query_result">
              <img src=<?php echo $rootFolder . "images/graph.png"; ?> width="48px">
              <p>Tvojega uspeha nismo uspeli izračunati, saj nimaš vnešenih ocen. Vnesi jih <a class="text_hyperlink" href="./grades.php">tukaj</a>.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
