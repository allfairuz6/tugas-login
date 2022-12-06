<?php
    define('DB_NAME', 'db_unbin');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');

    $kon =mysqli_connect("localhost", "root", "", "dbs_unbin") or die(mysqli_error());
?>