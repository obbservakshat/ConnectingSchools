<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Echo session variables that were set on previous page
echo "Welcome " . $_SESSION["uname"] . ".<br>";
?>

</body>
</html>