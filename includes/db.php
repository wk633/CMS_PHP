<?php

//$db['db_host'] = 'localhost';
//$db['db_user'] = 'root';
//$db['db_pass'] = '';
//$db['db_name'] = 'cms';
//
//foreach($db as $key => $value) {
//    define(strtoupper($key), $value);
//}
//
//$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


$connection = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);

//if ($connection) {
//    echo "connect success";
//}

?>