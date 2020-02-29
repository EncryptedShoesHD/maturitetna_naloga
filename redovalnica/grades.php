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
          <table>
            <tr>
              <th scope="col">PREDMET</th>
              <th scope="col">1. KONFERENCA</th>
              <th scope="col">2. KONFERENCA</th>
              <th scope="col">KONČNA OCENA</th>
            </tr>
            <tr>
              <td class="predmet"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" align="left">Slovenščina</td>
              <td><img src=<?php echo $rootFolder . "images/edit.png"; ?> width="20px" align="right">
                <span class="oral_grade">2</span>,
                <span class="written_grade">3</span>,
                <span class="oral_grade">5</span>,
                <span class="product_grade">5</span>
              </td>
              <td><img src=<?php echo $rootFolder . "images/edit.png"; ?> width="20px" align="right">
                <span class="oral_grade">3</span>,
                <span class="written_grade">4</span>,
                <span class="written_grade">4</span>
              </td>
              <td class="center">3.71 (4)</td>
            </tr>
            <tr>
              <td class="predmet"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" align="left">Angleščina</td>
              <td><img src=<?php echo $rootFolder . "images/edit.png"; ?> width="20px" align="right">
                <span class="oral_grade">4</span>,
                <span class="written_grade">2</span>,
                <span class="oral_grade">5</span>
              </td>
              <td><img src=<?php echo $rootFolder . "images/edit.png"; ?> width="20px" align="right">
                <span class="oral_grade">3</span>,
                <span class="written_grade">4</span>
              </td>
              <td class="center">3.60 (4)</td>
            </tr>
            <tr>
              <td class="predmet"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" align="left">Športna vzgoja</td>
              <td><img src=<?php echo $rootFolder . "images/edit.png"; ?> width="20px" align="right">
                <span class="product_grade">5</span>,
                <span class="product_grade">5</span>
              </td>
              <td><img src=<?php echo $rootFolder . "images/edit.png"; ?> width="20px" align="right">
                <span class="oral_grade">5</span>
              </td>
              <td class="center">5.00 (5)</td>
            </tr>
            <tr>
              <td class="predmet"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" align="left">Matematika</td>
              <td><img src=<?php echo $rootFolder . "images/edit.png"; ?> width="20px" align="right">
                <span class="oral_grade">2</span>,
                <span class="written_grade">4</span>,
                <span class="oral_grade">5</span>,
                <span class="product_grade">3</span>
              </td>
              <td><img src=<?php echo $rootFolder . "images/edit.png"; ?> width="20px" align="right">
                <span class="written_grade">3</span>,
                <span class="written_grade">5</span>
              </td>
              <td class="center">3.67 (4)</td>
            </tr>
            <tr>
              <td class="center predmet" colspan="4"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" valign="middle" style="transform:rotate(45deg);"><a>Dodaj nov predmet</a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
