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
    $pagina_actual = 'Categorias';
    include 'navbar.php'; 
  ?>
  </header>
  <div>
 
    
  
  </div>
  <div class="filters">
    <a href="?categoria=todos">Mostrar todos</a>
    <a href="?categoria=1">Discos</a>
    <a href="?categoria=2">Fuentes</a>
    <a href="?categoria=3">Gabinetes</a>
    <a href="?categoria=4">Mothers</a>
    <a href="?categoria=5">Placas de video</a>
    <a href="?categoria=6">Procesadores</a>
    <a href="?categoria=7">Ram</a>
  </div>
  

  <div id="product-container">
    <?php
    include '../Controladores/controller-categorias.php';
    ?>
  </div>
</body>
</html>