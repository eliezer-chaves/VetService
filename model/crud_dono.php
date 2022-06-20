<?php
include 'db/connect.php';
$table = "tbl_dono";

try {
    $conexao = criarConexao();
} catch (Exception $e) {
    echo '{ "Exceção_capturada": "' . $e->getMessage() . '"}';
}

if ($_POST["operation"] == "create") {
    if (empty($_POST["nome"]) || empty($_POST["cpf"]) || empty($_POST["cep"]) || empty($_POST["rua"]) || empty($_POST["bairro"]) || empty($_POST["uf"])) {
        echo '{ "resultado": "Preencha todos os campos", "status": "incomplete" }';
        return;
    }
    try {

        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $cep = $_POST["cep"];
        $rua = $_POST["rua"];
        $numero = $_POST["numero"];
        $complemento = $_POST["complemento"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];
        $uf = $_POST["uf"];
        $telefone = $_POST["telefone"];

        $sql = 'select DON_CPF from ' . $table . ' where DON_CPF = "' . $cpf . '" ;';
        $resultado = executarQuery($conexao, $sql);
        $dono = $resultado->fetch();

        if (!(empty($dono))) {
            echo '{"status": "exists", "cpf" : "' . $cpf . '"}';
            return;
        } else {
            $sql = "insert into " . $table .
                "(DON_NOME, DON_CPF, DON_CEP, DON_RUA, DON_NUMCASA, DON_COMPLEMENTO, DON_BAIRRO, DON_UF, DON_TELEFONE, DON_CIDADE)" .
                " values " .
                "(:DON_NOME, :DON_CPF, :DON_CEP, :DON_RUA, :DON_NUMCASA, :DON_COMPLEMENTO, :DON_BAIRRO, :DON_UF, :DON_TELEFONE, :DON_CIDADE);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':DON_NOME', $nome);
            $stmt->bindParam(':DON_CPF', $cpf);
            $stmt->bindParam(':DON_CEP', $cep);
            $stmt->bindParam(':DON_RUA', $rua);
            $stmt->bindParam(':DON_NUMCASA', $numero);
            $stmt->bindParam(':DON_COMPLEMENTO', $complemento);
            $stmt->bindParam(':DON_BAIRRO', $bairro);
            $stmt->bindParam(':DON_CIDADE', $cidade);
            $stmt->bindParam(':DON_UF', $uf);
            $stmt->bindParam(':DON_TELEFONE', $telefone);
            $stmt->execute();

            echo '{ "resultado": "Dono cadastrado", "status": "cadastrado", "dono": "' . $nome . '" }';
        }
    } catch (Exception $e) {
        echo '{ "Exceção_capturada": "' . $e->getMessage() . '", "status": "incomplete"}';
    }
} else if ($_POST["operation"] == "read_all") {

    $total = $_POST["quantidade"];
    $sql = "SELECT * FROM $table ORDER BY DON_NOME LIMIT $total";
    $resultado = executarQuery($conexao, $sql);

    $donos = [];

    while ($row = $resultado->fetch()) {
        $donos[] = [
            'donoCodigo' => $row['DON_CODIGO'],
            'donoNome' => $row['DON_NOME'],
            'donoCPF' => $row['DON_CPF'],
            'donoCEP' => $row['DON_CEP'],
            'donoRua' => $row['DON_RUA'],
            'donoNumCasa' => $row['DON_NUMCASA'],
            'donoComplemento' => $row['DON_COMPLEMENTO'],
            'donoBairro' => $row['DON_BAIRRO'],
            'donoUF' => $row['DON_UF'],
            'donoTelefone' => $row['DON_TELEFONE'],
            'donoCidade' => $row['DON_CIDADE']
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

            $sql = "select * from $table where DON_CODIGO = $codigo ";
            $resultado = executarQuery($conexao, $sql);
            $dono = $resultado->fetch();

            echo json_encode($dono);
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select"}';
    }
} else if ($_POST["operation"] == "read_dono_fk") {
    if (isset($_POST['query'])) {
        $inpText = $_POST['query'];
        $sql = 'SELECT DON_NOME, DON_CODIGO, DON_CPF, DON_TELEFONE FROM ' . $table . ' WHERE DON_NOME LIKE :DON_NOME limit 5';

        $stmt = $conexao->prepare($sql);
        $stmt->execute(['DON_NOME' => '%' . $inpText . '%']);

        $donos = [];

        while ($row = $stmt->fetch()) {
            $dados[] = [
                'id' => $row['DON_CODIGO'],
                'nome' => $row['DON_NOME'],
                'cpf' => $row['DON_CPF'],
                'telefone' => $row['DON_TELEFONE']
            ];
        }
        echo json_encode($dados);
    }
} else if ($_POST["operation"] == "update") {
    try {
        $DON_CODIGO = $_POST["codigo"];
        $DON_NOME = $_POST["donoNome"];
        $DON_CPF = $_POST["donoCPF"];
        $DON_CEP = $_POST["donoCEP"];
        $DON_RUA = $_POST["donoRua"];
        $DON_NUMCASA = $_POST["donoNumCasa"];
        $DON_COMPLEMENTO = $_POST["donoComplemento"];
        $DON_BAIRRO = $_POST["donoBairro"];
        $DON_CIDADE = $_POST["donoCidade"];
        $DON_UF = $_POST["donoUF"];
        $DON_TELEFONE = $_POST["donoTelefone"];

        $sql = "UPDATE " . $table . " SET DON_NOME = :DON_NOME, DON_CPF = :DON_CPF, DON_CEP = :DON_CEP, DON_RUA = :DON_RUA, DON_NUMCASA = :DON_NUMCASA, DON_COMPLEMENTO = :DON_COMPLEMENTO, DON_BAIRRO = :DON_BAIRRO, DON_CIDADE = :DON_CIDADE, DON_UF = :DON_UF, DON_TELEFONE = :DON_TELEFONE WHERE DON_CODIGO = :DON_CODIGO;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':DON_CODIGO', $DON_CODIGO);
        $stmt->bindParam(':DON_NOME', $DON_NOME);
        $stmt->bindParam(':DON_CPF', $DON_CPF);
        $stmt->bindParam(':DON_CEP', $DON_CEP);
        $stmt->bindParam(':DON_RUA', $DON_RUA);
        $stmt->bindParam(':DON_NUMCASA', $DON_NUMCASA);
        $stmt->bindParam(':DON_COMPLEMENTO', $DON_COMPLEMENTO);
        $stmt->bindParam(':DON_BAIRRO', $DON_BAIRRO);
        $stmt->bindParam(':DON_CIDADE', $DON_CIDADE);
        $stmt->bindParam(':DON_UF', $DON_UF);
        $stmt->bindParam(':DON_TELEFONE', $DON_TELEFONE);
        $stmt->execute();

        echo '{"status":"alterado"}';
    } catch (Exception $e) {
        echo '{"status":"erro"}';
    }
} else if ($_POST["operation"] == "delete") {
    try {
        $DON_CODIGO = $_POST["codigo"];
        $sql = "DELETE FROM " . $table . " WHERE DON_CODIGO = :DON_CODIGO;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':DON_CODIGO', $DON_CODIGO);
        $stmt->execute();
        echo '{"status":"deletado"}';
    } catch (Exception $e) {
        echo '{"status":"nao-deletado"}';
    }
} else if ($_POST["operation"] == "load_page") {
    $sql = "SELECT * FROM $table ORDER BY DON_NOME LIMIT 5";
    $resultado = executarQuery($conexao, $sql);

    $donos = [];

    while ($row = $resultado->fetch()) {
        $donos[] = [
            'donoCodigo' => $row['DON_CODIGO'],
            'donoNome' => $row['DON_NOME'],
            'donoCPF' => $row['DON_CPF'],
            'donoCEP' => $row['DON_CEP'],
            'donoRua' => $row['DON_RUA'],
            'donoNumCasa' => $row['DON_NUMCASA'],
            'donoComplemento' => $row['DON_COMPLEMENTO'],
            'donoBairro' => $row['DON_BAIRRO'],
            'donoUF' => $row['DON_UF'],
            'donoTelefone' => $row['DON_TELEFONE'],
            'donoCidade' => $row['DON_CIDADE']
        ];
    }
    if (empty($donos)) {
        echo '{"status":"vazio"}';
    } else {
        echo json_encode($donos);
    }
} else if ($_POST["operation"] == "search") {
    try {
        if (isset($_POST["nome"])) {
            $nome = $_POST["nome"];
            if ($_POST["quantidade"] == 5) {
                $sql = 'SELECT * FROM ' . $table . ' WHERE DON_NOME LIKE :DON_NOME ORDER BY DON_NOME LIMIT 5';
            } else {
                $sql = 'SELECT * FROM ' . $table . ' WHERE DON_NOME LIKE :DON_NOME ORDER BY DON_NOME';
            }


            $stmt = $conexao->prepare($sql);
            $stmt->execute(['DON_NOME' => '%' . $nome . '%']);

            $donos = [];

            while ($row = $stmt->fetch()) {
                $donos[] = [
                    'donoCodigo' => $row['DON_CODIGO'],
                    'donoNome' => $row['DON_NOME'],
                    'donoCPF' => $row['DON_CPF'],
                    'donoCEP' => $row['DON_CEP'],
                    'donoRua' => $row['DON_RUA'],
                    'donoNumCasa' => $row['DON_NUMCASA'],
                    'donoComplemento' => $row['DON_COMPLEMENTO'],
                    'donoBairro' => $row['DON_BAIRRO'],
                    'donoUF' => $row['DON_UF'],
                    'donoTelefone' => $row['DON_TELEFONE'],
                    'donoCidade' => $row['DON_CIDADE']
                ];
            }
            if (empty($donos)) {
                echo '{"status":"vazio"}';
            } else {
                echo json_encode($donos);
            }
        }
    } catch (Exception $e) {
        echo '{"status" : "erro-select", "erro":"' . $e . '"}';
    }
} else if ($_POST["operation"] == "count") {

    $sql = "SELECT COUNT(*) FROM " . $table . ";";
    $stmt = executarQuery($conexao, $sql);
    $totalROWS = $stmt->fetchColumn();

    echo $totalROWS ;
}
