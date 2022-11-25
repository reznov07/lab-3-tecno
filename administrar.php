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
            <img src="img/logo.png" alt="f">
            <h2 class="nombre-logo">Sports News</h2>
        </div>
        <nav>
            <a href="noticiario.php" class="nav-link">Inicio</a>
            <a href="noticiario.php" class="nav-link">Noticias</a>
            <a href="administrar.php" class="nav-link">Administrar Noticias</a>
        </nav>
    </header>


<?php
    session_start();
    require 'includes/app.php';

    $sql = "SELECT * FROM noticias";

    $resultado = $conn->query($sql);
    
    $listadonoticias = [];

    while( $noticia = mysqli_fetch_assoc($resultado) ){

      $listadonoticias[] = $noticia;

    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Obtener producto
        $query = 'SELECT * FROM noticias WHERE id = ' . $_POST["id"];

        $resultado = $conn->query($query);

        $noticia = mysqli_fetch_assoc($resultado);

        $imageName = $noticia["imagen"];

        // eliminar imagen
        if( isset($imageName) && $imageName != "" ){
            $path = CARPETA_IMAGENES . "/" . $imageName;
            if(file_exists($path)){
                unlink($path);
            }
        }

        $sql = "DELETE FROM noticias WHERE id = ".$_POST['id'];

        if ($conn->query($sql)){
            header('Location: /Lab3/administrar.php');
        }
    }
?>

<main>
    <div class="container my-5">
        <div class="table-responsive">
            <h2 class="col-12 my-3 text-center">Administrar Noticias</h2>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Título</th>
                        <th scope="col">Resumen</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Noticia</th>
                        <th scope="col">Fecha Ingreso</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($listadonoticias as $noticia):?>
                        <tr>
                            <td> <?php echo $noticia["id"]?> </td>
                            <td class="p-0">
                                <img src="imagenes/<?php echo $noticia["imagen"] ?>" style="max-height: 100px; object-fit: cover;">
                            </td>                                            
                            <td> <?php echo $noticia["titulo"]?> </td>
                            <td> <?php echo $noticia["resumen"]?> </td>
                            <td> <?php echo $noticia["categoria"]?> </td>
                            <td> <?php echo $noticia["noticia"]?> </td>
                            <td> <?php echo $noticia["fecha"]?> </td>
                            <td>
                                <div class="row text-center">
                                    <div class="col-12 col-lg-6">
                                        <a href="/Lab3/modificar.php?id=<?php echo $noticia["id"]?>" 
                                        class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                    <a href="/Lab3/eliminar.php? id=<?php echo $noticia["id"]?>" type="button" class="btn btn-outline-danger">
                                        <i class="bi bi-x-square-fill"></i>
                                    </a>
                                    <script src="js/alertas.js"></script>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <div class="alert alert-success">
                            Se ha agregado una noticia con exito. 
                        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close" ></button>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <div class="col-12 my-3 btn-responsive text-center">
            <a href="/Lab3/insertar.php" class="btn btn-outline-success"><i class="bi bi-plus-square"></i> Agregar</a>
        </div>
        
    </div>
</main>


<script src="libs/aos/aos.js"></script>
    <script src="libs/bootstrap-5/js/bootstrap.min.js" ></script>
    <script src="libs/glightbox/js/glightbox.min.js"></script>
    <script src="libs/glightbox/js/glightbox.min.js"></script>            
    <!-- Template Main JS File -->
    <script src="js/app.js"></script>
    <script src="js/main.js"></script>
</body>
</html>