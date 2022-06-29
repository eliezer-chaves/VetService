function clearFilds() {
  $("#nome").val("");
  $("#crmv").val("");
  $("#dropdown_estado").val("");
  $("#dropdown_especialidade").val("");
  $("#telefone").val("");
  $("#CRMVExists").val("");
}

$("#cadastrar").click(function () {
  var nome = $("#nome").val();
  var crmv = $("#crmv").val();
  var uf = $("#dropdown_estado :selected").val();
  var especialidade = $("#dropdown_especialidade :selected").text();
  var telefone = $("#telefone").val();
  var crmv_uf = crmv + "-" + uf;

  $.ajax({
    method: "POST",
    url: "../../model/crud_veterinario.php",
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
      $("#modalVeterinarioCadastrado").modal("show");
      $("#veterinarioNome").html(obj.veterinario);
      clearFilds();
    }
    if (obj.status == "incomplete") {
      $("#modalAviso").modal("show");
    }
    if (obj.status == "exists") {
      $("#modalExists").modal("show");
      $("#CRMVExists").html(obj.crmv);
    }
  });
});

$(document).on("click", "button", function (element) {
  var id = element.currentTarget.id;
  if (id == "btn-veterinario-cadastrado-modal") {
    $("#modalVeterinarioCadastrado").modal("hide");
    clearFilds();
  }
  if (id == "btn-ok-modal") {
    $("#modalAviso").modal("hide");
  }
  if (id == "btn-ok-modal-exists") {
    $("#modalExists").modal("hide");
    //clearFilds();
  }
});

//Mask Telefone
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

$("#telefone").mask(behavior, options);

//Mask do CRMV
$(document).ready(function () {
  $("#crmv").mask("99999");
});
