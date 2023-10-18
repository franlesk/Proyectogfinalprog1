<?php
require_once '../Controladores/conexion.php';
require_once "clase_producto.php";
require_once "clase_categoria.php";

session_start();

class Carrito {
    private $productos; // Array para almacenar los productos en el carrito.
    public function __construct() {
        $this->productos = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
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

   
    public function agregarProductoAlCarrito($productoID, $cantidad) {
        // Si el producto ya está en la sesión, simplemente actualiza la cantidad
        if (isset($this->productos[$productoID])) {
            $this->productos[$productoID]['cantidad'] += $cantidad;
        } else {
            // Si no está en la sesión, busca en la base de datos y agrégalo
            $producto = $this->obtenerDetallesProductoDesdeBD($productoID);
            if ($producto) {
                $this->agregarProducto($producto, $cantidad);
            } else {
                echo "Producto no encontrado.";
            }
        }

        // Guarda el carrito actualizado en la sesión
        $_SESSION['carrito'] = $this->productos;
    }

    private function obtenerDetallesProductoDesdeBD($productoID) {
        $conexion = conexion(); 

        if ($conexion) {
            $sql = "SELECT producto_id, producto_nombre, producto_precio, producto_foto FROM producto WHERE producto_id = :productoID";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':productoID', $productoID, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $producto = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($producto) {
                    return new Producto($producto['producto_id'], '', $producto['producto_nombre'], $producto['producto_precio'], 0, $producto['producto_foto'], new Categoria(0, ''));
                }
            } else {
                echo "Error al ejecutar la consulta.";
            }

            // Cerrar la conexión a la base de datos
            $conexion = null;
        } else {
            echo "Error de conexión a la base de datos.";
        }

        return null;
    }
    

    // Remover un producto del carrito.
    public function removerProducto($productoID) {
        if (array_key_exists($productoID, $this->productos)) {
            unset($this->productos[$productoID]);
        }
    }
    
    public function finalizarCompra(){
        try {
            $conexion = conexion();
    
            if ($conexion) {
                $idUsuario = $_SESSION['usuario_id'];
                $fechaCompra = date('Y-m-d H:i:s');
    
                
                $sqlCompra = "INSERT INTO compras (usuario_id, fecha_hora, finalizar) VALUES (:usuario_id, :fecha_hora, 0)";
                $stmtCompra = $conexion->prepare($sqlCompra);
                $stmtCompra->bindParam(':usuario_id', $idUsuario, PDO::PARAM_INT);
                $stmtCompra->bindParam(':fecha_hora', $fechaCompra);
    
                if ($stmtCompra->execute()) {
                    $idCompra = $conexion->lastInsertId();
    
                    
                    $productosEnCarrito = $this->obtenerProductos();
                    
                   
                    foreach ($productosEnCarrito as $productoData) {
                        $producto = $productoData['producto'];
                        $cantidad = $productoData['cantidad'];
                        $productoID = $producto->getProductoID();
    
                        $sqlProductoCompra = "INSERT INTO orden_producto (id_compra, producto_id, cantidad_compra) 
                                                VALUES (:id_compra, :producto_id, :cantidad)";
                        $stmtProductoCompra = $conexion->prepare($sqlProductoCompra);
                        $stmtProductoCompra->bindParam(':id_compra', $idCompra, PDO::PARAM_INT);
                        $stmtProductoCompra->bindParam(':producto_id', $productoID, PDO::PARAM_INT);
                        $stmtProductoCompra->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
    
                        if ($stmtProductoCompra->execute() !== TRUE) {
                            echo "Error al insertar producto en tabla_compra_producto: ";
                        }
                    }
    
                    $_SESSION['mensaje'] = "Compra registrada correctamente.";
                } else {
                    $_SESSION['mensaje'] = "Error al registrar la compra";
                }
            } else {
                $_SESSION['mensaje'] = "No se pudo conectar a la base de datos.";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . $idCompra;
        } finally {
            // Cerrar la conexión
            $conexion = null;
        }
    }
}
?>
