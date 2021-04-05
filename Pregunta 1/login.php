<?php
   include "./services/conexion.inc.php";
   session_start();

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

    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<!-- <body style="background-color:#CECFC9;width:100%;height:60px;" class=' w-100'> 

    <div> -->
<?php
        if(isset($_GET['color'])){
          if($_GET['color']==1){
            $_SESSION['header']='#276E90';
            $_SESSION['body']='#CECFC9';
            echo "<body style='background-color:#CECFC9;width:100%;height:60px;' class=' w-100'>";
            echo "<div>";
            echo "<div style='background-color:#276E90;width:100%;height:60px;'>";
        }
        if($_GET['color']==2){
            $_SESSION['header']='#46211A';
            $_SESSION['body']='#693D3D';
            echo "<body style='background-color:#693D3D;width:100%;height:60px;' class=' w-100'>";
            echo "<div>";
            echo "<div style='background-color:#46211A;width:100%;height:60px;'>";
        }
        if($_GET['color']==3){
            $_SESSION['header']='#30391F';
            $_SESSION['body']='#668A4C';
            echo "<body style='background-color:#668A4C;width:100%;height:60px;' class=' w-100'>";
            echo "<div>";
            echo "<div style='background-color:#30391F;width:100%;height:60px;'>";
        }
    }else{
       if(!isset($_SESSION['body']) && !isset($_SESSION['header'])){
            $_SESSION['header']='#276E90';
            $_SESSION['body']='#CECFC9';
       }
        echo "<body style='background-color:#CECFC9;width:100%;height:60px;' class=' w-100'>";
        echo "<div>";
        echo "<div style='background-color:#276E90;width:100%;height:60px;'>";
    }
        ?>

<div class="col-sm-3">
    <ul class="top_button_section flex-row-reverse">
        <li>
            <form action="login.php" method="GET">
                <select class="w-100 selectpicker" aria-label=".form-select-lg example" onchange="this.form.submit()"
                    name="color">

                    <option value="1">color uno</option>
                    <option value="2">color dos</option>
                    <option value="3">color tres</option>
                </select>
            </form>
        </li>
        <li><a class="login-bt" href="login.php">Login</a></li>
        <li><a class="login-bt active" href="signup.php">Registrar</a></li>


    </ul>

</div>

</div>
</div>


<div class="container">
    <div class="shadow-sm banner_section p-3 my-3 bg-light rounded">
        <?php
                 
                    
                    // $_SESSION['header']='#0A3143';
                    // $_SESSION['body']='#0A3143';
                    $user="";
                    $password="";              
                    
                    if(isset($_POST['user']) && isset($_POST['password'])){
                        $user=$_POST['user'];
                        $password=$_POST['password'];
                        $resultado = mysqli_query($con, "select * from usuario where password=MD5('".$password."') and usuario='".$user."';");
                        //print_r($resultado);
                        if(!$resultado || mysqli_num_rows($resultado)==0){
                            //die("query failed!");
                            $_SESSION['message_type']='danger';
                            $_SESSION['message']='No existe el usuario';
                            //echo " no existe";

                        }else{
                            $fila = mysqli_fetch_array($resultado);
                            $_SESSION['ci']=$fila['ci'];
                            $resultado = mysqli_query($con, "select * from persona where ci='".$_SESSION['ci']."';");
                            $fila= mysqli_fetch_array($resultado);
                            $_SESSION['nombre'] =$fila['nombre'];
                            $_SESSION['fecha'] =$fila['fecha'];
                            $_SESSION['departamento'] =$fila['departamento'];
                            $_SESSION['rol'] =$fila['tipo'];
                            $_SESSION['user']=$user;
                            $_SESSION['password']=$password;
                            //header("Cache-Control: no-store, no-cache, must-revalidate");
                            //header("Pragma: no-cache");
                     
                            header("Location: includes/index.php");
                            //die();
                    
                           
                        }
                       
                        //$ci=$fila['ci'];
                        //echo mysqli_num_rows($resultado)." si existe";
                        
                    }
                    if(isset($_SESSION['message'])){
                ?>
        <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">

            <?=$_SESSION['message']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php 
        //session_unset();
            }?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="focusedInput">
                    <p class="text-secondary">Usuario</p>
                </label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Introduzca su usuario" name="user" value="test">

            </div>
            <div class="form-group">
                <label>
                    <p class="text-secondary">Contraseña</p>
                </label>
                <input type="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Introduzca su contraseña" name="password" value="test">
            </div>

            <button type="submit" class="btn btn-primary bg-info " name="Aceptar" value="Aceptar">INGRESAR</button>
        </form>

    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>

<script src="js/jquery-3.0.0.min.js"></script>

<script src="js/plugin.js"></script>
<!-- sidebar -->
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>
<!-- javascript -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

</body>


</html>