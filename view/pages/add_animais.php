<!DOCTYPE html>
<html lang="PT-br">

<head>
  <meta charset="utf-8" />
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
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

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
        <div class="p-3 bg-light mt-5 shadow p-3 mb-5 bg-body rounded ">
          <div class="mb-4">
            <h2 class="text-center title">Adicionar animal</h2>
          </div>
          <div>
            <div class="row mb-3">
              <div class="col">
                <div class="form-group">
                  <label for="nome" class="">Nome:</label>
                  <input id="nome" type="text" class="form-control" />
                </div>
              </div>

            </div>
            <div class="row mb-3">
              <div class="form-group">
                <label for="dono">Dono:</label>
                <input type="text" id="input_dono" class="form-control" autocomplete="off" />
                <div class="list-group shadow-lg" id="resultado" style="position: absolute;   z-index: 1;"></div>
              </div>
            </div>

            <div class="row mb-3">
              <div class="form-group d-none">
                <label for="dono_codigo">Código:</label>
                <input id="dono_codigo" type="text" class="form-control" disabled />
              </div>
              <div class="form-group col">
                <label for="dono_cpf">CPF:</label>
                <input id="dono_cpf" type="text" class="form-control" disabled />
              </div>
              <div class="form-group col">
                <label for="dono_telefone">Telefone:</label>
                <input id="dono_telefone" type="text" class="form-control" disabled />
              </div>
            </div>

            <div class="row mb-3">
              <div class="col">
                <div class="form-group">
                  <label for="datanasc" class="">Nascimento</label>
                  <input type="date" class="form-control datepicker" id="datanasc" onkeydown="function block(){return false}" />
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col">
                <div class="input-group mb-3">
                  <label class="input-group-text" for="dropdown_especie">Espécie</label>
                  <select name="select" class="form-select" id="dropdown_especie">
                    <option selected style="display: none;" value="0">Escolha</option>
                    <option value="1">Canina</option>
                    <option value="2">Felina</option>
                    <option value="3">Réptil</option>
                    <option value="4">Ave</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label for="">Sexo:</label>
                <div class="form-check ">
                  <input class="form-check-input" type="radio" name="radioSexo" value="Macho" id="flexRadio_macho" />
                  <label class="form-check-label" for="flexRadio_macho">
                    Macho
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="radioSexo" value="Fêmea" id="flexRadio_femea" />
                  <label class="form-check-label" for="flexRadio_femea">
                    Fêmea
                  </label>
                </div>
              </div>

            </div>


            <div class="row mt-3 d-flex justify-content-center">
              <button type="submit" id="cadastrar" class="btn btn-primary w-50">
                Cadastrar animal
              </button>
            </div>

          </div>
          <!-- Modal Cadastrado -->
          <div id="modalAnimalCadastrado" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modal-header-cadastrado">Animal Cadastrado!</h4>
                </div>
                <div class="modal-body">
                  <p>Animal cadastrado com sucesso: </p>
                  <p>Nome: <b><span id="animalNome"></span></b></p>
                  <p>Dono: <b><span id="donoNome"></span></b></p>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary " id="btn-animal-cadastrado-modal" data-dismiss="modal">Ok</button>
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
                  <p>Animal não cadastrado, confira todos os campos.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-warning " id="btn-ok-modal" data-dismiss="modal">Ok</button>
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
    <script>
      
    </script>
    <script src="../../controller/add_animais.js"></script>
</body>

</html>