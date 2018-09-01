<?php
session_start();
?>
<script language="javascript">
    function red1()
    {
        window.location = "dashboard.php";
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
$query = $con->query("select * from users where username = '$username' and password='$password' ");
$count = mysqli_num_rows($query);
if($count == 1) {
    $result = $query->fetch_assoc();
    $_SESSION["username"]=$username;
    $_SESSION["login"] = 1;
    $_SESSION['permission'] = $result['permission'];
    echo "<h3 align='center'>Thank you..";
    if ($_SESSION['permission'] == 1)
    {
        echo "(admin)";
    }
    echo " $username, you will be redirected within 3 seconds </h3> ";
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