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
          <table>
            <tr>
              <th scope="col">PREDMET</th>
              <th scope="col">1. KONFERENCA</th>
              <th scope="col">2. KONFERENCA</th>
              <th scope="col">KONČNA OCENA</th>
            </tr>

            <?php
              $activeSubjects = getActiveSubjects($conn, $_SESSION['UserID']);
              $obdobje1 = new DateTime();
              $obdobje1->setDate(2020, 1, 15);
              $obdobje2 = new DateTime();
              $obdobje2->setDate(2020, 6, 23);
              while ($row = mysqli_fetch_assoc($activeSubjects)) {
                if(isFollowingSubject($conn, $_SESSION['UserID'], $row['SubjectID'])) {
                  echo '<tr>
                          <td class="predmet"><a href="' . $rootFolder . 'redovalnica/examinations.php?mode=edit&action=unfollow_subject&data=' . $row['SubjectID'] . '&redir=grades"><img src='; ?> <?php echo $rootFolder . "images/remove.png"; ?> <?php echo 'width="20px" align="left"></a>' . $row['Title'] . '</td>
                          <td><img style="transform:rotate(45deg);" src="' . $rootFolder . 'images/remove.png" width="20px" align="right">';

                          $subjectGrades = getActiveGrades($conn, $row['SubjectID'], $_SESSION['UserID']);
                          $sum = 0.0;
                          while ($row1 = mysqli_fetch_assoc($subjectGrades)) {
                            $dt = new DateTime($row1['DateReceived']);
                            if($dt <= $obdobje1) {
                              $sum = $sum + intval($row1['Grade']);

                              if($row1['Type'] === 'ustno') {
                                 echo '<span class="oral_grade">' . $row1['Grade'] . '</span> ';
                              } else if($row1['Type'] === 'pisno') {
                                 echo '<span class="written_grade">' . $row1['Grade'] . '</span> ';
                              } else if($row1['Type'] === 'izdelek') {
                                 echo '<span class="product_grade">' . $row1['Grade'] . '</span> ';
                              }
                            }
                          }

                          echo '</td>
                          <td><img style="transform:rotate(45deg);" src="' . $rootFolder . 'images/remove.png" width="20px" align="right">';

                          $subjectGrades = getActiveGrades($conn, $row['SubjectID'], $_SESSION['UserID']);
                          while ($row1 = mysqli_fetch_assoc($subjectGrades)) {
                            $dt = new DateTime($row1['DateReceived']);
                            if($dt <= $obdobje2 && $dt > $obdobje1) {
                              $sum = $sum + intval($row1['Grade']);

                              if($row1['Type'] === 'ustno') {
                                 echo '<span class="oral_grade">' . $row1['Grade'] . '</span> ';
                              } else if($row1['Type'] === 'pisno') {
                                 echo '<span class="written_grade">' . $row1['Grade'] . '</span> ';
                              } else if($row1['Type'] === 'izdelek') {
                                 echo '<span class="product_grade">' . $row1['Grade'] . '</span> ';
                              }
                            }
                          }

                          if($subjectGrades->num_rows != 0) {
                            $average = $sum / $subjectGrades->num_rows;
                            echo '<td class="center">' . number_format($average, 1) . ' (' . round($average) . ')</td>';
                          } else echo '<td class="center">0.0 (0)</td>';

                        echo '</tr>';
                }
              }
            ?>
            <!--<tr>
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
            </tr>-->
            <tr>
              <td class="center predmet" colspan="4"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" valign="middle" style="transform:rotate(45deg);"><a href=<?php echo $rootFolder . "redovalnica/examinations.php?mode=edit&action=add_subject&redir=grades"; ?>>Dodaj nov predmet</a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
