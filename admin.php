<?php
session_start();
if(!isset($_SESSION['logged'])or $_SESSION['logged']=false)
{
header("Location: index.php");
exit();
}

?>


<!DOCTYPE HTML>
<html lang="pl">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<title> Tawerna pod bocianem - strona grupy RPG</title>
<link rel="stylesheet" href="style.css" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lato|Lobster&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<script src="ckeditor/ckeditor.js"></script>
<script src="loadOptions.js"></script>
<script src="toCKE.js"></script>
<script src="enableButton.js"></script>
</head>

<body>
	<div id="container">
	
	<?php
	include "menu.php";
	?>
	
    
    
    <form action="changes.php" method="post" name="adminMainForm">
    <select name="step1Select" size="0" id="step1Select" onchange="loadStep(1)">
        <option>Dodaj</option>
        <option>Zmień</option>
        <option>Usuń</option>
    </select>
    
    <div id="step2"></div>
    <div style="clear:both;"></div>
    <input type="submit" disabled  value="Dalej" id="dalejAdmin">
    
</form>


</div>

	<div id="footer">
	Wstąp do tawerny! Bartosz Łyżwa &copy 2016
	</div>
	
</body>
