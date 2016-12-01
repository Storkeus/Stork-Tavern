<?php
    session_start();
    $selectedOption=$_GET['selectedOption'];
    $editedSite=$_SESSION['editedSite'];
    $type=$_SESSION['typeOfEditedSite'];
    
    require_once('connect.php');
    
    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
    $connection->set_charset("utf8");
    
    if($connection->connect_errno!=0)
	{
	echo 'Błąd połączenia. Przepraszamy :(';
	}
	else
	{
    $query="SELECT data_table_name FROM menu_subsites WHERE menu_subsite_name='$selectedOption'";
    $result=$connection->query($query);
    $table=$result->fetch_assoc();
    $tableName=$table['data_table_name'].'_content';

        switch($type)
        {
            case "z podstronami":
            
                $table1Name=$table['data_table_name'].'_content';
                $table2Name=$table['data_table_name'].'_descriptions'; 
                
                
                $query="SELECT cmpgn_name FROM $table2Name WHERE cmpgn_name='$selectedOption' ORDER BY cmpgn_name";
	
                $result=$connection->query($query);
                
                if($result->num_rows==0)
                {
                $isThereSomethingToEdit2=false;
                }
                $result->close();
                echo '<select name="step4Select" size="0" id="step4Select" onchange="loadStep(4)" onautocomplete="loadStep(4)">';            
                echo '<option>Opis podstrony</option>';
                
                
                $query="SELECT cmpgn_category_name, cmpgn_category, cmpgn_category_miniature  FROM $table1Name WHERE cmpgn_name='$selectedOption' ORDER BY cmpgn_id";
                
                $result=$connection->query($query);
                
              if($result->num_rows==0)
                {
                $isThereSomethingToEdit=false;
                }
                
                if(($isThereSomethingToEdit=false)&&($isThereSomethingToEdit2=false))
                {
                echo'</select>';
                exit();
                }

                while(($editable=$result->fetch_assoc())!=null)
                {
                echo '<option>'.$editable['cmpgn_category_name'].'</option>';
                }
                echo '</select>';


                //                 echo 'Nazwa podstrony: <textarea id="changeShortTextArea" rows="1">'.$editable['cmpgn_category_name'].'</textarea>';
               // echo' <textarea name="editor1" id="editor1" rows="10" cols="80" ="toCKE()"></textarea>';
                
                $connection->close();
                
                break;
                
                
                
        }
	}

?>
