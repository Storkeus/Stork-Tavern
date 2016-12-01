<?php

session_start();

require_once 'connect.php';

$connection=@new mysqli($host,$db_user,$db_password,$db_name);
$connection->set_charset("utf8");

if($connection->connect_errno!=0)
{
echo 'ERROR: '.$connection->connect_errno.' DESCRIPTION: '.$connection->connect_error;
}
else
{

$checkLogin=$_POST['login'];
$checkPassword=$_POST['password'];

$checkLogin=htmlentities($checkLogin,ENT_QUOTES,"UTF-8");
$checkPassword=htmlentities($checkPassword,ENT_QUOTES,"UTF-8");

    if($checkQuery=@$connection->query(sprintf("SELECT login, password FROM users WHERE login='%s' AND password='%s'",mysqli_real_escape_string($connection,$checkLogin),mysqli_real_escape_string($connection,$checkPassword))))
    {
    
        $howManyUsers=$checkQuery->num_rows;
        if($howManyUsers>0)
        {
        $row=$checkQuery->fetch_assoc();
        $_SESSION['logged']=true;
        $_SESSION['user']=$row['login'];
        unset($_SESSION['errorLogin']);
        $checkQuery->close();
        header('Location:admin.php');
        }
        else
        {
        $_SESSION['errorLogin']='<span class="error">Błędny login lub hasło</span>';
        header('Location:zaloguj.php');
        }
        
    }
    $connection->close();
}

?>
