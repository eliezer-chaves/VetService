datanasc.max = new Date().toISOString().split("T")[0];

var inputNome = $("#nome")
var inputNomeDono = $("#input_dono")
var inputCodigoDono = $("#dono_codigo")
var inputCPFDono = $("#dono_cpf")
var inputTelefoneDono = $("#dono_telefone")
var inputDataNascimento =  $("#datanasc")
var radioSexoMacho = $("#flexRadio_macho")
var radioSexoFemea = $("#flexRadio_femea")
var dropdownEspecie = $("#dropdown_especie")
var spanNomeDono = $("#donoNome")
var spanAnimalNome = $("#animalNome")
var modalAnimalCadastrado = $("#modalAnimalCadastrado")
var modalAviso = $("#modalAviso")
var buttonCadastrar = $("#cadastrar")
var urlCRUDAnimal = "../../model/crud_animal.php"
var urlCRUDDono = "../../model/crud_dono.php"

function clearFilds() {
  inputNome.val("");
  inputNomeDono.val("");
  inputCodigoDono.val("");
  inputCPFDono.val("");
  inputTelefoneDono.val("");
  inputDataNascimento.val("");
  radioSexoMacho.prop("checked", false);
  radioSexoFemea.prop("checked", false);
  dropdownEspecie.val("");
  spanNomeDono.val("");
  spanAnimalNome.val("");
}

buttonCadastrar.click(function () {
  var nome = inputNome.val();
  var donoNome = inputNomeDono.val();
  var donoCodigo = inputCodigoDono.val();
  var datanasc = inputDataNascimento.val();
  var sexo = $("input[name='radioSexo']:checked").val();
  if ($("#dropdown_especie :selected").text() != "Escolha") {
    var especie = $("#dropdown_especie :selected").text();
  } else {
    var especie = "";
  }
  $.ajax({
    method: "POST",
    url: urlCRUDAnimal,
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
      modalAnimalCadastrado.modal("show");
      spanNomeDono.html(obj.dono);
      spanAnimalNome.html(obj.animal);
      clearFilds();
    }
    if (obj.status == "incomplete") {
      modalAviso.modal("show");
    }
  });
});

$(document).ready(function () {
  inputNomeDono.keyup(function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: urlCRUDDono,
        method: "POST",
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

  $(document).on("click", "button", function (element) {
    var id = element.currentTarget.id;

    var array = id.split("_");

    if (id.includes("donoCodigo")) {
      $("#resultado").html("");
      var nome = element.currentTarget.textContent;
      var telefone = array[0].replace("donoTelefone", "");
      var cpf = array[1].replace("donoCPF", "");
      var codigo = array[2].replace("donoCodigo", "");

      inputNomeDono.val(nome);
      inputCodigoDono.val(codigo);
      inputCPFDono.val(cpf);
      inputTelefoneDono.val(telefone);
    }
  });
});

$(document).on("click", "button", function (element) {
  var id = element.currentTarget.id;
  if (id == "btn-animal-cadastrado-modal") {
    modalAnimalCadastrado.modal("hide");
    clearFilds();
  }
  if (id == "btn-ok-modal") {
    modalAviso.modal("hide");
  }
});
