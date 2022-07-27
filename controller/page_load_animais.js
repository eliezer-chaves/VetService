const urlCRUDAnimal = "../../model/crud_animal.php";

modalNascimentoAnimal.max = new Date().toISOString().split("T")[0];
$("#animalAlterado").hide();
$("#animalErro").hide();
$("#animalExcluido").hide();
$("#aviso").hide();

$("#semCadastro").hide();

function showAlertSuccess() {
  $("#animalAlterado")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#animalAlterado").fadeOut(1000);
    });
}

function showAlertSuccessDeletado() {
  $("#animalExcluido")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#animalExcluido").fadeOut(1000);
    });
}

function showAlertWarning() {
  $("#animalErro")
    .fadeTo(3000, 500)
    .fadeIn(3000, function () {
      $("#animalErro").fadeOut(3000);
    });
}

loadData();

function readAll() {
  var quantidade = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: urlCRUDAnimal,
    data: {
      operation: "read_all",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    $("#animais").empty();

    var obj = $.parseJSON(resposta);

    if (obj.total == undefined) {
      $("#conteudo").hide();
      $("#semCadastro").show();
    } else if (obj.status != "vazio") {
      var total = obj.total;

      $("#total_animais").html(total);

      if (total <= 5) {
        $("#total_animais_value").html(total);
        $("#total_resultados").hide();
        $("#total_animais_busca").hide();
        $("#total_animais_quantidade").show();
      } else {
        $("#total_resultados").show();
        $("#total_animais_quantidade").hide();
        $("#total_animais_busca").hide();
      }

      if (quantidade == "") {
        quantidade = obj.total;
      }

      for (var i = 0; i < quantidade; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var donoNome = obj.dados[i].donoNome;
        var donoCPF = obj.dados[i].donoCPF;
        var animalCodigo = obj.dados[i].animalCodigo;
        var animalNome = obj.dados[i].animalNome;
        var animalSexo = obj.dados[i].animalSexo;

        fillTable(donoNome, donoCPF, animalCodigo, animalNome, animalSexo);
      }
      var total = obj.total;
      $("#total_animais").html(total);
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
  } else if (id == "updateAnimal") {
    var codigo = $("#codigo").val();
    updateAnimal(codigo);
  } else if (id == "deleteAnimal") {
    var codigo = $("#modalExcluirAnimalCodigo").val();
    deleteAnimal(codigo);
  }
});

$("#nome_search").on("keydown", function (e) {
  if (e.keyCode === 13) {
    pesquisarAnimal();
  }
});

$("#search").click(function () {
  pesquisarAnimal();
});

function pesquisarAnimal() {
  var nome = $("#nome_search").val();
  $("#aviso").hide();
  $("#table").show();

  if (nome != "") {
    $.ajax({
      method: "POST",
      url: urlCRUDAnimal,
      data: {
        operation: "search",
        nome: nome,
        quantidade: quantidade,
      },
    }).done(function (resposta) {
      var obj = $.parseJSON(resposta);
      $("#animais").empty();
      var obj = $.parseJSON(resposta);

      if (obj.status != "vazio") {
        $("#conteudo").show();
        $("#semCadastro").hide();

        var total = obj.total;

        $("#total_animais_busca_value").html(total);
        $("#total_resultados").hide();
        $("#total_animais_busca").show();
        $("#total_animais_quantidade").hide();

        for (var i = 0; i < obj.dados.length; i++) {
          if (obj.dados[i] == undefined) {
            break;
          }

          var donoNome = obj.dados[i].donoNome;
          var donoCPF = obj.dados[i].donoCPF;
          var animalCodigo = obj.dados[i].animalCodigo;
          var animalNome = obj.dados[i].animalNome;
          var animalSexo = obj.dados[i].animalSexo;

          fillTable(donoNome, donoCPF, animalCodigo, animalNome, animalSexo);
        }
      } else {
        $("#table").hide();
        $("#aviso").show();
        $("#total_animais_quantidade").hide();
        $("#total_resultados").hide();
      }
    });
  } else {
    $("#table_count").val("5");
    loadData();
  }
}

$("#modalNomeDono").keyup(function () {
  let searchText = $("#modalNomeDono").val();
  if (searchText != "") {
    $.ajax({
      url: urlCRUDAnimal,
      method: "post",
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
          '<button  class=" list-group-item list-group-item-action " id="donoCodigo' +
          obj[item].donoCodigo +
          '">' +
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
  if (id.includes("donoCodigo")) {
    $("#resultado").html("");
    var nome = element.currentTarget.textContent;
    var codigo = element.currentTarget.id;
    var codigo = id.replace("donoCodigo", "");
    $("#modalNomeDono").val(nome);
    $("#modalCodigoDono").val(codigo);
  }
});

$("#table_count").on("change", function () {
  var total = $("#table_count").val();

  $.ajax({
    method: "POST",
    url: urlCRUDAnimal,
    data: {
      operation: "read_all",
      quantidade: total,
    },
  }).done(function (resposta) {
    $("#animais").empty();
    var obj = $.parseJSON(resposta);

    if (obj.status != "vazio") {
      for (var i = 0; i < obj.total; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var donoNome = obj.dados[i].donoNome;
        var donoCPF = obj.dados[i].donoCPF;
        var animalCodigo = obj.dados[i].animalCodigo;
        var animalNome = obj.dados[i].animalNome;
        var animalSexo = obj.dados[i].animalSexo;

        fillTable(donoNome, donoCPF, animalCodigo, animalNome, animalSexo);
      }
    }
  });
});

function loadData() {
  quantidade = $("#table_count").val();
  $.ajax({
    method: "POST",
    url: urlCRUDAnimal,
    data: {
      operation: "load_page",
      quantidade: quantidade,
    },
  }).done(function (resposta) {
    $("#animais").empty();
    var obj = $.parseJSON(resposta);

    if (obj.status != "vazio") {
      $("#conteudo").show();
      $("#semCadastro").hide();

      var total = obj.total;
      $("#total_animais").html(total);

      if (total <= 5) {
        $("#total_animais_value").html(total);
        $("#total_resultados").hide();
        $("#total_animais_busca").hide();
        $("#total_animais_quantidade").show();
      } else {
        $("#total_resultados").show();
        $("#total_animais_quantidade").hide();
        $("#total_animais_busca").hide();
      }

      for (var i = 0; i < quantidade; i++) {
        if (obj.dados[i] == undefined) {
          break;
        }
        var donoNome = obj.dados[i].donoNome;
        var donoCPF = obj.dados[i].donoCPF;
        var animalCodigo = obj.dados[i].animalCodigo;
        var animalNome = obj.dados[i].animalNome;
        var animalSexo = obj.dados[i].animalSexo;

        fillTable(donoNome, donoCPF, animalCodigo, animalNome, animalSexo);
      }
    } else {
      $("#conteudo").hide();
      $("#semCadastro").show();
    }
  });
}

function fillTable(donoNome, donoCPF, animalCodigo, animalNome, animalSexo) {
  if (animalSexo == "M") {
    animalSexo = "Macho";
  } else {
    animalSexo = "Fêmea";
  }
  var nova_linha = "";
  var nova_linha =
    '<tr class="item"> ' +
    '<th scope="row" class="text-center align-middle" id="animalCodigo' +
    animalCodigo +
    '">' +
    animalCodigo +
    "</th>" +
    '<td class="align-middle text-center">' +
    animalNome +
    "</td>" +
    '<td class="align-middle text-center">' +
    animalSexo +
    "</td>" +
    '<td class="align-middle text-center">' +
    donoNome +
    "</td>" +
    '<td class="align-middle text-center">' +
    donoCPF +
    "</td>" +
    '<td class="text-center text-center">' +
    '<button class="btn btn-warning me-2" id="editar' +
    animalCodigo +
    '" data-bs-toggle="modal" data-bs-target="#modalEditarAnimal" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar animal">' +
    '<i class="fa-solid fa-pen-to-square"></i>' +
    "</button>" +
    '<button class="btn btn-danger" id="excluir' +
    animalCodigo +
    '" data-bs-toggle="modal" data-bs-target="#modalExcluirAnimal" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir animal">' +
    '<i class="fa-solid fa-trash-can"></i>' +
    "</button>" +
    "</td>" +
    "</tr>";

  $("#animais").append(nova_linha);
}

function updateAnimal() {
  var animalCodigo = $("#modalCodigoAnimal").val();
  var animalNome = $("#modalNomeAnimal").val();
  var animalNascimento = $("#modalNascimentoAnimal").val();
  var donoCodigo = $("#modalCodigoDono").val();

  var especie;
  if ($("#dropdown_especie :selected").text() != "Escolha") {
    var especie = $("#dropdown_especie :selected").text();
  } else {
    var especie = "";
  }

  var sexo = $("input[name='radioSexo']:checked").val();

  $.ajax({
    method: "POST",
    url: urlCRUDAnimal,
    data: {
      animalCodigo: animalCodigo,
      animalNome: animalNome,
      animalNascimento: animalNascimento,
      donoCodigo: donoCodigo,
      especie: especie,
      sexo: sexo,
      operation: "update",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "alterado") {
      clearFillds();
      $("#modalEditarAnimal").modal("hide");
      loadData();
      showAlertSuccess();
    } else {
      showAlertWarning();
    }
  });
}

function deleteAnimal(codigo) {
  $.ajax({
    method: "POST",
    url: urlCRUDAnimal,
    data: {
      codigo: codigo,
      operation: "delete",
    },
  }).done(function (resposta) {
    console.log(resposta)

    var obj = $.parseJSON(resposta);
    if (obj.status == "deletado") {
      clearFillds();
      $("#modalExcluirAnimal").modal("hide");
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
    url: urlCRUDAnimal,
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
    var animalNascimento = obj.ANI_NASCIMENTO;
    var animalEspecie = obj.ANI_ESPECIE;
    var animalSexo = obj.ANI_SEXO;

    if (animalSexo == "M") {
      $("#sexoM").prop("checked", true);
    } else if (animalSexo == "F") {
      $("#sexoF").prop("checked", true);
    }
    if (animalEspecie == "Canina") {
      $("#dropdown_especie").val(1);
    } else if (animalEspecie == "Felina") {
      $("#dropdown_especie").val(2);
    } else if (animalEspecie == "Réptil") {
      $("#dropdown_especie").val(3);
    } else if (animalEspecie == "Ave") {
      $("#dropdown_especie").val(4);
    }
    $("#modalCodigoAnimal").val(animalCodigo);
    $("#modalCodigoDono").val(donoCodigo);
    $("#modalNomeAnimal").val(animalNome);
    $("#modalNomeDono").val(donoNome);
    $("#modalNascimentoAnimal").val(animalNascimento);
    $("#modalExcluirAnimalCodigo").val(donoCodigo);
    $("#modalExcluirAnimalNome").val(animalNome);
    $("#modalExcluirAnimalDonoNome").val(donoNome);
    $("#modalExcluirAnimalCodigo").val(animalCodigo);
  });
}

function clearFillds() {
  $("#modalCodigoAnimal").val("");
  $("#modalNomeAnimal").val("");
  $("#modalNomeDono").val("");
  $("#modalNascimentoAnimal").val("");
  $("#sexoM").prop("checked", false);
  $("#sexoF").prop("checked", false);
  $("#dropdown_especie").val("");
  $("#modalCodigoDono").val("");
  $("#modalExcluirAnimalCodigo").val("");
  $("#modalExcluirAnimalNome").val("");
  $("#modalExcluirAnimalDonoNome").val("");
  $("#modalExcluirAnimalCodigo").val("");
}
