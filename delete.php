<?php
if($_SERVER["REQUEST_METHOD"]=="GET"){
   if(isset($_GET["id"])){
    $id=(string)$_GET["id"];
    require_once 'scriptCode/config.php';
    $stmt=mysqli_prepare($con,"delete from person where personid=?");
    mysqli_stmt_bind_param($stmt,'i',$id);
    $end=mysqli_stmt_execute($stmt);
    if($end){
        header("location:allPerson.php?dltComplete={success delete}");
    }
   }
   else{
    header("location:allPerson.php");
   }
}