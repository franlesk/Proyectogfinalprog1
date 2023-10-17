<?php
require_once '../Controladores/conexion.php';
require_once "clase_producto.php";
require_once "clase_categoria.php";

class Carrito {
    private $productos; // Un array para almacenar los productos en el carrito.

    public function __construct() {
        $this->productos = array();
    }

    // Agregar un producto al carrito.
    public function agregarProducto(Producto $producto, $cantidad = 1) {
        $productoID = $producto->getProductoID();
    
        // Verifica si el producto ya está en el carrito.
        if (array_key_exists($productoID, $this->productos)) {
            $this->productos[$productoID]['cantidad'] += $cantidad;
        } else {
            // Si no está en el carrito, agrégalo.
            $this->productos[$productoID] = array(
                'producto' => $producto,
                'cantidad' => $cantidad
            );
        }
    }
    
    // Obtener todos los productos en el carrito.
    public function obtenerProductos() {
        return $this->productos;
    }

    // Calcular el precio total del carrito.
    public function calcularTotal() {
        $total = 0;
        foreach ($this->productos as $productoData) {
            $producto = $productoData['producto'];
            $cantidad = $productoData['cantidad'];
            $total += $producto->getProductoPrecio() * $cantidad;
        }
        return $total;
    }

    /*
    public function agregarProductoAlCarritoDesdeSesion($producto_id, $cantidad) {
            // Conectar a la base de datos (debes tener tu lógica de conexión aquí).
            $conexion = conexion(); 
        
            if ($conexion) {
                // Prepara una consulta para obtener detalles del producto.
                $sql = "SELECT producto_id, producto_nombre, producto_precio FROM producto WHERE producto_id = :productoID";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':productoID', $producto_id, PDO::PARAM_INT);
        
                if ($stmt->execute()) {
                    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($producto) {
                        // Agregar el producto al carrito con su nombre y precio
                    $this->agregarProducto(
                            new Producto($producto_id, '', $producto['producto_nombre'], $producto['producto_precio'], 0, '', new Categoria(0, '')),
                            $cantidad
                        );
                    } else {
                        echo "Producto no encontrado.";
                    }
                    } else {
                    echo "Error al ejecutar la consulta.";
                     }
        
                    // Cerrar la conexión a la base de datos
                    $conexion = null;
                } else {
                    echo "Error de conexión a la base de datos.";
                }
            }
*/
public function agregarProductoAlCarritoDesdeSesion($producto_id, $cantidad) {
    // Conectar a la base de datos (debes tener tu lógica de conexión aquí).
    $conexion = conexion(); 

    if ($conexion) {
        // Prepara una consulta para obtener detalles del producto.
        $sql = "SELECT producto_id, producto_nombre, producto_precio, producto_foto FROM producto WHERE producto_id = :productoID";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':productoID', $producto_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($producto) {
                // Agregar el producto al carrito con su nombre, precio y foto
                $this->agregarProducto(
                    new Producto($producto_id, '', $producto['producto_nombre'], $producto['producto_precio'], 0, $producto['producto_foto'], new Categoria(0, '')),
                    $cantidad
                );
            } else {
                echo "Producto no encontrado.";
            }
        } else {
            echo "Error al ejecutar la consulta.";
        }

        // Cerrar la conexión a la base de datos
        $conexion = null;
    } else {
        echo "Error de conexión a la base de datos.";
    }
}







    // Remover un producto del carrito.
    public function removerProducto($productoID) {
        if (array_key_exists($productoID, $this->productos)) {
            unset($this->productos[$productoID]);
        }
    }
    }
    
?>
