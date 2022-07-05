const urlCRUDEspecialidade = "../../model/crud_especialidade.php";
var input_especialidade = $("#input_especialidade");

function clearFilds() {
  input_especialidade.val("");
}

$("#cadastrar").click(function () {
  $.ajax({
    method: "POST",
    url: urlCRUDEspecialidade,
    data: {
      nome: input_especialidade.val(),
      operation: "create",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "cadastrado") {
      $("#modalEspecialidadeCadastrada").modal("show");
      $("#nomeModal").html(obj.especialidade);
    }
    if (obj.status == "incomplete") {
      $("#modalAviso").modal("show");
    }
  });
});

$(document).on("click", "button", function (element) {
  var id = element.currentTarget.id;
  if (id == "btn-especialidade-cadastrado-modal") {
    $("#modalEspecialidadeCadastrada").modal("hide");
    clearFilds();
  }
  if (id == "btn-aviso-modal") {
    $("#modalAviso").modal("hide");
  }
});
