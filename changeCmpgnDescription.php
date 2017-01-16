<?php
header('Content-Type: text/html; charset=utf-8');
    $newCmpgnDescription=rawurldecode($_GET['new_cmpgn_description']);
    $cmpgnName=$_GET['cmpgn_name'];
    
    
    require_once 'connect.php';
    
    $connection=@ new mysqli($host,$db_user,$db_password,$db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
	throw new Exception (mysqli_connect_errno());
	}
	else
	{
        @$connection->query($query);
	    $query="UPDATE `cmpgn_descriptions` SET `cmpgn_description` = '$newCmpgnDescription' WHERE `cmpgn_name`='$cmpgnName'";
	    @$connection->query($query);
	    $query="SELECT `cmpgn_description` FROM `cmpgn_descriptions` WHERE `cmpgn_name`='$cmpgnName'";
	    $result=@$connection->query($query);
	    $connection->close();
	    $categories=$result->fetch_assoc();
	    echo $categories['cmpgn_description'];
    }
    
?>
