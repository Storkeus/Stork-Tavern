<?php
session_start();
if(!isset($_SESSION['logged'])or $_SESSION['logged']=false)
{
header("Location: index.php");
exit();
}

    $newGreeting=rawurldecode($_GET['new_greeting']);
    
    
    require_once 'connect.php';
    
    $connection=@ new mysqli($host,$db_user,$db_password,$db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
	throw new Exception (mysqli_connect_errno());
	}
	else
	{
	    $query="UPDATE `home` SET `greeting` = '$newGreeting' WHERE `id_home`=1";
	    @$connection->query($query);
	    $query="SELECT `greeting` FROM `home` WHERE `id_home`=1";
	    $result=@$connection->query($query);
	    $connection->close();
	    $categories=$result->fetch_assoc();
	    echo $categories['greeting'];
    }
    
?>
