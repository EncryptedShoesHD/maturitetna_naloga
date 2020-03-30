<?php
  $result = getUserInfo($conn);
  $row = mysqli_fetch_assoc($result);
  echo '<div id="profile_widget">
        <div id="greeting">
          <span class="section_title">Pozdravljeni, ' . $row['Name'] . " " . $row['Surname'] . '!</span>
        </div>
        <div class="user_info_section">
          <span class="subsection_title">Ime in priimek</span>
          <div class="user_info">';

            if($_POST && isset($_POST['name']) && isset($_POST['surname'])) {
              if(changeNameAndSurname($conn, $_SESSION['UserID'], $_POST['name'], $_POST['surname'])) {
                header('Location: ' . $rootFolder . 'redovalnica/');
              } else echo '<p id="error">Pri spreminanju imena in priimka je prišlo do napake.</p>';
            }

            if($_GET && isset($_GET['mode']) && isset($_GET['variable']) && $_GET['variable'] === 'name') {
              echo '<form method="post" action="' . $rootFolder . 'redovalnica/index.php">
                      <input type="text" id="name" name="name" placeholder="Ime" pattern="[a-žA-Ž]{3,30}" value="' . $row['Name'] . '" required>
                      <input type="text" id="surname" name="surname" placeholder="Priimek" pattern="[a-žA-Ž]{3,30}" value="' . $row['Surname'] . '" required><br>
                      <input type="submit" value="Spremeni">
                    </form>';
            } else echo '<img src="' . $rootFolder . 'images/user.png" width="24px" align="left">
                         <span>' . $row['Name'] . " " . $row['Surname'] . '</span>
                         <a href="' . $rootFolder . 'redovalnica/?mode=edit&variable=name"><img src="' . $rootFolder . 'images/edit.png" width="24px" align="right"></a>';

          echo '</div>
        </div>
        <div class="user_info_section">
          <span class="subsection_title">E-poštni naslov</span>
          <div class="user_info">
            <img src="' . $rootFolder . 'images/email.png" width="24px" align="left">
            <span>' . $row['Email'] . '</span>
          </div>
        </div>
        <div class="user_info_section">
          <span class="subsection_title">Uporabniško ime</span>
          <div class="user_info">';

          if($_POST && isset($_POST['username'])) {
            if(!userExists($conn, $_POST['username'])) {
              if(changeUsername($conn, $_SESSION['UserID'], $_POST['username'])) {
                header('Location: ' . $rootFolder . 'redovalnica/');
              } else echo '<p id="error">Pri spreminanju uporabniškega imena je prišlo do napake.</p>';
            }else echo '<p id="error">To uporabniško ime je že zasedeno.</p>';
          }

          if($_GET && isset($_GET['mode']) && isset($_GET['variable']) && $_GET['variable'] === 'username') {
            echo '<form method="post" action="' . $rootFolder . 'redovalnica/index.php">
                    <input type="text" id="username" name="username" placeholder="Uporabniško ime" pattern="|[a-zA-Z0-9_-]{8,30}" title="Vnesite uporabniško ime, ki vsebuje najmanj 8 znakov. Vsebuje lahko male in velike črke, številke in vezaj ter podčrtaj." value="' . $row['Username'] . '"><br>
                    <input type="submit" value="Spremeni">
                  </form>';
          } else echo '<img src="' . $rootFolder . 'images/user.png" width="24px" align="left">
                       <span>' . $row['Username'] . '</span>
                       <a href="' . $rootFolder . 'redovalnica/?mode=edit&variable=username"><img src="' . $rootFolder . 'images/edit.png" width="24px" align="right"></a>';

          echo '</div>
        </div>
        <div class="user_info_section">
          <span class="subsection_title">Geslo</span>
          <div class="user_info">
            <img src="' . $rootFolder . 'images/password.png" width="24px" align="left">
            <span>Zaradi varnosti ga ne prikazujemo</span>
            <a href="' . $rootFolder . 'member/change_password.php"><img src="' . $rootFolder . 'images/edit.png" width="24px" align="right"></a>
          </div>
        </div>
        <div id="profile_action">
          <button>
            <a class="button_a" href="' . $rootFolder . 'member/sign_out.php"><img src="' . $rootFolder . 'images/signout.png" width="24px" align="left">Odjava</a>
          </button>
          <br>
          <button>
            <a class="button_a" href="' . $rootFolder . 'member/remove_account.php"><img src="' . $rootFolder . 'images/remove_acc.png" width="24px" align="left">Izbriši račun</a>
          </button>
        </div>
      </div>';

?>
