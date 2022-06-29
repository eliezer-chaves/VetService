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
      <!--Content -->
      <div class="container-fluid w-75  mb-5">
        <div class="bg-body shadow mt-5 p-3 bg-body rounded">
          <div class="d-flex justify-content-between">
            <div>
              <a href="../pages/add_consulta.php">
                <button class="btn btn-success" type="submit">
                  <i class="me-2 fa-solid fa-calendar-days"></i>
                  Adicionar consulta
                </button>
              </a>
            </div>
            <div class="d-flex w-50">
              <input class="form-control me-2" type="search" placeholder="Buscar consulta por animal" id="nome_search" />
              <button class="btn btn-primary" type="submit" id="search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="mt-2 shadow p-3 bg-body rounded">
          <div class="d-flex align-midle" id="total_resultados">
            <div class="me-1">
              Mostrando
            </div>
            <div style="width: 70px; " class="me-1">
              <select class="form-select form-select-sm mb-2" name="select" id="table_count" aria-label=".form-select-sm example">
                <option selected value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
              </select>
            </div>
            <div class="me-1">
              de <b><a id="total"></a></b>
            </div>
          </div>
          <table class="table table-hover table-bordered">
            <thead>
              <tr class="text-center">
                <th scope="col">Id</th>
                <th scope="col">Animal</th>
                <th scope="col">Dono</th>
                <th scope="col">Horário</th>
                <th scope="col">Dia</th>
                <th scope="col">Veterinário</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody id="consultas">

            </tbody>
          </table>
          <div class="d-flex justify-content-center algin-middle">
            <p id="aviso">Nenhuma consulta encontrada, faça uma nova pesquisa.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
              Editar consulta
            </h5>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="">

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Codigo consulta</span>
                  <input type="text" class="form-control" id="editarConsultaCodigo" disabled />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Codigo animal</span>
                  <input type="text" class="form-control" id="editarAnimalCodigo" disabled />
                </div>
              </div>

              <div class="row">
                <div class="form-group mb-3">
                  <label for="dono">Animal:</label>
                  <input type="text" id="editarAnimalNome" class="form-control" autocomplete="off" />
                  <div class="list-group shadow-lg" id="resultado" style="position: absolute; z-index: 1;"></div>
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Codigo dono</span>
                  <input type="text" class="form-control" id="editarCodigoDono" disabled readonly />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Dono</span>
                  <input type="text" class="form-control" disabled readonly id="editarNomeDono" />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <label class="input-group-text" for="veterinario_opcao">Veterinário(a)</label>
                  <select class="form-select" id="veterinario_opcao">
                    <option id="veterinario_opcao" selected>Escolha...</option>

                  </select>

                  <div class="input-group mt-3">
                    <span class="input-group-text">Código Veterinário:</span>
                    <input id="veterinario_codigo" type="text" class="form-control" disabled />
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Data</span>
                    <input type="date" class="form-control" id="editarDataConsulta" />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Hora</span>
                    <input type="time" class="form-control" id="editarHoraConsulta" />
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" id="updateConsulta">
              Confirmar alteração
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Excluir -->
    <div class="modal fade" id="modalExcluirConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="staticBackdropLabel">
              Você tem certeza que deseja excluir?
            </h5>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="">
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Código Consulta</span>
                    <input type="text" class="form-control" disabled id="excluirConsultaCodigo" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Código Dono</span>
                    <input type="text" class="form-control" disabled id="excluirDonoCodigo" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Dono</span>
                    <input type="text" class="form-control" disabled id="excluirDonoNome" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Código animal</span>
                  <input type="text" class="form-control" disabled id="excluirAnimalCodigo" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Animal</span>
                  <input type="text" class="form-control" disabled id="excluirAnimalNome" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Data</span>
                  <input type="text" class="form-control" disabled id="excluirConsultaData" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text ">Código veterinário</span>
                  <input type="text" class="form-control" disabled id="excluirVeterinarioCodigo" />
                </div>
              </div>
              <div class="row">
                <div class="input-group">
                  <span class="input-group-text">Veterinário</span>
                  <input type="text" class="form-control" disabled id="excluirVeterinarioNome" />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" id="deleteConsulta">
              Excluir
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer 
    <?php include 'componentes/footer.html'; ?>
  </div> -->
    <!-- Alerta Success -->
    <div class="alert alert-success text-center" id="consultaAlterado" role="alert">
      Consulta alterada com sucesso!
    </div>
    <!-- Alerta Success -->
    <div class="alert alert-warning text-center" id="consultaExcluido" role="alert">
      Consulta excluída com sucesso!
    </div>
    <!-- Alerta Erro -->
    <div class="alert alert-warning text-center" id="consultaErro" role="alert">
      Não foi possível alterar a consulta!
    </div>
    <script src="../../controller/page_load_consultas.js"></script>
</body>


</html>