<?php

require_once("../vendor/autoload.php");

use Helpers\HTTP;
use Libs\Databases\UsersTable;
use Libs\Databases\MySQL;

$db = new UsersTable(new MySQL());
$email = $_POST['email'];
$password = md5($_POST['password']);

if($email !== "" and $password !== "")
{      
    $user = $db->find_Email_Password($email,$password);
    if($user)
    {
        session_start();
        $_SESSION[$user];
        HTTP::redirect('admin.php');            
    }
    else
    {
        HTTP::redirect('index.php',"Your account is not found in our database.");
    }

}
else
{
    HTTP::redirect('index.php',"Incomplete Login Attempt.");
}