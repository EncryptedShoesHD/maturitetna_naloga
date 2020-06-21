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
    <script src=<?php echo $rootFolder . "js/script.js"; ?>></script>
    <title>Osebna redovalnica A+</title>
  </head>
  <body>
    <?php include($rootFolder . 'includes/site-parts/user_navbar.php'); ?>
    <div id="page_body">
      <div class="flexible_content">
        <?php include($rootFolder . 'includes/site-parts/profile_widget.php'); ?>
        <div id="upcoming_events_widget">
          <p id="instruction">Posamezno oceno spremenite tako, da nanjo kliknete.</p>
          <?php
            if($_GET) {
              if(isset($_GET['mode'])) {
                if($_GET['mode'] === 'edit') {
                  if(isset($_GET['action'])) {
                    if($_GET['action'] === 'add_grade') {
                      echo
                      '<form id="grade_edit" method="post" action="./grades.php">
                          <p id="instruction" style="width: 90%; margin-left: 5%; text-align: center;"><span style="color: 4744ff;">Dodajanje ocene</span> </p>
                          <label for="tip">Tip ocene</label>
                          <select name="tip" required>
                             <option value="pisno">Pisno</option>
                             <option value="ustno">Ustno</option>
                             <option value="izdelek">Izdelek</option>
                          </select>
                          <label for="datum">Datum pridobitve</label>
                          <input name="datum" type="date" required>
                          <label for="cas">Čas pridobitve</label>
                          <input name="cas" type="time" required>
                          <label for="ocena">Ocena</label>
                          <input name="ocena" type="number" min="1" max="5" required>
                          <div id="profile_action">
                            <button name="add_grade" value="' . $_GET['data'] . '">
                              <a class="button_a"><img src="' . $rootFolder . 'images/save.png" width="24px" align="left">Shrani</a>
                            </button>
                          </div>
                      </form>';
                    } else if($_GET['action'] === 'edit_grade') {
                      $gradeInfo = getGradeInfo($conn, $_GET['data']);

                      if($gradeInfo->num_rows > 0) {
                        $grade = mysqli_fetch_assoc($gradeInfo);
                        echo
                        '<form id="grade_edit" method="post" action="./grades.php">
                            <p id="instruction" style="width: 90%; margin-left: 5%; text-align: center;"><span style="color: 4744ff;">Urejanje ocene</span> </p>
                            <label for="tip">Tip ocene</label>
                            <select name="tip" required>
                               <option value="pisno" ' . ($grade['Type'] === 'pisno' ? 'selected="1"' : '') . '>Pisno</option>
                               <option value="ustno" ' . ($grade['Type'] === 'ustno' ? 'selected="1"' : '') . '>Ustno</option>
                               <option value="izdelek" ' . ($grade['Type'] === 'izdelek' ? 'selected="1"' : '') . '>Izdelek</option>
                            </select>
                            <label for="datum">Datum pridobitve</label>
                            <input name="datum" type="date" value="' . date('Y-m-d', strtotime($grade['DateReceived'])) . '" required>
                            <label for="cas">Čas pridobitve</label>
                            <input name="cas" type="time" value="' . date('H:i', strtotime($grade['DateReceived'])) . '" required>
                            <label for="ocena">Ocena</label>
                            <input name="ocena" type="number" min="1" max="5" value="' . $grade['Grade'] . '" required>
                            <div id="profile_action">
                              <button name="save_grade" value="' . $_GET['data'] . '">
                                <a class="button_a"><img src="' . $rootFolder . 'images/save.png" width="24px" align="left">Shrani</a>
                              </button>
                              <button name="remove_grade" value="' . $_GET['data'] . '">
                              <a class="button_a"><img src="' . $rootFolder . 'images/remove_white.png" width="24px" align="left">Odstrani</a>
                              </button>
                            </div>
                        </form>';
                      }
                    }
                  }
                }
              }
            }

            if($_POST) {
              if(isset($_POST['add_grade'])) {
                addGrade($conn, $_POST['add_grade'], $_SESSION['UserID'], $_POST['datum'], $_POST['cas'], $_POST['tip'], $_POST['ocena']);
                header('Location: ' . $rootFolder . 'redovalnica/grades.php');
              } else if(isset($_POST['save_grade'])) {
                saveGrade($conn, $_POST['save_grade'], $_POST['datum'], $_POST['cas'], $_POST['tip'], $_POST['ocena']);
                header('Location: ' . $rootFolder . 'redovalnica/grades.php');
              } else if(isset($_POST['remove_grade'])) {
                removeGrade($conn, $_POST['remove_grade']);
                header('Location: ' . $rootFolder . 'redovalnica/grades.php');
              }
            }
          ?>
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
                          <td><a href="' . $rootFolder . 'redovalnica/grades.php?mode=edit&data=' . $row['SubjectID'] . '"><img style="transform:rotate(45deg);" src="' . $rootFolder . 'images/remove.png" width="20px" align="right"></a>';

                          $subjectGrades = getActiveGrades($conn, $row['SubjectID'], $_SESSION['UserID']);
                          $sum = 0.0;
                          while ($row1 = mysqli_fetch_assoc($subjectGrades)) {
                            $dt = new DateTime($row1['DateReceived']);
                            if($dt <= $obdobje1) {
                              $sum = $sum + intval($row1['Grade']);

                              if($row1['Type'] === 'ustno') {
                                 echo '<span class="oral_grade" onclick="editGrade(' . $row1['GradeID'] . ')">' . $row1['Grade'] . '</span> ';
                              } else if($row1['Type'] === 'pisno') {
                                 echo '<span class="written_grade" onclick="editGrade(' . $row1['GradeID'] . ')">' . $row1['Grade'] . '</span> ';
                              } else if($row1['Type'] === 'izdelek') {
                                 echo '<span class="product_grade" onclick="editGrade(' . $row1['GradeID'] . ')">' . $row1['Grade'] . '</span> ';
                              }
                            }
                          }

                          echo '</td>
                          <td><a href="' . $rootFolder . 'redovalnica/grades.php?mode=edit&action=add_grade&data=' . $row['SubjectID'] . '"><img style="transform:rotate(45deg);" src="' . $rootFolder . 'images/remove.png" width="20px" align="right"></a>';

                          $subjectGrades = getActiveGrades($conn, $row['SubjectID'], $_SESSION['UserID']);
                          while ($row1 = mysqli_fetch_assoc($subjectGrades)) {
                            $dt = new DateTime($row1['DateReceived']);
                            if($dt <= $obdobje2 && $dt > $obdobje1) {
                              $sum = $sum + intval($row1['Grade']);

                              if($row1['Type'] === 'ustno') {
                                 echo '<span class="oral_grade" onclick="editGrade(' . $row1['GradeID'] . ')">' . $row1['Grade'] . '</span> ';
                              } else if($row1['Type'] === 'pisno') {
                                 echo '<span class="written_grade" onclick="editGrade(' . $row1['GradeID'] . ')">' . $row1['Grade'] . '</span> ';
                              } else if($row1['Type'] === 'izdelek') {
                                 echo '<span class="product_grade" onclick="editGrade(' . $row1['GradeID'] . ')">' . $row1['Grade'] . '</span> ';
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
