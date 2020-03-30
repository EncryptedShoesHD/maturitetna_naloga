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
          <p id="instruction">Novo ocenjevanje znanja lahko dodate z dvoklikom na prazno celico.</p>
          <?php

            if($_POST) {
              if(isset($_POST['title']) && !(trim($_POST['title']) === '') && isset($_POST['shortcode']) && !(trim($_POST['shortcode']) === ''))
                createSubject($conn, $_POST['title'], $_POST['shortcode']);
              if(isset($_POST['existing']) && !(trim($_POST['existing']) === 'null'))
                followSubject($conn, $_SESSION['UserID'], $_POST['existing']);
            }
            if($_GET && isset($_GET['mode']) && $_GET['mode'] === 'edit' && isset($_GET['action'])) {
              if($_GET['action'] === 'add_subject') {
                echo '<form id="insertion" method="post" action="./examinations.php">
                        <input type="text" name="title" id="title" pattern=".{3,30}" placeholder="Naziv predmeta">
                        <input type="text" name="shortcode" id="shortcode" pattern="[a-žA-Ž0-9]{3}" placeholder="Okrajšava predmeta" title="Vnesite tričrkovno oznako predmeta.">
                        <p id="instruction" style="font-size: 15px; width: 90%; margin-left: 5%">Lahko pa izberete enega izmed spodnjih predmetov, ki ste jim v preteklosti nehali slediti: </p>
                        <select name="existing" style="font-size: 15px; width: 90%; margin-left: 5%">
                          <option>Izberi predmet</option>
                          ';?>
                        <?php
                          $unfollowedSubjects = getUnfollowedSubjects($conn, $_SESSION['UserID']);

                          while($row = mysqli_fetch_assoc($unfollowedSubjects)) {
                            echo '<option value="' . $row['SubjectID'] . '">' . $row['Title'] . ' (' . $row['Shortcode'] . ')</option>';
                          }
                          echo '</select>
                          <input type="submit" value="Dodaj predmet">
                        </form>';?>
              <?php
              } else if ($_GET['action'] === 'unfollow_subject'){
                if(isset($_GET['data'])) {
                  unfollowSubject($conn, $_SESSION['UserID'], $_GET['data']);
                }
              } else if ($_GET['action'] === 'edit_exams') {
                if(isset($_GET['data'])) {
                  echo '<form id="grade_edit" method="post" action="./examinations.php">';

                  $subjectData = getSubjectTitleAndExaminations($conn, $_SESSION['UserID'], $_GET['data']);

                  echo '<p id="instruction" style="width: 90%; margin-left: 5%; text-align: center;"><span style="color: 4744ff;">' . array_keys($subjectData)[0] . '</span> </p>';

                  $subjects = $subjectData[array_keys($subjectData)[0]];
                  $i = 1;
                  foreach ($subjects as $key => $value) {
                    //echo '<pre>'; var_dump($value); echo '</pre>';
                    if($value[0] === "1")
                      echo '<input type="checkbox" id="item' . $i . '" name="item1" value="' . $value[2] . ' (' . $value[1]  . ')" checked>';
                    else
                      echo '<input type="checkbox" id="item' . $i . '" name="item1" value="' . $value[2] . ' (' . $value[1]  . ')">';
                    $dt = new DateTime($value[2]);
                    echo '<label for="item' . $i . '">' . $dt->format('d.m.Y') . ' (' . $value[1]  . ')
                          <a href="' . $rootFolder . 'redovalnica/examinations.php?mode=edit&action=edit_exam&data=' . $value[3] . '">
                            <img src='; ?> <?php echo $rootFolder . "images/edit.png" . ' width="20px" align="right">
                          </a>
                          </label>
                          <br>';
                    $i++;
                  }
                  echo '</form>';
                }
              }
            }

          ?>
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
            <?php
              $activeSubjects = getActiveSubjects($conn, $_SESSION['UserID']);
              while ($row = mysqli_fetch_assoc($activeSubjects)) {
                if(isFollowingSubject($conn, $_SESSION['UserID'], $row['SubjectID'])) {
                  echo '<tr>
                          <td class="predmet"><a href="' . $rootFolder . 'redovalnica/examinations.php?mode=edit&action=unfollow_subject&data=' . $row['SubjectID'] . '"><img src='; ?> <?php echo $rootFolder . "images/remove.png"; ?> <?php echo 'width="20px" align="left"></a>' . $row['Title'] . '</td>';

                          $activeExaminations = getActiveExaminations($conn, $_SESSION['UserID'], $row['SubjectID']);

                          $examinationsByMonths = array("01" => array(),
                                                        "02" => array(),
                                                        "03" => array(),
                                                        "04" => array(),
                                                        "05" => array(),
                                                        "06" => array(),
                                                        "07" => array(),
                                                        "08" => array(),
                                                        "09" => array(),
                                                        "10" => array(),
                                                        "11" => array(),
                                                        "12" => array(),);
                          while($row1 = mysqli_fetch_assoc($activeExaminations)) {
                            $dt = $row1['Date'];
                            $month = date("m", strtotime($dt));

                            $arr = $examinationsByMonths[$month];
                            array_push($arr, date("d", strtotime($dt)));

                            $examinationsByMonths[$month] = $arr;
                          }

                          foreach ($examinationsByMonths as $key => $value) {
                            if(sizeof($value) > 0) {
                              $toEcho = '<td>';
                              foreach ($value as $examination => $value2) {
                                $toEcho = $toEcho . $value2 . ', ';
                              }
                              $toEcho = substr($toEcho, 0, -2) . '<a href="' . $rootFolder . 'redovalnica/examinations.php?mode=edit&action=edit_exams&data=' . $row['SubjectID'] . '"><img src=';
                              $toEcho = $toEcho . $rootFolder . 'images/edit.png width="20px" align="right"></a></td>';
                              echo $toEcho;
                            }else echo '<td></td>';
                          }
                      echo '<tr>';
                  }
              }
            ?>
            <tr>
              <td class="center predmet" colspan="13"><img src=<?php echo $rootFolder . "images/remove.png"; ?> width="20px" valign="middle" style="transform:rotate(45deg);"><a href="./examinations.php?mode=edit&action=add_subject">Dodaj nov predmet</a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
