<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
        .h1 {
            font-size: 15px;
            font-weight: bold;
            transform: translateY(5px);
        }

        ::-webkit-scrollbar {
            width: 14px;
        }

        ::-webkit-scrollbar-thumb {
            background: pink;
            border-radius: 20px;
            border: 4px solid pink;
        }

        .light-theme::-webkit-scrollbar-thumb {
            border-color: pink;
        }

        .dark-theme::-webkit-scrollbar-thumb {
            border-color: pink;
        }

        .light-theme::-webkit-scrollbar-track {
            background: pink;
        }

        .dark-theme::-webkit-scrollbar-track {
            background: pink;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="left">
            <a onclick="f1()" class="add">
                <p>+</p>
            </a>
            <p class="text">Click the plus button to <br> add a contact.</p>
            <!-- mini card -->
            <?php
            require_once 'scriptCode/config.php';
            $query = mysqli_query($con, "select * from person join cod on person.personid=cod.codid join tel on person.personid = tel.personid join image on person.personid = image.imageid order by person.fullname");
            $i = 0;
            while ($i < $result = mysqli_fetch_assoc($query)) {
                echo "
            <a href='" . 'allPerson.php?id=' . $result["personid"] . "' . '>
        
                <div class='card'>
                    <div class='img'><img src='" . $result["image"] . "' alt=''></div>
                    <div class='textBox'>
                        <div class='textContent'>
                            <p class='h1'>" . $result["fullname"] . "</p>
                            <span class='span'>12 min ago</span>
                        </div>
                        <div>
                        <p class='p'>" . $result["telnumber"] . "</p>
                        <p class='p'><a href='" . 'allPerson.php?id=' . $result["personid"] . "'>Show all</a></p>
                        
                        </div>
                    </div>
                </div>
            </a>";
                $i++;
            }


            ?>

            <!-- --------- -->
        </div>
        <div class="flt"></div>

        <div class="right">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if (isset($_GET["id"])) {
                    $id = (int)$_GET["id"];
                    require_once 'scriptCode/config.php';


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

                    echo "<div id='card' class='card2'>
                    <div class='card__img'><svg xmlns='http://www.w3.org/2000/svg' width='100%'>
                            <rect fill='#ffffff' width='540' height='450'></rect>
                            <defs>
                                <linearGradient id='a' gradientUnits='userSpaceOnUse' x1='0' x2='0' y1='0' y2='100%' gradientTransform='rotate(222,648,379)'>
                                    <stop offset='0' stop-color='#ffffff'></stop>
                                    <stop offset='1' stop-color='#FC726E'></stop>
                                </linearGradient>
                                <pattern patternUnits='userSpaceOnUse' id='b' width='300' height='250' x='0' y='0' viewBox='0 0 1080 900'>
                                    <g fill-opacity='0.5'>
                                        <polygon fill='#444' points='90 150 0 300 180 300'></polygon>
                                        <polygon points='90 150 180 0 0 0'></polygon>
                                        <polygon fill='#AAA' points='270 150 360 0 180 0'></polygon>
                                        <polygon fill='#DDD' points='450 150 360 300 540 300'></polygon>
                                        <polygon fill='#999' points='450 150 540 0 360 0'></polygon>
                                        <polygon points='630 150 540 300 720 300'></polygon>
                                        <polygon fill='#DDD' points='630 150 720 0 540 0'></polygon>
                                        <polygon fill='#444' points='810 150 720 300 900 300'></polygon>
                                        <polygon fill='#FFF' points='810 150 900 0 720 0'></polygon>
                                        <polygon fill='#DDD' points='990 150 900 300 1080 300'></polygon>
                                        <polygon fill='#444' points='990 150 1080 0 900 0'></polygon>
                                        <polygon fill='#DDD' points='90 450 0 600 180 600'></polygon>
                                        <polygon points='90 450 180 300 0 300'></polygon>
                                        <polygon fill='#666' points='270 450 180 600 360 600'></polygon>
                                        <polygon fill='#AAA' points='270 450 360 300 180 300'></polygon>
                                        <polygon fill='#DDD' points='450 450 360 600 540 600'></polygon>
                                        <polygon fill='#999' points='450 450 540 300 360 300'></polygon>
                                        <polygon fill='#999' points='630 450 540 600 720 600'></polygon>
                                        <polygon fill='#FFF' points='630 450 720 300 540 300'></polygon>
                                        <polygon points='810 450 720 600 900 600'></polygon>
                                        <polygon fill='#DDD' points='810 450 900 300 720 300'></polygon>
                                        <polygon fill='#AAA' points='990 450 900 600 1080 600'></polygon>
                                        <polygon fill='#444' points='990 450 1080 300 900 300'></polygon>
                                        <polygon fill='#222' points='90 750 0 900 180 900'></polygon>
                                        <polygon points='270 750 180 900 360 900'></polygon>
                                        <polygon fill='#DDD' points='270 750 360 600 180 600'></polygon>
                                        <polygon points='450 750 540 600 360 600'></polygon>
                                        <polygon points='630 750 540 900 720 900'></polygon>
                                        <polygon fill='#444' points='630 750 720 600 540 600'></polygon>
                                        <polygon fill='#AAA' points='810 750 720 900 900 900'></polygon>
                                        <polygon fill='#666' points='810 750 900 600 720 600'></polygon>
                                        <polygon fill='#999' points='990 750 900 900 1080 900'></polygon>
                                        <polygon fill='#999' points='180 0 90 150 270 150'></polygon>
                                        <polygon fill='#444' points='360 0 270 150 450 150'></polygon>
                                        <polygon fill='#FFF' points='540 0 450 150 630 150'></polygon>
                                        <polygon points='900 0 810 150 990 150'></polygon>
                                        <polygon fill='#222' points='0 300 -90 450 90 450'></polygon>
                                        <polygon fill='#FFF' points='0 300 90 150 -90 150'></polygon>
                                        <polygon fill='#FFF' points='180 300 90 450 270 450'></polygon>
                                        <polygon fill='#666' points='180 300 270 150 90 150'></polygon>
                                        <polygon fill='#222' points='360 300 270 450 450 450'></polygon>
                                        <polygon fill='#FFF' points='360 300 450 150 270 150'></polygon>
                                        <polygon fill='#444' points='540 300 450 450 630 450'></polygon>
                                        <polygon fill='#222' points='540 300 630 150 450 150'></polygon>
                                        <polygon fill='#AAA' points='720 300 630 450 810 450'></polygon>
                                        <polygon fill='#666' points='720 300 810 150 630 150'></polygon>
                                        <polygon fill='#FFF' points='900 300 810 450 990 450'></polygon>
                                        <polygon fill='#999' points='900 300 990 150 810 150'></polygon>
                                        <polygon points='0 600 -90 750 90 750'></polygon>
                                        <polygon fill='#666' points='0 600 90 450 -90 450'></polygon>
                                        <polygon fill='#AAA' points='180 600 90 750 270 750'></polygon>
                                        <polygon fill='#444' points='180 600 270 450 90 450'></polygon>
                                        <polygon fill='#444' points='360 600 270 750 450 750'></polygon>
                                        <polygon fill='#999' points='360 600 450 450 270 450'></polygon>
                                        <polygon fill='#666' points='540 600 630 450 450 450'></polygon>
                                        <polygon fill='#222' points='720 600 630 750 810 750'></polygon>
                                        <polygon fill='#FFF' points='900 600 810 750 990 750'></polygon>
                                        <polygon fill='#222' points='900 600 990 450 810 450'></polygon>
                                        <polygon fill='#DDD' points='0 900 90 750 -90 750'></polygon>
                                        <polygon fill='#444' points='180 900 270 750 90 750'></polygon>
                                        <polygon fill='#FFF' points='360 900 450 750 270 750'></polygon>
                                        <polygon fill='#AAA' points='540 900 630 750 450 750'></polygon>
                                        <polygon fill='#FFF' points='720 900 810 750 630 750'></polygon>
                                        <polygon fill='#222' points='900 900 990 750 810 750'></polygon>
                                        <polygon fill='#222' points='1080 300 990 450 1170 450'></polygon>
                                        <polygon fill='#FFF' points='1080 300 1170 150 990 150'></polygon>
                                        <polygon points='1080 600 990 750 1170 750'></polygon>
                                        <polygon fill='#666' points='1080 600 1170 450 990 450'></polygon>
                                        <polygon fill='#DDD' points='1080 900 1170 750 990 750'></polygon>
                                    </g>
                                </pattern>
                            </defs>
                            <rect x='0' y='0' fill='url(#a)' width='100%' height='100%'></rect>
                            <rect x='0' y='0' fill='url(#b)' width='100%' height='100%'></rect>
                        </svg></div>
                    <div class='card__avatar'>
                        <img style='
                        border-radius: 50%; 
                        width:100px;
                        height: 100px;' src='" . $end4["image"] . "' alt=''>
                    </div>
                    <div class='card__title'>" . $end2["fullname"] . "</div>
                    <div class='card__subtitle'>" . $end3["telnumber"] . "</div>
                    <div class='card__subtitle'>" . $end2["email"] . "</div>
                    <div class='card__wrapper'>
                        <a href='showdata.php?id=" . $id . "' class='card__btn'>Edit</a>
                        <a href='javascript:check(" . $id . ")' class='card__btn card__btn-solid'>Delete</a>
                    </div>
                </div>";
                } else {
                    // pass
                }
            }
            ?>

            <h2 class="bigText" style="
        color:#ffffff75;
        margin:20px auto;
        text-align:center;">
                Click on the desired contact to<br> display contact information
            </h2>
        </div>
    </div>
    <div class="formWrapper">
        <i onclick="f2()" class="fa-solid fa-xmark close"></i>
        <form class="form" action="insert.php" method="post" enctype="multipart/form-data">
            <input placeholder="Full name" class="input" type="text" name="fullName">
            <input placeholder="phone number" class="input" type="text" name="telNumber">
            <input placeholder="Email" class="input" type="text" name="email">
            <input class="input" name="image" type="file">
            <input type="hidden" id="" name="cod" value=''>
            <input class="button2" type="submit" name="" id="">
        </form>

    </div>



    <script>
        function f1() {
            document.querySelector(".formWrapper").classList.add("onform");
            document.querySelector(".flt").classList.add('fltBack');
        }

        function f2() {
            document.querySelector(".formWrapper").classList.remove("onform");
            document.querySelector(".flt").classList.remove('fltBack');
        }

        function check(n) {
            if (!confirm("You are deleting this contact!!!")) {

            } else {
                window.location = "delete.php?id=" + n;
            }
        }
    </script>
</body>

</html>