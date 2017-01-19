<?php
    $campaign=rawurldecode($_GET['campaign_name']);
    $oldName=rawurldecode($_GET['category_name']);   
    $newName=rawurldecode($_GET['edit_cmpgn_category_name']);
    require_once 'connect.php';
    
    $connection=@ new mysqli($host,$db_user,$db_password,$db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
	throw new Exception (mysqli_connect_errno());
	}
	else
	{
	    $query="UPDATE `cmpgn_content` SET  `cmpgn_category_name`='$newName' WHERE `cmpgn_name`='$campaign' AND `cmpgn_category_name`='$oldName'";
	    @$connection->query($query);
	    $connection->close();
    }
    
?>
