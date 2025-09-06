<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["fullname"]) && isset($_POST["telnumber"]) && isset($_POST["email"])) {
        $fullname = $_POST["fullname"];
        $tel = $_POST["telnumber"];
        $email = $_POST["email"];
        $image = $_FILES["image"];
        $id = (int)$_POST["id"];
        require_once 'scriptCode/config.php';
        $Stmt = mysqli_prepare($con, "update person set fullname=?,email=? where personid=?");
        mysqli_stmt_bind_param($Stmt, 'ssi', $fullname, $email, $id);
        mysqli_stmt_execute($Stmt);


        // ---------------------
        $Stmt2 = mysqli_prepare($con, "update tel set telnumber=? where personid=?");
        mysqli_stmt_bind_param($Stmt2, 'si', $tel, $id);
        mysqli_stmt_execute($Stmt2);


        // ----------------------
        if (file_exists($_FILES["image"]["tmp_name"])) {
            $path = 'image/' . $_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"], $path);
        }
        else{
            $path = "./default/default.png";
            move_uploaded_file($_FILES["image"]["tmp_name"], $path);
        }

        $Stmt3 = mysqli_prepare($con, "update image set image=? where imageid=?");
        mysqli_stmt_bind_param($Stmt3, 'si', $path, $id);
        mysqli_stmt_execute($Stmt3);

        header("location:allPerson.php?updateTrue={success update}");
        // ----------------------
    } else {
        echo "error";
    }
}
