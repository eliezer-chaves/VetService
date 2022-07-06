<?php
include 'db/connect.php';

$table = "tbl_veterinario";
$table_reference = "tbl_especialidade";

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

        $sql = 'SELECT VET_CRMV FROM ' . $table . ' WHERE VET_CRMV = "' . $crmv . '" ;';
        $resultado = executarQuery($conexao, $sql);
        $veterinario = $resultado->fetch();

        if (!(empty($veterinario))) {
            echo '{"status":"exists", "crmv": "' . $crmv . '"}';
            return;
        } else {
            $sql = "INSERT INTO " . $table .
                "(VET_NOME, VET_CRMV, VET_TELEFONE, VET_CRMV_UF, ESP_CODIGO)" .
                " VALUES " .
                "(:VET_NOME, :VET_CRMV, :VET_TELEFONE, :VET_CRMV_UF, :ESP_CODIGO);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':VET_NOME', $nome);
            $stmt->bindParam(':VET_CRMV', $crmv);
            $stmt->bindParam(':VET_TELEFONE', $telefone);
            $stmt->bindParam(':VET_CRMV_UF', $crmv_uf);
            $stmt->bindParam(':ESP_CODIGO', $especialidade);
            $stmt->execute();

            echo '{ "resultado": "Veterinário cadastrado", "status": "cadastrado", "veterinario": "' . $nome . '" }';
        }
    } catch (Exception $e) {
        echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
    }
} else if ($_POST["operation"] == "read_all") {
    try {
        $total = $_POST["quantidade"];
        if ($total == "") {
            $sql = "SELECT * FROM $table INNER JOIN $table_reference ON $table.ESP_CODIGO = $table_reference.ESP_CODIGO ORDER BY VET_NOME;";
        } else {
            $sql = "SELECT * FROM $table INNER JOIN $table_reference ON $table.ESP_CODIGO = $table_reference.ESP_CODIGO ORDER BY VET_NOME LIMIT $total;";
        }

        $resultado = executarQuery($conexao, $sql);

        $veterinarios = [];

        while ($row = $resultado->fetch()) {
            $veterinarios[] = [
                'veterinarioCodigo' => $row['VET_CODIGO'],
                'veterinarioNome' => $row['VET_NOME'],
                'veterinarioCRMVUF' => $row['VET_CRMV_UF'],
                'veterinarioTelefone' => $row['VET_TELEFONE'],
                'veterinarioEspecialidade' => $row['ESP_NOME'],
                'veterinarioEspecialidadeCodigo' => $row['ESP_CODIGO']
            ];
        }
        if (empty($veterinarios)) {
            echo '{"status":"vazio"}';
        } else {
            $totalROWS = countTable();
            $veterinarios = json_encode($veterinarios);
            echo '{"total" : "' . $totalROWS . '", "dados" : ' . $veterinarios . '}';
        }
    } catch (Exception $e) {
        echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
    }
} else if ($_POST["operation"] == "read_one") {
    try {
        if (isset($_POST["codigo"])) {
            $codigo = $_POST["codigo"];

            $sql = "SELECT * FROM $table INNER JOIN $table_reference ON $table.ESP_CODIGO = $table_reference.ESP_CODIGO WHERE VET_CODIGO = $codigo;";

            $resultado = executarQuery($conexao, $sql);
            $veterinario = $resultado->fetch();

            echo json_encode($veterinario);
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro" : "' . $e . '" }';
    }
} else if ($_POST["operation"] == "update") {
    try {
        $VET_CODIGO = $_POST["veterinarioCodigo"];
        $VET_NOME = $_POST["veterinarioNome"];
        $VET_CRMV = $_POST["veterinarioCRMV"];
        $VET_CRMV_UF = $_POST["veterinarioCRMV_UF"];
        $ESP_CODIGO = $_POST["veterinarioEspecialidadeCodigo"];
        $VET_TELEFONE = $_POST["veterinarioTelefone"];

        $sql = "UPDATE " . $table . " SET VET_NOME = :VET_NOME, VET_CRMV = :VET_CRMV, VET_CRMV_UF = :VET_CRMV_UF, ESP_CODIGO = :ESP_CODIGO, VET_TELEFONE = :VET_TELEFONE WHERE VET_CODIGO = :VET_CODIGO;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':VET_CODIGO', $VET_CODIGO);
        $stmt->bindParam(':VET_TELEFONE', $VET_TELEFONE);
        $stmt->bindParam(':VET_NOME', $VET_NOME);
        $stmt->bindParam(':VET_CRMV', $VET_CRMV);
        $stmt->bindParam(':ESP_CODIGO', $ESP_CODIGO);
        $stmt->bindParam(':VET_CRMV_UF', $VET_CRMV_UF);
        $stmt->execute();

        echo '{"status" : "alterado"}';
    } catch (Exception $e) {
        echo '{"status":"erro", "erro" : "' . $e . '"}';
    }
} else if ($_POST["operation"] == "delete") {
    try {
        $VET_CODIGO = $_POST["codigo"];
        $sql = "DELETE FROM " . $table . " WHERE VET_CODIGO = :VET_CODIGO;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':VET_CODIGO', $VET_CODIGO);
        $stmt->execute();
        echo '{"status":"deletado"}';
    } catch (Exception $e) {
        echo '{"status":"nao-deletado"}';
    }
} else if ($_POST["operation"] == "count") {
    $sql = "SELECT COUNT(*) FROM " . $table . ";";
    $stmt = executarQuery($conexao, $sql);
    $totalROWS = $stmt->fetchColumn();

    echo $totalROWS;
} else if ($_POST["operation"] == "load_page") {

    $sql = "SELECT * FROM $table INNER JOIN $table_reference ON $table.ESP_CODIGO = $table_reference.ESP_CODIGO ORDER BY VET_NOME;";

    $resultado = executarQuery($conexao, $sql);

    $veterinarios = [];

    while ($row = $resultado->fetch()) {
        $veterinarios[] = [
            'veterinarioCodigo' => $row['VET_CODIGO'],
            'veterinarioNome' => $row['VET_NOME'],
            'veterinarioCRMVUF' => $row['VET_CRMV_UF'],
            'veterinarioTelefone' => $row['VET_TELEFONE'],
            'veterinarioEspecialidade' => $row['ESP_NOME'],
            'veterinarioEspecialidadeCodigo' => $row['ESP_CODIGO']
        ];
    }
    if (empty($veterinarios)) {
        echo '{"status":"vazio"}';
    } else {
        $total = count($veterinarios);
        $veterinarios = json_encode($veterinarios);
        echo '{"total" : "' . $total . '", "dados" : ' . $veterinarios . '}';
    }
} else if ($_POST["operation"] == "search") {
    try {
        if (isset($_POST["nome"])) {
            $nome = $_POST["nome"];

            $sql = "SELECT * FROM $table WHERE VET_NOME LIKE :VET_NOME ORDER BY VET_NOME;";


            $stmt = $conexao->prepare($sql);
            $stmt->execute(['VET_NOME' => '%' . $nome . '%']);

            $veterinarios = [];

            while ($row = $stmt->fetch()) {
                $veterinarios[] = [
                    'veterinarioCodigo' => $row['VET_CODIGO'],
                    'veterinarioNome' => $row['VET_NOME'],
                    'veterinarioCRMVUF' => $row['VET_CRMV_UF'],
                    'veterinarioTelefone' => $row['VET_TELEFONE'],
                    'veterinarioEspecialidade' => $row['VET_ESPECIALIDADE']
                ];
            }
            if (empty($veterinarios)) {
                echo '{"status":"vazio"}';
            } else {
                $total = count($veterinarios);
                $veterinarios = json_encode($veterinarios);
                echo '{"total" : "' . $total . '", "dados" : ' . $veterinarios . '}';
            }
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro":"' . $e . '"}';
    }
} else if ($_POST["operation"] == "load_dropdown") {
    try {
        $sql = "SELECT * FROM $table INNER JOIN $table_reference ON $table.ESP_CODIGO = $table_reference.ESP_CODIGO ORDER BY VET_NOME;";

        $resultado = executarQuery($conexao, $sql);

        $veterinarios = [];

        while ($row = $resultado->fetch()) {
            $veterinarios[] = [
                'veterinarioCodigo' => $row['VET_CODIGO'],
                'veterinarioNome' => $row['VET_NOME'],
                'veterinarioCRMVUF' => $row['VET_CRMV_UF'],
                'veterinarioTelefone' => $row['VET_TELEFONE'],
                'veterinarioEspecialidadeCodigo' => $row['ESP_CODIGO'],
                'veterinarioEspecialidade' => $row['ESP_NOME']
            ];
        }
        if (empty($veterinarios)) {
            echo '{"status":"vazio"}';
        } else {
            echo json_encode($veterinarios);
        }
    } catch (Exception $e) {
        echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
    }
}

function countTable()
{
    global $conexao, $table;
    $sql = "SELECT COUNT(*) FROM " . $table . ";";
    $stmt = executarQuery($conexao, $sql);
    $totalROWS = $stmt->fetchColumn();
    return $totalROWS;
}
