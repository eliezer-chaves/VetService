<?php
include 'db/connect.php';

$table = "tbl_diagnostico";
$table_consulta = "tbl_consulta";
$table_reference_dono = "tbl_dono";
$table_reference_consulta = "tbl_consulta";
$table_reference_animal = "tbl_animal";
$table_reference_especialidade = "tbl_especialidade";
$table_reference_veterinario = "tbl_veterinario";
try {
    $conexao = criarConexao();
} catch (Exception $e) {
    echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
}

if ($_POST["operation"] == "create") {
    if (empty($_POST["codigoConsulta"]) || empty($_POST["animalCodigo"])) {
        echo '{"resultado": "Preencha todos os campos", "status": "incomplete"}';
        return;
    } else {
        try {
            $animalCodigo = $_POST["animalCodigo"];
            $codigoConsulta = $_POST["codigoConsulta"];
            $peso = $_POST["peso"];
            $altura = $_POST["altura"];
            $temperatura = $_POST["temperatura"];
            $bpm = $_POST["bpm"];
            $pressao = $_POST["pressao"];
            $sintomas = $_POST["sintomas"];

            $sql = "INSERT INTO " . $table .
                "(ANI_CODIGO, CON_CODIGO, DIG_PESO, DIG_TEMPERATURA, DIG_BPM, DIG_ALTURA, DIG_PRESSAO, DIG_SINTOMAS)" .
                " VALUES " .
                "(:ANI_CODIGO, :CON_CODIGO, :DIG_PESO, :DIG_TEMPERATURA, :DIG_BPM, :DIG_ALTURA, :DIG_PRESSAO, :DIG_SINTOMAS);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':ANI_CODIGO', $animalCodigo);
            $stmt->bindParam(':CON_CODIGO', $codigoConsulta);
            $stmt->bindParam(':DIG_PESO', $peso);
            $stmt->bindParam(':DIG_ALTURA', $altura);
            $stmt->bindParam(':DIG_TEMPERATURA', $temperatura);
            $stmt->bindParam(':DIG_BPM', $bpm);
            $stmt->bindParam(':DIG_PRESSAO', $pressao);
            $stmt->bindParam(':DIG_SINTOMAS', $sintomas);
            $stmt->execute();

            echo '{ "resultado": "Consulta cadastrada", "status": "cadastrado"}';
        } catch (Exception $e) {
            echo '{ "status": "' . $e->getMessage() . '"}';
        }
    }
} else if ($_POST["operation"] == "read_all") {
    try {
        $total = $_POST["quantidade"];

        if ($total == "") {
            $sql = "SELECT * FROM $table 
            INNER JOIN $table_reference_consulta ON $table.CON_CODIGO = $table_reference_consulta.CON_CODIGO
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table_reference_consulta.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            ORDER BY ANI_NOME, CON_DATA, CON_HORA;";
        } else {
            $sql = "SELECT * FROM $table
            INNER JOIN $table_reference_consulta ON $table.CON_CODIGO = $table_reference_consulta.CON_CODIGO 
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table_reference_consulta.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            ORDER BY ANI_NOME, CON_DATA, CON_HORA LIMIT $total;";
        }

        $resultado = executarQuery($conexao, $sql);

        $animais = [];

        while ($row = $resultado->fetch()) {
            $animais[] = [
                'donoCodigo' => $row['DON_CODIGO'],
                'donoNome' => $row['DON_NOME'],
                'animalCodigo' => $row['ANI_CODIGO'],
                'animalNome' => $row['ANI_NOME'],
                'veterinarioCodigo' => $row['VET_CODIGO'],
                'veterinarioNome' => $row['VET_NOME'],
                'veterinarioEspecialidade' => $row['ESP_NOME'],
                'especialidadeCodigo' => $row['ESP_CODIGO'],
                'consultaCodigo' => $row['CON_CODIGO'],
                'consultaData' => $row['CON_DATA'],
                'consultaHora' => $row['CON_HORA'],
                'diagnosticoCodigo' => $row['DIG_CODIGO'],
            ];
        }
        if (empty($animais)) {
            echo '{"status":"vazio"}';
        } else {
            $totalROWS = countTable();
            $animais = json_encode($animais);
            echo '{"total" : "' . $totalROWS . '", "dados" : ' . $animais . '}';
        }
    } catch (Exception $e) {
        echo '{ "Exceção_capturada": "' . $e . '"}';
    }
} else if ($_POST["operation"] == "read_one") {
    try {
        if (isset($_POST["codigo"])) {
            $codigo = $_POST["codigo"];

            $sql = "SELECT * FROM $table 
            INNER JOIN $table_reference_consulta ON $table.CON_CODIGO = $table_reference_consulta.CON_CODIGO
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table_reference_consulta.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            WHERE $table.DIG_CODIGO = $codigo";

            $resultado = executarQuery($conexao, $sql);
            $diagnostico = $resultado->fetch();

            echo json_encode($diagnostico);
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro" : "' . $e . '" }';
    }
} else if ($_POST["operation"] == "update") {
    try {
        $DIG_CODIGO = $_POST["diagnosticoCodigo"];
        $DIG_PESO = $_POST["peso"];
        $DIG_ALTURA = $_POST["altura"];
        $DIG_BPM = $_POST["bpm"];
        $DIG_TEMPERATURA = $_POST["temperatura"];
        $DIG_PRESSAO = $_POST["pressao"];
        $DIG_SINTOMAS = $_POST["sintomas"];

        $sql = "UPDATE " . $table . " SET DIG_PESO = :DIG_PESO, DIG_ALTURA = :DIG_ALTURA, DIG_BPM = :DIG_BPM, DIG_TEMPERATURA = :DIG_TEMPERATURA, DIG_PRESSAO = :DIG_PRESSAO, DIG_SINTOMAS = :DIG_SINTOMAS WHERE DIG_CODIGO = :DIG_CODIGO;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':DIG_CODIGO', $DIG_CODIGO);
        $stmt->bindParam(':DIG_PESO', $DIG_PESO);
        $stmt->bindParam(':DIG_ALTURA', $DIG_ALTURA);
        $stmt->bindParam(':DIG_BPM', $DIG_BPM);
        $stmt->bindParam(':DIG_TEMPERATURA', $DIG_TEMPERATURA);
        $stmt->bindParam(':DIG_PRESSAO', $DIG_PRESSAO);
        $stmt->bindParam(':DIG_SINTOMAS', $DIG_SINTOMAS);
        $stmt->execute();

        echo '{"status" : "alterado"}';
    } catch (Exception $e) {
        echo '{"status":"erro", "erro" : "' . $e . '"}';
    }
} else if ($_POST["operation"] == "delete") {
    try {
        $DIG_CODIGO = $_POST["codigo"];
        $sql = "DELETE FROM " . $table . " WHERE DIG_CODIGO = :DIG_CODIGO;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':DIG_CODIGO', $DIG_CODIGO);
        $stmt->execute();
        echo '{"status":"deletado"}';
    } catch (Exception $e) {
        echo '{"status":"nao-deletado"}';
    }
} else if ($_POST["operation"] == "read_animal_fk") {
    if (isset($_POST['query'])) {
        $inpText = $_POST['query'];

        $sql = 'SELECT * FROM TBL_ANIMAL INNER JOIN TBL_DONO ON TBL_ANIMAL.DON_CODIGO = TBL_DONO.DON_CODIGO WHERE ANI_NOME LIKE :ANI_NOME LIMIT 5';

        $stmt = $conexao->prepare($sql);
        $stmt->execute(['ANI_NOME' => '%' . $inpText . '%']);

        $dados = [];

        while ($row = $stmt->fetch()) {
            $dados[] = [
                'donoCodigo' => $row['DON_CODIGO'],
                'donoNome' => $row['DON_NOME'],
                'donoCPF' => $row['DON_CPF'],
                'donoTelefone' => $row['DON_TELEFONE'],
                'animalCodigo' => $row['ANI_CODIGO'],
                'animalNome' => $row['ANI_NOME']
            ];
        }

        echo json_encode($dados);
    }
} else if ($_POST["operation"] == "count") {
    $sql = "SELECT COUNT(*) FROM " . $table . ";";
    $stmt = executarQuery($conexao, $sql);
    $totalROWS = $stmt->fetchColumn();

    echo $totalROWS;
} else if ($_POST["operation"] == "load_page") {

    $sql = "SELECT * FROM $table 
    INNER JOIN $table_reference_consulta ON $table.CON_CODIGO = $table_reference_consulta.CON_CODIGO
    INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
    INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
    INNER JOIN $table_reference_veterinario ON $table_reference_consulta.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
    INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
    ORDER BY ANI_NOME, CON_DATA, CON_HORA;";

    $resultado = executarQuery($conexao, $sql);

    $diagnosticos = [];

    while ($row = $resultado->fetch()) {
        $diagnosticos[] = [
            'donoCodigo' => $row['DON_CODIGO'],
            'donoNome' => $row['DON_NOME'],
            'animalCodigo' => $row['ANI_CODIGO'],
            'animalNome' => $row['ANI_NOME'],
            'veterinarioCodigo' => $row['VET_CODIGO'],
            'veterinarioNome' => $row['VET_NOME'],
            'veterinarioEspecialidade' => $row['ESP_NOME'],
            'consultaCodigo' => $row['CON_CODIGO'],
            'consultaData' => $row['CON_DATA'],
            'consultaHora' => $row['CON_HORA'],

            'diagnosticoCodigo' => $row['DIG_CODIGO'],
        ];
    }
    if (empty($diagnosticos)) {
        echo '{"status":"vazio"}';
    } else {
        $total = count($diagnosticos);
        $diagnosticos = json_encode($diagnosticos);
        echo '{"total" : "' . $total . '", "dados" : ' . $diagnosticos . '}';
    }
} else if ($_POST["operation"] == "search") {
    try {
        if (isset($_POST["nome"])) {
            $nome = $_POST["nome"];

            /* $sql = "SELECT * FROM $table 
                INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
                INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
                INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
                INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
                WHERE ANI_NOME LIKE :ANI_NOME ORDER BY CON_DATA, CON_HORA;"; */

            $sql = "SELECT * FROM $table 
            INNER JOIN $table_reference_consulta ON $table.CON_CODIGO = $table_reference_consulta.CON_CODIGO
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table_reference_consulta.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            WHERE ANI_NOME LIKE :ANI_NOME ORDER BY ANI_NOME, CON_DATA, CON_HORA;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute(['ANI_NOME' => '%' . $nome . '%']);

            $animais = [];

            while ($row = $stmt->fetch()) {
                $animais[] = [
                    'donoCodigo' => $row['DON_CODIGO'],
                    'donoNome' => $row['DON_NOME'],
                    'animalCodigo' => $row['ANI_CODIGO'],
                    'animalNome' => $row['ANI_NOME'],
                    'veterinarioCodigo' => $row['VET_CODIGO'],
                    'veterinarioNome' => $row['VET_NOME'],
                    'veterinarioEspecialidade' => $row['ESP_NOME'],
                    'consultaCodigo' => $row['CON_CODIGO'],
                    'consultaData' => $row['CON_DATA'],
                    'consultaHora' => $row['CON_HORA'],
                    'diagnosticoCodigo' => $row['DIG_CODIGO'],
                ];
            }
            if (empty($animais)) {
                echo '{"status":"vazio"}';
            } else {
                $total = count($animais);
                $animais = json_encode($animais);
                echo '{"total" : "' . $total . '", "dados" : ' . $animais . '}';
            }
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro":"' . $e . '"}';
    }
} else if ($_POST["operation"] == "load_calendar") {

    $sql = "SELECT * FROM $table 
        INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
        INNER JOIN $table_reference_consulta ON $table.CON_CODIGO = $table_reference_animal.CON_CODIGO
        ORDER BY CON_DATA, CON_HORA";

    $resultado = executarQuery($conexao, $sql);

    $consultas = [];

    while ($row = $resultado->fetch()) {
        $consultas[] = [
            'donoCodigo' => $row['DON_CODIGO'],
            'donoNome' => $row['DON_NOME'],
            'animalCodigo' => $row['ANI_CODIGO'],
            'animalNome' => $row['ANI_NOME'],
            'veterinarioCodigo' => $row['VET_CODIGO'],
            'veterinarioNome' => $row['VET_NOME'],
            'veterinarioEspecialidade' => $row['ESP_NOME'],
            'consultaCodigo' => $row['CON_CODIGO'],
            'consultaData' => $row['CON_DATA'],
            'consultaHora' => $row['CON_HORA'],
        ];
    }
    if (empty($consultas)) {
        echo '{"status":"vazio"}';
    } else {
        echo json_encode($consultas);
    }
} else if ($_POST["operation"] == "filter_table") {
    $quantidade = $_POST["quantidade"];
    $veterinarioCodigo = $_POST["veterinarioCodigo"];

    if ($veterinarioCodigo == "") {
        if ($quantidade == "") {
            $sql = "SELECT * FROM $table 
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            ORDER BY CON_DATA, CON_HORA;";

            $contador = "SELECT COUNT(*) FROM $table
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            ORDER BY CON_DATA, CON_HORA;";

            $stmtContador = executarQuery($conexao, $contador);
            $totalROWS = $stmtContador->fetchColumn();
        } else {
            $sql = "SELECT * FROM $table 
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            ORDER BY CON_DATA, CON_HORA LIMIT $quantidade; ";


            $contador = "SELECT COUNT(*) FROM $table
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            ORDER BY CON_DATA, CON_HORA LIMIT $quantidade; ";

            $stmtContador = executarQuery($conexao, $contador);
            $totalROWS = $stmtContador->fetchColumn();
        }
    } else {
        if ($quantidade == "") {
            $sql = "SELECT * FROM $table 
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            WHERE $table_reference_veterinario.VET_CODIGO = $veterinarioCodigo
            ORDER BY CON_DATA, CON_HORA;";

            $contador = "SELECT COUNT(*) FROM $table
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            WHERE $table_reference_veterinario.VET_CODIGO = $veterinarioCodigo
            ORDER BY CON_DATA, CON_HORA;";

            $stmtContador = executarQuery($conexao, $contador);
            $totalROWS = $stmtContador->fetchColumn();
        } else {
            $sql = "SELECT * FROM $table 
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            WHERE $table_reference_veterinario.VET_CODIGO = $veterinarioCodigo
            ORDER BY CON_DATA, CON_HORA LIMIT $quantidade;";

            $contador = "SELECT COUNT(*) FROM $table
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            INNER JOIN $table_reference_especialidade ON $table_reference_veterinario.ESP_CODIGO = $table_reference_especialidade.ESP_CODIGO
            WHERE $table_reference_veterinario.VET_CODIGO = $veterinarioCodigo
            ORDER BY CON_DATA, CON_HORA LIMIT $quantidade;";

            $stmtContador = executarQuery($conexao, $contador);
            $totalROWS = $stmtContador->fetchColumn();
        }
    }

    $resultado = executarQuery($conexao, $sql);

    $animais = [];

    while ($row = $resultado->fetch()) {
        $animais[] = [
            'donoCodigo' => $row['DON_CODIGO'],
            'donoNome' => $row['DON_NOME'],
            'animalCodigo' => $row['ANI_CODIGO'],
            'animalNome' => $row['ANI_NOME'],
            'veterinarioCodigo' => $row['VET_CODIGO'],
            'veterinarioNome' => $row['VET_NOME'],
            'veterinarioEspecialidade' => $row['ESP_NOME'],
            'especialidadeCodigo' => $row['ESP_CODIGO'],
            'consultaCodigo' => $row['CON_CODIGO'],
            'consultaData' => $row['CON_DATA'],
            'consultaHora' => $row['CON_HORA'],
        ];
    }
    if (empty($animais)) {
        echo '{"status":"vazio"}';
    } else {
        //$totalROWS = countTable();
        $animais = json_encode($animais);
        echo '{"total" : "' . $totalROWS . '", "dados" : ' . $animais . '}';
    }
} else if ($_POST["operation"] == "update_consulta") {
    try {
        if (isset($_POST["codigoConsulta"])) {
            $codigo = $_POST["codigoConsulta"];

            $sql = "UPDATE $table_consulta SET CON_REALIZADA = true WHERE CON_CODIGO = :CON_CODIGO;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':CON_CODIGO', $codigo);
            $stmt->execute();

            echo '{"status" : "alterado"}';
        } else {
            echo '{"status" : "nao-alterado"}';
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro" : "' . $e . '" }';
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
