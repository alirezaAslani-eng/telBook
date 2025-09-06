<?php
$dbHost="localhost";
$dbUser="root";
$dbpass="";
$dbName="telbook";
$con = mysqli_connect($dbHost, $dbUser, $dbpass,$dbName);



function check($n){
    if($n){
        echo<<<success
            <p>Success</p>
        success;
    }
    else{
        echo<<<error
            <p>Error</p>
        error;
    }
}
?>