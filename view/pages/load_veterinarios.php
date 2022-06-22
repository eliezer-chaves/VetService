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
        <div class="">
          <div class="mt-5 shadow p-3 bg-body rounded d-flex justify-content-between">
            <div>
              <a href="../pages/add_veterinario.php">
                <button class="btn btn-success" type="submit">
                  <i class="me-2 fa-solid fa-user-doctor"></i>
                  Adicionar veterinário
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
                  <th scope="col">Nome</th>
                  <th scope="col">CRMV</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody id="veterinarios">

              </tbody>
            </table>
            <div class="d-flex justify-content-center algin-middle">
              <p id="aviso">Nenhum veterinário encontrado, faça uma nova pesquisa.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarVeterinario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
              Editar veterinário
            </h5>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="">
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Código</span>
                  <input type="text" class="form-control" id="veterinarioCodigo" disabled />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Nome</span>
                  <input type="text" class="form-control" id="veterinarioNome" />
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">CRMV</span>
                    <input type="text" class="form-control" id="veterinarioCRMV" />
                  </div>
                </div>

                <div class="col-6">
                  <div class="input-group mb-3">
                    <label class="input-group-text" for="dropdown_estado">UF</label>
                    <select name="select" class="form-select" id="dropdown_estado">
                      <option selected style="display: none;" value="0">Escolha</option>
                      <option value="AC">Acre</option>
                      <option value="AL">Alagoas</option>
                      <option value="AP">Amapá</option>
                      <option value="AM">Amazonas</option>
                      <option value="BA">Bahia</option>
                      <option value="CE">Ceará</option>
                      <option value="DF">Distrito Federal</option>
                      <option value="ES">Espírito Santo</option>
                      <option value="GO">Goiás</option>
                      <option value="MA">Maranhão</option>
                      <option value="MT">Mato Grosso</option>
                      <option value="MS">Mato Grosso do Sul</option>
                      <option value="MG">Minas Gerais</option>
                      <option value="PA">Pará</option>
                      <option value="PB">Paraíba</option>
                      <option value="PR">Paraná</option>
                      <option value="PE">Pernambuco</option>
                      <option value="PI">Piauí</option>
                      <option value="RJ">Rio de Janeiro</option>
                      <option value="RN">Rio Grande do Norte</option>
                      <option value="RS">Rio Grande do Sul</option>
                      <option value="RO">Rondônia</option>
                      <option value="RR">Roraima</option>
                      <option value="SC">Santa Catarina</option>
                      <option value="SP">São Paulo</option>
                      <option value="SE">Sergipe</option>
                      <option value="TO">Tocantins</option>
                    </select>

                  </div>
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <label class="input-group-text" for="dropdown_especie">Especialidade</label>
                  <select name="select" class="form-select" id="dropdown_especialidade">
                    <option selected style="display: none;" value="0">Escolha</option>
                    <option value="1">Clínica e Cirurgia de Pequenos Animais</option>
                    <option value="2">Dermatologia</option>
                    <option value="3">Ortopedia</option>
                    <option value="4">Clínico Geral</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Telefone</span>
                  <input type="text" class="form-control" id="veterinarioTelefone" />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalEditarVeterinario" id="updateVeterinario">
              Confirmar alteração
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Excluir -->
    <div class="modal fade" id="modalExcluirVeterinario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <span class="input-group-text">Código</span>
                    <input type="text" class="form-control" id="modalExcluirVeterinarioCodigo" disabled />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Nome</span>
                    <input type="text" class="form-control" id="modalExcluirVeterinarioNome" disabled />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="input-group">
                  <span class="input-group-text">CRMV</span>
                  <input type="text" class="form-control" id="modalExcluirVeterinarioCRMV" disabled />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalExcluirVeterinario" id="deleteVeterinario">
              Excluir
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Alerta Success -->
    <div class="alert alert-success text-center" id="veterinarioAlterado" role="alert">
      Veterinário alterado com sucesso!
    </div>
    <!-- Alerta Success -->
    <div class="alert alert-warning text-center" id="veterinarioExcluido" role="alert">
      Veterinário excluído com sucesso!
    </div>
    <!-- Alerta Erro -->
    <div class="alert alert-warning text-center" id="veterinarioErro" role="alert">
      Não foi possível alterar o Veterinário!
    </div>
    <!-- Footer -->
    <!-- <?php include 'componentes/footer.html'; ?>
  </div> -->
    <script>
      $("#veterinarioAlterado").hide();
      $("#veterinarioErro").hide();
      $("#veterinarioExcluido").hide();
      $("#aviso").hide();

      function showAlertSuccess() {
        $("#veterinarioAlterado").fadeTo(1000, 500).fadeIn(1000, function() {
          $("#veterinarioAlterado").fadeOut(1000);
        });
      }

      function showAlertSuccessDeletado() {
        $("#veterinarioExcluido").fadeTo(1000, 500).fadeIn(1000, function() {
          $("#veterinarioExcluido").fadeOut(1000);
        });
      }

      function showAlertWarning() {
        $("#veterinarioErro").fadeTo(3000, 500).fadeIn(3000, function() {
          $("#veterinarioErro").fadeOut(3000);
        });
      }
      countTable()

      function countTable() {
        $.ajax({
          method: "POST",
          url: "../../model/crud_veterinario.php",
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

      $(document).ready(function() {
        $.ajax({
          method: "POST",
          url: "../../model/crud_veterinario.php",
          data: {
            operation: "load_page"
          }

        }).done(function(resposta) {
          $('#veterinarios').empty();
          var obj = $.parseJSON(resposta)
          var veterinarios = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var veterinario = obj[item]
              veterinarios.push(veterinario)
              quantidade++

              var veterinarioCodigo = obj[item].veterinarioCodigo
              var veterinarioNome = obj[item].veterinarioNome
              var veterinarioCRMV = obj[item].veterinarioCRMV
              var veterinarioCRMVUF = obj[item].veterinarioCRMVUF
              var veterinarioTelefone = obj[item].veterinarioTelefone
              var veterinarioEspecialidade = obj[item].veterinarioEspecialidade

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="veterinarioCodigo' + veterinarioCodigo + '">' + veterinarioCodigo + '</th>' +
                '<td class="align-middle text-center">' + veterinarioNome + '</td>' +
                '<td class="align-middle text-center">' + veterinarioCRMVUF + '</td>' +
                '<td class="align-middle text-center">' + veterinarioTelefone + '</td>' +
                '<td class="text-center text-center">' +
                '<button class="btn btn-warning me-2" id="editar' + veterinarioCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
                '<i class="fa-solid fa-pen-to-square"></i>' +
                '</button>' +
                '<button class="btn btn-danger" id="excluir' + veterinarioCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
                '<i class="fa-solid fa-trash-can"></i>' +
                '</button>' +
                '</td>' +
                '</tr>'

              $('#veterinarios').append(nova_linha);
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
        } else if (id == "updateVeterinario") {
          var codigo = $("#codigo").val()
          updateVeterinario(codigo)
        } else if (id == "deleteVeterinario") {
          var codigo = $("#modalExcluirVeterinarioCodigo").val()
          deleteVeterinario(codigo)
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
            url: "../../model/crud_veterinario.php",
            data: {
              operation: "search",
              nome: nome,
              quantidade: quantidade
            }
          }).done(function(resposta) {
            var obj = $.parseJSON(resposta)
            $('#veterinarios').empty();
            var obj = $.parseJSON(resposta)
            var veterinarios = []
            var quantidade = 0
            if (obj.status != "vazio") {
              Object.keys(obj).forEach((item) => {
                var veterinario = obj[item]
                veterinarios.push(veterinario)
                quantidade++

                var veterinarioCodigo = obj[item].veterinarioCodigo
                var veterinarioNome = obj[item].veterinarioNome
                var veterinarioCRMV = obj[item].veterinarioCRMV
                var veterinarioCRMVUF = obj[item].veterinarioCRMVUF
                var veterinarioTelefone = obj[item].veterinarioTelefone
                var veterinarioEspecialidade = obj[item].veterinarioEspecialidade

                var nova_linha = '';
                var nova_linha =
                  '<tr class="item"> ' +
                  '<th scope="row" class="text-center align-middle" id="veterinarioCodigo' + veterinarioCodigo + '">' + veterinarioCodigo + '</th>' +
                  '<td class="align-middle text-center">' + veterinarioNome + '</td>' +
                  '<td class="align-middle text-center">' + veterinarioCRMVUF + '</td>' +
                  '<td class="align-middle text-center">' + veterinarioTelefone + '</td>' +
                  '<td class="text-center text-center">' +
                  '<button class="btn btn-warning me-2" id="editar' + veterinarioCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
                  '<i class="fa-solid fa-pen-to-square"></i>' +
                  '</button>' +
                  '<button class="btn btn-danger" id="excluir' + veterinarioCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
                  '<i class="fa-solid fa-trash-can"></i>' +
                  '</button>' +
                  '</td>' +
                  '</tr>'

                $('#veterinarios').append(nova_linha);
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
          url: "../../model/crud_veterinario.php",
          data: {
            operation: "search",
            nome: nome,
            quantidade: quantidade
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)
          $('#veterinarios').empty();
          var veterinarios = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var veterinario = obj[item]
              veterinarios.push(veterinario)
              quantidade++

              var veterinarioCodigo = obj[item].veterinarioCodigo
              var veterinarioNome = obj[item].veterinarioNome
              var veterinarioCRMV = obj[item].veterinarioCRMV
              var veterinarioCRMVUF = obj[item].veterinarioCRMVUF
              var veterinarioTelefone = obj[item].veterinarioTelefone
              var veterinarioEspecialidade = obj[item].veterinarioEspecialidade

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="veterinarioCodigo' + veterinarioCodigo + '">' + veterinarioCodigo + '</th>' +
                '<td class="align-middle text-center">' + veterinarioNome + '</td>' +
                '<td class="align-middle text-center">' + veterinarioCRMVUF + '</td>' +
                '<td class="align-middle text-center">' + veterinarioTelefone + '</td>' +
                '<td class="text-center text-center">' +
                '<button class="btn btn-warning me-2" id="editar' + veterinarioCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
                '<i class="fa-solid fa-pen-to-square"></i>' +
                '</button>' +
                '<button class="btn btn-danger" id="excluir' + veterinarioCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
                '<i class="fa-solid fa-trash-can"></i>' +
                '</button>' +
                '</td>' +
                '</tr>'

              $('#veterinarios').append(nova_linha);
            });
          } else {
            $("#table").hide()
            $("#aviso").show()
          }
        })
      })

      var total;
      $('#table_count').on('change', function() {
        var total = this.value;
        $.ajax({
          method: "POST",
          url: "../../model/crud_veterinario.php",
          data: {
            operation: "read_all",
            quantidade: total
          }

        }).done(function(resposta) {
          $('#veterinarios').empty();
          var obj = $.parseJSON(resposta)
          var veterinarios = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var veterinario = obj[item]
              veterinarios.push(veterinario)
              quantidade++

              var veterinarioCodigo = obj[item].veterinarioCodigo
              var veterinarioNome = obj[item].veterinarioNome
              var veterinarioCRMV = obj[item].veterinarioCRMV
              var veterinarioCRMVUF = obj[item].veterinarioCRMVUF
              var veterinarioTelefone = obj[item].veterinarioTelefone
              var veterinarioEspecialidade = obj[item].veterinarioEspecialidade

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="veterinarioCodigo' + veterinarioCodigo + '">' + veterinarioCodigo + '</th>' +
                '<td class="align-middle text-center">' + veterinarioNome + '</td>' +
                '<td class="align-middle text-center">' + veterinarioCRMVUF + '</td>' +
                '<td class="align-middle text-center">' + veterinarioTelefone + '</td>' +
                '<td class="text-center text-center">' +
                '<button class="btn btn-warning me-2" id="editar' + veterinarioCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
                '<i class="fa-solid fa-pen-to-square"></i>' +
                '</button>' +
                '<button class="btn btn-danger" id="excluir' + veterinarioCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
                '<i class="fa-solid fa-trash-can"></i>' +
                '</button>' +
                '</td>' +
                '</tr>'

              $('#veterinarios').append(nova_linha);
            });
          }
        })

      });

      function loadData() {
        quantidade = $("#table_count").val();
        $.ajax({
          method: "POST",
          url: "../../model/crud_veterinario.php",
          data: {
            operation: "load_page",
            quantidade: quantidade
          }

        }).done(function(resposta) {
          countTable()
          $('#veterinarios').empty();
          var obj = $.parseJSON(resposta)
          var veterinarios = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var veterinario = obj[item]
              veterinarios.push(veterinario)
              quantidade++

              var veterinarioCodigo = obj[item].veterinarioCodigo
              var veterinarioNome = obj[item].veterinarioNome
              var veterinarioCRMV = obj[item].veterinarioCRMV
              var veterinarioCRMVUF = obj[item].veterinarioCRMVUF
              var veterinarioTelefone = obj[item].veterinarioTelefone
              var veterinarioEspecialidade = obj[item].veterinarioEspecialidade

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="veterinarioCodigo' + veterinarioCodigo + '">' + veterinarioCodigo + '</th>' +
                '<td class="align-middle text-center">' + veterinarioNome + '</td>' +
                '<td class="align-middle text-center">' + veterinarioCRMVUF + '</td>' +
                '<td class="align-middle text-center">' + veterinarioTelefone + '</td>' +
                '<td class="text-center text-center">' +
                '<button class="btn btn-warning me-2" id="editar' + veterinarioCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
                '<i class="fa-solid fa-pen-to-square"></i>' +
                '</button>' +
                '<button class="btn btn-danger" id="excluir' + veterinarioCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
                '<i class="fa-solid fa-trash-can"></i>' +
                '</button>' +
                '</td>' +
                '</tr>'

              $('#veterinarios').append(nova_linha);
            });

            if (quantidade < 5) {
              $("#total_resultados").hide()
            } else {
              $("#total_resultados").show()
            }
          }
        })
      }

      function updateVeterinario() {
        var veterinarioCodigo = $('#veterinarioCodigo').val()
        var veterinarioNome = $('#veterinarioNome').val()
        var veterinarioCRMV = $('#veterinarioCRMV').val()
        var veterinarioUF = $('#dropdown_estado :selected').val();
        var veterinarioEspecialidade = $("#dropdown_especialidade :selected").text();
        var veterinarioTelefone = $("#veterinarioTelefone").val();
        var veterinarioCRMV_UF = veterinarioCRMV + '-' + veterinarioUF

        $.ajax({
          method: "POST",
          url: "../../model/crud_veterinario.php",
          data: {
            veterinarioCodigo: veterinarioCodigo,
            veterinarioNome: veterinarioNome,
            veterinarioCRMV: veterinarioCRMV,
            veterinarioUF: veterinarioUF,
            veterinarioCRMV_UF: veterinarioCRMV_UF,
            veterinarioEspecialidade: veterinarioEspecialidade,
            veterinarioTelefone: veterinarioTelefone,
            operation: "update"
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)
          if (obj.status == "alterado") {
            clearFillds()
            $("#modalEditarVeterinario").modal('hide')
            loadData()
            showAlertSuccess()
          } else {
            showAlertWarning()
          }
        })
      }

      function deleteVeterinario(codigo) {
        $.ajax({
          method: "POST",
          url: "../../model/crud_veterinario.php",
          data: {
            codigo: codigo,
            operation: "delete"
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)
          if (obj.status == "deletado") {
            clearFillds()
            $("#modalExcluirVeterinario").modal('hide')
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
          url: "../../model/crud_veterinario.php",
          data: {
            codigo: codigo,
            operation: "read_one"
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)
          var veterinarioCodigo = obj.VET_CODIGO
          var veterinarioNome = obj.VET_NOME
          var veterinarioCRMV = obj.VET_CRMV
          var veterinarioTelefone = obj.VET_TELEFONE
          var veterinarioCRMV_UF = obj.VET_CRMV_UF
          var veterinarioEspecialidade = obj.VET_ESPECIALIDADE
          var uf = veterinarioCRMV_UF.split("-")
          var uf = uf[1]

          if (veterinarioEspecialidade == "Clínica e Cirurgia de Pequenos Animais"){
            $("#dropdown_especialidade").val(1);
          } else if (veterinarioEspecialidade == "Dermatologia"){
            $("#dropdown_especialidade").val(2);
          } else if (veterinarioEspecialidade == "Ortopedia"){
            $("#dropdown_especialidade").val(3);
          } else if (veterinarioEspecialidade == "Clínico Geral"){
            $("#dropdown_especialidade").val(4);
          }

          $('#veterinarioCodigo').val(veterinarioCodigo)
          $('#veterinarioNome').val(veterinarioNome)
          $('#veterinarioCRMV').val(veterinarioCRMV)
          $('#dropdown_estado').val(uf);
          $("#veterinarioTelefone").val(veterinarioTelefone);

          $('#modalExcluirVeterinarioCodigo').val(veterinarioCodigo)
          $('#modalExcluirVeterinarioNome').val(veterinarioNome)
          $('#modalExcluirVeterinarioCRMV').val(veterinarioCRMV)
        })
      }

      function clearFillds() {
        $('#veterinarioCodigo').val("")
        $('#veterinarioNome').val("")
        $('#veterinarioCRMV').val("")
        $('#dropdown_estado').val("");
        $("#dropdown_especialidade").val("");
        $("#veterinarioTelefone").val("");

        $('#modalExcluirVeterinarioCodigo').val("")
        $('#modalExcluirVeterinarioNome').val("")
        $('#modalExcluirVeterinarioCRMV').val("")
      }
    </script>
</body>

</html>