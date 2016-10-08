<link rel="stylesheet" href="menu.css" type="text/css">

	<div id="logo">
	Tawerna pod <span id="storkLogo">Bocianem</span>
	</div>
	
	<?php
	require_once('connect.php');
	$connection=@ new mysqli($host,$db_user,$db_password,$db_name);
	$connection->set_charset("utf8");
	
	if($connection->connect_errno!=0)
	{
	throw new Exception (mysqli_connect_errno());
	}
	else
	{
	$result=@$connection->query("SELECT * FROM menu_category_names ORDER BY menu_category_order");
	
        echo '<div id="menu">';
        echo '<ol>';
        while(($categories=$result->fetch_assoc())!=null)
        {
            echo '<li><a class="menuLink" href="'.$categories['menu_category_direction'].'">'.$categories['menu_category_name'].'</a>';
            
            $resultSubsites=@$connection->query("SELECT menu_subsite_direction, menu_subsite_name FROM menu_subsites WHERE menu_subsite_category=".'"'.$categories['menu_category_name'].'"'." ORDER BY menu_subsite_id");
            
                echo '<ul>';
            
                while(($subsites=$resultSubsites->fetch_assoc())!=null)
                {
                    echo '<li><a href="'.$subsites['menu_subsite_direction'].'" class="menuLink">'.$subsites['menu_subsite_name'].'</a></li>';
                }
            
                echo '</ul>';
            
            echo '</li>';
        }
        echo '</ol>';
        echo '</div>';
	}
	
	?>
	
