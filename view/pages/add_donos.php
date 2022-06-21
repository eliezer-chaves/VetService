<!DOCTYPE html>
<html lang="PT-br">

<head>

  <meta charset="utf-8">
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
          <div class="shadow mt-5 p-3 mb-5 bg-body rounded">
            <div class="mt-1">
              <h2 class="text-center title">Adicionar dono</h2>
            </div>
            <div class="p-3">
              <div class="row">
                <div class="col-8">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Nome</span>
                    <input type="text" id="nome" class="form-control" required />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">CPF</span>
                    <input type="text" class="form-control" id="cpf" required />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="input-group mb-3">
                    <span class="input-group-text">CEP</span>
                    <input type="text" class="form-control" id="cep" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-9">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Logradouro</span>
                    <input type="text" class="form-control" id="rua" required />
                  </div>
                </div>
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Número</span>
                    <input type="text" class="form-control" id="numero" required />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Complemento</span>
                  <input type="text" class="form-control" id="complemento" />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Bairro</span>
                    <input type="text" class="form-control" id="bairro" required />
                  </div>
                </div>
                <div class="col-4">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Cidade</span>
                    <input type="text" class="form-control" id="cidade" required />
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group mb-3">
                    <span class="input-group-text">UF</span>
                    <input type="text" class="form-control" id="uf" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <span class="input-group-text">Telefone</span>
                  <input type="text" class="form-control" id="telefone" required />
                </div>
              </div>
              <div class="row d-flex justify-content-center mt-4">
                <button type="submit" id="cadastrar" class="btn btn-primary w-50">
                  Cadastrar dono
                </button>

                <!-- Modal Cadastrado -->
                <div id="modalDonoCadastrado" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="modal-header-cadastrado">Dono(a) Cadastrado!</h4>
                      </div>
                      <div class="modal-body">
                        <p>Dono(a) cadastrado com sucesso: <b><span id="donoNome"></span></b></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary " id="btn-dono-cadastrado-modal" data-bs-target="#modalDonoCadastrado" data-dismiss="modal">Ok</button>
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
                        <p><b>Dono(a)</b> não cadastrado, confira todos os campos.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning " id="btn-aviso-modal" data-dismiss="modal">Ok</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Warning Dono Já Existe -->
                <div id="modalExists" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="modal-header-cadastrado">Dono(a) já cadastrado!</h4>
                      </div>
                      <div class="modal-body">
                        <p>O CPF <b><span id="donoExists"></b></span>, já está cadastrado.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning " id="btn-ok-modal-exists" data-dismiss="modal">Ok</button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div>
      <?php include 'componentes/footer.html'; ?>
    </div> -->

</body>
<!-- <script src="../../controller/add_donos.js"></script> -->
<script>
  function clearFilds() {
    $("#nome").val("");
    $("#cpf").val("");
    $("#cep").val("");
    $("#rua").val("");
    $("#numero").val("");
    $("#complemento").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
    $("#telefone").val("");
    $("#donoNome").val("");
    $("#donoExists").val("");
  }

  $("#cadastrar").click(function() {
    var nome = $("#nome").val();
    var cpf = $("#cpf").val();
    var cep = $("#cep").val();
    var rua = $("#rua").val();
    var numero = $("#numero").val();
    var complemento = $("#complemento").val();
    var bairro = $("#bairro").val();
    var cidade = $("#cidade").val();
    var uf = $("#uf").val();
    var telefone = $("#telefone").val();

    $.ajax({
      method: "POST",
      url: "../../model/crud_dono.php",
      data: {
        nome: nome,
        cep: cep,
        cpf: cpf,
        rua: rua,
        numero: numero,
        complemento: complemento,
        bairro: bairro,
        cidade: cidade,
        uf: uf,
        telefone: telefone,
        operation: "create",
      },
    }).done(function(resposta) {
      
      var obj = $.parseJSON(resposta);
      var nome = obj.dono;
      if (obj.status == "cadastrado") {
        $("#modalDonoCadastrado").modal("show");
        $("#donoNome").html(nome);
      }
      if (obj.status == "incomplete") {
        $("#modalAviso").modal("show");
      }
      if (obj.status == "exists") {
        $("#modalExists").modal("show");
        $("#donoExists").html(obj.cpf);
        //clearFilds();
      }
    });
  });

  $(document).on("click", "button", function(element) {
    var id = element.currentTarget.id;
    if (id == "btn-dono-cadastrado-modal") {
      $("#modalDonoCadastrado").modal("hide");
      clearFilds();
    }
    if (id == "btn-aviso-modal") {
      $("#modalAviso").modal("hide");
    }
    if (id == "btn-ok-modal-exists") {
      $("#modalExists").modal("hide");
    }
  });

  $(document).ready(function() {
    var $seuCampoCpf = $("#cpf");
    $seuCampoCpf.mask("000.000.000-00", {
      reverse: false,
    });
  });

  //Mask Telefone
  var behavior = function(val) {
      return val.replace(/\D/g, "").length === 11 ?
        "(00) 00000-0000" :
        "(00) 0000-00009";
    },
    options = {
      onKeyPress: function(val, e, field, options) {
        field.mask(behavior.apply({}, arguments), options);
      },
    };

  $("#telefone").mask(behavior, options);

  //Mask do CEP
  $(document).ready(function() {
    $("#cep").mask("99.999-999");
  });
  //Função para o CEP
  function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#rua").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
    $("#numero").val("");
  }
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
              limpa_formulario_cep();
              alert("CEP não encontrado.");
            }
          }
        );
      } //end if.
      else {
        //cep é inválido.
        limpa_formulario_cep();
        alert("Formato de CEP inválido.");
      }
    } //end if.
    else {
      //cep sem valor, limpa formulário.
      limpa_formulario_cep();
    }
  });
</script>

</html>