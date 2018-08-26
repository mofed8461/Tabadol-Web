<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <style>
        p.normal {
            font-weight: normal;
        }

        p.light {
            font-weight: lighter;
        }

        p.thick {
            font-weight: bold;
        }

        p.thicker {
            font-weight: 900;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Dashboard</title>
  
</head>

<body>
<div align="center" style="padding-top: 10%">
<div align="center">

<?php


if (isset($_SESSION['permission']) && $_SESSION['permission'] == 1)
{
?>

<form method="post" name="form1" action="add_news2.php">
    العنوان<br /><input type="text" name="title" id="title"><br />
    الخبر<br /><textarea name="text" id="txt"></textarea><br />
    <input align="middle" type="button"  value="اضافة" onclick="check()"  />
</form>

<script type="text/javascript">
    function check()
    {
        var title = document.getElementById("title");
        var txt = document.getElementById("txt");
        if (title.value == "")
        {
            alert("الرجاء وضع عنوان");
        }
        else if (txt.value == "")
        {
            alert("الرجاء كتابه محتوى الموضوع");
        }
        else
        {
            window.form1.submit();
        }
    }
</script>

<?php
}
else
{
    echo "<script>window.location = 'index.php';</script>";
}
?>
<a href="news.php">عوده</a>
</div>
</div>
</body>
</html>