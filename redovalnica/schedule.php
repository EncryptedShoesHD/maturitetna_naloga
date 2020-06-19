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
          <p id="instruction">Celico lahko spremenite tako, da nanjo dvakrat kliknete. Nove predmete lahko ustvarite v zavihku Preverjanja znanja.</p>
          <?php

            if($_POST) {
              if(isset($_POST['save_lesson'])) {
                $lecturerID = null;
                if(!empty($_POST['lecturer_name']) && !empty($_POST['lecturer_surname'])) {
                  $lecturer = getLecturerID($conn, $_POST['lecturer_name'], $_POST['lecturer_surname']);

                  if($lecturer != null && $lecturer->num_rows > 0) {
                    $row = mysqli_fetch_assoc($lecturer);
                    $lecturerID = intval($row['LecturerID']);
                  } else $lecturerID = createLecturer($conn, $_POST['lecturer_name'], $_POST['lecturer_surname']);
                }

                $startDT = new DateTime();
                $startDT->setTime(intval(intval($_POST['start']) / 100), intval(intval($_POST['start']) % 100));

                $endDT = new DateTime();
                $endDT->setTime(intval(intval($_POST['end']) / 100), intval(intval($_POST['end']) % 100));

                if(isset($_POST['lid'])) {
                  updateLesson($conn, $_POST['lid'], $_POST['subject'], $lecturerID, $_POST['classroom']);
                }
                else {
                  createLesson($conn, $_POST['subject'], $lecturerID, $_SESSION['UserID'], $startDT, $endDT, $_POST['dayofweek'], $_POST['classroom']);
                }

                header('Location: ' . $rootFolder . 'redovalnica/schedule.php');
              } else if(isset($_POST['remove_lesson'])) {
                $dayOfWeek = explode(';', $_POST['remove_lesson'])[0];
                $startRaw = explode(';', $_POST['remove_lesson'])[1];
                $endRaw = explode(';', $_POST['remove_lesson'])[2];
                $startDT = new DateTime();
                $startDT->setTime(intval(intval($startRaw) / 100), intval(intval($startRaw) % 100));
                $endDT = new DateTime();
                $endDT->setTime(intval(intval($endRaw) / 100), intval(intval($endRaw) % 100));
                $lesson = getLessonByPosition($conn, $dayOfWeek, $startDT, $endDT, $_SESSION['UserID']);

                if($lesson->num_rows > 0) {
                  $row = mysqli_fetch_assoc($lesson);
                  removeLesson($conn, $row['LessonID']);
                }

                header('Location: ' . $rootFolder . 'redovalnica/schedule.php');
              }
            }

            if($_GET) {
              if(isset($_GET['mode'])) {
                if($_GET['mode'] === 'edit') {
                  if(isset($_GET['action'])) {
                    if($_GET['action'] === 'edit_lesson') {
                      if(isset($_GET['data'])) {
                        $dayOfWeek = explode(';', $_GET['data'])[0];
                        $startRaw = explode(';', $_GET['data'])[1];
                        $endRaw = explode(';', $_GET['data'])[2];

                        $startDT = new DateTime();
                        $startDT->setTime(intval(intval($startRaw) / 100), intval(intval($startRaw) % 100));

                        $endDT = new DateTime();
                        $endDT->setTime(intval(intval($endRaw) / 100), intval(intval($endRaw) % 100));

                        //Check if lesson already exists.
                        $lesson = getLessonByPosition($conn, $dayOfWeek, $startDT, $endDT, $_SESSION['UserID']);

                        $activeSubjects = getActiveSubjects($conn, $_SESSION['UserID']);

                        echo
                        '<form id="grade_edit" method="post" action="./schedule.php">
                            <p id="instruction" style="width: 90%; margin-left: 5%; text-align: center;"><span style="color: 4744ff;">Sprememba šolske ure</span> </p>
                            <input type="hidden" name="dayofweek" value="' . $dayOfWeek . '">
                            <input type="hidden" name="start" value="' . $startRaw . '">
                            <input type="hidden" name="end" value="' . $endRaw . '">';

                        if($lesson->num_rows > 0) {
                          $row = mysqli_fetch_assoc($lesson);

                          echo
                          '<input type="text" name="lecturer_name" placeholder="Ime predavatelja" value="' . $row['LecturerName'] . '" maxlength="30">
                           <input type="text" name="lecturer_surname" placeholder="Priimek predavatelja" value="' . $row['LecturerSurname'] . '" maxlength="30">
                           <input type="text" name="classroom" placeholder="Učilnica" value="' . $row['Classroom'] . '" maxlength="10" required>
                           <input type="hidden" name="lid" value="' . $row['LessonID'] . '">
                           <select name="subject">';

                           while($row1 = mysqli_fetch_assoc($activeSubjects)) {
                             if($row['SubjectID'] === $row1['SubjectID'])
                                echo '<option value="' . $row1['SubjectID'] . '" selected>' . $row1['Title'] . '</option>';
                             else
                                echo '<option value="' . $row1['SubjectID'] . '">' . $row1['Title'] . '</option>';
                           }
                        } else {
                          echo
                          '<input type="text" name="lecturer_name" placeholder="Ime predavatelja" maxlength="30">
                           <input type="text" name="lecturer_surname" placeholder="Priimek predavatelja" maxlength="30">
                           <input type="text" name="classroom" placeholder="Učilnica" maxlength="10" required>
                           <select name="subject">';

                           while($row1 = mysqli_fetch_assoc($activeSubjects)) {
                             echo '<option value="' . $row1['SubjectID'] . '">' . $row1['Title'] . '</option>';
                           }
                        }

                        echo '</select>';

                        echo
                        ' </select>
                          <div id="profile_action">
                            <button name="save_lesson">
                              <a class="button_a"><img src="' . $rootFolder . 'images/save.png" width="24px" align="left">Shrani</a>
                            </button>
                            <br>
                            <button name="remove_lesson" value="' . $_GET['data'] . '">
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

            $activeLessons = getActiveLessons($conn, $_SESSION['UserID']);
            echo
            '<table>
              <tr>
                <th>/</th>
                <th scope="col">PONEDELJEK</th>
                <th scope="col">TOREK</th>
                <th scope="col">SREDA</th>
                <th scope="col">ČETRTEK</th>
                <th scope="col">PETEK</th>
                <th scope="col">SOBOTA</th>
              </tr>';

            $lessons = array();

            if($activeLessons->num_rows > 0) {
              while($row = mysqli_fetch_assoc($activeLessons)) {
                array_push($lessons, $row);
              }

              $beginnings = array('07:10', '08:00', '08:50', '09:40', '10:30', '11:20', '12:10', '13:00', '13:50');
              $endings = array('07:55', '08:45', '09:35', '10:25', '11:15', '12:05', '12:55', '13:45', '14:35');
              $index = 0;
              foreach ($beginnings as $beginning) {
                $day = 1;
                echo '<tr>
                        <th scope="row">
                          <span>' . $index . '</span>
                          <div>
                            <span>' . $beginning . ' - ' . $endings[$index] . '</span>
                          </div>
                        </th>';
                foreach($lessons as $lesson) {
                  if($lesson['Start'] === $beginning . ':00') {
                    if($day !== intval($lesson['DayOfWeek'])) {
                      $cnt = intval($lesson['DayOfWeek']) - $day;
                      for($i = 0; $i < $cnt; $i++) {
                        echo '<td ondblclick="editLesson(' . $day . ', ' . intval(str_replace(':', '', $beginning)) . ', ' . intval(str_replace(':', '', $endings[$index])) . ')"></td>';
                        $day++;
                      }
                    }
                    echo '<td ondblclick="editLesson(' . $lesson['DayOfWeek'] . ', ' . intval(str_replace(':', '', $beginning)) . ', ' . intval(str_replace(':', '', $endings[$index])) . ')">
                      <span class="subject_classroom">
                        <b>' . $lesson['Shortcode'] . '</b> <span>' . $lesson['Classroom'] . '</span>
                      </span><br>
                        ' . $lesson['LecturerSurname'] . ' ' . $lesson['LecturerName'] . '
                    </td>';

                    unset($lessons[array_search($lesson, $lessons)]);
                    $lessons = array_values($lessons);
                  } else {
                    $cnt = 6 - $day + 1;
                    for($i = 0; $i < $cnt; $i++) {
                      echo '<td ondblclick="editLesson(' . $day . ', ' . intval(str_replace(':', '', $beginning)) . ', ' . intval(str_replace(':', '', $endings[$index])) . ')"></td>';
                      $day++;
                    }
                    break;
                  }

                  $day++;
                }

                if($day != 7) {
                  $cnt = 7 - $day;
                  for($i = 0; $i < $cnt; $i++) {
                    echo '<td ondblclick="editLesson(' . $day . ', ' . intval(str_replace(':', '', $beginning)) . ', ' . intval(str_replace(':', '', $endings[$index])) . ')"></td>';
                    $day++;
                  }
                }

                echo '</tr>';
                $index++;
              }
            } else include($rootFolder . 'includes/site-parts/default_schedule.php');

            echo '</table>';
          ?>
        </div>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
