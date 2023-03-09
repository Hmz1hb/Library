<?php
session_start(); // start the session
session_destroy(); // end the session

// redirect to the login page
header("Location:http://localhost/Library/land-page.php");
exit(); // ensure that script execution stops here
?>
