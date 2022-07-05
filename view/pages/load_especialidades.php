<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
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
            <!-- Content -->
            <div class="container-fluid w-75 mb-3">
                <div id="conteudo">
                    <div class="mt-5 shadow p-3 bg-body rounded d-flex justify-content-between" id="content-header">
                        <div>
                            <a href="../pages/add_especialidade.php">
                                <button class="btn btn-success" type="submit">
                                    <i class="me-2 fa-solid fa-stethoscope"></i>
                                    Adicionar especialidade
                                </button>
                            </a>
                        </div>
                        <div class="d-flex w-50">
                            <input class="form-control me-2" type="search" placeholder="Buscar especialidade" id="nome_search" />
                            <button class="btn btn-primary" type="submit" id="search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mt-2 shadow p-3 bg-body rounded" id="content">
                        <div id="total_resultados" style="display: flex;">
                            <div class="d-flex align-midde mb-2" style="display:flex; justify-content: center; align-items: center;">
                                <div class="me-1">
                                    Mostrando
                                </div>
                                <div class="me-1">
                                    <select class="form-select form-select-sm" name="select" id="table_count" aria-label=".form-select-sm example">
                                        <option selected value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="">Todos</option>
                                    </select>
                                </div>
                                <div id="text_total_especialidades">
                                    de <b><span id="total_especialidades"></span></b> especialidades.
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 align-middle" style="display: flex;" id="total_especialidades_quantidade">
                            <div class="me-1" id="text_especialidades_quantidade">
                                Total de especialidades <b><span id="total_especialidade_value"></span></b>.
                            </div>
                        </div>

                        <div class="mb-2 align-middle" style="display: flex;" id="total_especialidade_busca">
                            <div class="me-1" id="text_especialidade_quantidade">
                                Total de especialidades encontradas: <b><span id="total_especialidades_busca_value"></span></b>.
                            </div>
                        </div>

                        <table class="table table-hover table-bordered" id="table">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Código</th>
                                    <th scope="col">Especialidade</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="especialidades">
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center algin-middle mt-2">
                            <p id="aviso">Nenhuma especialidade encontrada, faça uma nova pesquisa.</p>
                        </div>
                    </div>
                </div>

                <div id="semCadastro" class="mt-5 bg-white shadow rounded h-25 w-100" style="display: flex; justify-content: center; align-items: center;">

                    <div>
                        <b class="h3">Nenhuma especialidade cadastrada!</b>
                    </div>

                </div>

            </div>
        </div>

        <!-- Modal Editar -->
        <div class="modal fade" id="modalEditarEspecialidade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar especialidade</h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="">
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Código</span>
                                    <input type="text" class="form-control" id="codigo" disabled />
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nome</span>
                                    <input type="text" class="form-control" id="modalNome" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                            Fechar
                        </button>
                        <button type="button" class="btn btn-success" id="updateEspecialidade">
                            Confirmar alteração
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Excluir -->
        <div class="modal fade" id="modalEspecialidadeExcluir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="staticBackdropLabel">
                            Você tem certeza que deseja excluir?
                        </h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="p-3">
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Código</span>
                                    <input type="text" class="form-control" id="modalExcluirEspecialidadeCodigo" disabled />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Especialidade</span>
                                        <input type="text" class="form-control" id="modalExcluirEspecialidadeNome" disabled />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                            Fechar
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalEspecialidadeExcluir" id="modalEspecialidadeExcluir">
                            Excluir
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Erro Excluir -->
        <div class="modal fade" id="modalErroExcluir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="staticBackdropLabel">
                            Não foi possível excluir!
                        </h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Não foi possível excluir a seguinte especialidade: <b><span id="especialidadeNaoExcluida"></span></b>, pois há veterinários cadastrados com essa especialidade.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerta Success -->
        <div class="alert alert-success text-center" id="especialidadeAlterado" role="alert">
            Especialidade alterada com sucesso!
        </div>
        <!-- Alerta Success -->
        <div class="alert alert-warning text-center" id="especialidadeExcluido" role="alert">
            Especialidade excluída com sucesso!
        </div>
        <!-- Alerta Erro -->
        <div class="alert alert-warning text-center" id="especialidadeErro" role="alert">
            Não foi possível excluir especialidade!
        </div>

        <script src="../../controller/page_load_especialidades.js"></script>
</body>

</html>