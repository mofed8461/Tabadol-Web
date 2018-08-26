<?php
session_start();
include "connect.php";


if (!isset($_GET['id']))
{
    header('Location: dashboard.php');
}




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



.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #3e8e41;
}

#myInput {
    border-box: box-sizing;
    background-image: url('searchicon.png');
    background-position: 14px 12px;
    background-repeat: no-repeat;
    font-size: 16px;
    padding: 14px 20px 12px 45px;
    border: none;
    border-bottom: 1px solid #ddd;
}

#myInput:focus {outline: 3px solid #ddd;}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f6f6f6;
    min-width: 230px;
    overflow: auto;
    border: 1px solid #ddd;
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}

    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Dashboard</title>
  
</head>

<body>
<div align="center" style="padding-top: 10%">
    <div align="center">
        <h3>اضافة طلب استقراض</h3>
        <br />
        رقم المسؤوول
        <input id="phone" type="text" />
        <br />
        اسم المسؤوول
        <input id="name" type="text" />
        <br />
        تاريخ الاستقراض من
        <input id="start_time_d" type="number" min="1" max="31" placeholder="DD" value="1" />
        <input id="start_time_m" type="number" min="1" max="12" placeholder="MM" value="1" />
        <input id="start_time_y" type="number" min="2018" max="9999" placeholder="YYYY" value="2018" />

        <br />
        تاريخ الاستقراض الى
        <input id="end_time_d" type="number" min="1" max="31" placeholder="DD" value="1" />
        <input id="end_time_m" type="number" min="1" max="12" placeholder="MM" value="1" />
        <input id="end_time_y" type="number" min="2018" max="9999" placeholder="YYYY" value="2018" />
        <br />
        ملاحظات
        <input id="notes" type="text" />
        <br />
        <button onclick="submit();">اضافه</button>
        <br />
        <a href="dashboard.php">عوده</a>

    </div>
</div>
</body>
</html>

<script type="text/javascript">

    function diff( date1, date2 ) {
      //Get 1 day in milliseconds
      var one_day=1000*60*60*24;

      // Convert both dates to milliseconds
      var date1_ms = date1.getTime();
      var date2_ms = date2.getTime();

      // Calculate the difference in milliseconds
      var difference_ms = date2_ms - date1_ms;
        
      // Convert back to days and return
      return Math.round(difference_ms/one_day); 
    }

    function submit()
    {
        var phone = document.getElementById("phone");
        var name = document.getElementById("name");

        var start_time_d = document.getElementById("start_time_d").value;
        if (start_time_d < 10)
        {
            start_time_d = "0" + start_time_d;
        }
        var start_time_m = document.getElementById("start_time_m").value;
        if (start_time_m < 10)
        {
            start_time_m = "0" + start_time_m;
        }
        var start_time_y = document.getElementById("start_time_y").value;
        if (start_time_y < 10)
        {
            start_time_y = "0" + start_time_y;
        }

        var end_time_d = document.getElementById("end_time_d").value;
        if (end_time_d < 10)
        {
            end_time_d = "0" + end_time_d;
        }
        var end_time_m = document.getElementById("end_time_m").value;
        if (end_time_m < 10)
        {
            end_time_m = "0" + end_time_m;
        }
        var end_time_y = document.getElementById("end_time_y").value;
        if (end_time_y < 10)
        {
            end_time_y = "0" + end_time_y;
        }

        var notes = document.getElementById("notes");

        if (phone.value == "")
        {
            alert("رقم المسؤوول فارغ");
            return;
        }
        if (name.value == "")
        {
            alert("اسم المسؤوول فارغ");
            return;
        }

        var splitFrom = [start_time_y, start_time_m, start_time_d];
        var splitTo = [end_time_y, end_time_m, end_time_d];
        

        var fromDate = parseInt(splitFrom[0] + "" + splitFrom[1] + "" + splitFrom[2]);
        var toDate = parseInt(splitTo[0] + "" + splitTo[1] + "" + splitTo[2]);
        var cmonth = new Date().getMonth();
        if (cmonth < 10)
        {
            cmonth = "0" + cmonth;
        }

        var cday = new Date().toLocaleDateString('en-US', { day:'numeric' });
        if (cday < 10)
        {
            cday = "0" + cday;
        }


        var currentDate = parseInt(new Date().getFullYear() + "" + cmonth + "" + cday);

        if (currentDate >= fromDate || currentDate >= toDate)
        {
            alert("التاريخ يجب ان يكون بالمستقبل");
            return;
        }

        if (fromDate >= toDate)
        {
            alert("تاريخ بدايه الاستقراض يجب ان يكون قبل تاريخ النهايه");
            return;
        }

        var st = start_time_y + "-" + start_time_m + "-" + start_time_d;
        var ed = end_time_y + "-" + end_time_m + "-" + end_time_d;

        if (diff(new Date(st), new Date(ed)) > 7)
        {
            alert("مدو الاستقراض لا يجب ان تزيد عن 7 ايام");
            return;
        }

        window.location = "request_view.php?id=<?php echo $_GET["id"]; ?>&phone=" + phone.value + "&name=" + name.value + "&start_time=" + st + "&end_time=" + ed + "&notes=" + notes.value;
    }

</script>

