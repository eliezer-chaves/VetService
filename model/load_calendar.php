<?php
include 'db/connect.php';

$table = "tbl_consulta";
$table_reference_animal = "tbl_animal";
$table_reference_veterinario = "tbl_veterinario";
$table_reference_dono = "tbl_dono";
$table_reference_especialidade = "tbl_especialidade";

$conexao = criarConexao();

$sql = "SELECT * FROM $table 
        INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
        INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
        INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
        INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
        ORDER BY CON_DATA, CON_HORA";

$resultado = executarQuery($conexao, $sql);

$consultas = [];

while ($row = $resultado->fetch()) {
    $consultas[] = [
        'id' => $row['CON_CODIGO'], 
        'title' => $row['ANI_NOME'], 
        'color' => $row['VET_COLOR'], 
        'start' =>  $row['CON_DATA'] . " " . $row['CON_HORA'], 
        'end' => $row['CON_DATA'] . " " . $row['CON_HORA_FIM'], 
    ];
}
if (empty($consultas)) {
    echo '{"status":"vazio"}';
} else {
    echo json_encode($consultas);
}
