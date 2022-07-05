const urlCRUDVeterinario = "../../model/crud_veterinario.php";

$("#veterinarioAlterado").hide();
$("#veterinarioErro").hide();
$("#veterinarioExcluido").hide();

$("#aviso").hide();
$("#semCadastro").hide();

function showAlertSuccess() {
  $("#veterinarioAlterado")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#veterinarioAlterado").fadeOut(1000);
    });
}

function showAlertSuccessDeletado() {
  $("#veterinarioExcluido")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#veterinarioExcluido").fadeOut(1000);
    });
}

function showAlertWarning() {
  $("#veterinarioErro")
    .fadeTo(3000, 500)
    .fadeIn(3000, function () {
      $("#veterinarioErro").fadeOut(3000);
    });
}

loadData();

function readAll() {
  var quantidade = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: urlCRUDVeterinario,
    data: {
      operation: "read_all",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    $("#veterinarios").empty();

    var obj = $.parseJSON(resposta);

    if (obj.total == undefined) {
      $("#conteudo").hide();
      $("#semCadastro").show();
    } else if (obj.status != "vazio") {
      var total = obj.total;

      $("#total_veterinarios").html(total);

      if (total <= 5) {
        $("#total_veterinarios_value").html(total);
        $("#total_resultados").hide();
        $("#total_veterinarios_busca").hide();
        $("#total_veterinarios_quantidade").show();
      } else {
        $("#total_resultados").show();
        $("#total_veterinarios_quantidade").hide();
        $("#total_veterinarios_busca").hide();
      }

      if (quantidade == "") {
        quantidade = obj.total;
      }
      for (var i = 0; i < obj.total; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var veterinarioCodigo = obj.dados[i].veterinarioCodigo;
        var veterinarioNome = obj.dados[i].veterinarioNome;
        var veterinarioCRMVUF = obj.dados[i].veterinarioCRMVUF;
        var veterinarioTelefone = obj.dados[i].veterinarioTelefone;
        var veterinarioEspecialidade = obj.dados[i].veterinarioEspecialidade;

        fillTable(
          veterinarioCodigo,
          veterinarioNome,
          veterinarioCRMVUF,
          veterinarioTelefone,
          veterinarioEspecialidade
        );
      }
      var total = obj.total;
      $("#total_veterinarios").html(total);
    }
  });
}

$("#table_count").on("change", function () {
  var total = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: urlCRUDVeterinario,
    data: {
      operation: "read_all",
      quantidade: total,
    },
  }).done(function (resposta) {
    $("#veterinarios").empty();
    var obj = $.parseJSON(resposta);

    if (obj.status != "vazio") {
      for (var i = 0; i < obj.total; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var veterinarioCodigo = obj.dados[i].veterinarioCodigo;
        var veterinarioNome = obj.dados[i].veterinarioNome;
        var veterinarioCRMVUF = obj.dados[i].veterinarioCRMVUF;
        var veterinarioTelefone = obj.dados[i].veterinarioTelefone;
        var veterinarioEspecialidade = obj.dados[i].veterinarioEspecialidade;

        fillTable(
          veterinarioCodigo,
          veterinarioNome,
          veterinarioCRMVUF,
          veterinarioTelefone,
          veterinarioEspecialidade
        );
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
  } else if (id == "updateVeterinario") {
    var codigo = $("#codigo").val();
    updateVeterinario(codigo);
  } else if (id == "deleteVeterinario") {
    var codigo = $("#modalExcluirVeterinarioCodigo").val();
    deleteVeterinario(codigo);
  }
});

$("#nome_search").on("keydown", function (e) {
  if (e.keyCode === 13) {
    pesquisarVeterinario();
  }
});

$("#search").click(function () {
  pesquisarVeterinario();
});

function pesquisarVeterinario() {
  var nome = $("#nome_search").val();
  $("#aviso").hide();
  $("#table").show();

  if (nome != "") {
    $.ajax({
      method: "POST",
      url: urlCRUDVeterinario,
      data: {
        operation: "search",
        nome: nome,
      },
    }).done(function (resposta) {
      $("#veterinarios").empty();
      var obj = $.parseJSON(resposta);

      if (obj.status != "vazio") {
        $("#conteudo").show();
        $("#semCadastro").hide();

        var total = obj.total;

        $("#total_veterinarios_busca_value").html(total);
        $("#total_resultados").hide();
        $("#total_veterinarios_busca").show();
        $("#total_veterinarios_quantidade").hide();

        for (var i = 0; i < obj.dados.length; i++) {
          if (obj.dados[i] == undefined) {
            break;
          }
          var veterinarioCodigo = obj.dados[i].veterinarioCodigo;
          var veterinarioNome = obj.dados[i].veterinarioNome;
          var veterinarioCRMVUF = obj.dados[i].veterinarioCRMVUF;
          var veterinarioTelefone = obj.dados[i].veterinarioTelefone;
          var veterinarioEspecialidade = obj.dados[i].veterinarioEspecialidade;

          fillTable(
            veterinarioCodigo,
            veterinarioNome,
            veterinarioCRMVUF,
            veterinarioTelefone,
            veterinarioEspecialidade
          );
        }
      } else {
        $("#table").hide();
        $("#aviso").show();
        $("#total_veterinarios_quantidade").hide();
        $("#total_resultados").hide();
      }
    });
  } else {
    $("#table_count").val("5");
    loadData();
  }
}

function loadData() {
  var quantidade = $("#table_count").val();
  
  $.ajax({
    method: "POST",
    url: urlCRUDVeterinario,
    data: {
      operation: "load_page",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    $("#veterinarios").empty();
    var obj = $.parseJSON(resposta);
    if (obj.status != "vazio") {
      $("#conteudo").show();
      $("#semCadastro").hide();

      var total = obj.total;
      $("#total_veterinarios").html(total);

      if (total <= 5) {
        $("#total_veterinarios_value").html(total);
        $("#total_resultados").hide();
        $("#total_veterinarios_busca").hide();
        $("#total_veterinarios_quantidade").show();
      } else {
        $("#total_resultados").show();
        $("#total_veterinarios_quantidade").hide();
        $("#total_veterinarios_busca").hide();
      }

      for (var i = 0; i < quantidade; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var veterinarioCodigo = obj.dados[i].veterinarioCodigo;
        var veterinarioNome = obj.dados[i].veterinarioNome;
        var veterinarioCRMVUF = obj.dados[i].veterinarioCRMVUF;
        var veterinarioTelefone = obj.dados[i].veterinarioTelefone;
        var veterinarioEspecialidade = obj.dados[i].veterinarioEspecialidade;

        fillTable(
          veterinarioCodigo,
          veterinarioNome,
          veterinarioCRMVUF,
          veterinarioTelefone,
          veterinarioEspecialidade
        );
      }
    } else {
      $("#conteudo").hide();
      $("#semCadastro").show();
    }
  });
}

function fillTable(
  veterinarioCodigo,
  veterinarioNome,
  veterinarioCRMVUF,
  veterinarioTelefone,
  veterinarioEspecialidade
) {
  var nova_linha = "";
  var nova_linha =
    '<tr class="item"> ' +
    '<th scope="row" class="text-center align-middle" id="veterinarioCodigo' +
    veterinarioCodigo +
    '">' +
    veterinarioCodigo +
    "</th>" +
    '<td class="align-middle text-center">' +
    veterinarioNome +
    "</td>" +
    '<td class="align-middle text-center">' +
    veterinarioCRMVUF +
    "</td>" +
    '<td class="align-middle text-center">' +
    veterinarioEspecialidade +
    "</td>" +
    '<td class="align-middle text-center">' +
    veterinarioTelefone +
    "</td>" +
    '<td class="text-center text-center">' +
    '<button class="btn btn-warning me-2" id="editar' +
    veterinarioCodigo +
    '" data-bs-toggle="modal" data-bs-target="#modalEditarVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar veterinário">' +
    '<i class="fa-solid fa-pen-to-square"></i>' +
    "</button>" +
    '<button class="btn btn-danger" id="excluir' +
    veterinarioCodigo +
    '" data-bs-toggle="modal" data-bs-target="#modalExcluirVeterinario" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir veterinário">' +
    '<i class="fa-solid fa-trash-can"></i>' +
    "</button>" +
    "</td>" +
    "</tr>";

  $("#veterinarios").append(nova_linha);
}

function updateVeterinario() {
  var veterinarioCodigo = $("#veterinarioCodigo").val();
  var veterinarioNome = $("#veterinarioNome").val();
  var veterinarioCRMV = $("#veterinarioCRMV").val();
  var veterinarioUF = $("#dropdown_estado :selected").val();
  var veterinarioEspecialidade = $("#dropdown_especialidade :selected").text();
  var veterinarioTelefone = $("#veterinarioTelefone").val();
  var veterinarioCRMV_UF = veterinarioCRMV + "-" + veterinarioUF;

  $.ajax({
    method: "POST",
    url: urlCRUDVeterinario,
    data: {
      veterinarioCodigo: veterinarioCodigo,
      veterinarioNome: veterinarioNome,
      veterinarioCRMV: veterinarioCRMV,
      veterinarioUF: veterinarioUF,
      veterinarioCRMV_UF: veterinarioCRMV_UF,
      veterinarioEspecialidade: veterinarioEspecialidade,
      veterinarioTelefone: veterinarioTelefone,
      operation: "update",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "alterado") {
      clearFillds();
      $("#modalEditarVeterinario").modal("hide");
      readAll();
      showAlertSuccess();
    } else {
      showAlertWarning();
    }
  });
}

function deleteVeterinario(codigo) {
  $.ajax({
    method: "POST",
    url: urlCRUDVeterinario,
    data: {
      codigo: codigo,
      operation: "delete",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "deletado") {
      clearFillds();
      $("#modalExcluirVeterinario").modal("hide");
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
    url: urlCRUDVeterinario,
    data: {
      codigo: codigo,
      operation: "read_one",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    var veterinarioCodigo = obj.VET_CODIGO;
    var veterinarioNome = obj.VET_NOME;
    var veterinarioCRMV = obj.VET_CRMV;
    var veterinarioTelefone = obj.VET_TELEFONE;
    var veterinarioCRMV_UF = obj.VET_CRMV_UF;
    var veterinarioEspecialidade = obj.VET_ESPECIALIDADE;
    var uf = veterinarioCRMV_UF.split("-");
    var uf = uf[1];

    if (veterinarioEspecialidade == "Clínica e Cirurgia de Pequenos Animais") {
      $("#dropdown_especialidade").val(1);
    } else if (veterinarioEspecialidade == "Dermatologia") {
      $("#dropdown_especialidade").val(2);
    } else if (veterinarioEspecialidade == "Ortopedia") {
      $("#dropdown_especialidade").val(3);
    } else if (veterinarioEspecialidade == "Clínico Geral") {
      $("#dropdown_especialidade").val(4);
    }

    $("#veterinarioCodigo").val(veterinarioCodigo);
    $("#veterinarioNome").val(veterinarioNome);
    $("#veterinarioCRMV").val(veterinarioCRMV);
    $("#dropdown_estado").val(uf);
    $("#veterinarioTelefone").val(veterinarioTelefone);

    $("#modalExcluirVeterinarioCodigo").val(veterinarioCodigo);
    $("#modalExcluirVeterinarioNome").val(veterinarioNome);
    $("#modalExcluirVeterinarioCRMV").val(veterinarioCRMV);
  });
}

function clearFillds() {
  $("#veterinarioCodigo").val("");
  $("#veterinarioNome").val("");
  $("#veterinarioCRMV").val("");
  $("#dropdown_estado").val("");
  $("#dropdown_especialidade").val("");
  $("#veterinarioTelefone").val("");

  $("#modalExcluirVeterinarioCodigo").val("");
  $("#modalExcluirVeterinarioNome").val("");
  $("#modalExcluirVeterinarioCRMV").val("");
}
