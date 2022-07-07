<!DOCTYPE html>
<html lang="PT-br">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VetService</title>
  <!--Icone da aba -->
  <link rel="shortcut icon" href="../assets/rabbit.svg" />
  <!-- FullCalendar -->
  <link href='fullcalendar/lib/main.css' rel='stylesheet' />
  <script src='fullcalendar/lib/main.js'></script>
  <script src='fullcalendar/lib/locales/pt-br.js'></script>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>


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


  <style>
    .fc-timegrid {
      cursor: pointer;
    }
  </style>
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
        <div class="bg-white rounded shadow-lg mt-3 mb-5 p-3">
          <div id="calendar"></div>

        </div>
      </div>
    </div>
    <script>
      const urlCRUDConsulta = "../../model/crud_consulta.php";
      const urlCRUDVeterinario = "../../model/crud_veterinario.php";

      var calendar

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          locale: 'pt-br',
          themeSystem: 'bootstrap5',
          //expandRows: true,
          //slotMinTime: '08:00',
          //slotMaxTime: '20:00',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek,listMonth'
          },

          initialView: 'dayGridMonth',
          views: {
            listWeek: {
              buttonText: 'Consultas da semana'
            },
            listMonth: {
              buttonText: 'Consultas do mês'
            }
          },
          weekNumbers: true,
          navLinks: true, // can click day/week names to navigate views
          editable: true,
          selectable: true,
          nowIndicator: true,

          dayMaxEvents: true, // allow "more" link when too many events
          events: "../../model/load_calendar.php",

          eventClick: function(info) {
            var codigoConsulta = info.event.id
            var animalCodigo = info.event.extendedProps[0]
            var animal = info.event.extendedProps[1]
            var donoCodigo = info.event.extendedProps[2]
            var dono = info.event.extendedProps[3]
            var veterinarioCodigo = info.event.extendedProps[4]
            var veterinario = info.event.extendedProps[5]
            var especialidadeCodigo = info.event.extendedProps[6]
            var especialidade = info.event.extendedProps[7]
            var data = info.event.extendedProps[8]
            var horaInicio = info.event.extendedProps[9]
            var horaFim = info.event.extendedProps[10]

            fillModal(codigoConsulta, animalCodigo, animal, donoCodigo, dono, veterinarioCodigo, veterinario, especialidadeCodigo, especialidade, data, horaInicio, horaFim)

            $("#modalEditarConsulta").modal('show')
          },

          select: function(info) {
            console.log(info.start.toLocaleString())

          }

        });

        calendar.render();
      });

      function fillModal(codigoConsulta, animalCodigo, animal, donoCodigo, dono, veterinarioCodigo, veterinario, especialidadeCodigo, especialidade, data, horaInicio, horaFim) {
        $("#editarConsultaCodigo").val(codigoConsulta);
        $("#editarAnimalCodigo").val(animalCodigo);
        $("#editarAnimalNome").val(animal);
        $("#editarCodigoDono").val(donoCodigo);
        $("#editarNomeDono").val(dono);
        $("#editarDataConsulta").val(data);
        $("#editarHoraConsulta").val(horaInicio);
        $("#hora_consulta_fim").val(horaFim);
        $("#veterinario_opcao").val(veterinario);
        $("#veterinario_codigo").val(veterinarioCodigo);
        $("#veterinario_especialidade").val(especialidade);
        $("#especialidadeCodigo").val(especialidadeCodigo);
      }

      function clearFillds() {
        $("#editarConsultaCodigo").val("");
        $("#editarAnimalCodigo").val("");
        $("#editarAnimalNome").val("");
        $("#editarCodigoDono").val("");
        $("#editarNomeDono").val("");
        $("#editarDataConsulta").val("");
        $("#editarHoraConsulta").val("");
        $("#hora_consulta_fim").val("");
        $("#veterinario_opcao").val("");
        $("#veterinario_codigo").val("");
        $("#veterinario_especialidade").val("");
        $("#especialidadeCodigo").val("");
      }

      $(document).ready(function() {
        $("#editarAnimalNome").keyup(function() {
          let searchText = $(this).val();
          if (searchText != "") {
            $.ajax({
              url: urlCRUDConsulta,
              method: "POST",
              data: {
                query: searchText,
                operation: "read_animal_fk",
              },
            }).done(function(resposta) {
              var obj = $.parseJSON(resposta);
              var nova_linha = "";
              $("#resultado").html("");

              Object.keys(obj).forEach((item) => {
                nova_linha +=
                  '<button class="list-group-item list-group-item-action " ' +
                  'id="donoTelefone' +
                  obj[item].donoTelefone +
                  "_donoCPF" +
                  obj[item].donoCPF +
                  "_donoCodigo" +
                  obj[item].donoCodigo +
                  "_donoNome" +
                  obj[item].donoNome +
                  "_animalNome" +
                  obj[item].animalNome +
                  "_animalCodigo" +
                  obj[item].animalCodigo +
                  '">' +
                  obj[item].animalNome +
                  " - " +
                  obj[item].donoNome +
                  "</button><span></span>";
              });
              var stringExemplo = nova_linha;
              var resultado = stringExemplo.split("<span></span>");

              $("#resultado").append(resultado);
            });
          } else {
            $("#resultado").html("");
          }
        });

        $(document).on("click", "button", function(element) {
          var id = element.currentTarget.id;

          var array = id.split("_");

          if (id.includes("donoCodigo")) {
            $("#resultado").html("");
            var telefone = array[0].replace("donoTelefone", "");
            var cpf = array[1].replace("donoCPF", "");
            var donoCodigo = array[2].replace("donoCodigo", "");
            var donoNome = array[3].replace("donoNome", "");
            var animalNome = array[4].replace("animalNome", "");
            var animalCodigo = array[5].replace("animalCodigo", "");

            $("#editarAnimalNome").val(animalNome);
            $("#editarAnimalCodigo").val(animalCodigo);
            $("#editarNomeDono").val(donoNome);
            $("#editarCodigoDono").val(donoCodigo);
          }
        });
      });

      $(document).ready(function() {
        $.ajax({
          method: "POST",
          url: urlCRUDVeterinario,
          data: {
            operation: "load_dropdown",
          },
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta);

          novo_item = "";

          Object.keys(obj).forEach((item) => {
            novo_item +=
              '<option value="' +
              obj[item].veterinarioNome +
              '" id="' +
              obj[item].veterinarioCodigo +
              '" name="' +
              obj[item].veterinarioEspecialidade +
              "-" +
              obj[item].veterinarioEspecialidadeCodigo +
              '"><button>' +
              obj[item].veterinarioNome +
              "</button></option>";
          });
          $("#veterinario_opcao").append(novo_item);

          $("#veterinario_opcao").change(function() {
            var value = $("#veterinario_opcao :selected").attr("id");
            var especialidade = $("#veterinario_opcao :selected").attr("name");
            var especialidadeNome = especialidade.split("-")[0];
            var codigo = especialidade.split("-")[1];

            $("#veterinario_codigo").val(value);
            $("#veterinario_especialidade").val(especialidadeNome);
            $("#especialidadeCodigo").val(codigo);
          });
        });
      });

      $(document).on("click", "button", function(element) {
        var id = element.currentTarget.id;

        if (id == "updateConsulta") {
          var codigo = $("#editarConsultaCodigo").val();
          updateConsulta(codigo);
        }
      })

      function updateConsulta() {
        var animalCodigo = $("#editarAnimalCodigo").val();
        var consultaCodigo = $("#editarConsultaCodigo").val();
        var veterinarioCodigo = $("#veterinario_codigo").val();
        var consultaData = $("#editarDataConsulta").val();
        var consultaHora = $("#editarHoraConsulta").val();
        var consultaHoraFim = $("#hora_consulta_fim").val();
        $.ajax({
          method: "POST",
          url: urlCRUDConsulta,
          data: {
            animalCodigo: animalCodigo,
            consultaCodigo: consultaCodigo,
            veterinarioCodigo: veterinarioCodigo,
            consultaData: consultaData,
            consultaHora: consultaHora,
            consultaHoraFim: consultaHoraFim,
            operation: "update",
          },
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta);
          if (obj.status == "alterado") {
            clearFillds();
            $("#modalEditarConsulta").modal("hide");

            //location.reload();


          }
        });
      }
    </script>


    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
              Editar consulta
            </h5>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="">

              <div class="row">
                <div class="input-group mb-3 ">
                  <span class="input-group-text">Codigo consulta</span>
                  <input type="text" class="form-control" id="editarConsultaCodigo" disabled />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3 ">
                  <span class="input-group-text">Codigo animal</span>
                  <input type="text" class="form-control" id="editarAnimalCodigo" disabled />
                </div>
              </div>

              <div class="row">
                <div class="form-group mb-3">
                  <label for="dono">Animal:</label>
                  <input type="text" id="editarAnimalNome" class="form-control" autocomplete="off" />
                  <div class="list-group shadow-lg" id="resultado" style="position: absolute; z-index: 1;"></div>
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3 ">
                  <span class="input-group-text">Codigo dono</span>
                  <input type="text" class="form-control" id="editarCodigoDono" disabled readonly />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Dono</span>
                  <input type="text" class="form-control" disabled readonly id="editarNomeDono" />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <label class="input-group-text" for="veterinario_opcao">Veterinário(a)</label>
                  <select class="form-select" id="veterinario_opcao">
                    <option id="veterinario_opcao" selected>Escolha...</option>

                  </select>

                  <div class="input-group mt-3 ">
                    <span class="input-group-text">Código Veterinário:</span>
                    <input id="veterinario_codigo" type="text" class="form-control" disabled />
                  </div>

                  <div class="input-group mt-3">
                    <span class="input-group-text">Especialidade:</span>
                    <input id="veterinario_especialidade" type="text" class="form-control" disabled />
                  </div>

                  <div class="input-group mt-3 ">
                    <span class="input-group-text">Codigo Especialidade</span>
                    <input type="text" class="form-control" id="especialidadeCodigo" disabled />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Data</span>
                    <input type="date" class="form-control" id="editarDataConsulta" />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Hora</span>
                    <input type="time" class="form-control" id="editarHoraConsulta" />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group">
                    <span class="input-group-text" for="hora_consulta">Hora Término</span>
                    <input type="time" class="form-control" id="hora_consulta_fim" />
                  </div>
                </div>

              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" id="updateConsulta">
              Confirmar alteração
            </button>
          </div>
        </div>
      </div>
    </div>


</body>

</html>