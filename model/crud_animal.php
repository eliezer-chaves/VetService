<?php
include 'db/connect.php';

$table = "tbl_animal";

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
} else if ($_POST["operation"] == "read_one") {
} else if ($_POST["operation"] == "read_animal_fk") {
    if (isset($_POST['query'])) {
        $inpText = $_POST['query'];

        $sql =   'SELECT * FROM tbl_animal INNER JOIN tbl_dono ON tbl_animal.DON_CODIGO = tbl_dono.DON_CODIGO WHERE ANI_NOME LIKE :ANI_NOME limit 5';

        $stmt = $conexao->prepare($sql);
        $stmt->execute(['ANI_NOME' => '%' . $inpText . '%']);

        $dados = [];

        while ($row = $stmt->fetch()) {
            $dados[] = [
                'animalnome' => $row['ANI_NOME'],
                'animalCodigo' => $row['ANI_CODIGO'],
                'donoCodigo' => $row['DON_CODIGO'],
                'donoNome' => $row['DON_NOME'],
                'donoCPF' => $row['DON_CPF'],
                'donoTelefone' => $row['DON_TELEFONE']
            ];
        }

        echo json_encode($dados);
    }
} else if ($_POST["operation"] == "update") {
} else if ($_POST["operation"] == "delete") {
}
