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
      <div class="container-fluid w-75 mb-3">
        <div id="conteudo">
          <div class="mt-5 shadow p-3 bg-body rounded d-flex justify-content-between" id="content-header">
            <div>
              <a href="../pages/add_animais.php">
                <button class="btn btn-success" type="submit">
                  <i class="me-2 fa-solid fa-dog"></i>
                  Adicionar animal
                </button>
              </a>
            </div>
            <div class="d-flex w-50">
              <input class="form-control me-2" type="search" placeholder="Buscar" id="nome_search" />
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
                <div id="text_total_animais">
                  de <b><span id="total_animais"></span></b> animais.
                </div>
              </div>
            </div>

            <div class="mb-2 align-middle" style="display: flex;" id="total_animais_quantidade">
              <div class="me-1" id="text_animais_quantidade">
                Total de animais <b><span id="total_animais_value"></span></b>.
              </div>
            </div>

            <div class="mb-2 align-middle" style="display: flex;" id="total_animais_busca">
              <div class="me-1" id="text_animais_quantidade">
                Total de animais encontrados: <b><span id="total_animais_busca_value"></span></b>.
              </div>
            </div>

            <table class="table table-hover table-bordered" id="table">
              <thead>
                <tr class="text-center">
                  <th scope="col">Código</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Sexo</th>
                  <th scope="col">Dono</th>
                  <th scope="col">CPF</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody id="animais">
              </tbody>
            </table>

            <div class="d-flex justify-content-center algin-middle mt-2">
              <p id="aviso">Nenhum animal encontrado, faça uma nova pesquisa.</p>
            </div>
          </div>
        </div>

        <div id="semCadastro" class="mt-5 bg-white shadow rounded h-25 w-100" style="display: flex; justify-content: center; align-items: center;">
          <div>
            <b class="h3">Nenhum animal(a) cadastrado!</b>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarAnimal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
              Editar Animal
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
                <div class="input-group mb-3 d-none">
                  <span class="input-group-text">Dono código</span>
                  <input type="text" class="form-control" id="modalCodigoDono" disabled />
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group">
                  <label for="dono">Nome:</label>
                  <input type="text" id="modalNomeAnimal" class="form-control" autocomplete="off" />
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group">
                  <label for="dono">Dono:</label>
                  <input type="text" id="modalNomeDono" class="form-control" autocomplete="off" />
                  <div class="list-group shadow-lg" id="resultado" style="position: absolute; z-index: 1;"></div>
                </div>


              </div>
              <div class="row mb-2">
                <div class="form-group">
                  <label for="nascimento">Nascimento:</label>
                  <input type="date" class="form-control datepicker" id="modalNascimentoAnimal" onkeydown="function block(){return false}" />
                </div>
              </div>

              <div class="row mb-2">
                <div class="form-group">
                  <label for="dropdown_especie">Espécie:</label>
                  <select name="select" class="form-select" id="dropdown_especie">
                    <option selected style="display: none;" value="0">Escolha</option>
                    <option value="1">Canina</option>
                    <option value="2">Felina</option>
                    <option value="3">Réptil</option>
                    <option value="4">Ave</option>
                  </select>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col">
                  <label for="radioSexo">Sexo:</label>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioSexo" id="sexoM" value="M" />
                    <label class="form-check-label" for="sexoM">
                      Macho
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioSexo" id="sexoF" value="F" />
                    <label class="form-check-label" for="sexoF">
                      Fêmea
                    </label>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-success" id="updateAnimal">
              Confirmar alteração
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Excluir -->
    <div class="modal fade" id="modalExcluirAnimal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    <!-- Footer -->
    <!-- <?php include 'componentes/footer.html'; ?> -->
    <!-- Alerta Success -->
    <div class="alert alert-success text-center" id="animalAlterado" role="alert">
      Animal alterado com sucesso!
    </div>
    <!-- Alerta Success -->
    <div class="alert alert-warning text-center" id="animalExcluido" role="alert">
      Animal excluído com sucesso!
    </div>
    <!-- Alerta Erro -->
    <div class="alert alert-warning text-center" id="animalErro" role="alert">
      Não foi possível alterar o animal!
    </div>
    <script src="../../controller/page_load_animais.js"></script>
</body>

</html>