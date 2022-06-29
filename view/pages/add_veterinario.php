<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Adicionar dono - VetService</title>
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
        <div class="">
          <div class="bg-light mt-5 shadow p-3 mb-5 bg-body rounded">
            <div class="mt-1">
              
              <h2 class="text-center title">Adicionar veterinário</h1>
            </div>
            <div class="p-3">
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Nome</span>
                  <input type="text" class="form-control" id="nome" />
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">CRMV</span>
                    <input type="text" class="form-control" id="crmv" />
                  </div>
                </div>
                <div class="col-6">
                  <div class="input-group mb-3">
                    <label class="input-group-text" for="dropdown_estado">UF</label>
                    <!-- <input type="text" class="form-control" id="uf" /> -->
                    <select name="select" class="form-select" id="dropdown_estado">
                      <option selected style="display: none;" value="0">Escolha</option>
                      <option value="AC">Acre</option>
                      <option value="AL">Alagoas</option>
                      <option value="AP">Amapá</option>
                      <option value="AM">Amazonas</option>
                      <option value="BA">Bahia</option>
                      <option value="CE">Ceará</option>
                      <option value="DF">Distrito Federal</option>
                      <option value="ES">Espírito Santo</option>
                      <option value="GO">Goiás</option>
                      <option value="MA">Maranhão</option>
                      <option value="MT">Mato Grosso</option>
                      <option value="MS">Mato Grosso do Sul</option>
                      <option value="MG">Minas Gerais</option>
                      <option value="PA">Pará</option>
                      <option value="PB">Paraíba</option>
                      <option value="PR">Paraná</option>
                      <option value="PE">Pernambuco</option>
                      <option value="PI">Piauí</option>
                      <option value="RJ">Rio de Janeiro</option>
                      <option value="RN">Rio Grande do Norte</option>
                      <option value="RS">Rio Grande do Sul</option>
                      <option value="RO">Rondônia</option>
                      <option value="RR">Roraima</option>
                      <option value="SC">Santa Catarina</option>
                      <option value="SP">São Paulo</option>
                      <option value="SE">Sergipe</option>
                      <option value="TO">Tocantins</option>
                    </select>

                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <label class="input-group-text" for="dropdown_especie">Especialidade</label>
                    <select name="select" class="form-select" id="dropdown_especialidade">
                      <option selected style="display: none;" value="0">Escolha</option>
                      <option value="1">Clínica e Cirurgia de Pequenos Animais</option>
                      <option value="2">Dermatologia</option>
                      <option value="3">Ortopedia</option>
                      <option value="4">Clínico Geral</option>
                    </select>
                  </div>
                </div>
                <div class="col-6">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Telefone</span>
                    <input type="text" class="form-control" id="telefone" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row d-flex justify-content-center mt-4">
              <button type="submit" class="btn btn-primary w-50" id="cadastrar">
                Cadastrar veterinário
              </button>
              <!-- Modal Cadastrado -->
              <div id="modalVeterinarioCadastrado" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="modal-header-cadastrado">Veterinário Cadastrado!</h4>
                    </div>
                    <div class="modal-body">
                      <p>Veterinário(a) cadastrado com sucesso: <b> <span id="veterinarioNome"></span></b></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary " id="btn-veterinario-cadastrado-modal" data-dismiss="modal">Ok</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Warning -->
              <div id="modalAviso" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="modal-header-cadastrado">Informe todos os campos!</h4>
                    </div>
                    <div class="modal-body">
                      <p>Veterinário(a) não cadastrado, confira todos os campos.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning " id="btn-ok-modal" data-dismiss="modal">Ok</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Warning Dono Já Existe -->
              <div id="modalExists" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="modal-header-cadastrado">Veterinário já cadastrado!</h4>
                    </div>
                    <div class="modal-body">
                      <p>O CRMV <b><span id="CRMVExists"></b></span>, já está cadastrado.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning " id="btn-ok-modal-exists" data-dismiss="modal">Ok</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>
    <!-- Footer -->
    <?php include 'componentes/footer.html'; ?>
  </div>
  <script src="../../controller/page_add_veterinarios.js"></script>
</body>

</html>