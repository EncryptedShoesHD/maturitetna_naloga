<?php
 echo '<div id="profile_widget">
        <div id="greeting">
          <span class="section_title">Pozdravljeni, Jane Doe!</span>
        </div>
        <div class="user_info_section">
          <span class="subsection_title">Ime in priimek</span>
          <div class="user_info">
            <img src="' . $rootFolder . 'images/user.png" width="24px" align="left">
            <span>Jane Doe</span>
            <img src="' . $rootFolder . 'images/edit.png" width="24px" align="right">
          </div>
        </div>
        <div class="user_info_section">
          <span class="subsection_title">E-poštni naslov</span>
          <div class="user_info">
            <img src="' . $rootFolder . 'images/email.png" width="24px" align="left">
            <span>janedoe@gmail.com</span>
          </div>
        </div>
        <div class="user_info_section">
          <span class="subsection_title">Uporabniško ime</span>
          <div class="user_info">
            <img src="' . $rootFolder . 'images/user.png" width="24px" align="left">
            <span>janedoe</span>
            <img src="' . $rootFolder . 'images/edit.png" width="24px" align="right">
          </div>
        </div>
        <div class="user_info_section">
          <span class="subsection_title">Geslo</span>
          <div class="user_info">
            <img src="' . $rootFolder . 'images/password.png" width="24px" align="left">
            <span>Zaradi varnosti ga ne prikazujemo</span>
            <img src="' . $rootFolder . 'images/edit.png" width="24px" align="right">
          </div>
        </div>
        <div id="profile_action">
          <button>
            <img src="' . $rootFolder . 'images/signout.png" width="24px" align="left">
            Odjava
          </button>
          <br>
          <button>
            <img src="' . $rootFolder . 'images/remove_acc.png" width="24px" align="left">
            Izbriši račun
          </button>
        </div>
      </div>';

?>
