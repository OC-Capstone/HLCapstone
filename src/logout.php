<?php
// Set cookies to blank information to leave no trace.
setcookie('last_login', '', time() + 3600, "/");
setcookie('email', '', time() + 3600, "/");
setcookie('user_id', '', time() + 3600, "/");

// Set the expiration time of the cookies to the past to revoke them.
setcookie('last_login', '', time() - 3600, "/");
setcookie('email', '', time() - 3600, "/");
header("Location: login.html"); 
exit();
?>
