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
              <th>/</th>
              <th scope="col">PONEDELJEK</th>
              <th scope="col">TOREK</th>
              <th scope="col">SREDA</th>
              <th scope="col">ČETRTEK</th>
              <th scope="col">PETEK</th>
              <th scope="col">SOBOTA</th>
            </tr>
            <tr>
              <th scope="row">
                <span>0</span>
                <div>
                  <span>07:10 - 07:55</span>
                </div>
              </th>
              <td>
                <span class="subject_classroom">
                  <b>NUP</b> <span>BE05</span>
                </span><br>
                  Lubej Boštjan
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row">
                <span>1</span>
                <div>
                  <span>08:00 - 08:45</span>
                </div>
              </th>
              <td>
                <span class="subject_classroom">
                  <b>RPR</b> <span>BE05</span>
                </span><br>
                  Breznik Gorazd
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row">
                <span>2</span>
                <div>
                  <span>08:50 - 09:35</span>
                </div>
              </th>
              <td>
                <span class="subject_classroom">
                  <b>NRP</b> <span>BE06</span>
                </span><br>
                  Resinovič Boštjan
              </td>
              <td>
                <span class="subject_classroom">
                  <b>SLO</b> <span>E14</span>
                </span><br>
                  Hrastnik Velntajna
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row">
                <span>3</span>
                <div>
                  <span>09:40 - 10:25</span>
                </div>
              </th>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row">
                <span>4</span>
                <div>
                  <span>10:30 - 11:15</span>
                </div>
              </th>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row">
                <span>5</span>
                <div>
                  <span>11:20 - 12:05</span>
                </div>
              </th>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row">
                <span>6</span>
                <div>
                  <span>12:10 - 12:55</span>
                </div>
              </th>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row">
                <span>7</span>
                <div>
                  <span>13:00 - 13:45</span>
                </div>
              </th>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row">
                <span>8</span>
                <div>
                  <span>13:50 - 14:35</span>
                </div>
              </th>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
