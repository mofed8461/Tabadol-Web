<?php
session_start();
include "connect.php";


if (isset($_GET['id']) && isset($_GET['request_id']) && isset($_GET['quantity']) && isset($_GET['add']))
{
    $con->query("INSERT INTO request_data (request_id, dev_type_id, quantity) VALUES ('" . $_GET['request_id'] . "', '" . $_GET['dev_id'] . "', '" . $_GET['quantity'] . "')");

    header('Location: request_view.php?id=' . $_GET['id'] . '&request_id=' . $_GET['request_id']);
}


$query = $con->query("select * from dev_types");


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

        الجهاز
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn" id='devicesMenu'>Select Device</button>
            <div id="myDropdown" class="dropdown-content">
                <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">









<?php
while ($result = $query->fetch_assoc())
{








    echo "<a onclick=\"setSelected(" . $result['id'] . ", '" . $result['name'] . "');\">" . $result['name'] . "<img width='32px' height='32px' id='img_" . $result['id'] . "' src='" . $result['img'] . "' /></a>";







}



$query = $con->query("SELECT schools.id as id from users, schools where schools.id = users.school_id and users.username = '". $_SESSION["username"] . "'");
$result = $query->fetch_assoc();

?>


                <a onclick="addClick();" style="display: none">Add</a>

            </div>
        </div>
        <script>
        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        function filterFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            div = document.getElementById("myDropdown");
            a = div.getElementsByTagName("a");
            var addButton, enableAdd = true;
            for (i = 0; i < a.length; i++) {
                if (a[i].innerHTML != "Add")
                {
                    if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        a[i].style.display = "";
                        enableAdd = false;

                        
                    } else {
                        a[i].style.display = "none";                
                    }
                }
                else
                {
                    addButton = a[i];
                }
            }

            if (enableAdd)
            {
                addButton.style.display = "";
            }
            else
            {
                addButton.style.display = "none";
            }
        }

        function addClick()
        {
            window.location = "add_device_type.php?add=" + document.getElementById("myInput").value;
        }

        var selectedID = null;
        function setSelected(id, name)
        {
            selectedID = id;
            document.getElementById('devicesMenu').innerHTML = name;
            myFunction();
        }

        function submit()
        {
            var quantity = document.getElementById("quantity").value;
            quantity = parseInt(quantity);
            if (quantity == NaN)
            {
                alert('الرجاء اختيار كميه');
                return;
            }

            if (selectedID == null)
            {
                alert('الرجاء اختيار جهاز');
                return;
            }

            window.location = "add_request_devices.php?id=<?php echo $result['id']; ?>&request_id=<?php echo $_GET["request_id"]; ?>&quantity=" + quantity + "&dev_id=" + selectedID + "&add=true";
        }

        </script>
        <br />
        الكميه
        <input id="quantity" type="number" />
        <br />
        <button onclick="submit();">اضافه</button><br />
        <a href="dashboard.php">عوده</a>

    </div>
</div>
</body>
</html>

