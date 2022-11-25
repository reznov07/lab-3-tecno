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
    session_start();
    require 'includes/app.php';

    // if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if( !is_null($_GET) ){
        // debuguear($_GET);
        $query = 'SELECT * FROM noticias WHERE id = ' . $_GET["id"];

        $resultado = $conn->query($query);

        $noticia = mysqli_fetch_assoc($resultado);
        
        if( is_null($noticia) ){    
            header('Location: /Lab3');
        } 
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        // Subir imagen
        $imagen = subirImagen($_FILES["imagen"]["tmp_name"],$noticia["imagen"]);
        
        $sql = 'UPDATE noticias
        SET titulo = "' . $_POST['titulo']
        . '", imagen = "' . $imagen 
        . '", resumen = "' . $_POST['resumen']
        . '", categoria = "' . $_POST['categoria']
        . '", noticia = "' . $_POST['noticia'] 
        . '", fecha = "' . $_POST['fecha']. '" 
        WHERE id = ' . $_POST['id'];
        
        if ($conn->query($sql)){
            $_SESSION['message1'] = "La noticia se modificó correctamente";
            header('Location: /Lab3/administrar.php');
            exit(0);
        }
        else {
            $_SESSION['message1'] = "La noticia no se modificó correctamente";
            header('Location: /Lab3/administrar.php');
            exit(0);
        }
    }

?>

<main class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">

                <form method="post" enctype="multipart/form-data" class="bg-light my-3 p-3">
                    
                    <h2 class="fw-bold mt-1 mb-3 text-center">Modificar Noticia</h2>

                    <!-- Campo id -->
                    <div class="form-group">
                        <label for="id">Id:</label>
                        <input type="text" name="id" id="id"  readonly value="<?php echo $noticia["id"]?>">
                    </div>

                    <!-- Campo titulo -->
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" name="titulo" id="titulo"  placeholder="Ingrese el título..." value="<?php echo $noticia["titulo"]?>">               
                    </div>

                    <!-- Campo resumen -->
                    <div class="form-group">
                        <label for="resume">Resumen:</label>
                        <input type="text" name="resumen" id="resumen" placeholder="Ingrese el Resumen..." value="<?php echo $noticia["resumen"]?>">
                    </div>

                    <!-- Campo imagen -->
                    <div class="form-group">
                        <label for="imagen">Imagen:</label>
                        <input type="file" name="imagen" value="<?php echo $practica["imagen"]?>">
                    </div>

                    <!-- Campo categoria -->
                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select type="text" name="categoria" id="categoria" value="<?php echo $noticia["categoria"]?>">
                            <option value="">Seleccione Opción</option>
                            <option value="futbol">Futbol</option>
                            <option value="basquetbol">Basquetbol</option>
                            <option value="tenis">Tenis</option>
                            <option value="actualidad">Actualidad</option>
                        </select>
                    </div>

                    <!-- Campo noticia -->
                    <div class="form-group">
                        <label for="noticia">Noticia:</label>
                        <div class="input-group">
                            <textarea name="noticia" id="noticia" rows="8"><?php echo $noticia["noticia"]?></textarea>
                        </div>
                    </div>

                    <!-- Campo fecha -->
                    <div class="form-group">
                        <label for="fecha">Fecha ingreso:</label>
                        <div class="input-group">
                            <input type="date" name="fecha" id="fecha" placeholder="Ingrese la fecha de ingreso..." value="<?php echo $noticia["fecha"]?>">
                        </div>
                    </div>

                    <div class="row form-group text-center mb-0">

                        <div class="col-12 col-lg-6">
                            <button type="submit" class="btn btn-outline-success"><i class="bi bi-save"></i> Guardar</button>
                        </div>
                        <div class="col-12 col-lg-6">
                            <button type="reset" class="btn btn-outline-danger"><i class="bi bi-eraser"></i> Borrar cambios</button>
                        </div>
                        
                    </div>

                </form>
            </div>
        </div>
    </main>


    <script src="libs/aos/aos.js"></script>
    <script src="libs/bootstrap-5/js/bootstrap.min.js" ></script>
    <script src="libs/glightbox/js/glightbox.min.js"></script>

    <!-- Template Main JS File -->
    <script src="js/app.js"></script>
    <script src="js/main.js"></script>
</body>
</html>