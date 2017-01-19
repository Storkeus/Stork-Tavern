<?php
session_start();
if(!isset($_SESSION['logged'])or $_SESSION['logged']=false)
{
header("Location: index.php");
exit();
}

    $newContent=rawurldecode($_GET['new_content']);
    $campaignName=rawurldecode($_GET['campaign_name']);
    $categoryName=rawurldecode($_GET['category_name']);
    
    
    require_once 'connect.php';
    
    $connection=@ new mysqli($host,$db_user,$db_password,$db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
	throw new Exception (mysqli_connect_errno());
	}
	else
	{
	    $query="UPDATE `cmpgn_content` SET `cmpgn_category` = '$newContent' WHERE `cmpgn_name`='$campaignName' AND `cmpgn_category_name`='$categoryName'";
	    @$connection->query($query);
	    $query="SELECT `cmpgn_category` FROM `cmpgn_content` WHERE `cmpgn_name`='$campaignName' AND `cmpgn_category_name`='$newContent'";
	    $result=@$connection->query($query);
	    $connection->close();
	    $categories=$result->fetch_assoc();
	    echo $categories['cmpgn_category'];
    }
    
?>
