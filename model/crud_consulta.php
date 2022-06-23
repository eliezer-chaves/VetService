<?php
include 'db/connect.php';

$table = "tbl_consulta";
$table_reference_animal = "tbl_animal";
$table_reference_veterinario = "tbl_veterinario";
$table_reference_dono = "tbl_dono";
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
    $total = $_POST["quantidade"];

    $sql = "SELECT * FROM $table 
    INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
    INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
    INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
    ORDER BY CON_DATA, CON_HORA LIMIT $total";

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
            'consultaCodigo' => $row['CON_CODIGO'],
            'consultaData' => $row['CON_DATA'],
            'consultaHora' => $row['CON_HORA'],
        ];
    }
    if (empty($animais)) {
        echo '{"status":"vazio"}';
    } else {
        echo json_encode($animais);
    }
} else if ($_POST["operation"] == "read_one") {
    try {
        if (isset($_POST["codigo"])) {
            $codigo = $_POST["codigo"];
            $sql = "SELECT * FROM $table 
            INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
            INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
            INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
            WHERE CON_CODIGO = $codigo";

            $resultado = executarQuery($conexao, $sql);
            $consulta = $resultado->fetch();

            echo json_encode($consulta);
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro" : "' . $e . '" }';
    }
} else if ($_POST["operation"] == "update") {
    try {
        $ANI_CODIGO = $_POST["animalCodigo"];
        $CON_CODIGO = $_POST["consultaCodigo"];
        $VET_CODIGO = $_POST["veterinarioCodigo"];
        $CON_DATA = $_POST["consultaData"];
        $CON_HORA = $_POST["consultaHora"];

        $sql = "UPDATE " . $table . " SET ANI_CODIGO = :ANI_CODIGO, VET_CODIGO = :VET_CODIGO, CON_DATA = :CON_DATA, CON_HORA = :CON_HORA WHERE CON_CODIGO = :CON_CODIGO;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':ANI_CODIGO', $ANI_CODIGO);
        $stmt->bindParam(':CON_CODIGO', $CON_CODIGO);
        $stmt->bindParam(':VET_CODIGO', $VET_CODIGO);
        $stmt->bindParam(':CON_DATA', $CON_DATA);
        $stmt->bindParam(':CON_HORA', $CON_HORA);
        $stmt->execute();

        echo '{"status" : "alterado"}';
    } catch (Exception $e) {
        echo '{"status":"erro", "erro" : "'.$e.'"}';
    }
} else if ($_POST["operation"] == "delete") {
    try {
        $CON_CODIGO = $_POST["codigo"];
        $sql = "DELETE FROM " . $table . " WHERE CON_CODIGO = :CON_CODIGO;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':CON_CODIGO', $CON_CODIGO);
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
    INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
    INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
    INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO
    ORDER BY CON_DATA, CON_HORA LIMIT 5";
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
} else if ($_POST["operation"] == "search") {
    try {
        if (isset($_POST["nome"])) {
            $nome = $_POST["nome"];

            if ($_POST["quantidade"] == 5) {
                $sql = "SELECT * FROM $table 
                INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
                INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
                INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO WHERE ANI_NOME LIKE :ANI_NOME ORDER BY ANI_NOME LIMIT 5;";
            } else {
                $sql = "SELECT * FROM $table 
                INNER JOIN $table_reference_animal ON $table.ANI_CODIGO = $table_reference_animal.ANI_CODIGO
                INNER JOIN $table_reference_dono ON $table_reference_animal.DON_CODIGO = $table_reference_dono.DON_CODIGO
                INNER JOIN $table_reference_veterinario ON $table.VET_CODIGO = $table_reference_veterinario.VET_CODIGO WHERE ANI_NOME LIKE :ANI_NOME ORDER BY ANI_NOME";
            }

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
                    'consultaCodigo' => $row['CON_CODIGO'],
                    'consultaData' => $row['CON_DATA'],
                    'consultaHora' => $row['CON_HORA'],
                ];
            }
            if (empty($animais)) {
                echo '{"status":"vazio"}';
            } else {
                echo json_encode($animais);
            }
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro":"' . $e . '"}';
    }
}
