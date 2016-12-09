<?php
function login($handler, $username, $password) {
  if (empty($username) || empty($password)) {return 'Please fill in all fields.';}
  if (!isUsernameTaken($handler, $username)) {return 'User does not exist.';}

  $details = getDetails($handler, $username);

  $salt = $details[0];
  $saltedPassword = $details[1];

  if (md5($salt . $password . $salt) == $saltedPassword) {
    $_SESSION['username'] = $username;
    header("Location: panel.php");
  } else {
    return 'Invalid Login Information.';
  }

}

function getDetails($handler, $username) {
  $query = $handler->prepare("SELECT salt, password FROM admins WHERE username = :username");
  $query->bindParam(":username", $username);
  if($query->execute()) {
    return $query->fetch();
  }
}

function isUsernameTaken($handler, $username) {
  $query = $handler->prepare("SELECT username FROM admins WHERE username = :username");
  $query->bindParam(":username", $username);
  $query->execute();
  if ($query->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

?>