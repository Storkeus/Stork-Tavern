<?php
    $newGreeting=$_GET['new_greeting'];
    
    
    require_once 'connect.php';
    
    $connection=@ new mysqli($host,$db_user,$db_password,$db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
	throw new Exception (mysqli_connect_errno());
	}
	else
	{
	    $query="UPDATE `home` SET `greeting` = '$newGreeting' WHERE `id_home`=1";
	    @$connection->query($query);
	    $query="SELECT `greeting` FROM `home` WHERE `id_home`=1";
	    $result=@$connection->query($query);
	    $connection->close();
	    $categories=$result->fetch_assoc();
	    echo $categories['greeting'];
    }
    
/*
'<div class="tellerText">Piwo, wędzona kiełbasa i coś jakby zdechły szczur, właśnie to czujesz gdy wkraczasz do zadymionego pomieszczenia. W normalnych warunkach Twoja stopa nigdy nie stanęłaby w miejscu takim jak to. Nie są to jednak normalne warunki, przychodzis tu w ważnej sprawie, chcesz zdobyć konkretne informacje na temat swoich dawnych i przyszłych sesji, a to jedyne miejsce gdzie można dostać je za kufel piwa...</div><br>Witaj w Tawernie pod Bocianem, znajdziesz tu wiele informacji i ciekawostek o naszych dawnych sesjach jak i przydatne materiały dotyczące sesji obecnych i przyszłych. Granie w RPGi już nigdy nie będzie takie samo.'/*/
?>
