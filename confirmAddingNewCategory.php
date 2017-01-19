<?php
    $campaign=rawurldecode($_GET['cmpgn_name']);
    $name=rawurldecode($_GET['new_cmpgn_category_name']);   
    $image=rawurldecode($_GET['new_cmpgn_category_img']);
    require_once 'connect.php';
    
    $connection=@ new mysqli($host,$db_user,$db_password,$db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
	throw new Exception (mysqli_connect_errno());
	}
	else
	{
	    $query="INSERT INTO `cmpgn_content`(`cmpgn_name`, `cmpgn_category_name`, `cmpgn_category`, `cmpgn_category_miniature`) VALUES ('$campaign','$name','<div id=\"bugfixCBA\">Miejsce na zawartość kategorii</div>','$image')";
	    @$connection->query($query);
	    $connection->close();
    }
    echo "sukces"
?>
