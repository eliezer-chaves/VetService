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
        <div class="bg-light mt-5 shadow p-3 mb-5 bg-body rounded">
          <div class="mb-3">
            <h2 class="text-center title">Adicionar consulta</h2>
          </div>
          <div class="p-3">

            <div class="row mb-3">
              <div class="form-group">
                <label for="animal">Animal:</label>
                <input type="text" id="input_animal" class="form-control" autocomplete="off" />
                <div class="list-group shadow-lg" id="resultado" style="position: absolute;   z-index: 1;"></div>
              </div>
              <div class="input-group mt-3 d-none">
                <span class="input-group-text">Animal Código:</span>
                <input type="text" class="form-control" id="input_animal_codigo" disabled readonly />
              </div>
            </div>

            <div class="row mb-3">
              <div class="input-group ">
                <span class="input-group-text">Dono</span>
                <input type="text" class="form-control" id="input_dono" disabled readonly />
              </div>
            </div>

            <div class="row mb-3">
              <div class="col d-none">
                <div class="input-group ">
                  <span class="input-group-text">Código:</span>
                  <input id="dono_codigo" type="text" class="form-control" disabled />
                </div>
              </div>
              <div class="col">
                <div class="input-group">
                  <span class="input-group-text" for="dono_cpf">CPF:</span>
                  <input id="dono_cpf" type="text" class="form-control" disabled />
                </div>
              </div>
              <div class="col">
                <div class="input-group">
                  <span class="input-group-text" for="dono_telefone">Telefone:</span>
                  <input id="dono_telefone" type="text" class="form-control" disabled />
                </div>
              </div>

            </div>

            <div class="row">
              <div class="input-group mb-3">
                <label class="input-group-text" for="veterinario_opcao">Veterinário</label>
                <select class="form-select" id="veterinario_opcao">
                  <option id="veterinario_opcao" selected>Escolha...</option>

                </select>

                <div class="input-group mt-3 d-none">
                  <span class="input-group-text">Código Veterinário:</span>
                  <input id="veterinario_codigo" type="text" class="form-control" disabled />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Data</span>
                  <input type="date" class="form-control" id="data_consulta" />
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text">Hora</span>
                  <input type="time" class="form-control" id="hora_consulta" />
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center mt-4">
              <button type="submit" class="btn btn-primary w-50" id="cadastrar">
                Criar consulta
              </button>
            </div>
            <!-- Modal Cadastrado -->
            <div id="modalConsultaCadastrada" class="modal fade" role="dialog">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modal-header-cadastrado">Consulta Cadastrada!</h4>
                  </div>
                  <div class="modal-body">
                    <p>Consulta cadastrada com sucesso:</p>
                    <p>Data: <b><span id="dataModal"></span></b></p>
                    <p>Hora: <b><span id="horaModal"></span></b></p>
                    <p>Animal: <b><span id="animalNomeModal"></span></b></p>
                    <p>Dono: <b><span id="donoNomeModal"></span></b></p>
                    <p>Veterinário: <b><span id="veterinarioModal"></span></b></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary " id="btn-consulta-cadastrado-modal" data-dismiss="modal">Ok</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal Warning Campos Faltando -->
            <div id="modalAviso" class="modal fade" role="dialog">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modal-header-cadastrado">Informe todos os campos!</h4>
                  </div>
                  <div class="modal-body">
                    <p><b>Consulta</b> não cadastrada, confira todos os campos.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning " id="btn-aviso-modal" data-dismiss="modal">Ok</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div> -->
      <!-- Footer -->
      <?php include 'componentes/footer.html'; ?>
    <!-- </div> -->

    <script>
      data_consulta.min = new Date().toISOString().split("T")[0];

      function clearFilds() {
        $("#input_animal").val("");
        $("#input_animal_codigo").val("")
        $("#input_dono").val("");
        $("#dono_codigo").val("");
        $("#dono_cpf").val("");
        $("#dono_telefone").val("");
        $("#veterinario_opcao").val("");
        $("#veterinario_codigo").val("");
        $("#data_consulta").val("");
        $("#hora_consulta").val("");
        $("#dataModal").val("");
        $("#horaModal").val("");
        $("#animalNomeModal").val("");
        $("#donoNomeModal").val("");
        $("#veterinarioModal").val("");

      }

      $(document).ready(function() {
        $.ajax({
          method: "POST",
          url: "../../model/crud_veterinario.php",
          data:{
            operation: "read_all"
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

      $("#cadastrar").click(function() {
        var animalCodigo = $("#input_animal_codigo").val();
        var donoCodigo = $("#dono_codigo").val();
        var veterinario_codigo = $('#veterinario_codigo').val();
        var data = $("#data_consulta").val();
        var hora = $("#hora_consulta").val();
        var animalNome = $("#input_animal").val();
        var dono = $("#input_dono").val();
        var veterinario = $('#veterinario_opcao :selected').text()

        $.ajax({
          method: "POST",
          url: "../../model/crud_consulta.php",
          data: {
            animalCodigo: animalCodigo,
            donoCodigo: donoCodigo,
            veterinario_codigo: veterinario_codigo,
            data: data,
            hora: hora,
            animalNome: animalNome,
            dono: dono,
            veterinario: veterinario,
            operation: "create"
          },
        }).done(function(resposta) {
          var obj = $.parseJSON(resposta);
          if (obj.status == "cadastrado") {
            var dia = obj.data.split("-")[0];
            var mes = obj.data.split("-")[1];
            var ano = obj.data.split("-")[2];

            obj.data = ("0" + ano).slice(-2) + '/' + ("0" + mes).slice(-2) + '/' + dia;

            $("#modalConsultaCadastrada").modal("show");
            $("#dataModal").html(obj.data);
            $("#horaModal").html(obj.hora);
            $("#animalNomeModal").html(obj.animal);
            $("#donoNomeModal").html(obj.dono);
            $("#veterinarioModal").html(obj.veterinario);

          }
          if (obj.status == "incomplete") {
            $("#modalAviso").modal("show");
          }
        });
      });

      $(document).on("click", 'button', function(element) {
        var id = element.currentTarget.id;
        if (id == "btn-consulta-cadastrado-modal") {
          $('#modalConsultaCadastrada').modal('hide');
          clearFilds();
        }
        if (id == "btn-aviso-modal") {
          $('#modalAviso').modal('hide');
        }
        if (id == "btn-ok-modal-exists") {
          $('#modalExists').modal('hide');
        }
      });

      $(document).ready(function() {
        $("#input_animal").keyup(function() {
          let searchText = $(this).val();
          if (searchText != "") {
            $.ajax({
              url: "../../model/crud_animal.php",
              method: "post",
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
                  '_animalNome' + obj[item].animalnome +
                  '_animalCodigo' + obj[item].animalCodigo +
                  '">' + obj[item].animalnome + ' - ' + obj[item].donoNome +
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

            $("#input_animal").val(animalNome)
            $("#input_animal_codigo").val(animalCodigo)
            $("#input_dono").val(donoNome)
            $("#dono_codigo").val(donoCodigo)
            $("#dono_cpf").val(cpf)
            $("#dono_telefone").val(telefone)
          }
        });
      });
    </script>
</body>

</html>