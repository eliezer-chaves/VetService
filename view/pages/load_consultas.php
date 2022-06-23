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
      <!--Content -->
      <div class="container-fluid w-75  mb-5">
        <div class="bg-body shadow mt-5 p-3 bg-body rounded">
          <div class="d-flex justify-content-between">
            <div>
              <a href="../pages/add_consulta.php">
                <button class="btn btn-success" type="submit">
                  <i class="me-2 fa-solid fa-calendar-days"></i>
                  Adicionar consulta
                </button>
              </a>
            </div>
            <div class="d-flex w-50">
              <input class="form-control me-2" type="search" placeholder="Buscar consulta por animal" id="nome_search" />
              <button class="btn btn-primary" type="submit" id="search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="mt-2 shadow p-3 bg-body rounded">
          <div class="d-flex align-midle" id="total_resultados">
            <div class="me-1">
              Mostrando
            </div>
            <div style="width: 70px; " class="me-1">
              <select class="form-select form-select-sm mb-2" name="select" id="table_count" aria-label=".form-select-sm example">
                <option selected value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
              </select>
            </div>
            <div class="me-1">
              de <b><a id="total"></a></b>
            </div>
          </div>
          <table class="table table-hover table-bordered">
            <thead>
              <tr class="text-center">
                <th scope="col">Id</th>
                <th scope="col">Animal</th>
                <th scope="col">Dono</th>
                <th scope="col">Horário</th>
                <th scope="col">Dia</th>
                <th scope="col">Veterinário</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody id="consultas">

            </tbody>
          </table>
          <div class="d-flex justify-content-center algin-middle">
            <p id="aviso">Nenhuma consulta encontrada, faça uma nova pesquisa.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
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
                <div class="input-group mb-3">
                  <span class="input-group-text">Codigo consulta</span>
                  <input type="text" class="form-control" id="editarConsultaCodigo" disabled />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
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
                <div class="input-group mb-3">
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

                  <div class="input-group mt-3">
                    <span class="input-group-text">Código Veterinário:</span>
                    <input id="veterinario_codigo" type="text" class="form-control" disabled />
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
    <!-- Modal Excluir -->
    <div class="modal fade" id="modalExcluirConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="staticBackdropLabel">
              Você tem certeza que deseja excluir?
            </h5>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="">
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Código Consulta</span>
                    <input type="text" class="form-control" disabled id="excluirConsultaCodigo" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Código Dono</span>
                    <input type="text" class="form-control" disabled id="excluirDonoCodigo" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Dono</span>
                    <input type="text" class="form-control" disabled id="excluirDonoNome" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Código animal</span>
                  <input type="text" class="form-control" disabled id="excluirAnimalCodigo" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Animal</span>
                  <input type="text" class="form-control" disabled id="excluirAnimalNome" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Data</span>
                  <input type="text" class="form-control" disabled id="excluirConsultaData" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text ">Código veterinário</span>
                  <input type="text" class="form-control" disabled id="excluirVeterinarioCodigo" />
                </div>
              </div>
              <div class="row">
                <div class="input-group">
                  <span class="input-group-text">Veterinário</span>
                  <input type="text" class="form-control" disabled id="excluirVeterinarioNome" />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" id="deleteConsulta">
              Excluir
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer 
    <?php include 'componentes/footer.html'; ?>
  </div> -->
    <!-- Alerta Success -->
    <div class="alert alert-success text-center" id="consultaAlterado" role="alert">
      Consulta alterada com sucesso!
    </div>
    <!-- Alerta Success -->
    <div class="alert alert-warning text-center" id="consultaExcluido" role="alert">
      Consulta excluída com sucesso!
    </div>
    <!-- Alerta Erro -->
    <div class="alert alert-warning text-center" id="consultaErro" role="alert">
      Não foi possível alterar a consulta!
    </div>
    <script>
      $("#consultaAlterado").hide();
      $("#consultaExcluido").hide();
      $("#consultaErro").hide();
      $("#aviso").hide();

      function showAlertSuccess() {
        $("#consultaAlterado").fadeTo(1000, 500).fadeIn(1000, function() {
          $("#consultaAlterado").fadeOut(1000);
        });
      }

      function showAlertSuccessDeletado() {
        $("#consultaExcluido").fadeTo(1000, 500).fadeIn(1000, function() {
          $("#consultaExcluido").fadeOut(1000);
        });
      }

      function showAlertWarning() {
        $("#consultaErro").fadeTo(3000, 500).fadeIn(3000, function() {
          $("#consultaErro").fadeOut(3000);
        });
      }
      //Load DropDown
      $(document).ready(function() {
        $.ajax({
          method: "POST",
          url: "../../model/crud_veterinario.php",
          data: {
            operation: "load_dropdown"
          }

        }).done(function(resposta) {

          var obj = $.parseJSON(resposta)

          novo_item = ''

          Object.keys(obj).forEach((item) => {
            novo_item += '<option value="' + obj[item].veterinarioNome + '" id="' + obj[item].veterinarioCodigo + '"><button>' + obj[item].veterinarioNome + '</button></option>'
          });
          $('#veterinario_opcao').append(novo_item);

          $("#veterinario_opcao").change(function() {
            var value = $('#veterinario_opcao :selected').attr('id');

            $("#veterinario_codigo").val(value)
          });
        });
      });

      function countTable() {
        $.ajax({
          method: "POST",
          url: "../../model/crud_consulta.php",
          data: {
            operation: "count"
          }
        }).done(function(resposta) {
          if (resposta == 0) {
            $("#content").hide()
          }
          $("#total").html(resposta)
        })
      }

      countTable()

      $(document).ready(function() {
        $.ajax({
          method: "POST",
          url: "../../model/crud_consulta.php",
          data: {
            operation: "load_page"
          }

        }).done(function(resposta) {
          $('#consultas').empty();
          var obj = $.parseJSON(resposta)

          var consultas = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var consulta = obj[item]
              consultas.push(consulta)
              quantidade++
              var donoCodigo = obj[item].donoCodigo
              var donoNome = obj[item].donoNome
              var animalCodigo = obj[item].animalCodigo
              var animalNome = obj[item].animalNome
              var veterinarioCodigo = obj[item].veterinarioCodigo
              var veterinarioNome = obj[item].veterinarioNome
              var consultaCodigo = obj[item].consultaCodigo
              var consultaData = obj[item].consultaData
              var consultaHora = obj[item].consultaHora

              var consultaData = obj[item].consultaData

              var dia = consultaData.split("-")[0];
              var mes = consultaData.split("-")[1];
              var ano = consultaData.split("-")[2];

              consultaData = ("0" + ano).slice(-2) + '/' + ("0" + mes).slice(-2) + '/' + dia;

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="animalCodigo' + consultaCodigo + '">' + consultaCodigo + '</th>' +
                '<td class="align-middle text-center">' + animalNome + '</td>' +
                '<td class="align-middle text-center">' + donoNome + '</td>' +
                '<td class="align-middle text-center">' + consultaHora + '</td>' +
                '<td class="align-middle text-center">' + consultaData + '</td>' +
                '<td class="align-middle text-center">' + veterinarioNome + '</td>' +


                '<td class="text-center text-center">' +
                  '<button class="btn btn-success me-2" id="diagnostico' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar diagnóstico">' +
                    ' <i class="fa-solid fa-file-lines"></i>' +
                  '</button>' +
                  '<button class="btn btn-warning me-2" id="editar' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar consulta">' +
                    '<i class="fa-solid fa-pen-to-square"></i>' +
                  '</button>' +
                  '<button class="btn btn-danger" id="excluir' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir consulta">' +
                    '<i class="fa-solid fa-trash-can"></i>' +
                  '</button>' +
                '</td>' +
                '</tr>'

              $('#consultas').append(nova_linha);
            });

            if (quantidade < 5) {
              $("#total_resultados").hide()
            } else {
              $("#total_resultados").show()
            }
          }
        })
      })

      $(document).on("click", 'button', function(element) {
        var id = element.currentTarget.id;
        if (id.includes("editar")) {
          var codigo = id.replace("editar", "");
          fillFilds(codigo)
        } else if (id.includes("excluir")) {
          var codigo = id.replace("excluir", "");
          fillFilds(codigo)
        } else if (id == "updateConsulta") {
          var codigo = $("#codigo").val()
          updateConsulta(codigo)
        } else if (id == "deleteConsulta") {
          var codigo = $("#excluirConsultaCodigo").val()
          deleteConsulta(codigo)
        }
      })

      $('#nome_search').on('keydown', function(e) {
        if (e.keyCode === 13) {
          var nome = $("#nome_search").val()
          $("#aviso").hide();
          $("#table").show();
          $('#table_count').val('5')
          var quantidade;
          if (nome == "") {
            $("#total_resultados").show()
            quantidade = 5;
          } else {
            $("#total_resultados").hide()
            quantidade = 0;
          }
          $.ajax({
            method: "POST",
            url: "../../model/crud_consulta.php",
            data: {
              operation: "search",
              nome: nome,
              quantidade: quantidade
            }
          }).done(function(resposta) {
            var obj = $.parseJSON(resposta)
            $('#consultas').empty();
            var obj = $.parseJSON(resposta)
            var consultas = []
            var quantidade = 0
            if (obj.status != "vazio") {

              Object.keys(obj).forEach((item) => {
                var consulta = obj[item]
                consultas.push(consulta)
                quantidade++
                var donoCodigo = obj[item].donoCodigo
                var donoNome = obj[item].donoNome
                var animalCodigo = obj[item].animalCodigo
                var animalNome = obj[item].animalNome
                var veterinarioCodigo = obj[item].veterinarioCodigo
                var veterinarioNome = obj[item].veterinarioNome
                var consultaCodigo = obj[item].consultaCodigo
                var consultaData = obj[item].consultaData
                var consultaHora = obj[item].consultaHora

                var consultaData = obj[item].consultaData

                var dia = consultaData.split("-")[0];
                var mes = consultaData.split("-")[1];
                var ano = consultaData.split("-")[2];

                consultaData = ("0" + ano).slice(-2) + '/' + ("0" + mes).slice(-2) + '/' + dia;

                var nova_linha = '';
                var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="animalCodigo' + consultaCodigo + '">' + consultaCodigo + '</th>' +
                '<td class="align-middle text-center">' + animalNome + '</td>' +
                '<td class="align-middle text-center">' + donoNome + '</td>' +
                '<td class="align-middle text-center">' + consultaHora + '</td>' +
                '<td class="align-middle text-center">' + consultaData + '</td>' +
                '<td class="align-middle text-center">' + veterinarioNome + '</td>' +


                '<td class="text-center text-center">' +
                  '<button class="btn btn-success me-2" id="diagnostico' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar diagnóstico">' +
                    ' <i class="fa-solid fa-file-lines"></i>' +
                  '</button>' +
                  '<button class="btn btn-warning me-2" id="editar' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar consulta">' +
                    '<i class="fa-solid fa-pen-to-square"></i>' +
                  '</button>' +
                  '<button class="btn btn-danger" id="excluir' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir consulta">' +
                    '<i class="fa-solid fa-trash-can"></i>' +
                  '</button>' +
                '</td>' +
                '</tr>'

                $('#consultas').append(nova_linha);
              });

            } else {
              $("#table").hide()
              $("#aviso").show()
            }
          })
        }
      })


      $("#search").click(function() {
        var nome = $("#nome_search").val()
        $("#aviso").hide();
        $("#table").show();
        $('#table_count').val('5')
        var quantidade;
        if (nome == "") {
          $("#total_resultados").show()
          quantidade = 5;
        } else {
          $("#total_resultados").hide()
          quantidade = 0;
        }

        $.ajax({
          method: "POST",
          url: "../../model/crud_consulta.php",
          data: {
            operation: "search",
            nome: nome,
            quantidade: quantidade
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)
          $('#consultas').empty();
          var consultas = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var consulta = obj[item]
              consultas.push(consulta)
              quantidade++
              var donoCodigo = obj[item].donoCodigo
              var donoNome = obj[item].donoNome
              var animalCodigo = obj[item].animalCodigo
              var animalNome = obj[item].animalNome
              var veterinarioCodigo = obj[item].veterinarioCodigo
              var veterinarioNome = obj[item].veterinarioNome
              var consultaCodigo = obj[item].consultaCodigo
              var consultaData = obj[item].consultaData
              var consultaHora = obj[item].consultaHora

              var consultaData = obj[item].consultaData

              var dia = consultaData.split("-")[0];
              var mes = consultaData.split("-")[1];
              var ano = consultaData.split("-")[2];

              consultaData = ("0" + ano).slice(-2) + '/' + ("0" + mes).slice(-2) + '/' + dia;

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="animalCodigo' + consultaCodigo + '">' + consultaCodigo + '</th>' +
                '<td class="align-middle text-center">' + animalNome + '</td>' +
                '<td class="align-middle text-center">' + donoNome + '</td>' +
                '<td class="align-middle text-center">' + consultaHora + '</td>' +
                '<td class="align-middle text-center">' + consultaData + '</td>' +
                '<td class="align-middle text-center">' + veterinarioNome + '</td>' +


                '<td class="text-center text-center">' +
                  '<button class="btn btn-success me-2" id="diagnostico' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar diagnóstico">' +
                    ' <i class="fa-solid fa-file-lines"></i>' +
                  '</button>' +
                  '<button class="btn btn-warning me-2" id="editar' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar consulta">' +
                    '<i class="fa-solid fa-pen-to-square"></i>' +
                  '</button>' +
                  '<button class="btn btn-danger" id="excluir' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir consulta">' +
                    '<i class="fa-solid fa-trash-can"></i>' +
                  '</button>' +
                '</td>' +
                '</tr>'

              $('#consultas').append(nova_linha);
            });
          } else {
            $("#table").hide()
            $("#aviso").show()
          }
        })
      })

      //Completar campo de animal

      $(document).ready(function() {
        $("#editarAnimalNome").keyup(function() {
          let searchText = $(this).val();
          if (searchText != "") {
            $.ajax({
              url: "../../model/crud_consulta.php",
              method: "POST",
              data: {
                query: searchText,
                operation: "read_animal_fk"
              }
            }).done(function(resposta) {
              var obj = $.parseJSON(resposta)
              var nova_linha = ""
              $('#resultado').html("");

              Object.keys(obj).forEach((item) => {
                nova_linha += '<button class="list-group-item list-group-item-action " ' +
                  'id="donoTelefone' + obj[item].donoTelefone +
                  '_donoCPF' + obj[item].donoCPF +
                  '_donoCodigo' + obj[item].donoCodigo +
                  '_donoNome' + obj[item].donoNome +
                  '_animalNome' + obj[item].animalNome +
                  '_animalCodigo' + obj[item].animalCodigo +
                  '">' + obj[item].animalNome + ' - ' + obj[item].donoNome +
                  '</button><span></span>'
              });
              var stringExemplo = nova_linha;
              var resultado = stringExemplo.split("<span></span>");

              $('#resultado').append(resultado);

            });
          } else {
            $('#resultado').html("");
          }

        });

        $(document).on("click", "button", function(element) {
          var id = element.currentTarget.id

          var array = id.split("_")

          if (id.includes("donoCodigo")) {
            $('#resultado').html("");
            var telefone = array[0].replace("donoTelefone", "");
            var cpf = array[1].replace("donoCPF", "");
            var donoCodigo = array[2].replace("donoCodigo", "");
            var donoNome = array[3].replace("donoNome", "");
            var animalNome = array[4].replace("animalNome", "");
            var animalCodigo = array[5].replace("animalCodigo", "");

            $("#editarAnimalNome").val(animalNome)
            $("#editarAnimalCodigo").val(animalCodigo)
            $("#editarNomeDono").val(donoNome)
            $("#editarCodigoDono").val(donoCodigo)
          }
        });
      });

      //Auto complete

      var total;
      $('#table_count').on('change', function() {
        var total = this.value;
        $.ajax({
          method: "POST",
          url: "../../model/crud_consulta.php",
          data: {
            operation: "read_all",
            quantidade: total
          }

        }).done(function(resposta) {
          $('#consultas').empty();
          var obj = $.parseJSON(resposta)
          var consultas = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var consulta = obj[item]
              consultas.push(consulta)
              quantidade++
              var donoCodigo = obj[item].donoCodigo
              var donoNome = obj[item].donoNome
              var animalCodigo = obj[item].animalCodigo
              var animalNome = obj[item].animalNome
              var veterinarioCodigo = obj[item].veterinarioCodigo
              var veterinarioNome = obj[item].veterinarioNome
              var consultaCodigo = obj[item].consultaCodigo
              var consultaData = obj[item].consultaData
              var consultaHora = obj[item].consultaHora

              var consultaData = obj[item].consultaData

              var dia = consultaData.split("-")[0];
              var mes = consultaData.split("-")[1];
              var ano = consultaData.split("-")[2];

              consultaData = ("0" + ano).slice(-2) + '/' + ("0" + mes).slice(-2) + '/' + dia;

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="animalCodigo' + consultaCodigo + '">' + consultaCodigo + '</th>' +
                '<td class="align-middle text-center">' + animalNome + '</td>' +
                '<td class="align-middle text-center">' + donoNome + '</td>' +
                '<td class="align-middle text-center">' + consultaHora + '</td>' +
                '<td class="align-middle text-center">' + consultaData + '</td>' +
                '<td class="align-middle text-center">' + veterinarioNome + '</td>' +


                '<td class="text-center text-center">' +
                  '<button class="btn btn-success me-2" id="diagnostico' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar diagnóstico">' +
                    ' <i class="fa-solid fa-file-lines"></i>' +
                  '</button>' +
                  '<button class="btn btn-warning me-2" id="editar' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar consulta">' +
                    '<i class="fa-solid fa-pen-to-square"></i>' +
                  '</button>' +
                  '<button class="btn btn-danger" id="excluir' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir consulta">' +
                    '<i class="fa-solid fa-trash-can"></i>' +
                  '</button>' +
                '</td>' +
                '</tr>'

              $('#consultas').append(nova_linha);
            });
          }
        })

      });

      function loadData() {
        quantidade = $("#table_count").val();
        $.ajax({
          method: "POST",
          url: "../../model/crud_consulta.php",
          data: {
            operation: "load_page",
            quantidade: quantidade
          }

        }).done(function(resposta) {
          countTable()
          $('#consultas').empty();
          var obj = $.parseJSON(resposta)
          var consultas = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var consulta = obj[item]
              consultas.push(consulta)
              quantidade++
              var donoCodigo = obj[item].donoCodigo
              var donoNome = obj[item].donoNome
              var animalCodigo = obj[item].animalCodigo
              var animalNome = obj[item].animalNome
              var veterinarioCodigo = obj[item].veterinarioCodigo
              var veterinarioNome = obj[item].veterinarioNome
              var consultaCodigo = obj[item].consultaCodigo
              var consultaData = obj[item].consultaData
              var consultaHora = obj[item].consultaHora

              var consultaData = obj[item].consultaData

              var dia = consultaData.split("-")[0];
              var mes = consultaData.split("-")[1];
              var ano = consultaData.split("-")[2];

              consultaData = ("0" + ano).slice(-2) + '/' + ("0" + mes).slice(-2) + '/' + dia;

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="animalCodigo' + consultaCodigo + '">' + consultaCodigo + '</th>' +
                '<td class="align-middle text-center">' + animalNome + '</td>' +
                '<td class="align-middle text-center">' + donoNome + '</td>' +
                '<td class="align-middle text-center">' + consultaHora + '</td>' +
                '<td class="align-middle text-center">' + consultaData + '</td>' +
                '<td class="align-middle text-center">' + veterinarioNome + '</td>' +


                '<td class="text-center text-center">' +
                  '<button class="btn btn-success me-2" id="diagnostico' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar diagnóstico">' +
                    ' <i class="fa-solid fa-file-lines"></i>' +
                  '</button>' +
                  '<button class="btn btn-warning me-2" id="editar' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar consulta">' +
                    '<i class="fa-solid fa-pen-to-square"></i>' +
                  '</button>' +
                  '<button class="btn btn-danger" id="excluir' + consultaCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir consulta">' +
                    '<i class="fa-solid fa-trash-can"></i>' +
                  '</button>' +
                '</td>' +
                '</tr>'

              $('#consultas').append(nova_linha);
            });

            if (quantidade < 5) {
              $("#total_resultados").hide()
            } else {
              $("#total_resultados").show()
            }
          }
        })
      }

      function updateConsulta() {
        var animalCodigo = $('#editarAnimalCodigo').val()
        var consultaCodigo = $("#editarConsultaCodigo").val()
        var veterinarioCodigo = $("#veterinario_codigo").val()
        var consultaData = $('#editarDataConsulta').val()
        var consultaHora = $('#editarHoraConsulta').val()

        $.ajax({
          method: "POST",
          url: "../../model/crud_consulta.php",
          data: {
            animalCodigo: animalCodigo,
            consultaCodigo: consultaCodigo,
            veterinarioCodigo: veterinarioCodigo,
            consultaData: consultaData,
            consultaHora: consultaHora,
            operation: "update"
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)
          if (obj.status == "alterado") {
            clearFillds()
            $("#modalEditarConsulta").modal('hide')
            loadData()
            showAlertSuccess()
          } else {
            showAlertWarning()
          }
        })
      }

      function deleteConsulta(codigo) {
        $.ajax({
          method: "POST",
          url: "../../model/crud_consulta.php",
          data: {
            codigo: codigo,
            operation: "delete"
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)
          if (obj.status == "deletado") {
            clearFillds()
            $("#modalExcluirConsulta").modal('hide')
            loadData()
            showAlertSuccessDeletado()
          } else {
            showAlertWarning()
          }
        })
      }

      function fillFilds(codigo) {
        clearFillds()
        $.ajax({
          method: "POST",
          url: "../../model/crud_consulta.php",
          data: {
            codigo: codigo,
            operation: "read_one"
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)
          var donoCodigo = obj.DON_CODIGO
          var donoNome = obj.DON_NOME
          var animalCodigo = obj.ANI_CODIGO
          var animalNome = obj.ANI_NOME

          var veterinarioCodigo = obj.VET_CODIGO
          var veterinarioNome = obj.VET_NOME

          var consultaCodigo = obj.CON_CODIGO
          var consultaData = obj.CON_DATA
          var consultaHora = obj.CON_HORA

          //Modal Editar
          $("#editarConsultaCodigo").val(consultaCodigo)
          $("#editarAnimalCodigo").val(animalCodigo)
          $('#editarAnimalNome').val(animalNome)
          $('#editarCodigoDono').val(donoCodigo)
          $('#editarNomeDono').val(donoNome)
          $('#editarDataConsulta').val(consultaData)
          $('#editarHoraConsulta').val(consultaHora)
          $('#veterinario_opcao').val(veterinarioNome)
          $('#veterinario_codigo').val(veterinarioCodigo)

          var dia = consultaData.split("-")[0];
          var mes = consultaData.split("-")[1];
          var ano = consultaData.split("-")[2];

          consultaData = ("0" + ano).slice(-2) + '/' + ("0" + mes).slice(-2) + '/' + dia;

          //Modal Excluir
          $("#excluirConsultaCodigo").val(consultaCodigo)
          $("#excluirAnimalCodigo").val(animalCodigo)
          $('#excluirAnimalNome').val(animalNome)
          $('#excluirDonoCodigo').val(donoCodigo)
          $('#excluirDonoNome').val(donoNome)
          $('#excluirConsultaData').val(consultaData)
          $('#editarHoraConsulta').val(consultaHora)
          $('#excluirVeterinarioNome').val(veterinarioNome)
          $('#excluirVeterinarioCodigo').val(veterinarioCodigo)
        })
      }

      function clearFillds() {
        //Modal Editar
        $("#editarConsultaCodigo").val("")
        $("#editarAnimalCodigo").val("")
        $('#editarAnimalNome').val("")
        $('#editarCodigoDono').val("")
        $('#editarNomeDono').val("")
        $('#editarDataConsulta').val("")
        $('#editarHoraConsulta').val("")
        $('#veterinario_opcao').val("")
        $('#veterinario_codigo').val("")

        //Modal Excluir
        $("#excluirConsultaCodigo").val("")
        $("#excluirAnimalCodigo").val("")
        $('#excluirAnimalNome').val("")
        $('#excluirDonoCodigo').val("")
        $('#excluirDonoNome').val("")
        $('#excluirConsultaData').val("")
        $('#editarHoraConsulta').val("")
        $('#excluirVeterinarioNome').val("")
        $('#excluirVeterinarioCodigo').val("")
      }
    </script>
</body>


</html>