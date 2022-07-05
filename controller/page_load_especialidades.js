const urlCRUDEspecialidade = "../../model/crud_especialidade.php";

$("#especialidadeAlterado").hide();
$("#especialidadeErro").hide();
$("#especialidadeExcluido").hide();

$("#aviso").hide();
$("#semCadastro").hide();

function showAlertSuccess() {
  $("#especialidadeAlterado")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#especialidadeAlterado").fadeOut(1000);
    });
}

function showAlertSuccessDeletado() {
  $("#especialidadeExcluido")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#especialidadeExcluido").fadeOut(1000);
    });
}

function showAlertWarning() {
  $("#especialidadeErro")
    .fadeTo(3000, 500)
    .fadeIn(3000, function () {
      $("#especialidadeErro").fadeOut(3000);
    });
}

loadData();

function readAll() {
  var quantidade = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: urlCRUDEspecialidade,
    data: {
      operation: "read_all",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    $("#especialidades").empty();
    var obj = $.parseJSON(resposta);
    if (obj.total == undefined) {
      $("#conteudo").hide();
      $("#semCadastro").show();
    } else if (obj.status != "vazio") {
      var total = obj.total;

      $("#total_especialidades").html(total);

      if (total <= 5) {
        $("#total_especialidade_value").html(total);
        $("#total_resultados").hide();
        $("#total_especialidade_busca").hide();
        $("#total_especialidades_quantidade").show();
      } else {
        $("#total_resultados").show();
        $("#total_especialidades_quantidade").hide();
        $("#total_especialidade_busca").hide();
      }

      if (quantidade == "") {
        quantidade = obj.total;
      }
      for (var i = 0; i < quantidade; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var especialidadeCodigo = obj.dados[i].especialidadeCodigo;
        var especialidadeNome = obj.dados[i].especialidadeNome;

        fillTable(especialidadeCodigo, especialidadeNome);
      }
      var total = obj.total;
      $("#total_especialidades").html(total);
    }
  });
}

$("#table_count").on("change", function () {
  var total = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: urlCRUDEspecialidade,
    data: {
      operation: "read_all",
      quantidade: total,
    },
  }).done(function (resposta) {
    $("#especialidades").empty();
    var obj = $.parseJSON(resposta);

    if (obj.status != "vazio") {
      for (var i = 0; i < obj.total; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var especialidadeCodigo = obj.dados[i].especialidadeCodigo;
        var especialidadeNome = obj.dados[i].especialidadeNome;

        fillTable(especialidadeCodigo, especialidadeNome);
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
  } else if (id == "updateEspecialidade") {
    var codigo = $("#codigo").val();
    updateDono(codigo);
  } else if (id == "modalEspecialidadeExcluir") {
    var codigo = $("#modalExcluirEspecialidadeCodigo").val();
    deleteEspecialidade(codigo);
  }
});

$("#nome_search").on("keydown", function (e) {
  if (e.keyCode === 13) {
    pesquisarEspecialidade();
  }
});

$("#search").on("click", function () {
  pesquisarEspecialidade();
});

function loadData() {
  var quantidade = $("#table_count").val();

  $.ajax({
    method: "POST",
    url: urlCRUDEspecialidade,
    data: {
      operation: "load_page",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    $("#especialidades").empty();
    var obj = $.parseJSON(resposta);

    if (obj.status != "vazio") {
      $("#conteudo").show();
      $("#semCadastro").hide();

      var total = obj.total;
      $("#total_especialidades").html(total);

      if (total <= 5) {
        $("#total_especialidade_value").html(total);
        $("#total_resultados").hide();
        $("#total_especialidade_busca").hide();
        $("#total_especialidades_quantidade").show();
      } else {
        $("#total_resultados").show();
        $("#total_especialidades_quantidade").hide();
        $("#total_especialidade_busca").hide();
      }
      for (var i = 0; i < quantidade; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var especialidadeCodigo = obj.dados[i].especialidadeCodigo;
        var especialidadeNome = obj.dados[i].especialidadeNome;

        fillTable(especialidadeCodigo, especialidadeNome);
      }
    } else {
      $("#conteudo").hide();
      $("#semCadastro").show();
    }
  });
}

function pesquisarEspecialidade() {
  var nome = $("#nome_search").val();
  $("#aviso").hide();
  $("#table").show();
  if (nome != "") {
    $.ajax({
      method: "POST",
      url: urlCRUDEspecialidade,
      data: {
        operation: "search",
        nome: nome,
      },
    }).done(function (resposta) {
      $("#especialidades").empty();
      var obj = $.parseJSON(resposta);
      if (obj.status != "vazio") {
        $("#conteudo").show();
        $("#semCadastro").hide();

        var total = obj.total;

        $("#total_especialidades_busca_value").html(total);
        $("#total_resultados").hide();
        $("#total_especialidades_busca").show();
        $("#total_especialidades_quantidade").hide();

        for (var i = 0; i < obj.dados.length; i++) {
          if (obj.dados[i] == undefined) {
            break;
          }
          var especialidadeCodigo = obj.dados[i].especialidadeCodigo;
          var especialidadeNome = obj.dados[i].especialidadeNome;

          fillTable(especialidadeCodigo, especialidadeNome);
        }
      } else {
        $("#table").hide();
        $("#aviso").show();
        $("#total_especialidades_quantidade").hide();
        $("#total_resultados").hide();
      }
    });
  } else {
    $("#table_count").val("5");

    loadData();
  }
}

function fillTable(especialidadeCodigo, especialidadeNome) {
  var nova_linha = "";
  var nova_linha =
    '<tr class="item"> ' +
    '<th scope="row" class="text-center align-middle" id="especialidadeCodigo' +
    especialidadeCodigo +
    '">' +
    especialidadeCodigo +
    "</th>" +
    '<td class="align-middle text-center">' +
    especialidadeNome +
    "</td>" +
    '<td class="text-center text-center">' +
    '<button class="btn btn-warning me-2" id="editar' +
    especialidadeCodigo +
    '" data-bs-toggle="modal" data-bs-target="#modalEditarEspecialidade" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar especialidade">' +
    '<i class="fa-solid fa-pen-to-square"></i>' +
    "</button>" +
    '<button class="btn btn-danger" id="excluir' +
    especialidadeCodigo +
    '" data-bs-toggle="modal" data-bs-target="#modalEspecialidadeExcluir" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir especialidade">' +
    '<i class="fa-solid fa-trash-can"></i>' +
    "</button>" +
    "</td>" +
    "</tr>";

  $("#especialidades").append(nova_linha);
}

function updateDono() {
  var especialidadeCodigo = $("#codigo").val();
  var especialidadeNome = $("#modalNome").val();

  $.ajax({
    method: "POST",
    url: urlCRUDEspecialidade,
    data: {
      especialidadeCodigo: especialidadeCodigo,
      especialidadeNome: especialidadeNome,
      operation: "update",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "alterado") {
      clearFillds();
      $("#modalEditarEspecialidade").modal("hide");
      readAll();
      showAlertSuccess();
    } else {
      showAlertWarning();
    }
  });
}

function deleteEspecialidade(codigo) {
  $.ajax({
    method: "POST",
    url: urlCRUDEspecialidade,
    data: {
      codigo: codigo,
      operation: "delete",
    },
  }).done(function (resposta) {
    console.log(resposta);
    var obj = $.parseJSON(resposta);

    if (obj.status != "deletado") {
      $("#modalErroExcluir").modal("show");
      $("#especialidadeNaoExcluida").html(
        $("#modalExcluirEspecialidadeNome").val()
      );
    } else {
      clearFillds();
      $("#modalEspecialidadeExcluir").modal("hide");
      readAll();
      showAlertSuccessDeletado();
    }
  });
}

function fillFilds(codigo) {
  clearFillds();
  $.ajax({
    method: "POST",
    url: urlCRUDEspecialidade,
    data: {
      codigo: codigo,
      operation: "read_one",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);

    var especialidadeCodigo = obj.ESP_CODIGO;
    var especialidadeNome = obj.ESP_NOME;

    $("#codigo").val(especialidadeCodigo);
    $("#modalNome").val(especialidadeNome);

    //Modal Excluir
    $("#modalExcluirEspecialidadeCodigo").val(especialidadeCodigo);
    $("#modalExcluirEspecialidadeNome").val(especialidadeNome);
  });
}

function clearFillds() {
  $("#codigo").val("");
  $("#modalNome").val("");
  $("#modalExcluirEspecialidadeCodigo").val("");
  $("#modalExcluirEspecialidadeNome").val("");
}
