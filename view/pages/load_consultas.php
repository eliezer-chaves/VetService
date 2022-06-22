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
      <div class="container-fluid w-75">
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
              <input class="form-control me-2" type="search" placeholder="Buscar consulta por animal" id="floatingInput" />
              <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="mt-2 shadow p-3 bg-body rounded">
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
            <tbody>
              <tr>
                <th scope="row" class="text-center align-middle">1</th>
                <td class="text-center align-middle">Apolo</td>
                <td class="text-center align-middle">Eliézer</td>
                <td class="text-center align-middle">14:30</td>
                <td class="text-center align-middle">13 de maio de 2022</td>
                <td class="text-center align-middle">Luis</td>
                <td class="text-center">
                  <a class="btn btn-success" id="gerarDiagnostico" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar diagnóstico" href="../html/add-Diagnostico.html">
                    <i class="fa-solid fa-file-lines"></i>
                  </a>
                  <button class="btn btn-warning" id="editar" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar consulta">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <button class="btn btn-danger" id="excluir" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir consulta">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
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
                  <span class="input-group-text">Animal</span>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Dono</span>
                  <input type="text" class="form-control" disabled readonly />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <label class="input-group-text" for="veterinario_opcao">Veterinário</label>
                  <select class="form-select" id="veterinario_opcao">
                    <option id="veterinario_opcao" selected>
                      Escolha...
                    </option>
                    <option value="1">Luis</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Data</span>
                    <input type="date" class="form-control" id="dataConsulta" />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Hora</span>
                    <input type="time" class="form-control" />
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-success">
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
                    <span class="input-group-text">Dono</span>
                    <input type="text" class="form-control" disabled />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Animal</span>
                  <input type="text" class="form-control" disabled />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Data</span>
                  <input type="text" class="form-control" disabled />
                </div>
              </div>
              <div class="row">
                <div class="input-group">
                  <span class="input-group-text">Veterinário</span>
                  <input type="text" class="form-control" disabled />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalConfirmacao">
              Excluir
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer 
    <?php include 'componentes/footer.html'; ?>
  </div> -->
</body>

</html>