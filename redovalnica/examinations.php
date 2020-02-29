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
        <?php include($rootFolder . 'includes/site-parts/profile_widget.php'); ?>
        <div id="upcoming_events_widget">
          <p id="instruction">Novo ocenjevanje znanja lahko dodate z dvoklikom na prazno celico.</p>
          <table>
            <tr>
              <th scope="col">PREDMET</th>
              <th scope="col">JAN</th>
              <th scope="col">FEB</th>
              <th scope="col">MAR</th>
              <th scope="col">APR</th>
              <th scope="col">MAJ</th>
              <th scope="col">JUN</th>
              <th scope="col">JUL</th>
              <th scope="col">AVG</th>
              <th scope="col">SEP</th>
              <th scope="col">OKT</th>
              <th scope="col">NOV</th>
              <th scope="col">DEC</th>
            </tr>
            <tr>
              <td class="predmet"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" align="left">Slovenščina</td>
              <td>16<img src=<?php echo $rootFolder . "images/edit.png"; ?> width="20px" align="right"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td class="predmet"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" align="left">Angleščina</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td class="predmet"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" align="left">Športna vzgoja</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>4<img src=<?php echo $rootFolder . "images/edit.png"; ?> width="20px" align="right"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td class="predmet"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" align="left">Matematika</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td class="center predmet" colspan="13"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" valign="middle" style="transform:rotate(45deg);"><a>Dodaj nov predmet</a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
