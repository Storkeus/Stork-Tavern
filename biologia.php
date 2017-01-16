<!DOCTYPE HTML>
<html lang="pl">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<title> Tawerna pod bocianem - strona grupy RPG</title>
<link rel="stylesheet" href="style.css" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lato|Lobster&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<script src="cke/ckeditor.js"></script>

<script src="loadDoc.js"></script>

</head>

<body>

<div id="container">

	<?php
	include "menu.php";
	?>

	<?php
	/*
        Connecting with database and downloading everything about campaign
	*/
	require_once "connect.php";
	$connection=@new mysqli($host,$db_user,$db_password,$db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
	else
	{
		$fileName=basename($_SERVER['PHP_SELF'],".php");
		$result=@$connection->query("SELECT cmpgn_description FROM cmpgn_descriptions WHERE cmpgn_name='{$fileName}'");
		$resultText=$result->fetch_assoc();
		
		echo '<div id="campaignDescription">';
            if($logged==true)
            {
            echo '<i onclick="editCmpgnDescription(\''.$fileName.'\');" class="editIcon  icon-pencil"></i>';
            }
		echo $resultText['cmpgn_description'];
		echo '</div>';
		
		$result=@$connection->query("SELECT cmpgn_category_name, cmpgn_category_miniature FROM cmpgn_content WHERE cmpgn_name='{$fileName}'");
		if($result==false){echo 'Zapytanie nie zostało wykonane poprawne :('; $connection.close();}
		else
		{
            echo '<div id="campaignMenu">';
            while(($option=$result->fetch_assoc())!=null)
            {
              echo'
              <button  class="option" onclick="loadDoc('."'".$option['cmpgn_category_name']."','"."$fileName"."'".')">
                <img src="'.$option['cmpgn_category_miniature'].'"><br>
                <span class="optionTitle">'.$option['cmpgn_category_name'].'</span>
              </div>
              ';
            }
            echo '</div>';
		}
		
		$result->close();
		$connection->close();
		
	}
	?>
	
	
	<div id="optionContent"></div>
	
	
</div>



	<div id="footer">
	Wstąp do tawerny! Bartosz Łyżwa &copy 2016
	</div>
</body>
