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
  
  <div class="filters">
      <select name="orden" id="ordenselect" class="button-select" onchange="actualizarOrden()">
      <option value="" disabled selected hidden>Ordenar por</option>
        <option value="asc">Menor precio</option>
        <option value="desc">Mayor precio</option>  
      </select>
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
  <script>
    function actualizarOrden() {
      const select = document.getElementById('ordenselect');
      const orden = select.value;
      const categoria = obtenerCategoriaActual();
      const nuevaURL = `categorias.php?categoria=${categoria}&orden=${orden}`;
      window.location.href = nuevaURL;
    }

    function obtenerCategoriaActual() {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get('categoria') || 'todos';
    }
  </script>
</body>

</html>