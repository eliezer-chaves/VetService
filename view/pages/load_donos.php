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
      <div class="container-fluid w-75 mb-3">
        <div class="mt-5 shadow p-3 bg-body rounded d-flex justify-content-between">
          <div>
            <a href="../pages/add_donos.php">
              <button class="btn btn-success" type="submit">
                <i class="me-2 fa-solid fa-person"></i>
                Adicionar dono
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
          <div style="display: flex;" id="total_resultados">
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
              de <b> <a id="total"></a></b>
            </div>
          </div>
          <table class="table table-hover table-bordered" id="table">
            <thead>
              <tr class="text-center">
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Telefone</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody id="donos">
            </tbody>
          </table>
          <div class="d-flex justify-content-center algin-middle">
            <p id="aviso">Nenhum dono encontrado, faça uma nova pesquisa.</p>
          </div>

        </div>
      </div>
    </div>
    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarDono" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar dono</h5>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="">
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Código</span>
                  <input type="text" class="form-control" id="codigo" disabled />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Nome</span>
                  <input type="text" class="form-control" id="modalNome" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Telefone</span>
                  <input type="text" class="form-control" id="telefone" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">CPF</span>
                  <input type="text" class="form-control" id="cpf" />
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">CEP</span>
                    <input type="text" class="form-control" id="cep" />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Número</span>
                    <input type="text" class="form-control" id="numeroCasa" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Logradouro</span>
                  <input type="text" class="form-control" id="rua" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Complemento</span>
                  <input type="text" class="form-control" id="complemento" />
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Bairro</span>
                  <input type="text" class="form-control" id="bairro" />
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Cidade</span>
                    <input type="text" class="form-control" id="cidade" />
                  </div>
                </div>
                <div class="col-3">
                  <div class="input-group mb-3">
                    <span class="input-group-text">UF</span>
                    <input type="text" class="form-control" id="uf" />
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-success" id="updateDono">
              Confirmar alteração
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Alerta Success -->
    <div class="alert alert-success text-center" id="donoAlterado" role="alert">
      Dono alterado com sucesso!
    </div>
    <!-- Alerta Success -->
    <div class="alert alert-warning text-center" id="donoExcluido" role="alert">
      Dono excluído com sucesso!
    </div>
    <!-- Alerta Erro -->
    <div class="alert alert-warning text-center" id="donoErro" role="alert">
      Não foi possível alterar o dono!
    </div>
    <!-- Modal Excluir -->
    <div class="modal fade" id="modalExcluirDono" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <div class="input-group mb-3">
                  <span class="input-group-text">Código</span>
                  <input type="text" class="form-control" id="modalExcluirDonoCodigo" disabled />
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Dono</span>
                    <input type="text" class="form-control" id="modalExcluirDonoNome" disabled />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Telefone</span>
                  <input type="text" class="form-control" id="modalExcluirDonoTelefone" disabled />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">CPF</span>
                  <input type="text" class="form-control" id="modalExcluirDonoCPF" disabled />
                </div>
              </div>
              <div class="row"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
              Fechar
            </button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" id="modalExcluirDono">
              Excluir
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <!-- <div>
      <?php include 'componentes/footer.html'; ?>
    </div> -->
    <script>
      $("#donoAlterado").hide();
      $("#donoErro").hide();
      $("#donoExcluido").hide();
      $("#aviso").hide();

      function showAlertSuccess() {
        $("#donoAlterado").fadeTo(1000, 500).fadeIn(1000, function() {
          $("#donoAlterado").fadeOut(1000);
        });
      }

      function showAlertSuccessDeletado() {
        $("#donoExcluido").fadeTo(1000, 500).fadeIn(1000, function() {
          $("#donoExcluido").fadeOut(1000);
        });
      }

      function showAlertWarning() {
        $("#donoErro").fadeTo(3000, 500).fadeIn(3000, function() {
          $("#donoErro").fadeOut(3000);
        });
      }

      var total;
      $('#table_count').on('change', function() {
        var total = this.value;
        $.ajax({
          method: "POST",
          url: "../../model/crud_dono.php",
          data: {
            operation: "read_all",
            quantidade: total
          }

        }).done(function(resposta) {
          $('#donos').empty();
          var obj = $.parseJSON(resposta)
          var donos = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var dono = obj[item]

              donos.push(dono)
              quantidade++
              var donoCodigo = obj[item].donoCodigo
              var donoNome = obj[item].donoNome
              var donoCPF = obj[item].donoCPF
              var donoTelefone = obj[item].donoTelefone

              if (donoTelefone == "") {
                donoTelefone = "Não informado"
              }

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="donoCodigo' + donoCodigo + '">' + donoCodigo + '</th>' +
                '<td class="align-middle text-center">' + donoNome + '</td>' +
                '<td class="align-middle text-center">' + donoCPF + '</td>' +
                '<td class="align-middle text-center">' + donoTelefone + '</td>' +
                '<td class="text-center text-center">' +
                '<button class="btn btn-warning me-2" id="editar' + donoCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
                '<i class="fa-solid fa-pen-to-square"></i>' +
                '</button>' +
                '<button class="btn btn-danger" id="excluir' + donoCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
                '<i class="fa-solid fa-trash-can"></i>' +
                '</button>' +
                '</td>' +
                '</tr>'

              $('#donos').append(nova_linha);
            });
          }
        })

      });


      function countTable() {
        $.ajax({
          method: "POST",
          url: "../../model/crud_dono.php",
          data: {
            operation: "count"
          }
        }).done(function(resposta) {
          $("#total").html(resposta)
        })
      }

      countTable()

      $(document).ready(function() {
        $.ajax({
          method: "POST",
          url: "../../model/crud_dono.php",
          data: {
            operation: "load_page"
          }

        }).done(function(resposta) {
          $('#donos').empty();
          var obj = $.parseJSON(resposta)
          var donos = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var dono = obj[item]
              donos.push(dono)
              quantidade++
              var donoCodigo = obj[item].donoCodigo
              var donoNome = obj[item].donoNome
              var donoCPF = obj[item].donoCPF
              var donoTelefone = obj[item].donoTelefone

              if (donoTelefone == "") {
                donoTelefone = "Não informado"
              }

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="donoCodigo' + donoCodigo + '">' + donoCodigo + '</th>' +
                '<td class="align-middle text-center">' + donoNome + '</td>' +
                '<td class="align-middle text-center">' + donoCPF + '</td>' +
                '<td class="align-middle text-center">' + donoTelefone + '</td>' +
                '<td class="text-center text-center">' +
                '<button class="btn btn-warning me-2" id="editar' + donoCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
                '<i class="fa-solid fa-pen-to-square"></i>' +
                '</button>' +
                '<button class="btn btn-danger" id="excluir' + donoCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
                '<i class="fa-solid fa-trash-can"></i>' +
                '</button>' +
                '</td>' +
                '</tr>'

              $('#donos').append(nova_linha);
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
        } else if (id == "updateDono") {
          var codigo = $("#codigo").val()
          updateDono(codigo)
        } else if (id == "modalExcluirDono") {
          var codigo = $("#modalExcluirDonoCodigo").val()
          deleteDono(codigo)
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
          url: "../../model/crud_dono.php",
          data: {
            operation: "search",
            nome: nome,
            quantidade: quantidade
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)

          $('#donos').empty();
          var obj = $.parseJSON(resposta)
          var donos = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var dono = obj[item]
              donos.push(dono)
              quantidade++
              var donoCodigo = obj[item].donoCodigo
              var donoNome = obj[item].donoNome
              var donoCPF = obj[item].donoCPF
              var donoTelefone = obj[item].donoTelefone

              if (donoTelefone == "") {
                donoTelefone = "Não informado"
              }

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="donoCodigo' + donoCodigo + '">' + donoCodigo + '</th>' +
                '<td class="align-middle text-center">' + donoNome + '</td>' +
                '<td class="align-middle text-center">' + donoCPF + '</td>' +
                '<td class="align-middle text-center">' + donoTelefone + '</td>' +
                '<td class="text-center text-center">' +
                '<button class="btn btn-warning me-2" id="editar' + donoCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
                '<i class="fa-solid fa-pen-to-square"></i>' +
                '</button>' +
                '<button class="btn btn-danger" id="excluir' + donoCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
                '<i class="fa-solid fa-trash-can"></i>' +
                '</button>' +
                '</td>' +
                '</tr>'

              $('#donos').append(nova_linha);
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
          url: "../../model/crud_dono.php",
          data: {
            operation: "search",
            nome: nome,
            quantidade: quantidade
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)

          $('#donos').empty();
          var obj = $.parseJSON(resposta)
          var donos = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var dono = obj[item]
              donos.push(dono)
              quantidade++
              var donoCodigo = obj[item].donoCodigo
              var donoNome = obj[item].donoNome
              var donoCPF = obj[item].donoCPF
              var donoTelefone = obj[item].donoTelefone

              if (donoTelefone == "") {
                donoTelefone = "Não informado"
              }

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="donoCodigo' + donoCodigo + '">' + donoCodigo + '</th>' +
                '<td class="align-middle text-center">' + donoNome + '</td>' +
                '<td class="align-middle text-center">' + donoCPF + '</td>' +
                '<td class="align-middle text-center">' + donoTelefone + '</td>' +
                '<td class="text-center text-center">' +
                '<button class="btn btn-warning me-2" id="editar' + donoCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
                '<i class="fa-solid fa-pen-to-square"></i>' +
                '</button>' +
                '<button class="btn btn-danger" id="excluir' + donoCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
                '<i class="fa-solid fa-trash-can"></i>' +
                '</button>' +
                '</td>' +
                '</tr>'

              $('#donos').append(nova_linha);
            });


          } else {
            $("#table").hide()
            $("#aviso").show()
          }

        })
      })

      function loadData() {
        quantidade = $("#table_count").val();
        $.ajax({
          method: "POST",
          url: "../../model/crud_dono.php",
          data: {
            operation: "load_page",
            quantidade: quantidade
          }

        }).done(function(resposta) {
          countTable()
          $('#donos').empty();

          var obj = $.parseJSON(resposta)

          var donos = []
          var quantidade = 0
          if (obj.status != "vazio") {
            Object.keys(obj).forEach((item) => {
              var dono = obj[item]
              donos.push(dono)
              quantidade++
              var donoCodigo = obj[item].donoCodigo
              var donoNome = obj[item].donoNome
              var donoCPF = obj[item].donoCPF
              var donoTelefone = obj[item].donoTelefone

              if (donoTelefone == "") {
                donoTelefone = "Não informado"
              }

              var nova_linha = '';
              var nova_linha =
                '<tr class="item"> ' +
                '<th scope="row" class="text-center align-middle" id="donoCodigo' + donoCodigo + '">' + donoCodigo + '</th>' +
                '<td class="align-middle text-center">' + donoNome + '</td>' +
                '<td class="align-middle text-center">' + donoCPF + '</td>' +
                '<td class="align-middle text-center">' + donoTelefone + '</td>' +
                '<td class="text-center text-center">' +
                '<button class="btn btn-warning me-2" id="editar' + donoCodigo + '" data-bs-toggle="modal" data-bs-target="#modalEditarDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
                '<i class="fa-solid fa-pen-to-square"></i>' +
                '</button>' +
                '<button class="btn btn-danger" id="excluir' + donoCodigo + '" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
                '<i class="fa-solid fa-trash-can"></i>' +
                '</button>' +
                '</td>' +
                '</tr>'

              $('#donos').append(nova_linha);
            });

            if (quantidade < 5) {
              $("#total_resultados").hide()
            } else {
              $("#total_resultados").show()
            }
          }
        })
      }

      function updateDono() {
        var donoCodigo = $('#codigo').val()
        var donoNome = $('#modalNome').val()
        var donoCEP = $('#cep').val()
        var donoCPF = $('#cpf').val()
        var donoRua = $('#rua').val()
        var donoNumCasa = $('#numeroCasa').val()
        var donoComplemento = $('#complemento').val()
        var donoBairro = $('#bairro').val()
        var donoCidade = $('#cidade').val()
        var donoUF = $('#uf').val()
        var donoTelefone = $('#telefone').val()
        $.ajax({
          method: "POST",
          url: "../../model/crud_dono.php",
          data: {
            codigo: donoCodigo,
            donoNome: donoNome,
            donoCPF: donoCPF,
            donoCEP: donoCEP,
            donoRua: donoRua,
            donoNumCasa: donoNumCasa,
            donoComplemento: donoComplemento,
            donoBairro: donoBairro,
            donoCidade: donoCidade,
            donoUF: donoUF,
            donoTelefone: donoTelefone,
            operation: "update"
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)
          if (obj.status == "alterado") {
            clearFillds()
            $("#modalEditarDono").modal('hide')
            loadData()
            showAlertSuccess()
          } else {
            showAlertWarning()
          }
        })
      }

      function deleteDono(codigo) {

        $.ajax({
          method: "POST",
          url: "../../model/crud_dono.php",
          data: {
            codigo: codigo,
            operation: "delete"
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)

          if (obj.status == "deletado") {
            clearFillds()
            $("#modalExcluirDono").modal('hide')
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
          url: "../../model/crud_dono.php",
          data: {
            codigo: codigo,
            operation: "read_one"
          }
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta)
          var donoCodigo = obj.DON_CODIGO
          var donoNome = obj.DON_NOME
          var donoCPF = obj.DON_CPF
          var donoCEP = obj.DON_CEP
          var donoRua = obj.DON_RUA
          var donoNumCasa = obj.DON_NUMCASA
          var donoComplemento = obj.DON_COMPLEMENTO
          var donoBairro = obj.DON_BAIRRO
          var donoCidade = obj.DON_CIDADE
          var donoUF = obj.DON_UF
          var donoTelefone = obj.DON_TELEFONE

          $('#codigo').val(donoCodigo)
          $('#modalNome').val(donoNome)
          $('#telefone').val(donoTelefone)
          $('#cpf').val(donoCPF)
          $('#cep').val(donoCEP)
          $('#rua').val(donoRua)
          $('#bairro').val(donoBairro)
          $('#cidade').val(donoCidade)
          $('#uf').val(donoUF)
          $('#complemento').val(donoComplemento)
          $('#numeroCasa').val(donoNumCasa)

          //Modal Excluir
          $('#modalExcluirDonoCodigo').val(donoCodigo)
          $('#modalExcluirDonoNome').val(donoNome)
          $('#modalExcluirDonoTelefone').val(donoTelefone)
          $('#modalExcluirDonoCPF').val(donoCPF)
        })
      }

      function clearFillds() {
        $('#codigo').val("")
        $('#modalNome').val("")
        $('#cep').val("")
        $('#cpf').val("")
        $('#rua').val("")
        $('#numeroCasa').val("")
        $('#complemento').val("")
        $('#bairro').val("")
        $('#cidade').val("")
        $('#uf').val("")
        $('#telefone').val("")
      }
      $(document).ready(function() {
        var $seuCampoCpf = $("#cpf");
        $seuCampoCpf.mask("000.000.000-00", {
          reverse: false,
        });
      });
      //Mask Telefone
      var behavior = function(val) {
          return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {
          onKeyPress: function(val, e, field, options) {
            field.mask(behavior.apply({}, arguments), options);
          }
        };

      $('#telefone').mask(behavior, options);
      //Mask do CEP
      $(document).ready(function() {
        $("#cep").mask("99.999-999");
      });


      //Função para o CEP
      $("#cep").blur(function() {
        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, "");

        //Verifica se campo cep possui valor informado.
        if (cep != "") {
          //Expressão regular para validar o CEP.
          var validacep = /^[0-9]{8}$/;

          //Valida o formato do CEP.
          if (validacep.test(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            $("#rua").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#uf").val("...");
            $("#ibge").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON(
              "https://viacep.com.br/ws/" + cep + "/json/?callback=?",
              function(dados) {
                if (!("erro" in dados)) {
                  //Atualiza os campos com os valores da consulta.
                  $("#rua").val(dados.logradouro);
                  $("#bairro").val(dados.bairro);
                  $("#cidade").val(dados.localidade);
                  $("#uf").val(dados.uf);
                  $("#ibge").val(dados.ibge);
                } //end if.
                else {
                  //CEP pesquisado não foi encontrado.
                  limpa_formulário_cep();
                  alert("CEP não encontrado.");
                }
              }
            );
          } //end if.
          else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
          }
        } //end if.
        else {
          //cep sem valor, limpa formulário.
          limpa_formulário_cep();
        }
      });
    </script>
</body>

</html>