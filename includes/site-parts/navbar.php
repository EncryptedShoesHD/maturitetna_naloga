<?php

echo "<div id='navbar'>
        <a href='$rootFolder' id='home_redir'>
          <img src='" . $rootFolder . "images/logo.png' width='30px' height='30px' align='left'>
          <span id='brand_name' href='$rootFolder'>Osebna redovalnica</span>
        </a>
        <div id='nav_links'>
          <a class='nav_link' href='$rootFolder'>Domov</a>
          <a class='nav_link' href='" . $rootFolder . "aboutUs.php'>O nas</a>
          <a class='nav_link' href='" . $rootFolder . "aboutProduct.php'>O produktu</a>
          <a class='nav_link' href='" . $rootFolder . "member/login.php'>Prijava</a>
        </div>
      </div>";

?>
