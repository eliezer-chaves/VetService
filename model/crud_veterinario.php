<?php
include 'db/connect.php';

$table = "tbl_veterinario";

try {
    $conexao = criarConexao();
} catch (Exception $e) {
    echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
}

if ($_POST["operation"] == "create") {
    if (empty($_POST["nome"]) || empty($_POST["crmv"]) || empty($_POST["telefone"]) || empty($_POST["crmv_uf"]) || empty($_POST["especialidade"])) {
        echo '{ "resultado": "Preencha todos os campos", "status": "incomplete" }';
        return;
    }

    try {
        $nome = $_POST["nome"];
        $crmv = $_POST["crmv"];
        $telefone = $_POST["telefone"];
        $crmv_uf = $_POST["crmv_uf"];
        $especialidade = $_POST["especialidade"];

        $sql = 'select VET_CRMV from ' . $table . ' where VET_CRMV = "' . $crmv . '" ;';
        $resultado = executarQuery($conexao, $sql);
        $veterinario = $resultado->fetch();

        if (!(empty($veterinario))) {
            echo '{"status":"exists", "crmv": "' . $crmv . '"}';
            return;
        } else {
            $sql = "insert into " . $table .
                "(VET_NOME, VET_CRMV, VET_TELEFONE, VET_CRMV_UF, VET_ESPECIALIDADE)" .
                " values " .
                "(:VET_NOME, :VET_CRMV, :VET_TELEFONE, :VET_CRMV_UF, :VET_ESPECIALIDADE);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':VET_NOME', $nome);
            $stmt->bindParam(':VET_CRMV', $crmv);
            $stmt->bindParam(':VET_TELEFONE', $telefone);
            $stmt->bindParam(':VET_CRMV_UF', $crmv_uf);
            $stmt->bindParam(':VET_ESPECIALIDADE', $especialidade);
            $stmt->execute();

            echo '{ "resultado": "Veterinário cadastrado", "status": "cadastrado", "veterinario": "' . $nome . '" }';
        }
    } catch (Exception $e) {
        echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
    }
} else if ($_POST["operation"] == "read_all") {
    try {
        $sql = "SELECT VET_NOME, VET_CODIGO FROM $table";
        $resultado = executarQuery($conexao, $sql);

        $veterinarios = [];

        while ($row = $resultado->fetch()) {
            $veterinarios[] = [
                'veterinarioNome' => $row['VET_NOME'],
                'veterinarioCodigo' => $row['VET_CODIGO']
            ];
        }
        echo json_encode($veterinarios);
    } catch (Exception $e) {
        echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
    }
} else if ($_POST["operation"] == "read_one") {
} else if ($_POST["operation"] == "update") {
} else if ($_POST["operation"] == "delete") {
}
