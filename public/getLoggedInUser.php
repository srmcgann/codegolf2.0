<?
  require("functions.php");
  $userID=$_COOKIE['id'];
  $pass=mysqli_real_escape_string($link, $_COOKIE['session']);
  $sql="SELECT * FROM users WHERE id=$userID AND pass=\"$pass\"";
  $res=$link->query($sql);
  if(mysqli_num_rows($res)){
    ?>
      <div id="loggedInRightMenu">
        <div class="dropdown">
          <span onclick="location.href='<?=$name?>'" class="userMenu"><?=$name?></span>
          <img src='<?=$avatar?>' class="menuAvatar">
          <div class="dropdown-content">
            <p onclick="Preferences()" class="dropdownItem">Preferences</p>
            <p onclick="ChangePassword()" class="dropdownItem">Change Password</p>
            <p onclick="LogOut()" class="dropdownItem">Log Out</p>
          </div>
        </div>
      </div>
      <div id="header"></div>
    <?
  }
?>
