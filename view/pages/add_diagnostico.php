<!DOCTYPE html>
<html lang="pt-br">

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

</head>

<body>
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
        <div class="bg-light mt-5 shadow p-3 mb-5 bg-body rounded">
          <form class="p-3">
            <div class="mb-3">
              <h2 class="text-center title">Gerar diagnóstico</h2>
            </div>
            <div class="row">
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Código Animal</span>
                  <input type="text" class="form-control" id="codigoAnimal" disabled />
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Código Dono</span>
                  <input type="text" class="form-control"  id="codigoDono" disabled />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Animal</span>
                  <input type="text" class="form-control"  id="nomeAnimal" disabled />
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Dono</span>
                  <input type="text" class="form-control" id="nomeDono" disabled />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Data</span>
                  <input type="date" class="form-control" id="dataConsulta" disabled readonly />
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Hora</span>
                  <input type="time" class="form-control" id="horaConsulta" disabled readonly />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Peso</span>
                  <input type="text" class="form-control" id="peso" />
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Altura</span>
                  <input type="text" class="form-control" id="altura" />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Temperatura</span>
                  <input type="text" class="form-control" id="temperatura"/>
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Pressão</span>
                  <input type="text" class="form-control" id="pressao"/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-floating">
                  <textarea class="form-control" id="sintomas" style="height: 200px" ></textarea>
                  <label for="sintomas">Sintomas</label>
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center mt-4">
              <button type="submit" class="btn btn-primary w-50" id="cadastrar">
                Gerar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <script>
  </script>
</body>

</html>