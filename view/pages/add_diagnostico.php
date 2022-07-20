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
          <div class="p-3">
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
                  <input type="text" class="form-control" id="codigoDono" disabled />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Animal</span>
                  <input type="text" class="form-control" id="nomeAnimal" disabled />
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
                  <span class="input-group-text">Veterinário</span>
                  <input type="text" class="form-control" id="nomeVeterinario" disabled />
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Código Veterinário</span>
                  <input type="text" class="form-control" id="codigoVeterinario" disabled />
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Código Especialidade</span>
                  <input type="text" class="form-control" id="codigoEspecialidade" disabled />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Consulta Código</span>
                  <input type="texr" class="form-control" id="codigoConsulta" disabled readonly />
                </div>
              </div>
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
                  <span class="input-group-text">Peso (Kg)</span>
                  <input type="number" min="0" step=".1" class="form-control" id="peso" />
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Altura (m)</span>
                  <input type="number" min="0" step=".1" class="form-control" id="altura" />
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">BPM</span>
                  <input type="number" min="0" step="1" class="form-control" id="bpm" />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Temperatura (°C)</span>
                  <input type="number" min="0" step="0.5" class="form-control" id="temperatura" />
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Pressão</span>
                  <input type="text" class="form-control" id="pressao" />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-floating">
                  <textarea class="form-control" id="sintomas" style="height: 200px"></textarea>
                  <label for="sintomas">Sintomas</label>
                </div>
              </div>
            </div>
            <div class="row d-flex justify-content-between mt-4">
              <button class="btn btn-outline-danger w-25" id="limpar">
                Cancelar diagnóstico
              </button>
              <button class="btn btn-primary w-50" id="cadastrar">
                Gerar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Cadastrado -->
  <div id="modalDiagnosticoRealizado" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal-header-cadastrado">Diagnóstico Cadastrado!</h4>
        </div>
        <div class="modal-body">
          <p>Diagnóstico cadastrado com sucesso</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="changeConsultaStatus" data-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    const urlCRUDConsulta = "../../model/crud_consulta.php";
    const urlCRUDDiagnostico = "../../model/crud_diagnostico.php";
    $(document).ready(function() {
      var $pressao = $("#pressao");
      $pressao.mask("00/00", {
        reverse: false,
      });
    });

    var codigoConsulta = getCookie("codigoConsulta");

    if (codigoConsulta == "" || codigoConsulta == null) {
      window.location.href = "../../view/pages/load_consultas.php";
    } else {
      fillFilds(codigoConsulta)
    }

    function fillFilds(codigoConsulta) {
      $.ajax({
        method: "POST",
        url: urlCRUDConsulta,
        data: {
          codigo: codigoConsulta,
          operation: "read_one",
        },
      }).done(function(resposta) {
        console.log(resposta)
        var obj = $.parseJSON(resposta);

        var donoCodigo = obj.DON_CODIGO;
        var donoNome = obj.DON_NOME;
        var animalCodigo = obj.ANI_CODIGO;
        var animalNome = obj.ANI_NOME;

        var veterinarioCodigo = obj.VET_CODIGO;
        var veterinarioNome = obj.VET_NOME;
        var veterinarioEspecialidade = obj.ESP_NOME;
        var veterinarioEspecialidadeCodigo = obj.ESP_CODIGO;

        var consultaCodigo = obj.CON_CODIGO;
        var consultaData = obj.CON_DATA;
        var consultaHora = obj.CON_HORA;
        var hora_consulta_fim = obj.CON_HORA_FIM;

        $("#codigoAnimal").val(animalCodigo)
        $("#codigoDono").val(donoCodigo)
        $("#nomeAnimal").val(animalNome)
        $("#nomeDono").val(donoNome)
        $("#nomeVeterinario").val(veterinarioNome)
        $("#codigoVeterinario").val(veterinarioCodigo)
        $("#codigoEspecialidade").val(veterinarioEspecialidadeCodigo)
        $("#dataConsulta").val(consultaData)
        $("#horaConsulta").val(consultaHora)
        $("#codigoConsulta").val(consultaCodigo)
      });
    }

    $("#cadastrar").click(function() {
      var animalCodigo = $("#codigoAnimal").val()
      var codigoConsulta = $("#codigoConsulta").val()
      var peso = $("#peso").val()
      peso = peso + " Kg"
      var altura = $("#altura").val()
      altura = altura + " m"
      var temperatura = $("#temperatura").val()
      temperatura = temperatura + " °C"
      var bpm = $("#bpm").val()
      bpm = bpm + " bpm"
      var pressao = $("#pressao").val()
      var sintomas = $("#sintomas").val()

      $.ajax({
        method: "POST",
        url: urlCRUDDiagnostico,
        data: {
          codigoConsulta: codigoConsulta,
          animalCodigo: animalCodigo,
          peso: peso,
          altura: altura,
          temperatura: temperatura,
          bpm: bpm,
          pressao: pressao,
          sintomas: sintomas,
          operation: "create",
        },
      }).done(function(resposta) {
        console.log(resposta)
        var obj = $.parseJSON(resposta);
        if (obj.status == "cadastrado") {
          $("#modalDiagnosticoRealizado").modal('show')

        }
        if (obj.status == "incomplete") {
          console.log("incomplete")
        }
      });


    })
    $("#changeConsultaStatus").click(function() {
      $("#modalDiagnosticoRealizado").modal('hide')
      var codigoConsulta = $("#codigoConsulta").val()
      $.ajax({
        method: "POST",
        url: urlCRUDDiagnostico,
        data: {
          codigoConsulta: codigoConsulta,
          operation: "update_consulta",
        },
      }).done(function(resposta) {
        clearFillds()
        setCookie("codigoConsulta", "")
        location.reload()
      });
    })

    $("#limpar").click(function() {
      setCookie("codigoConsulta", "")
      location.reload()
    })

    function clearFillds() {
      $("#codigoAnimal").val("")
      $("#codigoDono").val("")
      $("#nomeAnimal").val("")
      $("#nomeDono").val("")
      $("#nomeVeterinario").val("")
      $("#codigoVeterinario").val("")
      $("#codigoEspecialidade").val("")
      $("#dataConsulta").val("")
      $("#horaConsulta").val("")
      $("#codigoConsulta").val("")
    }

    function setCookie(name, value, duration) {
      var now = new Date();
      var minutes = 30;
      now.setTime(now.getTime() + minutes * 60 * 1000);

      var meuCookie = name + "=" + value + ";";

      document.cookie = meuCookie;
    }

    function getCookie(name) {
      var cookies = document.cookie;
      var prefix = name + "=";
      var begin = cookies.indexOf("; " + prefix);

      if (begin == -1) {
        begin = cookies.indexOf(prefix);
        if (begin != 0) {
          return null;
        }
      } else {
        begin += 2;
      }
      var end = cookies.indexOf(";", begin);
      if (end == -1) {
        end = cookies.length;
      }
      return unescape(cookies.substring(begin + prefix.length, end));
    }
  </script>
</body>

</html>