<?php
    
    $selectedOption=$_GET['selectedOption'];
    
    switch($selectedOption)
    {
        case "Zmień":
        
        echo '<select name="step2Select" size="0" id="step2Select" onchange="loadStep(2)" onselect="loadStep(2)">';
        
        require_once "connect.php";
                
                $connection = @new mysqli($host, $db_user, $db_password, $db_name);
                $connection->set_charset("utf8");
                
                if($connection->connect_errno!=0)
                {
                    throw new Exception(mysqli_connect_errno());
                }
                else
                {
                
                    $query="SELECT menu_category_name, menu_site_type FROM menu_category_names ORDER BY menu_category_order";
                    $result=@$connection->query($query);
                    if($result==false){echo 'Zapytanie nie zostało wykonane poprawnie :( '; $connection->close();}
                    else
                    {
                        while(($categories=$result->fetch_assoc())!=null)
                        {
                            if($categories['menu_site_type']!="specjalna")
                            {
                                echo '<option>'.$categories['menu_category_name'].'</option>';
                            }
                        }
                        echo '</select> <div id="step3"></div>';
                        
                        $connection->close();
                    }
                    
                    
                }
                
        break;
        
    }


?>
