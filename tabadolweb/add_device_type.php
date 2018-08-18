<?php
session_start();
include "connect.php";







if (isset($_SESSION['permission']))
{
    
    if (isset($_GET["add"]))
    {

















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
        <form action="add_device_type.php?add2=<?php echo $_GET["add"]; ?>" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload"><br>
            Code<input type="text" name="code" id="code"><br>
            <input type="submit" value="Upload Image" name="submit">
        </form>
        </div>
        </div>
        </body>
        </html>

        <?php













    }
    else if (isset($_GET["add2"]))
    {














        $target_dir = "dev_imgs/";
        $target_file = $target_dir . uniqid(date('h-i-s')) . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ". <br>";

                


                $uploadOk = 1;

                if ($_FILES["fileToUpload"]["size"] > 1000000) {
                    echo "Sorry, your file is too large. (1 MB Max)<br>";
                    $uploadOk = 0;
                }


            } else {
                echo "File is not an image.<br>";
                ?>
                <script>
                    setTimeout(function() { window.location = 'add_device_type.php?add=<?php echo $_GET["add2"]; ?>'; }, 1000);
                </script>

                <?php
                $uploadOk = 0;

                


            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
                $uploadOk = 0;
            }


            if ($uploadOk == 1)
            {
                

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                {
                    $con->query("INSERT INTO dev_types (`name`, `img`, `code`) VALUES ('" . $_GET["add2"] . "', '" . $target_file . "', '" . $_POST["code"] . "')");

                    echo "Added Successfully";
                    ?>
                     <script>
                        setTimeout(function() { window.location = 'add_device_type.php'; }, 1000);
                    </script>

                    <?php

                } else {
                    echo "Failed to add";

                    ?>
                     <script>
                        setTimeout(function() { window.location = 'add_device_type.php?add=<?php echo $_GET["add2"]; ?>'; }, 1000);
                    </script>

                    <?php
                }
            }
        }

















    }
    else
    {

















        $query = $con->query("select * from dev_types");

        $count = mysqli_num_rows($query);


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
        <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Dropdown</button>
          <div id="myDropdown" class="dropdown-content">
            <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">









<?php
        while ($result = $query->fetch_assoc())
        {








            echo "<a href='?q=" . $result['id'] . "'>" . $result['name'] . "<img width='32px' height='32px' src='" . $result['img'] . "' /></a>";







        }
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
        </script>
        </div>
        </div>
        </body>
        </html>






<?php
    }



}
else
{
    echo "<script>window.location = 'index.php';</script>";
}



?>
