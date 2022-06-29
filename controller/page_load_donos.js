$("#donoAlterado").hide();
$("#donoErro").hide();
$("#donoExcluido").hide();
$("#aviso").hide();
$("#semCadastro").hide();

function showAlertSuccess() {
  $("#donoAlterado")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#donoAlterado").fadeOut(1000);
    });
}

function showAlertSuccessDeletado() {
  $("#donoExcluido")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#donoExcluido").fadeOut(1000);
    });
}

function showAlertWarning() {
  $("#donoErro")
    .fadeTo(3000, 500)
    .fadeIn(3000, function () {
      $("#donoErro").fadeOut(3000);
    });
}

var total;
$("#table_count").on("change", function () {
  var total = this.value;
  $.ajax({
    method: "POST",
    url: "../../model/crud_dono.php",
    data: {
      operation: "read_all",
      quantidade: total,
    },
  }).done(function (resposta) {
    $("#donos").empty();
    var obj = $.parseJSON(resposta);
    var donos = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      Object.keys(obj).forEach((item) => {
        var dono = obj[item];

        donos.push(dono);
        quantidade++;
        var donoCodigo = obj[item].donoCodigo;
        var donoNome = obj[item].donoNome;
        var donoCPF = obj[item].donoCPF;
        var donoTelefone = obj[item].donoTelefone;

        if (donoTelefone == "") {
          donoTelefone = "Não informado";
        }

        var nova_linha = "";
        var nova_linha =
          '<tr class="item"> ' +
          '<th scope="row" class="text-center align-middle" id="donoCodigo' +
          donoCodigo +
          '">' +
          donoCodigo +
          "</th>" +
          '<td class="align-middle text-center">' +
          donoNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoCPF +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoTelefone +
          "</td>" +
          '<td class="text-center text-center">' +
          '<button class="btn btn-warning me-2" id="editar' +
          donoCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
          '<i class="fa-solid fa-pen-to-square"></i>' +
          "</button>" +
          '<button class="btn btn-danger" id="excluir' +
          donoCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
          '<i class="fa-solid fa-trash-can"></i>' +
          "</button>" +
          "</td>" +
          "</tr>";

        $("#donos").append(nova_linha);
      });
    }
  });
});

function countTable() {
  $.ajax({
    method: "POST",
    url: "../../model/crud_dono.php",
    data: {
      operation: "count",
    },
  }).done(function (resposta) {
    if (resposta == 0) {
      $("#content").hide();
    }
    $("#total").html(resposta);
  });
}

$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../../model/crud_dono.php",
    data: {
      operation: "load_page",
    },
  }).done(function (resposta) {
    $("#donos").empty();
    var obj = $.parseJSON(resposta);
    var donos = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      $("#conteudo").show();
      $("#semCadastro").hide();
      countTable();
      Object.keys(obj).forEach((item) => {
        var dono = obj[item];
        donos.push(dono);
        quantidade++;
        var donoCodigo = obj[item].donoCodigo;
        var donoNome = obj[item].donoNome;
        var donoCPF = obj[item].donoCPF;
        var donoTelefone = obj[item].donoTelefone;

        if (donoTelefone == "") {
          donoTelefone = "Não informado";
        }

        var nova_linha = "";
        var nova_linha =
          '<tr class="item"> ' +
          '<th scope="row" class="text-center align-middle" id="donoCodigo' +
          donoCodigo +
          '">' +
          donoCodigo +
          "</th>" +
          '<td class="align-middle text-center">' +
          donoNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoCPF +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoTelefone +
          "</td>" +
          '<td class="text-center text-center">' +
          '<button class="btn btn-warning me-2" id="editar' +
          donoCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
          '<i class="fa-solid fa-pen-to-square"></i>' +
          "</button>" +
          '<button class="btn btn-danger" id="excluir' +
          donoCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
          '<i class="fa-solid fa-trash-can"></i>' +
          "</button>" +
          "</td>" +
          "</tr>";
        $("#donos").append(nova_linha);
      });

      if (quantidade < 5) {
        $("#total_resultados").hide();
      } else {
        $("#total_resultados").show();
      }
    } else if (obj.status == "vazio") {
      $("#conteudo").hide();
      $("#semCadastro").show();
    }
  });
});

$(document).on("click", "button", function (element) {
  var id = element.currentTarget.id;
  if (id.includes("editar")) {
    var codigo = id.replace("editar", "");
    fillFilds(codigo);
  } else if (id.includes("excluir")) {
    var codigo = id.replace("excluir", "");
    fillFilds(codigo);
  } else if (id == "updateDono") {
    var codigo = $("#codigo").val();
    updateDono(codigo);
  } else if (id == "modalExcluirDono") {
    var codigo = $("#modalExcluirDonoCodigo").val();
    deleteDono(codigo);
  }
});

$("#nome_search").on("keydown", function (e) {
  if (e.keyCode === 13) {
    var nome = $("#nome_search").val();
    $("#aviso").hide();
    $("#table").show();
    $("#table_count").val("5");
    var quantidade;
    if (nome == "") {
      $("#total_resultados").show();
      quantidade = 5;
    } else {
      $("#total_resultados").hide();
      quantidade = 0;
    }

    $.ajax({
      method: "POST",
      url: "../../model/crud_dono.php",
      data: {
        operation: "search",
        nome: nome,
        quantidade: quantidade,
      },
    }).done(function (resposta) {
      $("#donos").empty();
      var obj = $.parseJSON(resposta);

      var quantidade = 0;

      if (obj.status != "vazio") {
        var total = obj.total
        $("#total").html(obj.total)
        console.log(obj.total)
        for (var i = 0; i < obj.dados.length; i++) {
          var donoCodigo = obj.dados[i].donoCodigo;
          var donoNome = obj.dados[i].donoNome;
          var donoCPF = obj.dados[i].donoCPF;
          var donoTelefone = obj.dados[i].donoTelefone;

          if (donoTelefone == "") {
            donoTelefone = "Não informado";
          }

          var nova_linha = "";
          var nova_linha =
            '<tr class="item"> ' +
            '<th scope="row" class="text-center align-middle" id="donoCodigo' +
            donoCodigo +
            '">' +
            donoCodigo +
            "</th>" +
            '<td class="align-middle text-center">' +
            donoNome +
            "</td>" +
            '<td class="align-middle text-center">' +
            donoCPF +
            "</td>" +
            '<td class="align-middle text-center">' +
            donoTelefone +
            "</td>" +
            '<td class="text-center text-center">' +
            '<button class="btn btn-warning me-2" id="editar' +
            donoCodigo +
            '" data-bs-toggle="modal" data-bs-target="#modalEditarDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
            '<i class="fa-solid fa-pen-to-square"></i>' +
            "</button>" +
            '<button class="btn btn-danger" id="excluir' +
            donoCodigo +
            '" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
            '<i class="fa-solid fa-trash-can"></i>' +
            "</button>" +
            "</td>" +
            "</tr>";

          $("#donos").append(nova_linha);
        }

        
      } else {
        $("#table").hide();
        $("#aviso").show();
      }
    });
  }
});

$("#search").click(function () {
  var nome = $("#nome_search").val();
  $("#aviso").hide();
  $("#table").show();
  $("#table_count").val("5");
  var quantidade;
  if (nome == "") {
    $("#total_resultados").show();
    quantidade = 5;
  } else {
    $("#total_resultados").hide();
    quantidade = 0;
  }

  $.ajax({
    method: "POST",
    url: "../../model/crud_dono.php",
    data: {
      operation: "search",
      nome: nome,
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);

    $("#donos").empty();
    var obj = $.parseJSON(resposta);
    var donos = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      Object.keys(obj).forEach((item) => {
        var dono = obj[item];
        donos.push(dono);
        quantidade++;
        var donoCodigo = obj[item].donoCodigo;
        var donoNome = obj[item].donoNome;
        var donoCPF = obj[item].donoCPF;
        var donoTelefone = obj[item].donoTelefone;

        if (donoTelefone == "") {
          donoTelefone = "Não informado";
        }

        var nova_linha = "";
        var nova_linha =
          '<tr class="item"> ' +
          '<th scope="row" class="text-center align-middle" id="donoCodigo' +
          donoCodigo +
          '">' +
          donoCodigo +
          "</th>" +
          '<td class="align-middle text-center">' +
          donoNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoCPF +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoTelefone +
          "</td>" +
          '<td class="text-center text-center">' +
          '<button class="btn btn-warning me-2" id="editar' +
          donoCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
          '<i class="fa-solid fa-pen-to-square"></i>' +
          "</button>" +
          '<button class="btn btn-danger" id="excluir' +
          donoCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
          '<i class="fa-solid fa-trash-can"></i>' +
          "</button>" +
          "</td>" +
          "</tr>";

        $("#donos").append(nova_linha);
      });
    } else {
      $("#table").hide();
      $("#aviso").show();
    }
  });
});

function loadData() {
  quantidade = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: "../../model/crud_dono.php",
    data: {
      operation: "load_page",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    countTable();
    $("#donos").empty();

    var obj = $.parseJSON(resposta);

    var donos = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      Object.keys(obj).forEach((item) => {
        var dono = obj[item];
        donos.push(dono);
        quantidade++;
        var donoCodigo = obj[item].donoCodigo;
        var donoNome = obj[item].donoNome;
        var donoCPF = obj[item].donoCPF;
        var donoTelefone = obj[item].donoTelefone;

        if (donoTelefone == "") {
          donoTelefone = "Não informado";
        }

        var nova_linha = "";
        var nova_linha =
          '<tr class="item"> ' +
          '<th scope="row" class="text-center align-middle" id="donoCodigo' +
          donoCodigo +
          '">' +
          donoCodigo +
          "</th>" +
          '<td class="align-middle text-center">' +
          donoNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoCPF +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoTelefone +
          "</td>" +
          '<td class="text-center text-center">' +
          '<button class="btn btn-warning me-2" id="editar' +
          donoCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dono">' +
          '<i class="fa-solid fa-pen-to-square"></i>' +
          "</button>" +
          '<button class="btn btn-danger" id="excluir' +
          donoCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalExcluirDono" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir dono">' +
          '<i class="fa-solid fa-trash-can"></i>' +
          "</button>" +
          "</td>" +
          "</tr>";

        $("#donos").append(nova_linha);
      });

      if (quantidade < 5) {
        $("#total_resultados").hide();
      } else {
        $("#total_resultados").show();
      }
    }
  });
}

function updateDono() {
  var donoCodigo = $("#codigo").val();
  var donoNome = $("#modalNome").val();
  var donoCEP = $("#cep").val();
  var donoCPF = $("#cpf").val();
  var donoRua = $("#rua").val();
  var donoNumCasa = $("#numeroCasa").val();
  var donoComplemento = $("#complemento").val();
  var donoBairro = $("#bairro").val();
  var donoCidade = $("#cidade").val();
  var donoUF = $("#uf").val();
  var donoTelefone = $("#telefone").val();
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
      operation: "update",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "alterado") {
      clearFillds();
      $("#modalEditarDono").modal("hide");
      loadData();
      showAlertSuccess();
    } else {
      showAlertWarning();
    }
  });
}

function deleteDono(codigo) {
  $.ajax({
    method: "POST",
    url: "../../model/crud_dono.php",
    data: {
      codigo: codigo,
      operation: "delete",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);

    if (obj.status == "deletado") {
      clearFillds();
      $("#modalExcluirDono").modal("hide");
      loadData();
      showAlertSuccessDeletado();
    } else {
      showAlertWarning();
    }
  });
}

function fillFilds(codigo) {
  clearFillds();
  $.ajax({
    method: "POST",
    url: "../../model/crud_dono.php",
    data: {
      codigo: codigo,
      operation: "read_one",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    var donoCodigo = obj.DON_CODIGO;
    var donoNome = obj.DON_NOME;
    var donoCPF = obj.DON_CPF;
    var donoCEP = obj.DON_CEP;
    var donoRua = obj.DON_RUA;
    var donoNumCasa = obj.DON_NUMCASA;
    var donoComplemento = obj.DON_COMPLEMENTO;
    var donoBairro = obj.DON_BAIRRO;
    var donoCidade = obj.DON_CIDADE;
    var donoUF = obj.DON_UF;
    var donoTelefone = obj.DON_TELEFONE;

    $("#codigo").val(donoCodigo);
    $("#modalNome").val(donoNome);
    $("#telefone").val(donoTelefone);
    $("#cpf").val(donoCPF);
    $("#cep").val(donoCEP);
    $("#rua").val(donoRua);
    $("#bairro").val(donoBairro);
    $("#cidade").val(donoCidade);
    $("#uf").val(donoUF);
    $("#complemento").val(donoComplemento);
    $("#numeroCasa").val(donoNumCasa);

    //Modal Excluir
    $("#modalExcluirDonoCodigo").val(donoCodigo);
    $("#modalExcluirDonoNome").val(donoNome);
    $("#modalExcluirDonoTelefone").val(donoTelefone);
    $("#modalExcluirDonoCPF").val(donoCPF);
  });
}

function clearFillds() {
  $("#codigo").val("");
  $("#modalNome").val("");
  $("#cep").val("");
  $("#cpf").val("");
  $("#rua").val("");
  $("#numeroCasa").val("");
  $("#complemento").val("");
  $("#bairro").val("");
  $("#cidade").val("");
  $("#uf").val("");
  $("#telefone").val("");
}
$(document).ready(function () {
  var $seuCampoCpf = $("#cpf");
  $seuCampoCpf.mask("000.000.000-00", {
    reverse: false,
  });
});
//Mask Telefone
var behavior = function (val) {
    return val.replace(/\D/g, "").length === 11
      ? "(00) 00000-0000"
      : "(00) 0000-00009";
  },
  options = {
    onKeyPress: function (val, e, field, options) {
      field.mask(behavior.apply({}, arguments), options);
    },
  };

$("#telefone").mask(behavior, options);
//Mask do CEP
$(document).ready(function () {
  $("#cep").mask("99.999-999");
});

//Função para o CEP
$("#cep").blur(function () {
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
        function (dados) {
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
