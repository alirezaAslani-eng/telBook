<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $id = (int)$_GET["id"];
        require_once 'scriptCode/config.php';
        $stmt = mysqli_prepare($con, "select * from person where personid=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        $run = mysqli_stmt_execute($stmt);
        $rslt = mysqli_stmt_get_result($stmt);
        $end = mysqli_fetch_assoc($rslt);

        // ---------------------
        $stmt2 = mysqli_prepare($con, "select * from person where personid=?");
        mysqli_stmt_bind_param($stmt2, 'i', $id);
        $run2 = mysqli_stmt_execute($stmt2);
        $rslt2 = mysqli_stmt_get_result($stmt2);
        $end2 = mysqli_fetch_assoc($rslt2);

        // ----------------------
        $stmt3 = mysqli_prepare($con, "select * from tel where personid=?");
        mysqli_stmt_bind_param($stmt3, 'i', $id);
        $run3 = mysqli_stmt_execute($stmt3);
        $rslt3 = mysqli_stmt_get_result($stmt3);
        $end3 = mysqli_fetch_assoc($rslt3);

        // ----------------------
        $stmt4 = mysqli_prepare($con, "select * from image where imageid=?");
        mysqli_stmt_bind_param($stmt4, 'i', $id);
        $run4 = mysqli_stmt_execute($stmt4);
        $rslt4 = mysqli_stmt_get_result($stmt4);
        $end4 = mysqli_fetch_assoc($rslt4);

        $image = $end4["image"];
        $name = $end["fullname"];
        $phone = $end3["telnumber"];
        $email = $end2["email"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body,
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        input {
            display: block;
            text-align: center;
        }


        img {
            width: 240px;
            border-radius: 50%;
        }
        
    </style>
</head>

<body>
    <img src="<?= $image ?>" alt="">
    <i style="font-size: 30px;" class="fa-solid fa-pencil my-3"></i>
    <h2><?= $name ?></h2>
    <form method="post" action="./update.php" enctype="multipart/form-data">
        <div class="inputFile">
            <input class="form-control my-3" type="file" name="image" id="" value="">
        </div>
        <input class="form-control my-1" type="text" name="fullname" id="" placeholder="Name" value="<?= $name ?>">
        <input type="hidden" name="id" id="" value="<?= $id ?>">
        <input class="form-control my-1" type="text" name="telnumber" id="" placeholder="Phone number" value="<?= $phone ?>">
        <input class="form-control my-1" type="text" name="email" id="" placeholder="email" value="<?= $email ?>">
        <input class="form-control my-1" type="submit" name="" id="">
    </form>
    <?php
    
    
    ?>
</body>

</html>