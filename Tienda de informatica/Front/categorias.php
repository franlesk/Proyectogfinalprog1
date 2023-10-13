<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Estilos/navbar.css">
  <link rel="stylesheet" href="Estilos/categorias.css">
  <title>Tienda de electronica</title>
</head>
<body>
  <header>

  <?php 
    $pagina_actual = 'home';
    include 'navbar.php'; 
  ?>
  </header>
  <div>
 
    
  
  </div>
  <div class="filters">
    <a href="?category=todos">Mostrar todos</a>
    <a href="?category=1">Discos</a>
    <a href="?category=2">Fuentes</a>
    <a href="?category=3">Gabinetes</a>
    <a href="?category=4">Mothers</a>
    <a href="?category=5">Placas de video</a>
    <a href="?category=6">Procesadores</a>
    <a href="?category=7">Ram</a>
  </div>
  

  <div id="product-container">
    <?php
    include '../Controladores/controller-categorias.php';
    ?>
  </div>
</body>
</html>