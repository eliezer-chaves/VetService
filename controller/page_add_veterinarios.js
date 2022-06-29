var inputNome = $("#nome");
var inputCRMV = $("#crmv");
var dropdownEstado = $("#dropdown_estado");
var dropdownEspecialidade = $("#dropdown_especialidade");
var inputTelefone = $("#telefone");
var inputCRMVModal = $("#CRMVExists");
var buttonCadastrar = $("#cadastrar");
var urlCRUDVeterinario = "../../model/crud_veterinario.php";
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

buttonCadastrar.click(function () {
  var nome = inputNome.val();
  var crmv = inputCRMV.val();
  var uf = $("#dropdown_estado :selected").val();
  var especialidade = $("#dropdown_especialidade :selected").text();
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
