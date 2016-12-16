<?php
    $newLink=$_GET['new_link'];
    $name=$_GET['name'];
    
    
    require_once 'connect.php';
    
    $connection=@ new mysqli($host,$db_user,$db_password,$db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
	throw new Exception (mysqli_connect_errno());
	}
	else
	{
	    $query="UPDATE `menu_subsites` SET `menu_subsite_direction` = '$newLink' WHERE `menu_subsite_name`='$name'";
	    @$connection->query($query);
	    $query="SELECT * FROM `menu_subsites` WHERE `menu_subsite_name`='$name'";
	    $result=@$connection->query($query);
	    $connection->close();
	    $categories=$result->fetch_assoc();
	    echo $categories['menu_subsite_direction'];
    }
    
    
?>
