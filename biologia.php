<!DOCTYPE HTML>
<html lang="pl">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<title> Tawerna pod bocianem - strona grupy RPG</title>
<link rel="stylesheet" href="style.css" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lato|Lobster&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>

<body>

<div id="container">

	<?php
	include "menu.php";
	?>

	<?php
	require_once "connect.php";
	$connection=@new mysqli($host,$db_user,$db_password,$db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
	else
	{
		/*$campaignName=basename($_SERVER['PHP_SELF'],".php").PHP_EOL;
		$resultDescription=@$connection->query("SELECT Description FROM campaigndescriptions WHERE Name=\"'$campaignName'\"");
		if($resultDescription==false){echo 'Zapytanie nie zostało wykonane poprawnie :( '; $connection->close();}
		
		$queryData=$resultDescription->fetch_assoc();
		
		echo'<div id="description">';
		
		echo $queryData['Description'];
		
		echo'</div>';*/
		$fileName=basename($_SERVER['PHP_SELF'],".php");
		$result=@$connection->query("SELECT cmpgn_description FROM cmpgn_descriptions WHERE cmpgn_name='{$fileName}'");
		$resultText=$result->fetch_assoc();
		echo $resultText['cmpgn_description'];
	}
	?>
	
	
</div>

	<div id="footer">
	Wstąp do tawerny! Bartosz Łyżwa &copy 2016
	</div>
	
</body>
