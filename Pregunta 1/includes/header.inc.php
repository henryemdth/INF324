<?php
session_start();
$ci= $_SESSION['ci'];
$rol= $_SESSION['rol'];
//echo $rol;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>INF 323</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <!-- Responsive-->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="../images/umsa.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

</head>

<!-- <body style="background-color:#CECFC9;width:100%;height:60px;">
    <div style="background-color:#276E90;width:100%;height:80px;"> -->

        <?php
        $header= $_SESSION['header'];
        $body =$_SESSION['body'];
    
     
        echo "<body style='background-color:$body;width:100%;height:60px;'>";
        echo "<div style='background-color:$header;width:100%;height:80px;'>";
    
    ?>
        <div class="container ">
            <div class="row d-flex justify-content-between ">
                <div class="col-sm-1 ">
                    <div class="logo"><a href="index.php"><img src="../images/ico.png"></a></div>
                </div>
                <div class="col-sm-8 ">
                    <div class="menu-area ">
                        <nav class="navbar navbar-expand-lg ">
                            <!-- <a class="navbar-brand" href="#">Menu</a> -->
                            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link  p-3" href="informatica.php">Informatica</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link p-3" href="fisica.php">Fisica</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  p-3" href="quimica.php">Quimica</a>
                                    </li>
                                    <!-- <li class="nav-item" href="#">
                                        <a class="nav-link  p-3" href="blog.html">Estadistica</a>
                                    </li>
                                    <li class="nav-item" href="#">
                                        <a class="nav-link  p-3" href="contact.html">Biologia</a>
                                    </li> -->
                                    <li class="nav-item dropdown nav-user ml-auto">
                                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="../images/user.png" alt="" class="user-avatar-md rounded"
                                                style="width: 50px">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                                            aria-labelledby="navbarDropdownMenuLink2">
                                            <!-- <a class="dropdown-item">Available</a> -->
                                            <a class="dropdown-item" href="../signup.php?edit=edit">
                                                Editar
                                            </a>
                                            <?php if($rol=='Estudiante'){
                                                echo "<a class='dropdown-item' href='./notas.php'>Ver notas</a>";
                                            }else{
                                                echo "<a class='dropdown-item' href='./promedio.php'>Ver promedio de notas</a>";
                                            }?>
                                            <a class="dropdown-item" href="../logout.php">
                                                Salir
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </nav>
                    </div>
                </div>
            </div>
        </div>