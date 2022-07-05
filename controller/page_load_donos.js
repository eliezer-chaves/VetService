const urlCRUDDono = "../../model/crud_dono.php";

var inputCEP = $("#cep");
var inputRua = $("#rua");
var inputBairro = $("#bairro");
var inputCidade = $("#cidade");
var inputUF = $("#uf");
var inputTelefone = $("#telefone");

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

function readAll() {
  var quantidade = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: urlCRUDDono,
    data: {
      operation: "read_all",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    $("#donos").empty();
    var obj = $.parseJSON(resposta);
    if (obj.total == undefined) {
      $("#conteudo").hide();
      $("#semCadastro").show();
    } else if (obj.status != "vazio") {
      var total = obj.total;

      $("#total_donos").html(total);

      if (total <= 5) {
        $("#total_donos_value").html(total);
        $("#total_resultados").hide();
        $("#total_donos_busca").hide();
        $("#total_donos_quantidade").show();
      } else {
        $("#total_resultados").show();
        $("#total_donos_quantidade").hide();
        $("#total_donos_busca").hide();
      }

      if (quantidade == "") {
        quantidade = obj.total;
      }
      for (var i = 0; i < quantidade; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var donoCodigo = obj.dados[i].donoCodigo;
        var donoNome = obj.dados[i].donoNome;
        var donoCPF = obj.dados[i].donoCPF;
        var donoTelefone = obj.dados[i].donoTelefone;

        if (donoTelefone == "") {
          donoTelefone = "Não informado";
        }

        fillTable(donoCodigo, donoNome, donoCPF, donoTelefone);
      }
      var total = obj.total;
      $("#total_donos").html(total);
    }
  });
}

$("#table_count").on("change", function () {
  var total = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: urlCRUDDono,
    data: {
      operation: "read_all",
      quantidade: total,
    },
  }).done(function (resposta) {
    $("#donos").empty();
    var obj = $.parseJSON(resposta);

    if (obj.status != "vazio") {
      for (var i = 0; i < obj.total; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var donoCodigo = obj.dados[i].donoCodigo;
        var donoNome = obj.dados[i].donoNome;
        var donoCPF = obj.dados[i].donoCPF;
        var donoTelefone = obj.dados[i].donoTelefone;

        if (donoTelefone == "") {
          donoTelefone = "Não informado";
        }
        fillTable(donoCodigo, donoNome, donoCPF, donoTelefone);
      }
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
    pesquisarDono();
  }
});

$("#search").on("click", function () {
  pesquisarDono();
});

loadData();

function loadData() {
  var quantidade = $("#table_count").val();

  $.ajax({
    method: "POST",
    url: urlCRUDDono,
    data: {
      operation: "load_page",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    $("#donos").empty();
    var obj = $.parseJSON(resposta);

    if (obj.status != "vazio") {
      $("#conteudo").show();
      $("#semCadastro").hide();

      var total = obj.total;
      $("#total_donos").html(total);

      if (total <= 5) {
        $("#total_donos_value").html(total);
        $("#total_resultados").hide();
        $("#total_donos_busca").hide();
        $("#total_donos_quantidade").show();
      } else {
        $("#total_resultados").show();
        $("#total_donos_quantidade").hide();
        $("#total_donos_busca").hide();
      }
      for (var i = 0; i < quantidade; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var donoCodigo = obj.dados[i].donoCodigo;
        var donoNome = obj.dados[i].donoNome;
        var donoCPF = obj.dados[i].donoCPF;
        var donoTelefone = obj.dados[i].donoTelefone;

        if (donoTelefone == "") {
          donoTelefone = "Não informado";
        }

        fillTable(donoCodigo, donoNome, donoCPF, donoTelefone);
      }
    } else {
      $("#conteudo").hide();
      $("#semCadastro").show();
    }
  });
}

function pesquisarDono() {
  var nome = $("#nome_search").val();
  $("#aviso").hide();
  $("#table").show();
  if (nome != "") {
    $.ajax({
      method: "POST",
      url: urlCRUDDono,
      data: {
        operation: "search",
        nome: nome,
      },
    }).done(function (resposta) {
      $("#donos").empty();
      var obj = $.parseJSON(resposta);
      if (obj.status != "vazio") {
        $("#conteudo").show();
        $("#semCadastro").hide();

        var total = obj.total;

        $("#total_donos_busca_value").html(total);
        $("#total_resultados").hide();
        $("#total_donos_busca").show();
        $("#total_donos_quantidade").hide();

        for (var i = 0; i < obj.dados.length; i++) {
          var donoCodigo = obj.dados[i].donoCodigo;
          var donoNome = obj.dados[i].donoNome;
          var donoCPF = obj.dados[i].donoCPF;
          var donoTelefone = obj.dados[i].donoTelefone;

          if (donoTelefone == "") {
            donoTelefone = "Não informado";
          }

          fillTable(donoCodigo, donoNome, donoCPF, donoTelefone);
        }
      } else {
        $("#table").hide();
        $("#aviso").show();
        $("#total_resultados").hide();
      }
    });
  } else {
    loadData();
  }
}

function fillTable(donoCodigo, donoNome, donoCPF, donoTelefone) {
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
    url: urlCRUDDono,
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
      readAll();
      showAlertSuccess();
    } else {
      showAlertWarning();
    }
  });
}

function deleteDono(codigo) {
  $.ajax({
    method: "POST",
    url: urlCRUDDono,
    data: {
      codigo: codigo,
      operation: "delete",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);

    if (obj.status == "deletado") {
      clearFillds();
      $("#modalExcluirDono").modal("hide");
      readAll();
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
    url: urlCRUDDono,
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
  $("#cpf").mask("000.000.000-00", {
    reverse: false,
  });
  inputCEP.mask("99.999-999");

});

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

inputTelefone.mask(behavior, options);

inputCEP.blur(function () {
  var cep = inputCEP.val().replace(/\D/g, "");

  if (cep != "") {
    var validacep = /^[0-9]{8}$/;

    if (validacep.test(cep)) {
      inputRua.val("Buscando...");
      inputBairro.val("Buscando...");
      inputCidade.val("Buscando...");
      inputUF.val("Buscando...");

      $.getJSON(
        "https://viacep.com.br/ws/" + cep + "/json/?callback=?",
        function (dados) {
          if (!("erro" in dados)) {
            inputRua.val(dados.logradouro);
            inputBairro.val(dados.bairro);
            inputCidade.val(dados.localidade);
            inputUF.val(dados.uf);
          } else {
            inputCEP.val("");
            inputRua.val("");
            inputBairro.val("");
            inputCidade.val("");
            inputUF.val("");
            alert("CEP não encontrado.");
          }
        }
      );
    } else {
      inputCEP.val("");
      inputRua.val("");
      inputBairro.val("");
      inputCidade.val("");
      inputUF.val("");
      alert("Formato de CEP inválido.");
    }
  } else {
    inputCEP.val("");
    inputRua.val("");
    inputBairro.val("");
    inputCidade.val("");
    inputUF.val("");
  }
});
