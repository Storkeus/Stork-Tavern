<?php

$choose=$_GET['choose'];
$name=$_GET['name'];
require_once "connect.php";
$connection=@new mysqli($host,$db_user,$db_password,$db_name);
$connection->set_charset("utf8");

if($connection->connect_errno!=0)
{
    throw new Exception(mysqli_connect_errno());
}
else
{
    $result=@$connection->query("SELECT cmpgn_category FROM cmpgn_content WHERE cmpgn_name='{$name}'AND cmpgn_category_name='{$choose}'");
    if($result==false){echo 'Zapytanie nie zostało wykonane poprawne :('; $connection->close();}
    else
    {
    
    $content=$result->fetch_assoc();
    
   @ session_start();
    if(isset($_SESSION['logged'])&& $_SESSION['logged']=true)
    {
		echo '<i onclick="editCmpgnCategoryContent(\''.$choose.'\', \''.$name.'\');" class="editIcon  icon-pencil"></i>';
    }
    
    echo $content['cmpgn_category'];
    
    }
}

?>
