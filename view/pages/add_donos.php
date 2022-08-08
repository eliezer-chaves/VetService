<!DOCTYPE html>
<html lang="PT-br">

<head>

  <meta charset="utf-8">
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
      <div class="container-fluid w-75">
        <div class="">
          <div class="shadow mt-5 p-3 mb-5 bg-body rounded">
            <div class="mt-1">
              <h2 class="text-center title">Adicionar dono</h2>
            </div>
            <div class="p-3">
              <div class="row">
                <div class="col-8">
                  <div class="form-group mb-3">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" class="form-control" required />
                  </div>
                </div>
                <div class="col">
                  <div class="form-group mb-3">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" required />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group mb-3">
                    <label for="cep">CEP:</label>
                    <input type="text" class="form-control" id="cep" required />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-9">
                  <div class="form-group mb-3">
                    <label for="rua">Rua:</label>
                    <input type="text" class="form-control" id="rua" required />
                  </div>
                </div>
                <div class="col">
                  <div class="form-group mb-3">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" id="numero" required />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group mb-3">
                  <label for="complemento">Complemento:</label>
                  <input type="text" class="form-control" id="complemento" />
                </div>
              </div>
              <div class="row">
                <div class="col-5">
                  <div class="form-group mb-3">
                    <label for="bairro">Bairro:</label>
                    <input type="text" class="form-control" id="bairro" required />
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group mb-3">
                    <label for="cidade">Cidade:</label>
                    <input type="text" class="form-control" id="cidade" required />
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group mb-3">
                    <label for="uf">UF:</label>
                    <input type="text" class="form-control" id="uf" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group mb-3">
                  <label for="telefone">Telefone:</label>
                  <input type="text" class="form-control" id="telefone" required />
                </div>
              </div>
              <div class="row d-flex justify-content-center mt-4">
                <button type="submit" id="cadastrar" class="btn btn-primary w-50">
                  Cadastrar dono
                </button>

                <!-- Modal Cadastrado -->
                <div id="modalDonoCadastrado" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="modal-header-cadastrado">Dono(a) Cadastrado!</h4>
                      </div>
                      <div class="modal-body">
                        <p>Dono(a) cadastrado com sucesso: <b><span id="ModalNomeDono"></span></b></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary " id="btn-dono-cadastrado-modal" data-bs-target="#modalDonoCadastrado" data-dismiss="modal">Ok</button>
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
                        <p><b>Dono(a)</b> não cadastrado, confira todos os campos.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning " id="btn-aviso-modal" data-dismiss="modal">Ok</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Warning Dono Já Existe -->
                <div id="modalExists" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="modal-header-cadastrado">Dono(a) já cadastrado!</h4>
                      </div>
                      <div class="modal-body">
                        <p>O CPF <b><span id="donoExists"></b></span>, já está cadastrado.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning " id="btn-ok-modal-exists" data-dismiss="modal">Ok</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div>
      <?php include 'componentes/footer.html'; ?>
    </div> -->

</body>
<script src="../../controller/page_add_donos.js"></script>

</html>