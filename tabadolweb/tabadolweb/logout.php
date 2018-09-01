<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["login"]);
unset($_SESSION["permission"]);
session_destroy();
?>
<html>
<script language="javascript">
window.location = "index.php";
</script>
</html>
