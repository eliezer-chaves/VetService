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
              <a href="../pages/add_donos.php">
                <button class="btn btn-success" type="submit">
                  <i class="me-2 fa-solid fa-person"></i>
                  Adicionar dono
                </button>
              </a>
            </div>
            <div class="d-flex w-50">
              <input class="form-control me-2" type="search" placeholder="Buscar dono" id="nome_search" />
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
                <div id="text_total_donos">
                  de <b><span id="total_donos"></span></b> donos.
                </div>
              </div>
            </div>

            <div class="mb-2 align-middle" style="display: flex;" id="total_donos_quantidade">
              <div class="me-1" id="text_donos_quantidade">
                Total de donos <b><span id="total_donos_value"></span></b>.
              </div>
            </div>

            <div class="mb-2 align-middle" style="display: flex;" id="total_donos_busca">
              <div class="me-1" id="text_donos_quantidade">
                Total de donos encontrados: <b><span id="total_donos_busca_value"></span></b>.
              </div>
            </div>

            <table class="table table-hover table-bordered" id="table">
              <thead>
                <tr class="text-center">
                  <th scope="col">Código</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Animais cadastrados</th>
                  <th scope="col">CPF</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody id="donos">
              </tbody>
            </table>
            
            <div class="d-flex justify-content-center algin-middle mt-2">
              <p id="aviso">Nenhum(a) dono(a) encontrado(a), faça uma nova pesquisa.</p>
            </div>
            
          </div>
        </div>

        <div id="semCadastro" class="mt-5 bg-white shadow rounded h-25 w-100" style="display: flex; justify-content: center; align-items: center;">
          <div>
            <b class="h3">Nenhum dono(a) cadastrado!</b>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarDono" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar dono</h5>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="">
              <div class="row">
                <div class="input-group mb-3 d-none">
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
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Telefone</span>
                  <input type="text" class="form-control" id="telefone" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">CPF</span>
                  <input type="text" class="form-control" id="cpf" />
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">CEP</span>
                    <input type="text" class="form-control" id="cep" />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Número</span>
                    <input type="text" class="form-control" id="numeroCasa" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Logradouro</span>
                  <input type="text" class="form-control" id="rua" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Complemento</span>
                  <input type="text" class="form-control" id="complemento" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Bairro</span>
                  <input type="text" class="form-control" id="bairro" />
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Cidade</span>
                    <input type="text" class="form-control" id="cidade" />
                  </div>
                </div>
                <div class="col-3">
                  <div class="input-group mb-3">
                    <span class="input-group-text">UF</span>
                    <input type="text" class="form-control" id="uf" />
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-success" id="updateDono">
              Confirmar alteração
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Excluir -->
    <div class="modal fade" id="modalExcluirDono" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <div class="input-group mb-3 d-none">
                  <span class="input-group-text">Código</span>
                  <input type="text" class="form-control" id="modalExcluirDonoCodigo" disabled />
                </div>
              </div>
              <div class="row">
                <p><b> Ao excluir esse dono, os animais também serão excluídos.</b></p>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Dono</span>
                    <input type="text" class="form-control" id="modalExcluirDonoNome" disabled />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Telefone</span>
                  <input type="text" class="form-control" id="modalExcluirDonoTelefone" disabled />
                </div>
              </div>
              <div class="row">
                <div class="input-group">
                  <span class="input-group-text">CPF</span>
                  <input type="text" class="form-control" id="modalExcluirDonoCPF" disabled />
                </div>
              </div>
              <div class="row"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" id="modalExcluirDono">
              Excluir
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Alerta Success -->
    <div class="alert alert-success text-center" id="donoAlterado" role="alert">
      Dono(a) alterado(a) com sucesso!
    </div>
    <!-- Alerta Success -->
    <div class="alert alert-warning text-center" id="donoExcluido" role="alert">
      Dono(a) excluído com sucesso!
    </div>
    <!-- Alerta Erro -->
    <div class="alert alert-warning text-center" id="donoErro" role="alert">
      Não foi possível alterar o(a) dono(a)!
    </div>

    <!-- Footer -->
    <!-- <div>
      <?php include 'componentes/footer.html'; ?>
    </div> -->
    <script src="../../controller/page_load_donos.js"></script>
</body>

</html>