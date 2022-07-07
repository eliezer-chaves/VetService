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
      <div class="container-fluid w-75">
        <div class="bg-light mt-5 shadow p-3 mb-5 bg-body rounded" id="content">
          <div class="mb-3">
            <h2 class="text-center title">Adicionar consulta</h2>
          </div>
          <div class="p-3">
            <div class="row mb-3">
              <div class="form-group">
                <label for="animal">Animal:</label>
                <input type="text" id="input_animal" class="form-control" autocomplete="off" />
                <div class="list-group shadow-lg" id="resultado" style="position: absolute;   z-index: 1;"></div>
              </div>
              <div class="input-group mt-3 d-none">
                <span class="input-group-text">Animal Código:</span>
                <input type="text" class="form-control" id="input_animal_codigo" disabled readonly />
              </div>
            </div>

            <div class="row mb-3">
              <div class="input-group ">
                <span class="input-group-text">Dono</span>
                <input type="text" class="form-control" id="input_dono" disabled readonly />
              </div>
            </div>

            <div class="row mb-3">
              <div class="col d-none">
                <div class="input-group ">
                  <span class="input-group-text">Código:</span>
                  <input id="dono_codigo" type="text" class="form-control" disabled />
                </div>
              </div>
              <div class="col">
                <div class="input-group">
                  <span class="input-group-text" for="dono_cpf">CPF:</span>
                  <input id="dono_cpf" type="text" class="form-control" disabled />
                </div>
              </div>
              <div class="col">
                <div class="input-group">
                  <span class="input-group-text" for="dono_telefone">Telefone:</span>
                  <input id="dono_telefone" type="text" class="form-control" disabled />
                </div>
              </div>

            </div>

            <div class="row">
              <div class="form-group mb-3">
                <label for="veterinario_opcao">Veterinário:</label>
                <select class="form-select" id="veterinario_opcao">
                  <option id="veterinario_opcao" selected>Escolha...</option>
                </select>

                <div class="input-group mt-3 ">
                  <span class="input-group-text">Especialidade:</span>
                  <input id="veterinario_especialidade" type="text" class="form-control" disabled />
                </div>

                <div class="input-group mt-3 d-none">
                  <span class="input-group-text">Código Veterinário:</span>
                  <input id="veterinario_codigo" type="text" class="form-control" disabled />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group ">
                  <span for="data_consulta">Data:</span>
                  <input type="date" class="form-control" id="data_consulta" />
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <span for="hora_consulta">Hora:</span>
                  <input type="time" class="form-control" id="hora_consulta" />
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <span for="hora_consulta">Hora Término:</span>
                  <input type="time" class="form-control" id="hora_consulta_fim" />
                </div>
              </div>
            </div>
          </div>

          <div class="row d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary w-50" id="cadastrar">
              Criar consulta
            </button>
          </div>

          <!-- Modal Cadastrado -->
          <div id="modalConsultaCadastrada" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modal-header-cadastrado">Consulta Cadastrada!</h4>
                </div>
                <div class="modal-body">
                  <p>Consulta cadastrada com sucesso:</p>
                  <p>Data: <b><span id="dataModal"></span></b></p>
                  <p>Hora: <b><span id="horaModal"></span></b></p>
                  <p>Animal: <b><span id="animalNomeModal"></span></b></p>
                  <p>Dono: <b><span id="donoNomeModal"></span></b></p>
                  <p>Veterinário: <b><span id="veterinarioModal"></span></b></p>
                  <p>Especialidade: <b><span id="veterinarioEspecialidadeModal"></span></b></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary " id="btn-consulta-cadastrado-modal" data-dismiss="modal">Ok</button>
                </div>
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
                  <button type="button" class="btn btn-warning " id="btn-aviso-modal" data-dismiss="modal">Ok</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-light mt-5 shadow p-3 mb-5 bg-body rounded" id="semAnimal">
        <div class="mt-1">
          <h5 class="text-center">Primeiro cadastre algum animal, para poder adicionar uma consulta.</h5>
        </div>
      </div>
      <div class="bg-light mt-5 shadow p-3 mb-5 bg-body rounded" id="semVeterinario">
        <div class="mt-1">
          <h5 class="text-center">Primeiro cadastre algum veterinário, para poder adicionar uma consulta.</h5>
        </div>
      </div>
    </div>
  </div>
  <!-- <?php include 'componentes/footer.html'; ?> -->
  <script src="../../controller/page_add_consultas.js"></script>

</body>

</html>