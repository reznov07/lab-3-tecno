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
            <a href="noticiario.php" class="nav-link">Inicio</a>
            <a href="noticiario.php" class="nav-link">Noticias</a>
            <a href="administrar.php" class="nav-link">Administrar Noticias</a>
        </nav>
    </header>

<?php 
    include 'includes/funciones/conexion.php';

    require 'includes/app.php';

    $sql = "SELECT * FROM noticias";

    $resultado = $conn->query($sql);
    
    $listadonoticias = [];

    while( $noticia = mysqli_fetch_assoc($resultado) ){
        
      $listadonoticias[] = $noticia;

    } 
    
?>

<main  class="container" style="position:relative; padding-bottom: 20em;">
<div>
        <h2 class="col-12 my-3 text-center">Noticias</h2>
        <div class="row border border-dark">
        <?php foreach ($listadonoticias as $noticia):?>
        <div class="col-6 col-md-4 py-2 border border-dark rounded">
            <div class="card text-center border-0" >
                <a href="/Lab3/noticia.php?id=<?php echo $noticia["id"]?>">
                <img src="imagenes/<?php echo $noticia["imagen"] ?>" class="card-img-top" style="width: 200px; height: 200px;">
                </a>  
                <div class="card-body">
                    <h4><?php echo $noticia["titulo"]?></h4>
                    <h5><?php echo $noticia["categoria"]?></h5>
                    <h5><?php echo $noticia["resumen"]?></h5>
                    <p><?php echo $noticia["fecha"]?></p>
                
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</main>