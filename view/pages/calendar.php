<!DOCTYPE html>
<html lang="PT-br">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VetService</title>
  <!--Icone da aba -->
  <link rel="shortcut icon" href="../assets/rabbit.svg" />
  <!-- FullCalendar -->
  <link href='fullcalendar/lib/main.css' rel='stylesheet' />
  <script src='fullcalendar/lib/main.js'></script>
  <script src='fullcalendar/lib/locales/pt-br.js'></script>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--CSS-->
  <link rel="stylesheet" href="../css/assets.css" />
  <link rel="stylesheet" href="../css/sidebar.css" />
  <link rel="stylesheet" href="../css/footer.css" />
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>


  <style>
    .fc-timegrid {
      cursor: pointer;
    }
    
  </style>
</head>

<body class="">
  <div id="box">
    <!-- Header -->
    <?php include 'componentes/header.html'; ?>
    <!-- Main -->
    <div >
      <!--Content -->
      <div class="container-fluid">
        <div class="bg-white rounded shadow mt-3 mb-5 p-3 h-75">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
    
    <!-- Modal Warning Campos Faltando -->
    <div id="modalAviso" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modal-header-cadastrado">Informe todos os campos!</h4>
          </div>
          <div class="modal-body">
            <p><b>Consulta</b> não cadastrada, confira todos os campos.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning " id="btn-aviso-modal" data-bs-dismiss="modal" data-bs-target="#modalAviso">Ok</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
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
                <div class="input-group mb-3 d-none">
                  <span class="input-group-text">Codigo consulta</span>
                  <input type="text" class="form-control" id="editarConsultaCodigo" disabled />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3 d-none">
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
                <div class="input-group mb-3 d-none">
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

                  <div class="input-group mt-3 d-none">
                    <span class="input-group-text">Código Veterinário:</span>
                    <input id="veterinario_codigo" type="text" class="form-control" disabled />
                  </div>

                  <div class="input-group mt-3">
                    <span class="input-group-text">Especialidade:</span>
                    <input id="veterinario_especialidade" type="text" class="form-control" disabled />
                  </div>

                  <div class="input-group mt-3 d-none">
                    <span class="input-group-text">Codigo Especialidade</span>
                    <input type="text" class="form-control" id="especialidadeCodigo" disabled />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group ">
                    <span class="input-group-text">Data</span>
                    <input type="date" class="form-control" id="editarDataConsulta" />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group ">
                    <span class="input-group-text">Hora</span>
                    <input type="time" class="form-control" id="editarHoraConsulta" step="300"/>
                  </div>
                </div>
                <div class="col">
                  <div class="input-group">
                    <span class="input-group-text" for="hora_consulta">Hora Término</span>
                    <input type="time" class="form-control" id="hora_consulta_fim" />
                  </div>
                </div>

              </div>
            </form>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" id="deleteConsulta">
              Excluir consulta
            </button>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" id="updateConsulta">
              Confirmar alteração
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Add Consulta -->
    <div class="modal fade" id="modalAddConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
              Adicionar consulta
            </h5>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="">
              <div class="row">
                <div class="input-group mb-3 d-none">
                  <span class="input-group-text">Codigo animal</span>
                  <input type="text" class="form-control" id="modalAdd_AnimalCodigo" disabled />
                </div>
              </div>

              <div class="row">
                <div class="form-group mb-3">
                  <label for="dono">Animal:</label>
                  <input type="text" id="modalAddAnimalNome" class="form-control" autocomplete="off" />
                  <div class="list-group shadow-lg" id="resultadoAdd" style="position: absolute; z-index: 1;"></div>
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3 d-none">
                  <span class="input-group-text">Codigo dono</span>
                  <input type="text" class="form-control" id="modalAdd_editarCodigoDono" disabled readonly />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Dono</span>
                  <input type="text" class="form-control" disabled readonly id="modalAdd_NomeDono" />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <label class="input-group-text" for="modalAdd_veterinario_opcao">Veterinário(a)</label>
                  <select class="form-select" id="modalAdd_veterinario_opcao">
                    <option id="modalAdd_veterinario_opcao" selected>Escolha...</option>

                  </select>

                  <div class="input-group mt-3 d-none">
                    <span class="input-group-text">Código Veterinário:</span>
                    <input id="modalAdd_veterinario_codigo" type="text" class="form-control" disabled />
                  </div>

                  <div class="input-group mt-3">
                    <span class="input-group-text">Especialidade:</span>
                    <input id="modadlAdd_veterinario_especialidade" type="text" class="form-control" disabled />
                  </div>

                  <div class="input-group mt-3 d-none">
                    <span class="input-group-text">Codigo Especialidade</span>
                    <input type="text" class="form-control" id="modalAdd_especialidadeCodigo" disabled />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Data</span>
                    <input type="date" class="form-control" id="modalAdd_DataConsulta" />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Hora</span>
                    <input type="time" class="form-control" id="modalAdd_HoraConsulta" />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group">
                    <span class="input-group-text" for="hora_consulta">Hora Término</span>
                    <input type="time" class="form-control" id="modalAdd_hora_consulta_fim" />
                  </div>
                </div>

              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalAddConsulta" id="createConsulta">
              Cadastrar consulta
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Alerta Success -->
    <div class="alert alert-warning text-center" id="consultaExcluido" role="alert">
      Consulta excluída com sucesso!
    </div>

    <!-- Alerta Erro -->
    <div class="alert alert-warning text-center" id="consultaErro" role="alert">
      Não foi possível excluir a consulta!
    </div>

    <script src="../../controller/calendar.js"></script>
</body>

</html>