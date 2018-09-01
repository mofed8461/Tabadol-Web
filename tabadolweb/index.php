<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
    <title>admin-page</title>
    <script language="javascript">
        function check()
        {
            var admin_name = document.adminform.username.value;
            var password      = document.adminform.password.value;
            if(admin_name =="" )
            {
                alert("fill the admin name");
            }
            else if(password =="" )
            {
                alert("fill the admin password");
            }
            else
            {
                document.adminform.submit();
            }
        }
    </script>
</head>

<body>
<div align="center" style="padding-top: 10%">
<div align="center"><img src="imgs/bg.jpeg" width="300" height="300"  /></div>
<h3><div  align="center" >Admin Login </div></h3>
<div align="center">
    <form name="adminform" method="post" action="adminlogin.php">
        <table >
            <tr><td>Username</td><td><input type="text" name="username" /></td></tr>
            <tr><td>Password</td><td><input type="password" name="password" /></td></tr>
            <tr>
                <td colspan="2" align="center"><input type="button" value="Login" onclick="check()"  /></td>
            </tr>

        </table>
    </form>
</div>
</div>
</body>
</html>