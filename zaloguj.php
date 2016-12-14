<?php
session_start();

if(isset($_SESSION['logged'])&&$_SESSION['logged']=true)
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
</head>

<body>
	<div id="container">
	
	<?php
	require_once "menu.php";
	?>
	

	<div id="loginContainer" >
	<?php
            if(isset($_SESSION['errorLogin']))
            echo $_SESSION['errorLogin'];
        ?>
        <form method="post" action="logowanie.php" autocomplete="on">
        <input class="loginInput" type="text" name="login" placeholder="LOGIN">
        <input class="loginInput" type="password" name="password" placeholder="HASŁO">
        <input type="submit" value="Zaloguj się">
        </form>
        

        
    </div>

	
	
</div>

	<div id="footer">
	Wstąp do tawerny! Bartosz Łyżwa &copy 2016
	</div>
	
</body>
