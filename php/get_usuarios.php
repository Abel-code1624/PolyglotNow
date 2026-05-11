<?php
$conexion = mysqli_connect("localhost", "root", "", "polyglotnow");
$sql = "SELECT usuario FROM usuarios ORDER BY usuario";
$result = mysqli_query($conexion, $sql);

echo "<div>";
while($row = mysqli_fetch_assoc($result)) {
    $selected = (isset($_GET['usuario']) && $_GET['usuario'] == $row['usuario']) ? "checked" : "";
    echo "<label><input type='radio' name='usuario_bd' value='{$row['usuario']}'/> {$row['usuario']}</label><br>";
}
echo "</div>";
?>
