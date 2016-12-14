<?php

   @ session_start();

    if(isset($_SESSION['logged'])&& $_SESSION['logged']=true)
    {
    $logged=true;
    }
    else
    {
    $logged=false;
    }
        
//}

?>

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
	
        if ($logged)
        {
            $query="SELECT * FROM menu_category_names WHERE (menu_when_show='logged' OR menu_when_show='always')AND menu_site_type!='usunięta' ORDER BY menu_category_order";
            echo '<link rel="stylesheet" href="css/fontello.css" type="text/css">';
            echo '<script src="edit.js"></script>';
        }
        else
        {
            $query="SELECT * FROM menu_category_names WHERE (menu_when_show='notlogged' OR menu_when_show='always')AND menu_site_type!='usunięto' ORDER BY menu_category_order";
        }
	
	
        $result=@$connection->query($query);
	
        echo '<div id="menu">';
        echo '<ol>';
        while(($categories=$result->fetch_assoc())!=null)
        {                    
                            
            echo '<li><div  id="menuLink_'.$categories['menu_category_name'].'"><a class="menuLink" href="'.$categories['menu_category_direction'].'">'.$categories['menu_category_name'].'</a><i onclick="editSubsiteName(\''.$categories['menu_category_name'].'\');" class="editIcon  icon-pencil"></i></div>';
            
            
        if ($logged)
        {
            $query="SELECT menu_subsite_direction, menu_subsite_name FROM menu_subsites WHERE menu_subsite_category=".'"'.$categories['menu_category_name'].'"'." AND (subsites_when_show='logged' OR subsites_when_show='always') ORDER BY menu_subsite_id";
        }
        else
        {
            $query="SELECT menu_subsite_direction, menu_subsite_name FROM menu_subsites WHERE menu_subsite_category=".'"'.$categories['menu_category_name'].'"'." AND (subsites_when_show='notlogged' OR subsites_when_show='always') ORDER BY menu_subsite_id";
        }
        
                    $resultSubsites=@$connection->query("SELECT menu_subsite_direction, menu_subsite_name FROM menu_subsites WHERE menu_subsite_category=".'"'.$categories['menu_category_name'].'"'." ORDER BY menu_subsite_id");
        
        
            $resultSubsites=@$connection->query($query);
            
                echo '<ul>';
            
                while(($subsites=$resultSubsites->fetch_assoc())!=null)
                {

                    echo '<li><div id="subsiteLink_'.$subsites['menu_subsite_name'].'"><a href="'.$subsites['menu_subsite_direction'].'" class="menuLink">'.$subsites['menu_subsite_name'].'</a><i onclick="editSubSubsiteName(\''.$subsites['menu_subsite_name'].'\');" class="editIcon  icon-pencil"></i></div></li>';
                }
            
                echo '</ul>';
            
            echo '</li>';
        }
        echo '</ol>';
        echo '</div>';
        $result->close();
        $connection->close();
	}
	
	?>
