<?php
session_start();
if(!isset($_SESSION['logged'])or $_SESSION['logged']=false)
{
header("Location: index.php");
exit();
}

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
	    $query="UPDATE `menu_category_names` SET `menu_site_type` = 'usunięta' WHERE `menu_category_name`='$name'";
	    @$connection->query($query);
	    $query="SELECT * FROM `menu_category_names` WHERE `menu_category_name`='$name'";
	    $result=@$connection->query($query);
	    $connection->close();
	    $categories=$result->fetch_assoc();
	    echo 'Usunięto: '.$categories['menu_category_name'];
    }
    
    
?>
 
