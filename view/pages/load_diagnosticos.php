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
     
      <!-- Content -->
      <div class="container-fluid w-75 mb-3">
        <div id="conteudo">
          <div class="mt-5 shadow p-3 bg-body rounded d-flex justify-content-between" id="content-header">
            <div>
              <!-- <a href="../pages/add_animais.php">
                <button class="btn btn-success" type="submit">
                  <i class="me-2 fa-solid fa-dog"></i>
                  Adicionar animal
                </button>
              </a> -->
            </div>
            <div class="d-flex w-50">
              <input class="form-control me-2" type="search" placeholder="Buscar diagnóstico por animal" id="nome_search" />
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
                    <option value="">Todas</option>
                  </select>
                </div>
                <div id="text_total_consultas">
                  de <b><span id="total_consultas"></span></b> diagnósticos.
                </div>
              </div>
            </div>

            <div class="mb-2 align-middle" style="display: flex;" id="total_consultas_quantidade">
              <div class="me-1" id="text_consultas_quantidade">
                Total de diagnósticos <b><span id="total_consultas_value"></span></b>.
              </div>
            </div>

            <div class="mb-2 align-middle" style="display: flex;" id="total_consultas_busca">
              <div class="me-1" id="text_consultas_quantidade">
                Total de diagnósticos encontrados: <b><span id="total_consultas_busca_value"></span></b>.
              </div>
            </div>

            <table class="table table-hover table-bordered" id="table">
              <thead>
                <tr class="text-center">
                  <th scope="col">Código</th>
                  <th scope="col">Animal</th>
                  <th scope="col">Dono</th>
                  <th scope="col">Veterinário</th>
                  <th scope="col">Data da consulta</th>
                  <th scope="col">Hora da consulta</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody id="diagnosticos">
              </tbody>
            </table>

            <div class="d-flex justify-content-center algin-middle mt-2">
              <p id="aviso">Nenhum diagnóstico encontrado, faça uma nova pesquisa.</p>
            </div>
          </div>
        </div>

        <div id="semConsulta" class="mt-5 bg-white shadow rounded h-25 w-100" style="display: flex; justify-content: center; align-items: center;">
          <div>
            <b class="h3">Diagnóstico animal(a) cadastrado!</b>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarDiagnostico" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
              Editar Diagnóstico
            </h5>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="">
              <div class="row">
                <div class="input-group mb-3 d-none">
                  <span class="input-group-text">Código</span>
                  <input type="text" class="form-control" id="modalCodigoAnimal" disabled />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Nome</span>
                  <input type="text" class="form-control" id="modalNomeAnimal" disabled />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Dono</span>
                  <input type="text" class="form-control" id="modalNomeDono" disabled />
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Data</span>
                    <input type="date" class="form-control" id="dataConsulta" disabled />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Hora</span>
                    <input type="time" class="form-control" id="horaConsulta" disabled />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Peso (Kg)</span>
                    <input type="number" min="0" step=".1" class="form-control" id="peso" />
                  </div>
                </div>

                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Altura (m)</span>
                    <input type="number" min="0" step=".1" class="form-control" id="altura" />
                  </div>
                </div>

                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">BPM</span>
                    <input type="number" min="0" step="1" class="form-control" id="bpm" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Temperatura (°C)</span>
                    <input type="number" min="0" step="0.5" class="form-control" id="temperatura" />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Pressão</span>
                    <input type="text" class="form-control" id="pressao" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-floating">
                  <textarea class="form-control" id="sintomas" style="height: 200px"></textarea>
                  <label for="sintomas">Sintomas</label>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-success" id="updateDiagnostico">
              Confirmar alteração
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Excluir -->
    <div class="modal fade" id="modalExcluirDiagnostico" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <p><b>Ao excluir este animal, você irá excluir todas as consultas dele.</b></p>
                <div class="input-group mb-3 d-none">
                  <span class="input-group-text">Código</span>
                  <input type="text" class="form-control" id="modalExcluirAnimalCodigo" disabled />
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Dono</span>
                    <input type="text" class="form-control" id="modalExcluirAnimalDonoNome" disabled />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="input-group">
                  <span class="input-group-text">Nome</span>
                  <input type="text" class="form-control" id="modalExcluirAnimalNome" disabled />
                </div>
              </div>
              <div class="row"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalExcluirAnimal" id="deleteAnimal">
              Excluir
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Alerta Success -->
    <div class="alert alert-success text-center" id="diagnosticoAlterado" role="alert">
      Diagnóstico alterado com sucesso!
    </div>
    <!-- Alerta Success -->
    <div class="alert alert-warning text-center" id="diagnosticoExcluido" role="alert">
      Diagnóstico excluído com sucesso!
    </div>
    <!-- Alerta Erro -->
    <div class="alert alert-warning text-center" id="diagnosticoErro" role="alert">
      Não foi possível alterar o diagnóstico!
    </div>
    <script src="../../controller/page_load_diagnosticos.js"></script>
</body>

</html>