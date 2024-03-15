<?php
// Set the expiration time of the cookies to the past to revoke them
setcookie('last_login', '', time() - 3600, "/");
setcookie('email', '', time() - 3600, "/");
header("Location: login.html"); 
exit();
?>
