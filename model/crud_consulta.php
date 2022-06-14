<?php
include 'db/connect.php';

$table = "tbl_consulta";

try {
    $conexao = criarConexao();
} catch (Exception $e) {
    echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
}

if ($_POST["operation"] == "create") {
    if (empty($_POST["animalCodigo"]) || empty($_POST["veterinario_codigo"]) || empty($_POST["data"]) || empty($_POST["hora"])) {
        echo '{"resultado": "Preencha todos os campos", "status": "incomplete"}';
        return;
    } else {
        try {
            $animalCodigo = $_POST["animalCodigo"];
            $donoCodigo = $_POST["donoCodigo"];
            $veterinario_codigo = $_POST["veterinario_codigo"];
            $data = $_POST["data"];
            $hora = $_POST["hora"];

            $sql = "insert into " . $table .
                "(ANI_CODIGO, VET_CODIGO, CON_DATA, CON_HORA)" .
                " values " .
                "(:ANI_CODIGO, :VET_CODIGO, :CON_DATA, :CON_HORA);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':ANI_CODIGO', $animalCodigo);
            $stmt->bindParam(':VET_CODIGO', $veterinario_codigo);
            $stmt->bindParam(':CON_DATA', $data);
            $stmt->bindParam(':CON_HORA', $hora);
            $stmt->execute();

            echo '{ "resultado": "Consulta cadastrada", "status": "cadastrado", "data": "' . $data . '", "hora": "' . $hora . '", "animal":"' . $_POST['animalNome'] . '", "dono" : "' . $_POST['dono'] . '", "veterinario":"' . $_POST['veterinario'] . '" }';
        } catch (Exception $e) {
            echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
        }
    }
} else if ($_POST["operation"] == "read_all") {
} else if ($_POST["operation"] == "read_one") {
} else if ($_POST["operation"] == "update") {
} else if ($_POST["operation"] == "delete") {
}
