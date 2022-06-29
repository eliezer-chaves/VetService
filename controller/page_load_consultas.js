$("#consultaAlterado").hide();
$("#consultaExcluido").hide();
$("#consultaErro").hide();
$("#aviso").hide();

function showAlertSuccess() {
  $("#consultaAlterado")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#consultaAlterado").fadeOut(1000);
    });
}

function showAlertSuccessDeletado() {
  $("#consultaExcluido")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#consultaExcluido").fadeOut(1000);
    });
}

function showAlertWarning() {
  $("#consultaErro")
    .fadeTo(3000, 500)
    .fadeIn(3000, function () {
      $("#consultaErro").fadeOut(3000);
    });
}
//Load DropDown
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../../model/crud_veterinario.php",
    data: {
      operation: "load_dropdown",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);

    novo_item = "";

    Object.keys(obj).forEach((item) => {
      novo_item +=
        '<option value="' +
        obj[item].veterinarioNome +
        '" id="' +
        obj[item].veterinarioCodigo +
        '"><button>' +
        obj[item].veterinarioNome +
        "</button></option>";
    });
    $("#veterinario_opcao").append(novo_item);

    $("#veterinario_opcao").change(function () {
      var value = $("#veterinario_opcao :selected").attr("id");

      $("#veterinario_codigo").val(value);
    });
  });
});

function countTable() {
  $.ajax({
    method: "POST",
    url: "../../model/crud_consulta.php",
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

countTable();

$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../../model/crud_consulta.php",
    data: {
      operation: "load_page",
    },
  }).done(function (resposta) {
    $("#consultas").empty();
    var obj = $.parseJSON(resposta);

    var consultas = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      Object.keys(obj).forEach((item) => {
        var consulta = obj[item];
        consultas.push(consulta);
        quantidade++;
        var donoCodigo = obj[item].donoCodigo;
        var donoNome = obj[item].donoNome;
        var animalCodigo = obj[item].animalCodigo;
        var animalNome = obj[item].animalNome;
        var veterinarioCodigo = obj[item].veterinarioCodigo;
        var veterinarioNome = obj[item].veterinarioNome;
        var consultaCodigo = obj[item].consultaCodigo;
        var consultaData = obj[item].consultaData;
        var consultaHora = obj[item].consultaHora;

        var consultaData = obj[item].consultaData;

        var dia = consultaData.split("-")[0];
        var mes = consultaData.split("-")[1];
        var ano = consultaData.split("-")[2];

        consultaData =
          ("0" + ano).slice(-2) + "/" + ("0" + mes).slice(-2) + "/" + dia;

        var nova_linha = "";
        var nova_linha =
          '<tr class="item"> ' +
          '<th scope="row" class="text-center align-middle" id="animalCodigo' +
          consultaCodigo +
          '">' +
          consultaCodigo +
          "</th>" +
          '<td class="align-middle text-center">' +
          animalNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          consultaHora +
          "</td>" +
          '<td class="align-middle text-center">' +
          consultaData +
          "</td>" +
          '<td class="align-middle text-center">' +
          veterinarioNome +
          "</td>" +
          '<td class="text-center text-center">' +
          '<button class="btn btn-success me-2" id="diagnostico' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar diagnóstico">' +
          ' <i class="fa-solid fa-file-lines"></i>' +
          "</button>" +
          '<button class="btn btn-warning me-2" id="editar' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar consulta">' +
          '<i class="fa-solid fa-pen-to-square"></i>' +
          "</button>" +
          '<button class="btn btn-danger" id="excluir' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir consulta">' +
          '<i class="fa-solid fa-trash-can"></i>' +
          "</button>" +
          "</td>" +
          "</tr>";

        $("#consultas").append(nova_linha);
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
  } else if (id == "updateConsulta") {
    var codigo = $("#codigo").val();
    updateConsulta(codigo);
  } else if (id == "deleteConsulta") {
    var codigo = $("#excluirConsultaCodigo").val();
    deleteConsulta(codigo);
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
      url: "../../model/crud_consulta.php",
      data: {
        operation: "search",
        nome: nome,
        quantidade: quantidade,
      },
    }).done(function (resposta) {
      var obj = $.parseJSON(resposta);
      $("#consultas").empty();
      var obj = $.parseJSON(resposta);
      var consultas = [];
      var quantidade = 0;
      if (obj.status != "vazio") {
        Object.keys(obj).forEach((item) => {
          var consulta = obj[item];
          consultas.push(consulta);
          quantidade++;
          var donoCodigo = obj[item].donoCodigo;
          var donoNome = obj[item].donoNome;
          var animalCodigo = obj[item].animalCodigo;
          var animalNome = obj[item].animalNome;
          var veterinarioCodigo = obj[item].veterinarioCodigo;
          var veterinarioNome = obj[item].veterinarioNome;
          var consultaCodigo = obj[item].consultaCodigo;
          var consultaData = obj[item].consultaData;
          var consultaHora = obj[item].consultaHora;

          var consultaData = obj[item].consultaData;

          var dia = consultaData.split("-")[0];
          var mes = consultaData.split("-")[1];
          var ano = consultaData.split("-")[2];

          consultaData =
            ("0" + ano).slice(-2) + "/" + ("0" + mes).slice(-2) + "/" + dia;

          var nova_linha = "";
          var nova_linha =
            '<tr class="item"> ' +
            '<th scope="row" class="text-center align-middle" id="animalCodigo' +
            consultaCodigo +
            '">' +
            consultaCodigo +
            "</th>" +
            '<td class="align-middle text-center">' +
            animalNome +
            "</td>" +
            '<td class="align-middle text-center">' +
            donoNome +
            "</td>" +
            '<td class="align-middle text-center">' +
            consultaHora +
            "</td>" +
            '<td class="align-middle text-center">' +
            consultaData +
            "</td>" +
            '<td class="align-middle text-center">' +
            veterinarioNome +
            "</td>" +
            '<td class="text-center text-center">' +
            '<button class="btn btn-success me-2" id="diagnostico' +
            consultaCodigo +
            '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar diagnóstico">' +
            ' <i class="fa-solid fa-file-lines"></i>' +
            "</button>" +
            '<button class="btn btn-warning me-2" id="editar' +
            consultaCodigo +
            '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar consulta">' +
            '<i class="fa-solid fa-pen-to-square"></i>' +
            "</button>" +
            '<button class="btn btn-danger" id="excluir' +
            consultaCodigo +
            '" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir consulta">' +
            '<i class="fa-solid fa-trash-can"></i>' +
            "</button>" +
            "</td>" +
            "</tr>";

          $("#consultas").append(nova_linha);
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
    url: "../../model/crud_consulta.php",
    data: {
      operation: "search",
      nome: nome,
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    $("#consultas").empty();
    var consultas = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      Object.keys(obj).forEach((item) => {
        var consulta = obj[item];
        consultas.push(consulta);
        quantidade++;
        var donoCodigo = obj[item].donoCodigo;
        var donoNome = obj[item].donoNome;
        var animalCodigo = obj[item].animalCodigo;
        var animalNome = obj[item].animalNome;
        var veterinarioCodigo = obj[item].veterinarioCodigo;
        var veterinarioNome = obj[item].veterinarioNome;
        var consultaCodigo = obj[item].consultaCodigo;
        var consultaData = obj[item].consultaData;
        var consultaHora = obj[item].consultaHora;

        var consultaData = obj[item].consultaData;

        var dia = consultaData.split("-")[0];
        var mes = consultaData.split("-")[1];
        var ano = consultaData.split("-")[2];

        consultaData =
          ("0" + ano).slice(-2) + "/" + ("0" + mes).slice(-2) + "/" + dia;

        var nova_linha = "";
        var nova_linha =
          '<tr class="item"> ' +
          '<th scope="row" class="text-center align-middle" id="animalCodigo' +
          consultaCodigo +
          '">' +
          consultaCodigo +
          "</th>" +
          '<td class="align-middle text-center">' +
          animalNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          consultaHora +
          "</td>" +
          '<td class="align-middle text-center">' +
          consultaData +
          "</td>" +
          '<td class="align-middle text-center">' +
          veterinarioNome +
          "</td>" +
          '<td class="text-center text-center">' +
          '<button class="btn btn-success me-2" id="diagnostico' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar diagnóstico">' +
          ' <i class="fa-solid fa-file-lines"></i>' +
          "</button>" +
          '<button class="btn btn-warning me-2" id="editar' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar consulta">' +
          '<i class="fa-solid fa-pen-to-square"></i>' +
          "</button>" +
          '<button class="btn btn-danger" id="excluir' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir consulta">' +
          '<i class="fa-solid fa-trash-can"></i>' +
          "</button>" +
          "</td>" +
          "</tr>";

        $("#consultas").append(nova_linha);
      });
    } else {
      $("#table").hide();
      $("#aviso").show();
    }
  });
});

//Completar campo de animal

$(document).ready(function () {
  $("#editarAnimalNome").keyup(function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "../../model/crud_consulta.php",
        method: "POST",
        data: {
          query: searchText,
          operation: "read_animal_fk",
        },
      }).done(function (resposta) {
        var obj = $.parseJSON(resposta);
        var nova_linha = "";
        $("#resultado").html("");

        Object.keys(obj).forEach((item) => {
          nova_linha +=
            '<button class="list-group-item list-group-item-action " ' +
            'id="donoTelefone' +
            obj[item].donoTelefone +
            "_donoCPF" +
            obj[item].donoCPF +
            "_donoCodigo" +
            obj[item].donoCodigo +
            "_donoNome" +
            obj[item].donoNome +
            "_animalNome" +
            obj[item].animalNome +
            "_animalCodigo" +
            obj[item].animalCodigo +
            '">' +
            obj[item].animalNome +
            " - " +
            obj[item].donoNome +
            "</button><span></span>";
        });
        var stringExemplo = nova_linha;
        var resultado = stringExemplo.split("<span></span>");

        $("#resultado").append(resultado);
      });
    } else {
      $("#resultado").html("");
    }
  });

  $(document).on("click", "button", function (element) {
    var id = element.currentTarget.id;

    var array = id.split("_");

    if (id.includes("donoCodigo")) {
      $("#resultado").html("");
      var telefone = array[0].replace("donoTelefone", "");
      var cpf = array[1].replace("donoCPF", "");
      var donoCodigo = array[2].replace("donoCodigo", "");
      var donoNome = array[3].replace("donoNome", "");
      var animalNome = array[4].replace("animalNome", "");
      var animalCodigo = array[5].replace("animalCodigo", "");

      $("#editarAnimalNome").val(animalNome);
      $("#editarAnimalCodigo").val(animalCodigo);
      $("#editarNomeDono").val(donoNome);
      $("#editarCodigoDono").val(donoCodigo);
    }
  });
});

//Auto complete

var total;
$("#table_count").on("change", function () {
  var total = this.value;
  $.ajax({
    method: "POST",
    url: "../../model/crud_consulta.php",
    data: {
      operation: "read_all",
      quantidade: total,
    },
  }).done(function (resposta) {
    $("#consultas").empty();
    var obj = $.parseJSON(resposta);
    var consultas = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      Object.keys(obj).forEach((item) => {
        var consulta = obj[item];
        consultas.push(consulta);
        quantidade++;
        var donoCodigo = obj[item].donoCodigo;
        var donoNome = obj[item].donoNome;
        var animalCodigo = obj[item].animalCodigo;
        var animalNome = obj[item].animalNome;
        var veterinarioCodigo = obj[item].veterinarioCodigo;
        var veterinarioNome = obj[item].veterinarioNome;
        var consultaCodigo = obj[item].consultaCodigo;
        var consultaData = obj[item].consultaData;
        var consultaHora = obj[item].consultaHora;

        var consultaData = obj[item].consultaData;

        var dia = consultaData.split("-")[0];
        var mes = consultaData.split("-")[1];
        var ano = consultaData.split("-")[2];

        consultaData =
          ("0" + ano).slice(-2) + "/" + ("0" + mes).slice(-2) + "/" + dia;

        var nova_linha = "";
        var nova_linha =
          '<tr class="item"> ' +
          '<th scope="row" class="text-center align-middle" id="animalCodigo' +
          consultaCodigo +
          '">' +
          consultaCodigo +
          "</th>" +
          '<td class="align-middle text-center">' +
          animalNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          consultaHora +
          "</td>" +
          '<td class="align-middle text-center">' +
          consultaData +
          "</td>" +
          '<td class="align-middle text-center">' +
          veterinarioNome +
          "</td>" +
          '<td class="text-center text-center">' +
          '<button class="btn btn-success me-2" id="diagnostico' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar diagnóstico">' +
          ' <i class="fa-solid fa-file-lines"></i>' +
          "</button>" +
          '<button class="btn btn-warning me-2" id="editar' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar consulta">' +
          '<i class="fa-solid fa-pen-to-square"></i>' +
          "</button>" +
          '<button class="btn btn-danger" id="excluir' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir consulta">' +
          '<i class="fa-solid fa-trash-can"></i>' +
          "</button>" +
          "</td>" +
          "</tr>";

        $("#consultas").append(nova_linha);
      });
    }
  });
});

function loadData() {
  quantidade = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: "../../model/crud_consulta.php",
    data: {
      operation: "load_page",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    countTable();
    $("#consultas").empty();
    var obj = $.parseJSON(resposta);
    var consultas = [];
    var quantidade = 0;
    if (obj.status != "vazio") {
      Object.keys(obj).forEach((item) => {
        var consulta = obj[item];
        consultas.push(consulta);
        quantidade++;
        var donoCodigo = obj[item].donoCodigo;
        var donoNome = obj[item].donoNome;
        var animalCodigo = obj[item].animalCodigo;
        var animalNome = obj[item].animalNome;
        var veterinarioCodigo = obj[item].veterinarioCodigo;
        var veterinarioNome = obj[item].veterinarioNome;
        var consultaCodigo = obj[item].consultaCodigo;
        var consultaData = obj[item].consultaData;
        var consultaHora = obj[item].consultaHora;

        var consultaData = obj[item].consultaData;

        var dia = consultaData.split("-")[0];
        var mes = consultaData.split("-")[1];
        var ano = consultaData.split("-")[2];

        consultaData =
          ("0" + ano).slice(-2) + "/" + ("0" + mes).slice(-2) + "/" + dia;

        var nova_linha = "";
        var nova_linha =
          '<tr class="item"> ' +
          '<th scope="row" class="text-center align-middle" id="animalCodigo' +
          consultaCodigo +
          '">' +
          consultaCodigo +
          "</th>" +
          '<td class="align-middle text-center">' +
          animalNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          donoNome +
          "</td>" +
          '<td class="align-middle text-center">' +
          consultaHora +
          "</td>" +
          '<td class="align-middle text-center">' +
          consultaData +
          "</td>" +
          '<td class="align-middle text-center">' +
          veterinarioNome +
          "</td>" +
          '<td class="text-center text-center">' +
          '<button class="btn btn-success me-2" id="diagnostico' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar diagnóstico">' +
          ' <i class="fa-solid fa-file-lines"></i>' +
          "</button>" +
          '<button class="btn btn-warning me-2" id="editar' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalEditarConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar consulta">' +
          '<i class="fa-solid fa-pen-to-square"></i>' +
          "</button>" +
          '<button class="btn btn-danger" id="excluir' +
          consultaCodigo +
          '" data-bs-toggle="modal" data-bs-target="#modalExcluirConsulta" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir consulta">' +
          '<i class="fa-solid fa-trash-can"></i>' +
          "</button>" +
          "</td>" +
          "</tr>";

        $("#consultas").append(nova_linha);
      });

      if (quantidade < 5) {
        $("#total_resultados").hide();
      } else {
        $("#total_resultados").show();
      }
    }
  });
}

function updateConsulta() {
  var animalCodigo = $("#editarAnimalCodigo").val();
  var consultaCodigo = $("#editarConsultaCodigo").val();
  var veterinarioCodigo = $("#veterinario_codigo").val();
  var consultaData = $("#editarDataConsulta").val();
  var consultaHora = $("#editarHoraConsulta").val();

  $.ajax({
    method: "POST",
    url: "../../model/crud_consulta.php",
    data: {
      animalCodigo: animalCodigo,
      consultaCodigo: consultaCodigo,
      veterinarioCodigo: veterinarioCodigo,
      consultaData: consultaData,
      consultaHora: consultaHora,
      operation: "update",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "alterado") {
      clearFillds();
      $("#modalEditarConsulta").modal("hide");
      loadData();
      showAlertSuccess();
    } else {
      showAlertWarning();
    }
  });
}

function deleteConsulta(codigo) {
  $.ajax({
    method: "POST",
    url: "../../model/crud_consulta.php",
    data: {
      codigo: codigo,
      operation: "delete",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "deletado") {
      clearFillds();
      $("#modalExcluirConsulta").modal("hide");
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
    url: "../../model/crud_consulta.php",
    data: {
      codigo: codigo,
      operation: "read_one",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    var donoCodigo = obj.DON_CODIGO;
    var donoNome = obj.DON_NOME;
    var animalCodigo = obj.ANI_CODIGO;
    var animalNome = obj.ANI_NOME;

    var veterinarioCodigo = obj.VET_CODIGO;
    var veterinarioNome = obj.VET_NOME;

    var consultaCodigo = obj.CON_CODIGO;
    var consultaData = obj.CON_DATA;
    var consultaHora = obj.CON_HORA;

    //Modal Editar
    $("#editarConsultaCodigo").val(consultaCodigo);
    $("#editarAnimalCodigo").val(animalCodigo);
    $("#editarAnimalNome").val(animalNome);
    $("#editarCodigoDono").val(donoCodigo);
    $("#editarNomeDono").val(donoNome);
    $("#editarDataConsulta").val(consultaData);
    $("#editarHoraConsulta").val(consultaHora);
    $("#veterinario_opcao").val(veterinarioNome);
    $("#veterinario_codigo").val(veterinarioCodigo);

    var dia = consultaData.split("-")[0];
    var mes = consultaData.split("-")[1];
    var ano = consultaData.split("-")[2];

    consultaData =
      ("0" + ano).slice(-2) + "/" + ("0" + mes).slice(-2) + "/" + dia;

    //Modal Excluir
    $("#excluirConsultaCodigo").val(consultaCodigo);
    $("#excluirAnimalCodigo").val(animalCodigo);
    $("#excluirAnimalNome").val(animalNome);
    $("#excluirDonoCodigo").val(donoCodigo);
    $("#excluirDonoNome").val(donoNome);
    $("#excluirConsultaData").val(consultaData);
    $("#editarHoraConsulta").val(consultaHora);
    $("#excluirVeterinarioNome").val(veterinarioNome);
    $("#excluirVeterinarioCodigo").val(veterinarioCodigo);
  });
}

function clearFillds() {
  //Modal Editar
  $("#editarConsultaCodigo").val("");
  $("#editarAnimalCodigo").val("");
  $("#editarAnimalNome").val("");
  $("#editarCodigoDono").val("");
  $("#editarNomeDono").val("");
  $("#editarDataConsulta").val("");
  $("#editarHoraConsulta").val("");
  $("#veterinario_opcao").val("");
  $("#veterinario_codigo").val("");

  //Modal Excluir
  $("#excluirConsultaCodigo").val("");
  $("#excluirAnimalCodigo").val("");
  $("#excluirAnimalNome").val("");
  $("#excluirDonoCodigo").val("");
  $("#excluirDonoNome").val("");
  $("#excluirConsultaData").val("");
  $("#editarHoraConsulta").val("");
  $("#excluirVeterinarioNome").val("");
  $("#excluirVeterinarioCodigo").val("");
}
