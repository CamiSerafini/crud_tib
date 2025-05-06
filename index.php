<?php
/**
 * Este es el script por donde comienza el sitio, el nombre index.php
 * es una convención estándar como puede serlo index.html
 */

/**
 * Al principio se incluye el archivo de configuración, que en este caso no es
 * una mala práctica porque está muy bien tener la conexión a la base de datos
 * en un solo lugar.
 */
include 'config.php';

/**
 * uso el objeto connection para ejecutar una consulta
 * a la base de datos.
 * query es una función("método") 
 */
$result = $connection->query("SELECT * FROM students");

/**
 * Con echo mostramos por "pantalla" (navegador web)
 * el html al cliente.
 */
echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<link rel='stylesheet' href='style.css?v=" . time() . "'>";
echo "</head>";

echo "<body>";
echo "<h1>Listado de Estudiantes</h1>";
echo "<a href='insert.php'>Agregar Nuevo</a><br><br>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Nombre</th><th>Email</th><th>Edad</th><th>Acciones</th></tr>";
    while ($row = $result->fetch_assoc()) { //por cada fila de la tabla de la base de datos me va a ir creado la fila de la tabla que quedará en la vista del navegador
        echo "<tr>
                <td>{$row['fullname']}</td>
                <td>{$row['email']}</td>
                <td>{$row['age']}</td>
                <td>
                    <a href='update.php?id={$row['id']}'>Editar</a> |
                    <a href='delete.php?id={$row['id']}'>Borrar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay estudiantes cargados.";
}
echo "</body>";
echo "</html>";
?>
