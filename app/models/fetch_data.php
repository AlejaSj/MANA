<?php
$conn = new mysqli("localhost", "root", "PkU3qJ35jr(4/r-V", "mana");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);}

$type = $_GET['type'] ?? '';

if ($type === 'frecuencias') {
    $query = "SELECT frecuencia, COUNT(*) as count FROM form_info GROUP BY frecuencia";
} elseif ($type === 'voluntariado') {
    $query = "SELECT voluntariado, COUNT(*) as count FROM form_info GROUP BY voluntariado";
} elseif ($type === 'importancia') {
    $query = "SELECT frecuencia, AVG(importancia) as promedio FROM form_info GROUP BY frecuencia";
} elseif ($type === 'edad_importancia') {
    $query = "SELECT edad, importancia FROM form_info";
} elseif ($type === 'horas_por_frecuencia') {
    $query = "SELECT frecuencia, SUM(horas) as total_horas FROM form_info GROUP BY frecuencia";
} elseif ($type === 'profesiones') {
    $query = "SELECT profesion, COUNT(*) as count FROM form_info GROUP BY profesion";
} elseif ($type === 'horas_arboles') {
    $query = "SELECT profesion, SUM(horas) as total_horas, SUM(arboles) as total_arboles FROM form_info GROUP BY profesion";
}elseif ($type === 'horas_arboles') {
    $query = "SELECT edad, SUM(horas) as total_horas, SUM(arboles) as total_arboles FROM actividades GROUP BY edad";
    $result = $conn->query($query);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}

$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
