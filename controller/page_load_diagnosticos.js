const urlCRUDVeterinario = "../../model/crud_veterinario.php";
const urlCRUDConsulta = "../../model/crud_consulta.php";
const urlCRUDDiagnostico = "../../model/crud_diagnostico.php";

$("#diagnosticoAlterado").hide();
$("#diagnosticoExcluido").hide();
$("#diagnosticoErro").hide();
$("#aviso").hide();
$("#semConsulta").hide();

function showAlertSuccess() {
  $("#diagnosticoAlterado")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#diagnosticoAlterado").fadeOut(1000);
    });
}

function showAlertSuccessDeletado() {
  $("#diagnosticoExcluido")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#diagnosticoExcluido").fadeOut(1000);
    });
}

function showAlertWarning() {
  $("#diagnosticoErro")
    .fadeTo(3000, 500)
    .fadeIn(3000, function () {
      $("#diagnosticoErro").fadeOut(3000);
    });
}

//Load DropDown
/* $(document).ready(function () {
  $.ajax({
    method: "POST",
    url: urlCRUDVeterinario,
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
        "_" +
        obj[item].veterinarioEspecialidade +
        "_" +
        obj[item].veterinarioEspecialidadeCodigo +
        '" name="' +
        obj[item].veterinarioEspecialidade +
        "-" +
        obj[item].veterinarioEspecialidadeCodigo +
        '"><button>' +
        obj[item].veterinarioNome +
        "</button></option>";
    });
    $("#veterinario_opcao").append(novo_item);
    $("#modal_veterinario_opcao").append(novo_item);

    $("#veterinario_opcao").change(function () {
      var data = $("#veterinario_opcao :selected").attr("id");
      var veterinarioCodigo = data.split("_")[0];
      var especialidade = data.split("_")[1];
      var codigo = data.split("_")[2];
      if (veterinarioCodigo == "veterinario") {
        veterinarioCodigo = "";
      }

      $("#filtro_veterinario_codigo").val(veterinarioCodigo);
      $("#veterinario_especialidade").val(especialidade);
      $("#especialidadeCodigo").val(codigo);
      filterTable(veterinarioCodigo);
    });

    $("#modal_veterinario_opcao").change(function () {
      var veterinarioCodigo = $("#modal_veterinario_opcao :selected").attr(
        "id"
      );
      var especialidade = $("#modal_veterinario_opcao :selected").attr("name");

      var especialidadeNome = especialidade.split("-")[0];
      var codigo = especialidade.split("-")[1];

      //$("#modal_veterinario_opcao").val(veterinarioNome);
      $("#modal_veterinario_codigo").val(veterinarioCodigo);
      $("#modal_veterinario_especialidade").val(especialidadeNome);
      $("#modal_especialidadeCodigo").val(codigo);
    });
  });
}); */

/* function filterTable(veterinarioCodigo) {
  var quantidade = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: urlCRUDConsulta,
    data: {
      operation: "filter_table",
      veterinarioCodigo: veterinarioCodigo,
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    $("#diagnosticos").empty();

    var obj = $.parseJSON(resposta);

    if (obj.total == undefined) {
      $("#conteudo").hide();
      $("#semConsulta").show();
    } else if (obj.status != "vazio") {
      var total = obj.total;

      $("#total_consultas").html(total);

      if (total <= 5) {
        $("#total_consultas_value").html(total);
        $("#total_resultados").hide();
        $("#total_consultas_busca").hide();
        $("#total_consultas_quantidade").show();
      } else {
        $("#total_resultados").show();
        $("#total_consultas_quantidade").hide();
        $("#total_consultas_busca").hide();
      }

      for (var i = 0; i < obj.total; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var donoNome = obj.dados[i].donoNome;
        var animalNome = obj.dados[i].animalNome;
        var veterinarioNome = obj.dados[i].veterinarioNome;
        var veterinarioEspecialidade = obj.dados[i].veterinarioEspecialidade;
        var consultaCodigo = obj.dados[i].consultaCodigo;
        var consultaData = obj.dados[i].consultaData;
        var consultaHora = obj.dados[i].consultaHora;
        var consultaData = obj.dados[i].consultaData;

        fillTable(
          donoNome,
          animalNome,
          veterinarioNome,
          consultaCodigo,
          consultaData,
          consultaHora,
          veterinarioEspecialidade
        );
      }
      var total = obj.total;
      $("#total_consultas").html(total);
    }
  });
} */

loadData();

function readAll() {
  var quantidade = $("#table_count").val();

  $.ajax({
    method: "POST",
    url: urlCRUDDiagnostico,
    data: {
      operation: "read_all",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    $("#diagnosticos").empty();

    var obj = $.parseJSON(resposta);

    if (obj.total == undefined) {
      $("#conteudo").hide();
      $("#semConsulta").show();
    } else if (obj.status != "vazio") {
      var total = obj.total;

      $("#total_consultas").html(total);

      if (total <= 5) {
        $("#total_consultas_value").html(total);
        $("#total_resultados").hide();
        $("#total_consultas_busca").hide();
        $("#total_consultas_quantidade").show();
      } else {
        $("#total_resultados").show();
        $("#total_consultas_quantidade").hide();
        $("#total_consultas_busca").hide();
      }
      if (quantidade == "") {
        quantidade = obj.total;
      }
      for (var i = 0; i < quantidade; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var donoNome = obj.dados[i].donoNome;
        var animalNome = obj.dados[i].animalNome;
        var veterinarioNome = obj.dados[i].veterinarioNome;
        var consultaData = obj.dados[i].consultaData;
        var consultaHora = obj.dados[i].consultaHora;
        var consultaData = obj.dados[i].consultaData;
        var diagnosticoCodigo = obj.dados[i].diagnosticoCodigo;

        fillTable(
          donoNome,
          animalNome,
          veterinarioNome,
          consultaData,
          consultaHora,
          diagnosticoCodigo
        );
      }
      var total = obj.total;
      $("#total_consultas").html(total);
    }
  });
}

$(document).on("click", "button", function (element) {
  var id = element.currentTarget.id;
  if (id.includes("editar")) {
    var codigo = id.replace("editar", "");
    fillFilds(codigo);
  } else if (id.includes("excluir")) {
    var codigo = id.replace("excluir", "");
    fillFilds(codigo);
  } else if (id == "updateDiagnostico") {
    var codigo = $("#codigo").val();
    updateDiagnostico(codigo);
  } else if (id == "deleteDiagnostico") {
    var codigo = $("#modalExcluirDiagnosticoCodigo").val();
    deleteConsulta(codigo);
  } else if (id.includes("diagnostico")) {
    var codigo = id.replace("diagnostico", "");
    setCookie("codigoConsulta", codigo);
    window.location.href = "../../view/pages/add_diagnostico.php";
  }
});

/* function setCookie(name, value) {
  var now = new Date();
  var minutes = 30;
  now.setTime(now.getTime() + minutes * 60 * 1000);

  var meuCookie = name + "=" + value + ";";

  document.cookie = meuCookie;
} */

function pesquisarDiagnostico() {
  var nome = $("#nome_search").val();
  $("#aviso").hide();
  $("#table").show();

  if (nome != "") {
    $.ajax({
      method: "POST",
      url: urlCRUDDiagnostico,
      data: {
        operation: "search",
        nome: nome,
      },
    }).done(function (resposta) {
      var obj = $.parseJSON(resposta);
      $("#diagnosticos").empty();

      if (obj.status != "vazio") {
        $("#conteudo").show();
        $("#semConsulta").hide();

        var total = obj.total;

        $("#total_consultas_busca_value").html(total);
        $("#total_resultados").hide();
        $("#total_consultas_busca").show();
        $("#total_consultas_quantidade").hide();
        $("#filtro").hide();

        for (var i = 0; i < obj.dados.length; i++) {
          if (obj.dados[i] == undefined) {
            break;
          }
          var donoNome = obj.dados[i].donoNome;
          var animalNome = obj.dados[i].animalNome;
          var veterinarioNome = obj.dados[i].veterinarioNome;
          var consultaData = obj.dados[i].consultaData;
          var consultaHora = obj.dados[i].consultaHora;
          var diagnosticoCodigo = obj.dados[i].diagnosticoCodigo;

          fillTable(
            donoNome,
            animalNome,
            veterinarioNome,
            consultaData,
            consultaHora,
            diagnosticoCodigo
          );
        }
      } else {
        $("#table").hide();
        $("#aviso").show();
        $("#total_consultas_quantidade").hide();
        $("#total_resultados").hide();
        $("#filtro").hide();
      }
    });
  } else {
    $("#table_count").val("5");
    $("#filtro").show();
    loadData();
  }
}

$("#nome_search").on("keydown", function (e) {
  if (e.keyCode === 13) {
    pesquisarDiagnostico();
  }
});

$("#search").click(function () {
  pesquisarDiagnostico();
});

/* $(document).ready(function () {
  $("#editarAnimalNome").keyup(function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: urlCRUDConsulta,
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
}); */

$("#table_count").on("change", function () {
  var total = $("#table_count").val();

  $.ajax({
    method: "POST",
    url: urlCRUDDiagnostico,
    data: {
      operation: "read_all",
      quantidade: total,
    },
  }).done(function (resposta) {
    $("#diagnosticos").empty();
    var obj = $.parseJSON(resposta);

    if (obj.status != "vazio") {
      for (var i = 0; i < obj.total; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var donoNome = obj.dados[i].donoNome;
        var animalNome = obj.dados[i].animalNome;
        var veterinarioNome = obj.dados[i].veterinarioNome;
        var consultaData = obj.dados[i].consultaData;
        var consultaHora = obj.dados[i].consultaHora;
        var diagnosticoCodigo = obj.dados[i].diagnosticoCodigo;

        fillTable(
          donoNome,
          animalNome,
          veterinarioNome,
          consultaData,
          consultaHora,
          diagnosticoCodigo
        );
      }
    }
  });
});

function loadData() {
  var quantidade = $("#table_count").val();

  $.ajax({
    method: "POST",
    url: urlCRUDDiagnostico,
    data: {
      operation: "load_page",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    $("#diagnosticos").empty();

    var obj = $.parseJSON(resposta);

    if (obj.status != "vazio") {
      $("#conteudo").show();
      $("#semConsulta").hide();

      var total = obj.total;
      $("#total_consultas").html(total);

      if (total <= 5) {
        $("#total_consultas_value").html(total);
        $("#total_resultados").hide();
        $("#total_consultas_busca").hide();
        $("#total_consultas_quantidade").show();
      } else {
        $("#total_resultados").show();
        $("#total_consultas_quantidade").hide();
        $("#total_consultas_busca").hide();
      }

      for (var i = 0; i < quantidade; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var donoNome = obj.dados[i].donoNome;
        var animalNome = obj.dados[i].animalNome;
        var veterinarioNome = obj.dados[i].veterinarioNome;
        var consultaData = obj.dados[i].consultaData;
        var consultaHora = obj.dados[i].consultaHora;

        var diagnosticoCodigo = obj.dados[i].diagnosticoCodigo;

        fillTable(
          donoNome,
          animalNome,
          veterinarioNome,
          consultaData,
          consultaHora,
          diagnosticoCodigo
        );
      }
    } else {
      $("#conteudo").hide();
      $("#semConsulta").show();
    }
  });
}

function fillTable(
  donoNome,
  animalNome,
  veterinarioNome,
  consultaData,
  consultaHora,
  diagnosticoCodigo
) {
  var array = veterinarioNome.split(" ");
  var veterinarioFirstNome = array[0];
  var veterinarioLastName = array.at(-1);

  veterinarioNome = veterinarioFirstNome + " " + veterinarioLastName;

  var hora = consultaHora.split(":")[0];
  var minuto = consultaHora.split(":")[1];

  consultaHora = hora + ":" + minuto;

  var dia = consultaData.split("-")[0];
  var mes = consultaData.split("-")[1];
  var ano = consultaData.split("-")[2];
  consultaData =
    ("0" + ano).slice(-2) + "/" + ("0" + mes).slice(-2) + "/" + dia;

  var nova_linha = "";
  var nova_linha =
    '<tr class="item"> ' +
    '<th scope="row" class="text-center align-middle" id="diagnosticoCodigo' +
    diagnosticoCodigo +
    '">' +
    diagnosticoCodigo +
    "</th>" +
    '<td class="align-middle text-center">' +
    animalNome +
    "</td>" +
    '<td class="align-middle text-center">' +
    donoNome +
    "</td>" +
    '<td class="align-middle text-center">' +
    veterinarioNome +
    "</td>" +
    '<td class="align-middle text-center">' +
    consultaData +
    "</td>" +
    '<td class="align-middle text-center">' +
    consultaHora +
    "</td>" +
    '<td class="text-center text-center">' +
    '<button class="btn btn-success me-2" id="editar' +
    diagnosticoCodigo +
    '" data-bs-toggle="modal" data-bs-target="#modalEditarDiagnostico" data-bs-toggle="tooltip" data-bs-placement="top" title="Visualizar diagnóstico">' +
    '<i class="fa-solid fa-magnifying-glass"></i>' +
    "</button>" +
    '<button class="btn btn-danger" id="excluir' +
    diagnosticoCodigo +
    '" data-bs-toggle="modal" data-bs-target="#modalExcluirDiagnostico" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir diagnóstico">' +
    '<i class="fa-solid fa-trash-can"></i>' +
    "</button>" +
    "</td>" +
    "</tr>";

  $("#diagnosticos").append(nova_linha);
}

function updateDiagnostico() {
  //var animalCodigo = $("#modalCodigoAnimal").val();
  //var consultaCodigo = $("#editarConsultaCodigo").val();

  var diagnosticoCodigo = $("#diagnosticoCodigo").val();
  var peso = $("#peso").val();
  var altura = $("#altura").val();
  var bpm = $("#bpm").val();
  var temperatura = $("#temperatura").val();
  var pressao = $("#pressao").val();
  var sintomas = $("#sintomas").val();

  $.ajax({
    method: "POST",
    url: urlCRUDDiagnostico,
    data: {
      diagnosticoCodigo: diagnosticoCodigo,
      peso: peso,
      altura: altura,
      bpm: bpm,
      temperatura: temperatura,
      pressao: pressao,
      sintomas: sintomas,
      operation: "update",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "alterado") {
      clearFillds();
      $("#modalEditarDiagnostico").modal("hide");
      readAll();
      showAlertSuccess();
    } else {
      showAlertWarning();
    }
  });
}

function deleteConsulta(codigo) {
  $.ajax({
    method: "POST",
    url: urlCRUDDiagnostico,
    data: {
      codigo: codigo,
      operation: "delete",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "deletado") {
      clearFillds();
      $("#modalExcluirConsulta").modal("hide");
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
    url: urlCRUDDiagnostico,
    data: {
      codigo: codigo,
      operation: "read_one",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    var donoNome = obj.DON_NOME;
    var animalCodigo = obj.ANI_CODIGO;
    var animalNome = obj.ANI_NOME;

    var consultaData = obj.CON_DATA;
    var consultaHora = obj.CON_HORA;
    var consultaCodigo = obj.CON_CODIGO;

    var diagnosticoCodigo = obj.DIG_CODIGO;
    var peso = obj.DIG_PESO;
    var altura = obj.DIG_ALTURA;
    var bpm = obj.DIG_BPM;
    var temperatura = obj.DIG_TEMPERATURA;
    var pressao = obj.DIG_PRESSAO;
    var sintomas = obj.DIG_SINTOMAS;

    //Modal Editar
    $("#modalCodigoAnimal").val(animalCodigo);
    $("#modalNomeAnimal").val(animalNome);
    $("#modalNomeDono").val(donoNome);

    $("#consultaCodigo").val(consultaCodigo);
    $("#dataConsulta").val(consultaData);
    $("#horaConsulta").val(consultaHora);

    $("#diagnosticoCodigo").val(diagnosticoCodigo);
    $("#peso").val(peso);
    $("#altura").val(altura);
    $("#bpm").val(bpm);
    $("#temperatura").val(temperatura);
    $("#pressao").val(pressao);
    $("#sintomas").val(sintomas);

    var dia = consultaData.split("-")[0];
    var mes = consultaData.split("-")[1];
    var ano = consultaData.split("-")[2];

    consultaData =
      ("0" + ano).slice(-2) + "/" + ("0" + mes).slice(-2) + "/" + dia;

    //Modal Excluir
    $("#modalExcluirDiagnosticoCodigo").val(diagnosticoCodigo);
    $("#modalExcluirAnimalDonoNome").val(donoNome);
    $("#modalExcluirAnimalNome").val(animalNome);
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
  $("#hora_consulta_fim").val("");
  $("#veterinario_opcao").val("");
  $("#veterinario_codigo").val("");
  $("#veterinario_especialidade").val("");
  $("#especialidadeCodigo").val("");

  //Modal Excluir
  $("#modalExcluirDiagnosticoCodigo").val("");
  $("#modalExcluirAnimalDonoNome").val("");
  $("#modalExcluirAnimalNome").val("");
}
