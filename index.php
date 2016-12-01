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

	
	<div id="content">
	<?php	
	
	/* connect with a SQL server and download greeting and announcement */
	
	require_once "connect.php";
	
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
	else
	{
		$result=@$connection->query("SELECT greeting, announcement FROM home WHERE id_home=1");
		if($result==false){echo 'Zapytanie nie zostało wykonane poprawnie :( '; $connection->close();}
		{
            $resultText=$result->fetch_assoc();
            echo $resultText['greeting'];
		}
	}
	
	?>
	</div>
	
	
	<div id="announcements">
	<?php
	echo $resultText['announcement'];	
	$result->close();
	$connection->close();
	?>

	
	</div>
	
	
</div>

	<div id="footer">
	Wstąp do tawerny! Bartosz Łyżwa &copy 2016
	</div>
	
</body>
