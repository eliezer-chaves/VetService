var inputNome = $("#nome");
var inputCRMV = $("#crmv");
var dropdownEstado = $("#dropdown_estado");
var dropdownEspecialidade = $("#dropdown_especialidade");
var inputTelefone = $("#telefone");
var inputCRMVModal = $("#CRMVExists");
var buttonCadastrar = $("#cadastrar");
const urlCRUDVeterinario = "../../model/crud_veterinario.php";
const urlCRUDEspecialidade = "../../model/crud_especialidade.php";
var inputModalNomeVeterinario = $("#veterinarioNome");
var modalVeterinarioCadastrado = $("#modalVeterinarioCadastrado");
var modalAviso = $("#modalAviso");
var modalExists = $("#modalExists");

function clearFilds() {
  inputNome.val("");
  inputCRMV.val("");
  dropdownEstado.val("");
  dropdownEspecialidade.val("");
  inputTelefone.val("");
  inputCRMVModal.val("");
}

$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: urlCRUDEspecialidade,
    data: {
      operation: "load_dropdown",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "vazio") {
      $("#content").hide()
    } else {
      $("#semEspecialidade").hide()
      novo_item = "";
      Object.keys(obj).forEach((item) => {
        novo_item +=
          '<option value="' +
          obj[item].especialidadeCodigo +
          '" id="' +
          obj[item].especialidadeCodigo +
          '"><button>' +
          obj[item].especialidadeNome +
          "</button></option>";
      });
      $("#dropdown_especialidade").append(novo_item);
    }
  });
});

buttonCadastrar.click(function () {
  var nome = inputNome.val();
  var crmv = inputCRMV.val();
  var uf = $("#dropdown_estado :selected").val();
  var especialidade = $("#dropdown_especialidade :selected").val();
  var telefone = inputTelefone.val();
  var crmv_uf = crmv + "-" + uf;

  $.ajax({
    method: "POST",
    url: urlCRUDVeterinario,
    data: {
      nome: nome,
      crmv: crmv,
      crmv_uf: crmv_uf,
      especialidade: especialidade,
      telefone: telefone,
      operation: "create",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "cadastrado") {
      modalVeterinarioCadastrado.modal("show");
      inputModalNomeVeterinario.html(obj.veterinario);
      clearFilds();
    }
    if (obj.status == "incomplete") {
      modalAviso.modal("show");
    }
    if (obj.status == "exists") {
      modalExists.modal("show");
      inputCRMVModal.html(obj.crmv);
    }
  });
});

$(document).on("click", "button", function (element) {
  var id = element.currentTarget.id;
  if (id == "btn-veterinario-cadastrado-modal") {
    modalVeterinarioCadastrado.modal("hide");
    clearFilds();
  }
  if (id == "btn-ok-modal") {
    modalAviso.modal("hide");
  }
  if (id == "btn-ok-modal-exists") {
    modalExists.modal("hide");
  }
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

$(document).ready(function () {
  inputCRMV.mask("99999");
});
