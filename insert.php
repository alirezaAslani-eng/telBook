<?php
if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    header("location:google.com");
} else {
    $fullName = $_POST["fullName"];
    $telNumber = $_POST["telNumber"];
    $email = $_POST["email"];
    $image = $_FILES["image"];
    $cod = $_POST["cod"];


    if (
        isset($fullName) && $fullName != "" &&
        isset($telNumber) && $telNumber != "" &&
        isset($email)
    ) {
        $personid = (int)rand(1000, 9999);
        $fullName = (string)$fullName;
        $telNumber = (string)$telNumber;
        $email = (string)$email;
        $cod = (string)$cod;
        // --person------------------
        require_once 'scriptCode/config.php';
        $stmt = mysqli_prepare($con, "insert into person(personid,fullname,email) values(?,?,?)");
        mysqli_stmt_bind_param($stmt, 'iss', $personid, $fullName, $email);
        $result = mysqli_stmt_execute($stmt);
        check($result);
        // --cod------------------
        $stmt2 = mysqli_prepare($con, "insert into cod(codid,cod) values(?,?)");
        mysqli_stmt_bind_param($stmt2, 'is', $personid, $cod);
        $result2 = mysqli_stmt_execute($stmt2);
        check($result2);
        // --tel------------------
        $stmt3 = mysqli_prepare($con, "insert into tel(telid,telnumber,personid) values(?,?,?)");
        mysqli_stmt_bind_param($stmt3, 'isi', $personid, $telNumber, $personid);
        $result3 = mysqli_stmt_execute($stmt3);
        check($result3);
        if (!isset($image)) {
            header("location:allPerson.php?msgupload={error file}");
        } elseif (file_exists($_FILES["image"]["tmp_name"])) {
            $path = 'image/' . $_FILES["image"]["name"];
            $format = pathinfo($path, PATHINFO_EXTENSION);
            $checkImg = getimagesize($_FILES["image"]["tmp_name"]);
            if (!$checkImg) {
                header("location:allPerson.php?msgtype={not picture}");
            } else {
                if ($format != 'png' && $format != 'jpg' && $format != 'jpeg') {
                    header("location:allPerson.php?msgformat={error format}");
                } else {
                    if ($_FILES["image"]["size"] > 1500000) {
                        header("location:allPerson.php?msgsize={error size}");
                    } else {
                        if (!$upload = move_uploaded_file($_FILES["image"]["tmp_name"], $path)) {
                            echo 'error upload';
                        } else {
                            // --imageAddress---------------------
                            $stmt4 = mysqli_prepare($con, "insert into image(imageid,image) values(?,?)");
                            mysqli_stmt_bind_param($stmt4, 'is', $personid, $path);
                            $result4 = mysqli_stmt_execute($stmt4);
                            check($result3);
                            header("location:allPerson.php?msgSuccess={Complete}");
                        }
                    }
                }
            }
        } else {
            echo "error";
            $stmt5 = mysqli_prepare($con, "insert into image(imageid) values(?)");
            mysqli_stmt_bind_param($stmt5, 'i', $personid);
            $result5 = mysqli_stmt_execute($stmt5);
            check($result5);
            header("location:allPerson.php?msgSuccess={not image}");
        }
    }
}
