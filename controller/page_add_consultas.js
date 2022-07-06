data_consulta.min = new Date().toISOString().split("T")[0];

var inputNomeAnimal = $("#input_animal");
var inputCodigoAnimal = $("#input_animal_codigo");
var inputNomeDono = $("#input_dono");
var inputCodigoDono = $("#dono_codigo");
var inputCPFDono = $("#dono_cpf");
var inputTelefoneDono = $("#dono_telefone");
var dropdownVeterinario = $("#veterinario_opcao");
var inputCodigoVeterinario = $("#veterinario_codigo");
var inputDataConsulta = $("#data_consulta");
var inputHoraConsulta = $("#hora_consulta");
var inputDataConsultaModal = $("#dataModal");
var inputHoraConsultaModal = $("#horaModal");
var inputNomeAnimalModal = $("#animalNomeModal");
var inputNomeDonoModal = $("#donoNomeModal");
var inputVeterinarioModal = $("#veterinarioModal");
var buttonCadastrar = $("#cadastrar");
const urlCRUDVeterinario = "../../model/crud_veterinario.php";
const urlCRUDConsulta = "../../model/crud_consulta.php";
const urlCRUDAnimal = "../../model/crud_animal.php";
var modalConsultaCadastrada = $("#modalConsultaCadastrada");
var modalAviso = $("#modalAviso");
var modalExists = $("#modalExists");

function clearFilds() {
  inputNomeAnimal.val("");
  inputCodigoAnimal.val("");
  inputNomeDono.val("");
  inputCodigoDono.val("");
  inputCPFDono.val("");
  inputTelefoneDono.val("");
  dropdownVeterinario.val("");
  inputCodigoVeterinario.val("");
  inputDataConsulta.val("");
  inputHoraConsulta.val("");
  inputDataConsultaModal.val("");
  inputHoraConsultaModal.val("");
  inputNomeAnimalModal.val("");
  inputNomeDonoModal.val("");
  inputVeterinarioModal.val("");
  $("#veterinario_especialidade").val("");

}

$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: urlCRUDAnimal,
    data: {
      operation: "load_page",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "vazio") {
      $("#content").hide();
      $("#semVeterinario").hide();
    } else {
      $("#content").show();
      $("#semAnimal").hide();
      $("#semVeterinario").hide();
    }
  });
});

$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: urlCRUDVeterinario,
    data: {
      operation: "load_dropdown",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "vazio") {
      $("#content").hide();
      $("#semVeterinario").show();
      
      $("#semAnimal").hide();
    } else {
      novo_item = "";
      Object.keys(obj).forEach((item) => {
        novo_item +=
          '<option value="' +
          obj[item].veterinarioNome +
          '" id="' +
          obj[item].veterinarioCodigo +
          '" name="'+obj[item].veterinarioEspecialidade+'"><button>' +
          obj[item].veterinarioNome +
          "</button></option>";
      });
      $("#veterinario_opcao").append(novo_item);
      dropdownVeterinario.change(function () {
        var value = $("#veterinario_opcao :selected").attr("id");
        inputCodigoVeterinario.val(value);
        var especialidade = $("#veterinario_opcao :selected").attr("name");
        $("#veterinario_especialidade").val(especialidade)

      });
    }
  });
});

buttonCadastrar.click(function () {
  var animalCodigo = inputCodigoAnimal.val();
  var donoCodigo = inputCodigoDono.val();
  var veterinario_codigo = $("#veterinario_codigo").val();
  var data = inputDataConsulta.val();
  var hora = inputHoraConsulta.val();
  var animalNome = inputNomeAnimal.val();
  var dono = inputNomeDono.val();
  var veterinario = $("#veterinario_opcao :selected").text();
  var especialidade = $("#veterinario_especialidade").val();

  $.ajax({
    method: "POST",
    url: urlCRUDConsulta,
    data: {
      animalCodigo: animalCodigo,
      donoCodigo: donoCodigo,
      veterinario_codigo: veterinario_codigo,
      data: data,
      hora: hora,
      animalNome: animalNome,
      dono: dono,
      veterinario: veterinario,
      especialidade: especialidade,
      operation: "create",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "cadastrado") {
      var dia = obj.data.split("-")[0];
      var mes = obj.data.split("-")[1];
      var ano = obj.data.split("-")[2];

      obj.data =
        ("0" + ano).slice(-2) + "/" + ("0" + mes).slice(-2) + "/" + dia;

      modalConsultaCadastrada.modal("show");
      inputDataConsultaModal.html(obj.data);
      inputHoraConsultaModal.html(obj.hora);
      inputNomeAnimalModal.html(obj.animal);
      inputNomeDonoModal.html(obj.dono);
      inputVeterinarioModal.html(obj.veterinario);
      $("#veterinarioEspecialidadeModal").html(obj.especialidade);
    }
    if (obj.status == "incomplete") {
      modalAviso.modal("show");
    }
  });
});

$(document).on("click", "button", function (element) {
  var id = element.currentTarget.id;
  if (id == "btn-consulta-cadastrado-modal") {
    modalConsultaCadastrada.modal("hide");
    clearFilds();
  }
  if (id == "btn-aviso-modal") {
    modalAviso.modal("hide");
  }
  if (id == "btn-ok-modal-exists") {
    modalExists.modal("hide");
  }
});

$(document).ready(function () {
  inputNomeAnimal.keyup(function () {
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

      inputNomeAnimal.val(animalNome);
      inputCodigoAnimal.val(animalCodigo);
      inputNomeDono.val(donoNome);
      inputCodigoDono.val(donoCodigo);
      inputCPFDono.val(cpf);
      inputTelefoneDono.val(telefone);
    }
  });
});
