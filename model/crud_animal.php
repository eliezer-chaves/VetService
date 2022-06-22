<?php
include 'db/connect.php';

$table = "tbl_animal";
$table_reference = "tbl_dono";

try {
    $conexao = criarConexao();
} catch (Exception $e) {
    echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
}

if ($_POST["operation"] == "create") {
    if (empty($_POST["nome"]) || empty($_POST["donoNome"]) || empty($_POST["donoCodigo"])) {
        echo '{"resultado": "Preencha todos os campos", "status": "incomplete"}';
        return;
    } else {
        try {
            $nome = $_POST["nome"];
            $donoNome = $_POST["donoNome"];
            $donoCodigo = $_POST["donoCodigo"];
            $datanasc = $_POST["datanasc"];
            $sexo = $_POST["sexo"];
            $especie = $_POST["especie"];

            $sql = "insert into " . $table .
                "(ANI_NOME, ANI_NASCIMENTO, ANI_ESPECIE, ANI_SEXO, DON_CODIGO)" .
                " values " .
                "(:ANI_NOME, :ANI_NASCIMENTO, :ANI_ESPECIE, :ANI_SEXO, :DON_CODIGO);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':ANI_NOME', $nome);
            $stmt->bindParam(':ANI_NASCIMENTO', $datanasc);
            $stmt->bindParam(':ANI_ESPECIE', $especie);
            $stmt->bindParam(':ANI_SEXO', $sexo);
            $stmt->bindParam(':DON_CODIGO', $donoCodigo);
            $stmt->execute();

            echo '{"status": "cadastrado", "dono": "' . $donoNome . '", "animal": "' . $nome . '" }';
        } catch (Exception $e) {
            echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
        }
    }
} else if ($_POST["operation"] == "read_all") {
    $total = $_POST["quantidade"];
    $sql = "SELECT * FROM $table ORDER BY ANI_NOME LIMIT $total";
    $resultado = executarQuery($conexao, $sql);

    $animais = [];

    while ($row = $resultado->fetch()) {
        $animais[] = [
            'animalCodigo' => $row['ANI_CODIGO'],
            'animalNome' => $row['ANI_NOME'],
            'animalSexo' => $row['ANI_SEXO'],
            'donoCodigo' => $row['DON_CODIGO']
        ];
    }
    if (empty($donos)) {
        echo '{"status":"vazio"}';
    } else {
        echo json_encode($donos);
    }
} else if ($_POST["operation"] == "read_one") {
    try {
        if (isset($_POST["codigo"])) {
            $codigo = $_POST["codigo"];

            $sql = "SELECT * FROM $table INNER JOIN $table_reference ON $table.DON_CODIGO = $table_reference.DON_CODIGO WHERE ANI_CODIGO = $codigo;";
            $resultado = executarQuery($conexao, $sql);
            $animal = $resultado->fetch();

            echo json_encode($animal);
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro" : "' . $e . '" }';
    }
} else if ($_POST["operation"] == "read_animal_fk") {
    if (isset($_POST['query'])) {
        $inpText = $_POST['query'];

        $sql = 'SELECT * FROM tbl_dono WHERE DON_NOME LIKE :DON_NOME LIMIT 5';

        $stmt = $conexao->prepare($sql);
        $stmt->execute(['DON_NOME' => '%' . $inpText . '%']);

        $dados = [];

        while ($row = $stmt->fetch()) {
            $dados[] = [
                'donoCodigo' => $row['DON_CODIGO'],
                'donoNome' => $row['DON_NOME'],
            ];
        }

        echo json_encode($dados);
    }
} else if ($_POST["operation"] == "update") {
    try {
        $ANI_CODIGO = $_POST["animalCodigo"];
        $ANI_NOME = $_POST["animalNome"];
        $ANI_NASCIMENTO = $_POST["animalNascimento"];
        $ANI_ESPECIE = $_POST["especie"];
        $ANI_SEXO = $_POST["sexo"];
        $DON_CODIGO = $_POST["donoCodigo"];

        $sql = "UPDATE " . $table . " SET ANI_NOME = :ANI_NOME, ANI_NASCIMENTO = :ANI_NASCIMENTO, ANI_ESPECIE = :ANI_ESPECIE, ANI_SEXO = :ANI_SEXO, DON_CODIGO = :DON_CODIGO WHERE ANI_CODIGO = :ANI_CODIGO;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':ANI_CODIGO', $ANI_CODIGO);
        $stmt->bindParam(':DON_CODIGO', $DON_CODIGO);
        $stmt->bindParam(':ANI_NOME', $ANI_NOME);
        $stmt->bindParam(':ANI_NASCIMENTO', $ANI_NASCIMENTO);
        $stmt->bindParam(':ANI_SEXO', $ANI_SEXO);
        $stmt->bindParam(':ANI_ESPECIE', $ANI_ESPECIE);
        $stmt->execute();

        echo '{"status" : "alterado"}';
    } catch (Exception $e) {
        echo '{"status":"erro", "erro" : "'.$e.'"}';
    }
} else if ($_POST["operation"] == "delete") {
    try {
        $ANI_CODIGO = $_POST["codigo"];
        $sql = "DELETE FROM " . $table . " WHERE ANI_CODIGO = :ANI_CODIGO;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':ANI_CODIGO', $ANI_CODIGO);
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
    $sql = "SELECT * FROM $table INNER JOIN $table_reference ON $table.DON_CODIGO = $table_reference.DON_CODIGO ORDER BY ANI_NOME LIMIT 5";
    $resultado = executarQuery($conexao, $sql);

    $animais = [];

    while ($row = $resultado->fetch()) {
        $animais[] = [
            'donoCodigo' => $row['DON_CODIGO'],
            'donoNome' => $row['DON_NOME'],
            'animalCodigo' => $row['ANI_CODIGO'],
            'animalNome' => $row['ANI_NOME'],
            'animalNascimento' => $row['ANI_NASCIMENTO'],
            'animalEspecie' => $row['ANI_ESPECIE'],
            'animalSexo' => $row['ANI_SEXO']
        ];
    }
    if (empty($animais)) {
        echo '{"status":"vazio"}';
    } else {
        echo json_encode($animais);
    }
} else if ($_POST["operation"] == "search") {
    try {
        if (isset($_POST["nome"])) {
            $nome = $_POST["nome"];
            $sql = "SELECT * FROM $table ORDER BY ANI_NOME LIMIT 5";

            if ($_POST["quantidade"] == 5) {
                $sql = "SELECT * FROM $table INNER JOIN $table_reference ON $table.DON_CODIGO = $table_reference.DON_CODIGO WHERE ANI_NOME LIKE :ANI_NOME ORDER BY ANI_NOME LIMIT 5;";
            } else {
                $sql = "SELECT * FROM $table INNER JOIN $table_reference ON $table.DON_CODIGO = $table_reference.DON_CODIGO WHERE ANI_NOME LIKE :ANI_NOME ORDER BY ANI_NOME;";
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
                    'animalNascimento' => $row['ANI_NASCIMENTO'],
                    'animalEspecie' => $row['ANI_ESPECIE'],
                    'animalSexo' => $row['ANI_SEXO']
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
