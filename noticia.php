<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Red Gol</title>
    <link href="libs/aos/aos.css" rel="stylesheet">
    <link href="libs/bootstrap-5/css/bootstrap.min.css" rel="stylesheet">
    <link href="libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="libs/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="libs/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="f">
            <h2 class="nombre-logo">Red Gol</h2>
        </div>
        <nav>
            <a href="" class="nav-link">Inicio</a>
            <a href="" class="nav-link">Qatar 2022</a>
            <a href="" class="nav-link">Ultimas noticias</a>
            <a href="" class="nav-link">Sobre Nosotros</a>
            <a href="" class="nav-link">Contacto</a>
        </nav>
    </header>


<?php 

    require 'includes/app.php';
        
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        // debuguear($_GET);
        $query = 'SELECT * FROM noticias WHERE id = ' . $_GET["id"];

        $resultado = $conn->query($query);

        $noticia = mysqli_fetch_assoc($resultado);
        
        if( is_null($noticia) ){
            header('Location: /Lab3');
        }

    }
?>

    <main style="position:relative; padding-bottom: 2em;">
        <div class="container bg-light my-5 p-5">
            <div class="row border border-dark py-2 mx-2 d-flex justify-content-center" style="background-color: #ffe4eb;">
                <div class="col-12 col-md-6 d-flex py-2">
                    <div class="card text-center border-0">
                        <img src="imagenes/<?php echo $noticia["imagen"]?>" class="card-img-top">
                    </div>
                    <div class="card border-0">
                        <div class="card-body">
                            <h3><?php echo $noticia["titulo"]?></h3>
                            <h6><?php echo $noticia["categoria"]?></h6>
                            <p>
                            <!-- Para que funcionen las "" htmlentities — Convierte todas las entidades HTML a sus caracteres correspondientes -->                                
                            <?php echo html_entity_decode($noticia["noticia"])?>
                            </p>
                            <p>
                            Fecha ingreso: <?php echo $noticia["fecha"]?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>