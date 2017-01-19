<?php
session_start();
if(!isset($_SESSION['logged'])or $_SESSION['logged']=false)
{
header("Location: index.php");
exit();
}

    $newName=$_GET['new_name'];
    $oldName=$_GET['old_name'];
    
    
    require_once 'connect.php';
    
    $connection=@ new mysqli($host,$db_user,$db_password,$db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
	throw new Exception (mysqli_connect_errno());
	}
	else
	{
	    $query="UPDATE `menu_category_names` SET `menu_category_name` = '$newName' WHERE `menu_category_name`='$oldName'";
	    @$connection->query($query);
	    $query="SELECT * FROM `menu_category_names`WHERE `menu_category_name`='$newName'";
	    $result=@$connection->query($query);
        $connection->close();
	    $categories=$result->fetch_assoc();
	    echo $categories['menu_category_name'];
    }
    
    
?>
