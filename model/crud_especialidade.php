<?php
include 'db/connect.php';

$table = "tbl_especialidade";

try {
    $conexao = criarConexao();
} catch (Exception $e) {
    echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
}

if ($_POST["operation"] == "create") {
    if (empty($_POST["nome"])) {
        echo '{ "resultado": "Preencha todos os campos", "status": "incomplete" }';
        return;
    }
    try {
        $nome = $_POST["nome"];
        $sql = "INSERT INTO " . $table . "(ESP_NOME)" . " VALUES " . "(:ESP_NOME);";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':ESP_NOME', $nome);
        $stmt->execute();
        echo '{ "resultado": "Especialidade cadastrada", "status": "cadastrado", "especialidade": "' . $nome . '" }';
    } catch (Exception $e) {
        echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
    }
} else if ($_POST["operation"] == "read_all") {
    try {
        $total = $_POST["quantidade"];
        if ($total == "") {
            $sql = "SELECT * FROM $table ORDER BY ESP_NOME";
        } else {
            $sql = "SELECT * FROM $table ORDER BY ESP_NOME LIMIT $total";
        }

        $resultado = executarQuery($conexao, $sql);

        $especialidades = [];

        while ($row = $resultado->fetch()) {
            $especialidades[] = [
                'especialidadeCodigo' => $row['ESP_CODIGO'],
                'especialidadeNome' => $row['ESP_NOME']
            ];
        }
        if (empty($especialidades)) {
            echo '{"status":"vazio"}';
        } else {
            $totalROWS = countTable();
            $especialidades = json_encode($especialidades);
            echo '{"total" : "' . $totalROWS . '", "dados" : ' . $especialidades . '}';
        }
    } catch (Exception $e) {
        echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
    }
} else if ($_POST["operation"] == "read_one") {
    try {
        if (isset($_POST["codigo"])) {
            $codigo = $_POST["codigo"];

            $sql = "SELECT * FROM $table WHERE ESP_CODIGO = $codigo;";
            $resultado = executarQuery($conexao, $sql);
            $especialidade = $resultado->fetch();

            echo json_encode($especialidade);
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro" : "' . $e . '" }';
    }
} else if ($_POST["operation"] == "update") {
    try {
        $ESP_CODIGO = $_POST["especialidadeCodigo"];
        $ESP_NOME = $_POST["especialidadeNome"];

        $sql = "UPDATE " . $table . " SET ESP_NOME = :ESP_NOME WHERE ESP_CODIGO = :ESP_CODIGO;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':ESP_CODIGO', $ESP_CODIGO);
        $stmt->bindParam(':ESP_NOME', $ESP_NOME);

        $stmt->execute();

        echo '{"status" : "alterado"}';
    } catch (Exception $e) {
        echo '{"status":"erro", "erro" : "' . $e . '"}';
    }
} else if ($_POST["operation"] == "delete") {
    try {
        $ESP_CODIGO = $_POST["codigo"];
        $sql = "DELETE FROM " . $table . " WHERE ESP_CODIGO = :ESP_CODIGO;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':ESP_CODIGO', $ESP_CODIGO);
        $stmt->execute();
        echo '{"status":"deletado"}';
    } catch (Exception $e) {
        echo '{"status":"nao-deletado"}';
    }
} else if ($_POST["operation"] == "load_page") {
    try {
        $sql = "SELECT * FROM $table ORDER BY ESP_NOME";

        $resultado = executarQuery($conexao, $sql);

        $especialidades = [];

        while ($row = $resultado->fetch()) {
            $especialidades[] = [
                'especialidadeCodigo' => $row['ESP_CODIGO'],
                'especialidadeNome' => $row['ESP_NOME']
            ];
        }
        if (empty($especialidades)) {
            echo '{"status":"vazio"}';
        } else {
            $total = count($especialidades);
            $especialidades = json_encode($especialidades);
            echo '{"total" : "' . $total . '", "dados" : ' . $especialidades . '}';
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro":"' . $e . '"}';
    }
} else if ($_POST["operation"] == "search") {
    try {
        if (isset($_POST["nome"])) {
            $nome = $_POST["nome"];
            $sql = 'SELECT * FROM ' . $table . ' WHERE ESP_NOME LIKE :ESP_NOME ORDER BY ESP_NOME';

            $stmt = $conexao->prepare($sql);
            $stmt->execute(['ESP_NOME' => '%' . $nome . '%']);

            $especialidades = [];

            while ($row = $stmt->fetch()) {
                $especialidades[] = [
                    'especialidadeCodigo' => $row['ESP_CODIGO'],
                    'especialidadeNome' => $row['ESP_NOME']
                ];
            }
            if (empty($especialidades)) {

                echo '{"status":"vazio"}';
            } else {
                $total = count($especialidades);
                $especialidades = json_encode($especialidades);
                echo '{"total" : "' . $total . '", "dados" : ' . $especialidades . '}';
            }
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro":"' . $e . '"}';
    }
} else if ($_POST["operation"] == "load_dropdown") {
    try {
        $sql = "SELECT * FROM $table ORDER BY ESP_NOME;";
        $stmt = executarQuery($conexao, $sql);

        $especialidades = [];

        while ($row = $stmt->fetch()) {
            $especialidades[] = [
                'especialidadeCodigo' => $row['ESP_CODIGO'],
                'especialidadeNome' => $row['ESP_NOME']
            ];
        }
        if (empty($especialidades)) {
            echo '{"status":"vazio"}';
        } else {
            echo json_encode($especialidades);
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
