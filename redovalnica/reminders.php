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
        <?php
          include($rootFolder . 'includes/site-parts/profile_widget.php');
          include($rootFolder . 'includes/helpers.php');
        ?>
        <div id="upcoming_events_widget">

          <?php
          if($_GET) {
            if(isset($_GET['mode'])) {
              if($_GET['mode'] === 'edit') {
                if(isset($_GET['action'])) {
                  if($_GET['action'] === 'remove') {
                    removeReminder($conn, $_GET['data']);
                    header('Location: ' . $rootFolder . 'redovalnica/reminders.php');
                  } else if($_GET['action'] === 'add') {
                    echo
                    '<form id="grade_edit" method="post" action="./reminders.php">
                        <p id="instruction" style="width: 90%; margin-left: 5%; text-align: center;"><span style="color: 4744ff;">Dodajanje opomnika</span> </p>
                        <input name="naslov" type="text" placeholder="Naslov" required maxlength="30">
                        <label for="datum">Datum</label>
                        <input name="datum" type="date" min="' . date("Y-m-d") . '" required>
                        <label for="cas">Čas</label>
                        <input name="cas" type="time" required>
                        <label for="opozorilo_pred_kolicina">Opozorilo pred (količina)</label>
                        <input name="opozorilo_pred_kolicina" type="number" min="0">
                        <label for="opozorilo_pred_enota">Opozorilo pred (enota)</label>
                        <select name="opozorilo_pred_enota">
                           <option value="month">Mesec</option>
                           <option value="week">Teden</option>
                           <option value="day">Dan</option>
                           <option value="hour">Ura</option>
                           <option value="minute">Minuta</option>
                           <option value="second">Sekunda</option>
                        </select>
                        <div id="profile_action">
                          <button name="add_reminder">
                            <a class="button_a"><img src="' . $rootFolder . 'images/save.png" width="24px" align="left">Shrani</a>
                          </button>
                        </div>
                    </form>';
                  }
                }
              }
            }
          } else if($_POST) {
            if(isset($_POST['add_reminder'])) {
              saveReminder($conn, $_SESSION['UserID'], $_POST['naslov'], $_POST['datum'], $_POST['cas'], $_POST['opozorilo_pred_kolicina'], $_POST['opozorilo_pred_enota']);
              header('Location: ' . $rootFolder . 'redovalnica/reminders.php');
            }
          }

            $reminders = getActiveReminders($conn, $_SESSION['UserID']);
            if($reminders->num_rows > 0) {
              while($reminder = mysqli_fetch_assoc($reminders)) {
                echo
                '<div class="reminder">
                    <span class="reminder_title">' . $reminder['Title'] . '
                      <img onclick="removeReminder(' . $reminder['ReminderID'] . ')" src="' . $rootFolder . 'images/remove.png" width="18px" style="cursor: pointer">
                    </span>
                    <div class="reminder_data">
                      <span class="reminder_data_type">Datum:</span><span>' . date_format(new Datetime($reminder['DateUntil']), 'd. F, Y') . '</span>
                    </div>
                    <div class="reminder_data">
                      <span class="reminder_data_type">Ura:</span><span>' . date_format(new Datetime($reminder['DateUntil']), 'H:i') . '</span>
                    </div>
                    <div class="reminder_data">
                      <span class="reminder_data_type">Opozorilo pred dogodkom:</span><span>' . prettifySeconds(intval($reminder['RemindSecondsBefore'])) . '</span>
                    </div>
                 </div>';
              }
            }
          ?>
          <div class="query_result">
            <img onclick="addReminder()" src=<?php echo $rootFolder . "images/remove.png"; ?> width="48px" style="transform:rotate(45deg); cursor: pointer;">
            <p>Nov opomnik lahko ustvariš s klikom na zgornji gumb.</p>
          </div>
        </div>
      </div>
    </div>
    <?php include($rootFolder . 'includes/site-parts/footer.php') ?>
  </body>
</html>
