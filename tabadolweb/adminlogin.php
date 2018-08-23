<?php
session_start();
?>
<script language="javascript">
    function red1()
    {
        window.location = "cbody.php";
    }
    function red2()
    {
        window.location = "index.php";
    }

</script>
<?php
include "connect.php";
$username = $_POST["username"];
$password = $_POST["password"];


$result = $con ->query("select * from users where username = '$username' and password='$password' ");

$num = mysqli_num_rows($result);

if( $num != 0) {
    $_SESSION["username"]=$username;
    $_SESSION["login"] = 1;
    echo "<h3 align='center'>Thank you..admin. $username, you will be redirected within 3 seconds </h3> ";
    echo "<script>setTimeout('red1()',3000)</script>";
}
else {
    echo "<h3 align='center'>Error in name or password, you will be redirected within 3 seconds </h3> ";
    echo "<script>setTimeout('red2()',3000) </script>";
}
?>
<div align="center">
    <img src="imgs/loading-dots.gif"  />
</div>