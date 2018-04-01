<?php ob_start();?>

<?php
//$db["db_host"]= "localhost";
//$db["db_user"]= "root";
//$db["db_pass"]= "root";
//$db["db_name"]= "cms";
$db["db_host"]= "us-cdbr-iron-east-05.cleardb.net";
$db["db_user"]= "b2e6ad5fe0fe9d";
$db["db_pass"]= "e9574ae994aa871";
$db["db_name"]= "heroku_3f21b90598cb615";

foreach($db as $key => $value ){
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//}if($connection){
//    echo "We are connected";
//
?>