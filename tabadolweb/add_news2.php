
<?php
$title  = $_POST["title"];
$txt = $_POST["text"];


include("connect.php");

$con->query("INSERT into news  set title='$title', text='$txt'") or die("Error in inserting data");


echo "<h2 align='center'>تم نشر الخبر</h2>";

?>
<script language="javascript">
    setTimeout("window.location='news.php'",'3000');
</script>
