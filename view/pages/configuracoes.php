<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VetService</title>
    <!--Icone da aba -->
    <link rel="shortcut icon" href="../assets/rabbit.svg" />
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/assets.css" />
    <link rel="stylesheet" href="../css/sidebar.css" />
    <link rel="stylesheet" href="../css/footer.css" />
    <link rel="stylesheet" href="../css/main.css" />
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
</head>

<body class="">
    <div id="box">
        <!-- Header -->
        <?php include 'componentes/header.html'; ?>
        <!-- Main -->
        <div class="d-flex" id="main">
            <!-- Sidebar -->
            <div class="bg-white shadow" id="sidebar">
                <?php include 'componentes/sidebar.html'; ?>
            </div>
            <!--Content -->
            <div class="container-fluid w-50">
                <div class="bg-white rounded shadow mt-3 mb-5 p-3">
                    <div class="mb-5">
                        <div class="mb-2">
                            <label for="inputCodigo" class="form-label">Código</label>
                            <input type="text" id="inputCodigo" class="form-control" disabled>
                        </div>

                        <div class="mb-2">
                            <label for="inputNome" class="form-label">Nome</label>
                            <input type="text" id="inputNome" class="form-control" aria-describedby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text">
                                Este será seu nome de identificação, poderá ser o nome da sua clínica também.
                            </div>
                        </div>
                        <div>
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="email" id="inputEmail" class="form-control" aria-describedby="emaildHelpBlock">
                            <div id="emaildHelpBlock" class="form-text">
                                Este será seu email para contato.
                            </div>
                        </div>
                    </div>

                    <div id="deleteAll" class="mb-5">
                        <div class="d-flex justify-content-between mb-2">
                            <p>Apagar todos os <b>donos.</b></p>
                            <button type="button" class="btn btn-outline-danger btn-sm" style="width: 150px;" id="deletarDonos"><i class="me-2 fa-solid fa-person"></i>Excluir</button>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <p>Apagar todos os <b>animais.</b></p>
                            <button type="button" class="btn btn-outline-danger btn-sm" style="width: 150px;" id="deletarAnimais"><i class="me-2 fa-solid fa-dog"></i>Excluir</button>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <p>Apagar todas as <b>consultas.</b></p>
                            <button type="button" class="btn btn-outline-danger btn-sm" style="width: 150px;" id="deletarConsultas"><i class="me-2 fa-solid fa-calendar-days"></i>Excluir</button>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p>Apagar todos os <b>diagnósticos.</b></p>
                            <button type="button" class="ms-2 btn btn-outline-danger btn-sm" style="width: 150px;" id="deletarDiagnosticos"><i class="me-2 fa-solid fa-file-pen"></i>Excluir</button>
                        </div>
                    </div>

                    <div>
                        <label for="" class="form-label">Deletar conta</label>
                        <button type="button" class="ms-2 btn btn-outline-danger btn-sm" style="width: 150px;" id="deletarConta" aria-describedby="deleteAccountdHelpBlock">Excluir conta</button>
                        <div id="deleteAccountdHelpBlock" class="form-text">
                            Ao fazer isso todos os seus dados serão excluídos.
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- <script src="../../controller/configuracoes.js"></script> -->
</body>

</html>