 <?php
 
 session_start();
 
    $selectedOption=$_GET['selectedOption'];
    
    require_once "connect.php";
                
    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
    $connection->set_charset("utf8");
    
    if($connection->connect_errno!=0)
	{
	echo 'Błąd połączenia. Przepraszamy :(';
	}
	else
	{
	
    $query="SELECT menu_site_type FROM menu_category_names WHERE menu_category_name='$selectedOption'";
    $result=$connection->query($query);
    $type=$result->fetch_assoc();
    $_SESSION['typeOfEditedSite']=$type['menu_site_type'];
    
        switch($type['menu_site_type'])
        {
            case "z podstronami":
            
                $query="SELECT menu_subsite_name FROM menu_subsites WHERE menu_subsite_category='$selectedOption' ORDER BY menu_subsite_id";
	
                $result=$connection->query($query);
                if($result->num_rows==0)
                {
                exit();
                }
                
                echo '<select name="step3Select" size="0" id="step3Select" onchange="if(value!=0){enableButton('."'dalejAdmin'".');loadStep(3)}else{disableButton('."'dalejAdmin'".');" onselect="loadStep(3)"  selected="true">';
                echo '<option selected value="0">NAZWA</option>';
                while(($subsites=$result->fetch_assoc())!=null)
                {
                echo '<option>'.$subsites['menu_subsite_name'].'</option>';
                }
                echo '</select><div id="step4"></div>';
                
                $_SESSION['editedSite']=$selectedOption;
                $connection->close();
                
                break;
         case "główna":
         
         echo '<select name="step3Select" size="0" id="step3Select" onchange="if(value!=0){enableButton('."'dalejAdmin'".')}else{disableButton('."'dalejAdmin'".')}"> 
         <option selected value="0">RUBRYKI</option>
         <option>Powitanie</option>
         <option>Ogłoszenie</option>
         </select>';
         
         
                
                
                
        }
	}

 ?>
