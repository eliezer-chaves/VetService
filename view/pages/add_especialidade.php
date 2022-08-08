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
  <link rel="stylesheet" href="../css/assets.css" />
  <link rel="stylesheet" href="../css/sidebar.css" />
  <link rel="stylesheet" href="../css/footer.css" />
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
      <div class="container-fluid w-75">
        <div class="bg-light mt-5 shadow p-3 mb-5 bg-body rounded">
          <div class="mb-3">
            <h2 class="text-center title">Adicionar especialidade</h2>
          </div>
          <div class="p-3">
            <div class="row mb-3">
              <div class="input-group ">
                <span class="input-group-text">Nome</span>
                <input type="text" class="form-control" id="input_especialidade"/>
              </div>
            </div>

            <div class="row d-flex justify-content-center mt-4">
              <button type="submit" class="btn btn-primary w-50" id="cadastrar">
                Cadastrar especialidade
              </button>
            </div>

            <!-- Modal Cadastrado -->
            <div id="modalEspecialidadeCadastrada" class="modal fade" role="dialog">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modal-header-cadastrado">Consulta Cadastrada!</h4>
                  </div>
                  <div class="modal-body">
                    <p>Especialidade cadastrada com sucesso:</p>
                    <p>Nome: <b><span id="nomeModal"></span></b></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary " id="btn-especialidade-cadastrado-modal" data-dismiss="modal">Ok</button>
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
                    <p>Especialidade não cadastrada, confira todos os campos.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning " id="btn-aviso-modal" data-dismiss="modal">Ok</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- <?php include 'componentes/footer.html'; ?> -->
    <script src="../../controller/page_add_especialidades.js"></script>

</body>

</html>