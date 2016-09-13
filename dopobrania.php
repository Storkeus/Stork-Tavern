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
		/*
		Connecting with SQL database and downloading list of files to download
		*/
		
		include "menu.php";

			require_once "connect.php";
	
			$connection = @new mysqli($host, $db_user, $db_password, $db_name);
			$connection->set_charset("utf8");
			
			if($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$result=@$connection->query("SELECT dwn_name, src_picture, src_file, dwn_description, id_downloads FROM downloads");
				if($result==false){echo 'Zapytanie nie zostało wykonane poprawnie :( '; $connection->close();}
				else
				{
					echo'<div id="dwnContent">';
						while(($file=$result->fetch_assoc())!=null)
						{
							echo'
							<div class="toDownload">
								<img src="'.$file['src_picture'].'">
								<div class="dwnBUTTON">
									<a href="'.$file['src_file'].'" download="'.$file['dwn_name'].'">
										<button type="button">Pobierz!</button>
									</a>
								</div>
							</div>';
						}
					echo '</div>';
                    $result->close();
                    $connection->close();
				}
			}
			
			?>
			

	
	
	</div>

	<div id="footer">
	Wstąp do tawerny! Bartosz Łyżwa &copy 2016
	</div>
	
</body>
