<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VetService</title>
  <!--Icone da aba -->
  <link rel="shortcut icon" href="assets/rabbit.svg" />
  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--CSS-->
  <link rel="stylesheet" href="css/header.css" />
  <link rel="stylesheet" href="css/assets.css" />
  <link rel="stylesheet" href="css/sidebar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/main.css" />
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

</head>

<body class="">
  <div id="box">
    <!-- Header -->
    <header class="bg-primary d-flex justify-content-between shadow">
      <div class="brand">
        <img src="assets/brand.svg" alt="" style="height: 30px" />
      </div>
      <div class="">
        <div class="header-profile" style="margin-right: 40px;">
          <a href="assets/profile.svg">
            <img src="assets/profile.svg" alt="" />
          </a>
        </div>
      </div>
    </header>

    <!-- Main -->
    <div class="d-flex" id="main">
      <!-- Sidebar -->
      <div class="bg-white shadow" id="sidebar">
        <div class="accordion accordion-flush" id="accordion">
          <!-- Item do accordion -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="accordion-donos-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-donos">
                <i class="me-2 fa-solid fa-person"></i>Donos
              </button>
            </h2>
            <div id="accordion-donos" class="accordion-collapse collapse">
              <div class="">
                <div class="list-group">
                  <a href="pages/add_donos.php" class="list-group-item list-group-item-action">Adicionar donos</a>
                  <a href="pages/load_donos.php" class="list-group-item list-group-item-action">Listar donos</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Item do accordion -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="accordion-animais-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-animais">
                <i class="me-2 fa-solid fa-dog"></i>Animais
              </button>
            </h2>
            <div id="accordion-animais" class="accordion-collapse collapse">
              <div class="">
                <div class="list-group">
                  <a href="pages/add_animais.php" class="list-group-item list-group-item-action">Adicionar animais</a>
                  <a href="pages/load_animais.php" class="list-group-item list-group-item-action">Listar animais</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Item do accordion -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="accordion-consultas-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-consultas">
                <i class="me-2 fa-solid fa-calendar-days"></i>Consultas
              </button>
            </h2>
            <div id="accordion-consultas" class="accordion-collapse collapse">
              <div class="">
                <div class="list-group">
                  <a href="pages/add_consulta.php" class="list-group-item list-group-item-action" aria-current="true">Adicionar consulta</a>
                  <a href="pages/load_consultas.php" class="list-group-item list-group-item-action">Listar consultas</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Item do accordion -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="accordion-consultas-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-veterinarios">
                <i class="me-2 fa-solid fa-user-doctor"></i>Veterinários
              </button>
            </h2>
            <div id="accordion-veterinarios" class="accordion-collapse collapse">
              <div class="">
                <div class="list-group">
                  <a href="pages/add_veterinario.php" class="list-group-item list-group-item-action" aria-current="true">Adicionar veterinário</a>
                  <a href="pages/load_veterinarios.php" class="list-group-item list-group-item-action">Listar veterinários</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- Content -->
      <div class="container-fluid w-75">

      </div>
    </div>
    <!-- Footer -->
    <footer class="bg-primary shadow" id="footer">

    </footer>
    <script></script>
</body>

</html>