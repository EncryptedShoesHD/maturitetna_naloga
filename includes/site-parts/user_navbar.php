<?php

echo "<div id='navbar'>
        <a href='$rootFolder' id='home_redir'>
          <img src='" . $rootFolder . "images/logo.png' width='30px' height='30px' align='left'>
          <span id='brand_name' href='$rootFolder'>Osebna redovalnica</span>
        </a>
        <div id='nav_links'>
          <a class='nav_link' href='" . $rootFolder . "redovalnica'>Domov</a>
          <a class='nav_link' href='" . $rootFolder . "redovalnica/schedule.php'>Urnik</a>
          <a class='nav_link' href='" . $rootFolder . "redovalnica/grades.php'>Ocene</a>
          <a class='nav_link' href='" . $rootFolder . "redovalnica/examinations.php'>Preverjanja znanja</a>
          <a class='nav_link' href='" . $rootFolder . "redovalnica/reminders.php'>Opomniki</a>
          <a class='nav_link' href='" . $rootFolder . "member/sign_out.php'>Odjava</a>
        </div>
      </div>";

?>
