$("#veterinarioAlterado").hide();
$("#veterinarioErro").hide();
$("#veterinarioExcluido").hide();
$("#aviso").hide();

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
countTable();

function countTable() {
  $.ajax({
    method: "POST",
    url: "../../model/crud_veterinario.php",
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
    url: "../../model/crud_veterinario.php",
    data: {
      operation: "load_page",
    },
  }).done(function (resposta) {
    $("#veterinarios").empty();
    var obj = $.parseJSON(resposta);
    var veterinarios = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      Object.keys(obj).forEach((item) => {
        var veterinario = obj[item];
        veterinarios.push(veterinario);
        quantidade++;

        var veterinarioCodigo = obj[item].veterinarioCodigo;
        var veterinarioNome = obj[item].veterinarioNome;
        var veterinarioCRMV = obj[item].veterinarioCRMV;
        var veterinarioCRMVUF = obj[item].veterinarioCRMVUF;
        var veterinarioTelefone = obj[item].veterinarioTelefone;
        var veterinarioEspecialidade = obj[item].veterinarioEspecialidade;

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
      });

      if (quantidade < 5) {
        $("#total_resultados").hide();
      } else {
        $("#total_resultados").show();
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
      url: "../../model/crud_veterinario.php",
      data: {
        operation: "search",
        nome: nome,
        quantidade: quantidade,
      },
    }).done(function (resposta) {
      var obj = $.parseJSON(resposta);
      $("#veterinarios").empty();
      var obj = $.parseJSON(resposta);
      var veterinarios = [];
      var quantidade = 0;
      if (obj.status != "vazio") {
        Object.keys(obj).forEach((item) => {
          var veterinario = obj[item];
          veterinarios.push(veterinario);
          quantidade++;

          var veterinarioCodigo = obj[item].veterinarioCodigo;
          var veterinarioNome = obj[item].veterinarioNome;
          var veterinarioCRMV = obj[item].veterinarioCRMV;
          var veterinarioCRMVUF = obj[item].veterinarioCRMVUF;
          var veterinarioTelefone = obj[item].veterinarioTelefone;
          var veterinarioEspecialidade = obj[item].veterinarioEspecialidade;

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
        });
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
    url: "../../model/crud_veterinario.php",
    data: {
      operation: "search",
      nome: nome,
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    $("#veterinarios").empty();
    var veterinarios = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      Object.keys(obj).forEach((item) => {
        var veterinario = obj[item];
        veterinarios.push(veterinario);
        quantidade++;

        var veterinarioCodigo = obj[item].veterinarioCodigo;
        var veterinarioNome = obj[item].veterinarioNome;
        var veterinarioCRMV = obj[item].veterinarioCRMV;
        var veterinarioCRMVUF = obj[item].veterinarioCRMVUF;
        var veterinarioTelefone = obj[item].veterinarioTelefone;
        var veterinarioEspecialidade = obj[item].veterinarioEspecialidade;

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
      });
    } else {
      $("#table").hide();
      $("#aviso").show();
    }
  });
});

var total;
$("#table_count").on("change", function () {
  var total = this.value;
  $.ajax({
    method: "POST",
    url: "../../model/crud_veterinario.php",
    data: {
      operation: "read_all",
      quantidade: total,
    },
  }).done(function (resposta) {
    $("#veterinarios").empty();
    var obj = $.parseJSON(resposta);
    var veterinarios = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      Object.keys(obj).forEach((item) => {
        var veterinario = obj[item];
        veterinarios.push(veterinario);
        quantidade++;

        var veterinarioCodigo = obj[item].veterinarioCodigo;
        var veterinarioNome = obj[item].veterinarioNome;
        var veterinarioCRMV = obj[item].veterinarioCRMV;
        var veterinarioCRMVUF = obj[item].veterinarioCRMVUF;
        var veterinarioTelefone = obj[item].veterinarioTelefone;
        var veterinarioEspecialidade = obj[item].veterinarioEspecialidade;

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
      });
    }
  });
});

function loadData() {
  quantidade = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: "../../model/crud_veterinario.php",
    data: {
      operation: "load_page",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    countTable();
    $("#veterinarios").empty();
    var obj = $.parseJSON(resposta);
    var veterinarios = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      Object.keys(obj).forEach((item) => {
        var veterinario = obj[item];
        veterinarios.push(veterinario);
        quantidade++;

        var veterinarioCodigo = obj[item].veterinarioCodigo;
        var veterinarioNome = obj[item].veterinarioNome;
        var veterinarioCRMV = obj[item].veterinarioCRMV;
        var veterinarioCRMVUF = obj[item].veterinarioCRMVUF;
        var veterinarioTelefone = obj[item].veterinarioTelefone;
        var veterinarioEspecialidade = obj[item].veterinarioEspecialidade;

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
      });

      if (quantidade < 5) {
        $("#total_resultados").hide();
      } else {
        $("#total_resultados").show();
      }
    }
  });
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
    url: "../../model/crud_veterinario.php",
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
      loadData();
      showAlertSuccess();
    } else {
      showAlertWarning();
    }
  });
}

function deleteVeterinario(codigo) {
  $.ajax({
    method: "POST",
    url: "../../model/crud_veterinario.php",
    data: {
      codigo: codigo,
      operation: "delete",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "deletado") {
      clearFillds();
      $("#modalExcluirVeterinario").modal("hide");
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
    url: "../../model/crud_veterinario.php",
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
