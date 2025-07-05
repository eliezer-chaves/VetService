<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VetService</title>
  <!--Icone da aba -->
  <link rel="shortcut icon" href="view/assets/rabbit.svg" />
  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--CSS-->
  <link rel="stylesheet" href="view/css/header.css" />
  <link rel="stylesheet" href="view/css/assets.css" />
  <link rel="stylesheet" href="view/css/sidebar.css" />
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

  <style>
    #header {
      height: 70px;
    }

    /* Dropdown Button */
    .dropbtn {
      background-color: #0d6efd;
      color: rgb(235, 235, 235);
      padding: 16px;
      font-size: 18px;
      border: none;
      height: 70px;
    }

    .dropbtn:hover {
      font-weight: bold;
      color: white;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #fefefe;
      min-width: max-content;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1111;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
      background-color: #0d6efd;
      color: white;
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
      display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
      font-weight: bold;
    }

    .dropdown-content-item {
      border-bottom: 1px solid #0d6efd;
    }
  </style>
</head>

<body class="">
  <div id="box">
    <!-- Header -->
    <header class="bg-primary shadow">
      <div id="header" class="d-flex justify-content-between align-items-center">
        <div class="brand ms-2">
          <a href="index.php">
            <img src="view/assets/brand.svg" alt="" style="height: 50px" />
          </a>
        </div>

        <div>
          <div class="d-flex justify-content-center">
            <a href="index.php">
              <button class="dropbtn">visão geral</button>
            </a>
            <div class="dropdown">
              <button class="dropbtn">cadastros</button>
              <div class="dropdown-content">
                <a href="view/pages/load_animais.php" class="dropdown-content-item">Animais</a>
                <a href="view/pages/load_donos.php" class="dropdown-content-item">Donos</a>
                <a href="view/pages/load_veterinarios.php" class="dropdown-content-item">Veterinários</a>
                <a href="view/pages/load_especialidades.php">Especialidades</a>
              </div>
            </div>

            <div class="dropdown">
              <button class="dropbtn">consultas</button>
              <div class="dropdown-content">
                <a href="view/pages/calendar.php" class="dropdown-content-item">Ver calendário</a>
                <a href="view/pages/load_consultas.php" class="dropdown-content-item">Consultas a realizar</a>
                <a href="view/pages/load_diagnosticos.php">Consultar diagnósticos</a>
              </div>
            </div>
          </div>
        </div>

        <div class="header-profile me-5">
          <a href="view/pages/configuracoes.php">
            <img src="view/assets/profile.svg" alt="" style="height: 35px; width: 35px" />
          </a>
        </div>
      </div>
    </header>

    <!-- Main -->
    <div class="d-flex" id="main">
      <!-- Content -->
      <div class="container-fluid">
        <div class="d-flex flex-column align-items-center">
          <div class="p-3 bg-light mt-5 shadow p-3 rounded w-75 d-flex justify-content-between" style="height: 200px;">
            <div class=" w-50 h-100">
              <h2>Bem vindo!</h2>
            </div>

            <div class="border-start border-2 d-flex flex-column align-items-center ">
              <div class="ms-3">
                <div class="my-2 ">
                  <h4 class="text-secondary">Adicionar</h4>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                  <div class="card border rounded-4 shadow me-2">
                    <a href="view/pages/calendar.php" class="btn btn-primary d-flex flex-column align-items-center justify-content-center" style="height: 100px;">
                      <i class="fa-2xl fa-solid fa-calendar-days my-4"></i>
                      <span>calendário</span>
                    </a>
                  </div>

                  <div class="card border rounded-4 shadow me-2">
                    <a href="view/pages/add_animais.php" class="btn btn-primary d-flex flex-column align-items-center justify-content-center" style="height: 100px;">
                      <i class="fa-2xl fa-solid fa-paw my-4"></i>
                      <span>animais</span>
                    </a>
                  </div>

                  <div class="card border rounded-4 shadow me-2">
                    <a href="view/pages/add_donos.php" class="btn btn-primary d-flex flex-column align-items-center justify-content-center" style="height: 100px;">
                      <i class="fa-2xl fa-solid fa-person my-4"></i>
                      <span>donos</span>
                    </a>
                  </div>

                  <div class="card border rounded-4 shadow me-2">
                    <a href="view/pages/add_veterinario.php" class="btn btn-primary d-flex flex-column align-items-center justify-content-center" style="height: 100px;">
                      <i class="fa-2xl fa-solid fa-user-doctor my-4"></i>
                      <span>veterinários</span>
                    </a>
                  </div>

                  <div class="card border rounded-4 shadow me-2">
                    <a href="view/pages/add_especialidade.php" class="btn btn-primary d-flex flex-column align-items-center justify-content-center" style="height: 100px;">
                      <i class="fa-2xl fa-solid fa-stethoscope my-4"></i>
                      <span>especialidades</span>
                    </a>
                  </div>
                </div>
              </div>

            </div>

          </div>
          <!-- <div class="p-3 bg-light mt-5 shadow p-3 rounded w-75">
            a
          </div> -->
        </div>

      </div>
    </div>

    <script></script>
</body>

</html>