<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Authorization, Accept, X-Requested-With, x-xsrf-token");
header("Content-Type: application/json; charset=utf-8");



include 'config.php';
$email =$_POST['email_address'];
$password = $_POST['password'];
$message = '';
$error = false;
$array;
try {
      $SelectQuery = "SELECT * FROM users Where email_address = '$email' AND password = '$password'  ";
        $Check = mysqli_query($kon, $SelectQuery);
        if(mysqli_num_rows($Check)>0){
            $array = mysqli_fetch_assoc($Check);
            if($array['password'] != $password){
                $message = "You insert a wrong password";
                $error = true;
                $array = null;
            }
        } else {
            $message = "No account yet";
            $error = true;
            $array = null;
        }
        mysqli_close($kon);
} catch(Exception $e){
    $message = $e->getMessage();
    die();
}

$result = ['message' => $message, 'result' =>  $array ,'error' => $error];
echo  json_encode($result);