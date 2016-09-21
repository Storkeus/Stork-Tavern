<!DOCTYPE HTML>
<html lang="pl">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<title> Tawerna pod bocianem - strona grupy RPG</title>
<link rel="stylesheet" href="style.css" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lato|Lobster&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

<script>
var option="";
 function loadSite(var choose)
 {
 option=choose;
 document.getElementById("hOption").innerHTML=option;
 document.getElementByIf("hOption").submit();
 }
</script>
</head>

<body>

<div id="container">

	<?php
	include "menu.php";
	?>

	<?php
	/*
        Connecting with database and downloading evrything about campaign
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
		echo $resultText['cmpgn_description'];
		echo '</div>';
		
		$result=@$connection->query("SELECT cmpgn_category_name, cmpgn_category, cmpgn_category_miniature FROM cmpgn_content WHERE cmpgn_name='{$fileName}'");
		if($result==false){echo 'Zapytanie nie zostało wykonane poprawne :('; $connection.close();}
		else
		{
            echo '<div id="campaignMenu">';
            while(($option=$result->fetch_assoc())!=null)
            {
              echo'
              <button type="button" class="option" onclick="loadSite('.$option['cmpgn_category_name'.')">
                <img src="'.$option['cmpgn_category_miniature'].'"><br>
                <span class="optionTitle">'.$option['cmpgn_category_name'].'</span>
              </div>
              ';
            }
            echo '</div>';
		}
	echo '<div id="campaignContent">';
	$result=$connection->query("SELECT cmpgn_category FROM cmpgm_content WHERE cmpgn_category_name='{$GET['hOption']}'");
	
	echo '<\div>';
		
		
	}
	?>
	
	
</div>

	<div id="footer">
	Wstąp do tawerny! Bartosz Łyżwa &copy 2016
	</div>
	
	<form method="GET" id="hForm">
	<input id="hOption" type="text"></input>
	</form>
	
</body>
