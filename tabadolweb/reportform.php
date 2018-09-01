<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Report</title>
</head>

<body >
<?php
include "connect.php";


$query = $con->query("
                    SELECT 
                    sc1.id AS school_id,
                    sc1.name AS ask, 
                    sc2.name AS give, 
                    transactions.id AS tid,
                    transactions.phone_1 AS p1,
                    transactions.phone_2 AS p2,
                    transactions.name_1 AS n1,
                    transactions.name_2 AS n2,
                    transactions.request_id AS rid,
                    requests.start_time AS st,
                    requests.end_time AS ed,
                    requests.notes AS notes
                    FROM
                    transactions, 
                    schools AS sc1, 
                    schools AS sc2,
                    requests
                    WHERE 
                    transactions.school_1_id=sc1.id AND 
                    transactions.school_2_id=sc2.id AND
                    requests.id=transactions.request_id
                    ");

while ($result = $query->fetch_assoc())
{
?>

?>
	<div align="center">
<img src="imgs/Screen Shot 2018-09-01 at 9.36.23 PM.png"/>
		<input style="position: absolute; left: 533px; top: 517px; width: 225px;" type="text" name="school_name" value="<?php echo $result["ask"]; ?>"/>
	  <input style="position: absolute; left: 92px; top: 519px; width: 159px;" type="text" name="phone" value="<?php echo $result["p1"]; ?>"/>
	  <input style="position: absolute; left: 538px; top: 594px; width: 212px;" type="text" name="person1" value="<?php echo $result["n1"]; ?>"/>
		<input style="position: absolute; left: 105px; top: 590px; width: 212px;" type="text" name="phone1" value="<?php echo $result["p2"]; ?>"/>
		<!--<input style="position: absolute; left: 472px; top: 666px; width: 212px;" type="text" name="school_name"/>-->
		<input style="position: absolute; left: 89px; top: 667px; width: 212px;" type="text" name="manager1" value="<?php echo $result["ask"]; ?>"/>
		<input style="position: absolute; left: 564px; top: 816px; width: 212px; height: 26px;" type="text" name="school_name2" value="<?php echo $result["ask"]; ?>"/>
	  <input style="position: absolute; left: 140px; top: 815px; width: 142px; height: 26px;" type="text" name="phone2" value="<?php echo $result["ask"]; ?>"/>
	  <input style="position: absolute; left: 540px; top: 889px; width: 160px; height: 26px;" type="text" name="person3" value="<?php echo $result["ask"]; ?>"/>
	  <input style="position: absolute; left: 164px; top: 892px; width: 212px; height: 26px;" type="text" name="phone3" value="<?php echo $result["ask"]; ?>"/>
	  <input style="position: absolute; left: 192px; top: 964px; width: 159px; height: 26px;" type="text" name="manager3" value="<?php echo $result["ask"]; ?>"/>
	  <input style="position: absolute; left: 602px; top: 1127px; width: 191px; height: 26px;" type="text" name="dev_name" value="<?php echo $result["ask"]; ?>"/>
		<!--<input style="position: absolute; left: 525px; top: 1194px; width: 159px; height: 26px;" type="text" name="school_name"/>-->
		<input style="position: absolute; left: 601px; top: 1275px; width: 159px; height: 26px;" type="text" name="from" value="<?php echo $result["ask"]; ?>"/>
		<input style="position: absolute; left: 232px; top: 1271px; width: 219px; height: 26px;" type="text" name="to" value="<?php echo $result["ask"]; ?>"/>
	<!--	<input style="position: absolute; left: 457px; top: 965px; width: 159px; height: 26px;" type="text" name="school_name"/>-->
        <?php
        }

        ?>
</div>
</body>
</html>