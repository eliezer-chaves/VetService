datanasc.max = new Date().toISOString().split("T")[0];

function clearFilds() {
  $("#nome").val("");
  $("#input_dono").val("");
  $("#dono_codigo").val("");
  $("#dono_cpf").val("");
  $("#dono_telefone").val("");
  $("#datanasc").val("");
  $("#flexRadio_macho").prop("checked", false);
  $("#flexRadio_femea").prop("checked", false);
  $("#dropdown_especie").val("");

  $("#donoNome").val("");
  $("#animalNome").val("");
}

$("#cadastrar").click(function () {
  var nome = $("#nome").val();
  var donoNome = $("#input_dono").val();
  var donoCodigo = $("#dono_codigo").val();
  var datanasc = $("#datanasc").val();
  var sexo = $("input[name='radioSexo']:checked").val();
  if ($("#dropdown_especie :selected").text() != "Escolha") {
    var especie = $("#dropdown_especie :selected").text();
  } else {
    var especie = "";
  }

  $.ajax({
    method: "POST",
    url: "../../model/crud_animal.php",
    data: {
      nome: nome,
      donoNome: donoNome,
      donoCodigo: donoCodigo,
      datanasc: datanasc,
      sexo: sexo,
      especie: especie,
      operation: "create",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "cadastrado") {
      $("#modalAnimalCadastrado").modal("show");
      $("#donoNome").html(obj.dono);
      $("#animalNome").html(obj.animal);
      clearFilds();
    }
    if (obj.status == "incomplete") {
      $("#modalAviso").modal("show");
    }
  });
});

$(document).ready(function () {
  // Send Search Text to the server
  $("#input_dono").keyup(function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "../../model/crud_dono.php",
        method: "post",
        data: {
          query: searchText,
          operation: "read_dono_fk",
        },
      }).done(function (resposta) {
        var obj = $.parseJSON(resposta);
        var nova_linha = "";
        $("#resultado").html("");

        Object.keys(obj).forEach((item) => {
          nova_linha +=
            '<button  class=" list-group-item list-group-item-action " id="donoTelefone' +
            obj[item].telefone +
            "_donoCPF" +
            obj[item].cpf +
            "_donoCodigo" +
            obj[item].id +
            '">' +
            obj[item].nome +
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

  // Set searched text in input field on click of search button
  $(document).on("click", "button", function (element) {
    var id = element.currentTarget.id;

    var array = id.split("_");

    if (id.includes("donoCodigo")) {
      $("#resultado").html("");
      var nome = element.currentTarget.textContent;
      var telefone = array[0].replace("donoTelefone", "");
      var cpf = array[1].replace("donoCPF", "");
      var codigo = array[2].replace("donoCodigo", "");

      $("#input_dono").val(nome);
      $("#dono_codigo").val(codigo);
      $("#dono_cpf").val(cpf);
      $("#dono_telefone").val(telefone);
    }
  });
});

$(document).on("click", "button", function (element) {
  var id = element.currentTarget.id;
  if (id == "btn-animal-cadastrado-modal") {
    $("#modalAnimalCadastrado").modal("hide");
    clearFilds();
  }
  if (id == "btn-ok-modal") {
    $("#modalAviso").modal("hide");
  }
});
