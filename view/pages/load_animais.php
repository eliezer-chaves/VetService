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
        <div class="mt-5 shadow p-3 bg-body rounded d-flex justify-content-between">
          <div>
            <a href="../pages/add_animais.php">
                <button class="btn btn-success" type="submit">
                  <i class="me-2 fa-solid fa-dog"></i>
                  Adicionar animal
                </button>
            </a>
          </div>
          <div class="d-flex w-50">
            <input class="form-control me-2" type="search" placeholder="Buscar" id="floatingInput" />
            <button class="btn btn-primary" type="submit">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </div>
        </div>
        <!-- Table -->
        <div class="mt-2 shadow p-3 bg-body rounded">
          <table class="table table-hover table-bordered">
            <thead>
              <tr class="text-center">
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Dono</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row" class="text-center align-middle">1</th>
                <td class="align-middle text-center">Apolo</td>
                <td class="align-middle text-center">Eliézer</td>
                <td class="text-center text-center">
                  <button class="btn btn-warning" id="editar" data-bs-toggle="modal" data-bs-target="#modalEditarAnimal" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar animal">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <button class="btn btn-danger" id="excluir" data-bs-toggle="modal" data-bs-target="#modalExcluirAnimal" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir animal">
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
                <div class="input-group mb-3">
                  <span class="input-group-text">Nome</span>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Dono</span>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Nascimento</span>
                  <input type="date" class="form-control datepicker" id="datanasc" onkeydown="function block(){return false}" />
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadio_macho" />
                    <label class="form-check-label" for="flexRadio_macho">
                      Macho
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadio_femea" />
                    <label class="form-check-label" for="flexRadio_femea">
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
            <button type="button" class="btn btn-success">
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
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Dono</span>
                    <input type="text" class="form-control" disabled />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Nome</span>
                  <input type="text" class="form-control" disabled />
                </div>
              </div>
              <div class="row"></div>
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
    <!-- Footer -->
    <?php include 'componentes/footer.html'; ?>
  </div>
  <script>
    datanasc.max = new Date().toISOString().split("T")[0];
  </script>
</body>

</html>