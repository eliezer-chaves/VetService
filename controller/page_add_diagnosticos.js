const urlCRUDConsulta = "../../model/crud_consulta.php";
const urlCRUDDiagnostico = "../../model/crud_diagnostico.php";
$(document).ready(function () {
  var $pressao = $("#pressao");
  $pressao.mask("00/00", {
    reverse: false,
  });
});

var codigoConsulta = getCookie("codigoConsulta");

if (codigoConsulta == "" || codigoConsulta == null) {
  window.location.href = "../../view/pages/load_consultas.php";
} else {
  fillFilds(codigoConsulta);
}

function fillFilds(codigoConsulta) {
  $.ajax({
    method: "POST",
    url: urlCRUDConsulta,
    data: {
      codigo: codigoConsulta,
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
    var veterinarioEspecialidade = obj.ESP_NOME;
    var veterinarioEspecialidadeCodigo = obj.ESP_CODIGO;

    var consultaCodigo = obj.CON_CODIGO;
    var consultaData = obj.CON_DATA;
    var consultaHora = obj.CON_HORA;
    var hora_consulta_fim = obj.CON_HORA_FIM;

    $("#codigoAnimal").val(animalCodigo);
    $("#codigoDono").val(donoCodigo);
    $("#nomeAnimal").val(animalNome);
    $("#nomeDono").val(donoNome);
    $("#nomeVeterinario").val(veterinarioNome);
    $("#codigoVeterinario").val(veterinarioCodigo);
    $("#codigoEspecialidade").val(veterinarioEspecialidadeCodigo);
    $("#dataConsulta").val(consultaData);
    $("#horaConsulta").val(consultaHora);
    $("#codigoConsulta").val(consultaCodigo);
  });
}

$("#cadastrar").click(function () {

  var animalCodigo = $("#codigoAnimal").val();
  var codigoConsulta = $("#codigoConsulta").val();
  var peso = $("#peso").val();
  //peso = peso + " Kg";
  var altura = $("#altura").val();
  //altura = altura + " m";
  var temperatura = $("#temperatura").val();
  //temperatura = temperatura + " °C";
  var bpm = $("#bpm").val();
  //bpm = bpm + " bpm";
  var pressao = $("#pressao").val();
  var sintomas = $("#sintomas").val();

  $.ajax({
    method: "POST",
    url: urlCRUDDiagnostico,
    data: {
      codigoConsulta: codigoConsulta,
      animalCodigo: animalCodigo,
      peso: peso,
      altura: altura,
      temperatura: temperatura,
      bpm: bpm,
      pressao: pressao,
      sintomas: sintomas,
      operation: "create",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "cadastrado") {
      $("#modalDiagnosticoRealizado").modal("show");
    }
    if (obj.status == "incomplete") {
      //console.log("incomplete");
    }
  });
});
$("#changeConsultaStatus").click(function () {
  $("#modalDiagnosticoRealizado").modal("hide");
  var codigoConsulta = $("#codigoConsulta").val();
  $.ajax({
    method: "POST",
    url: urlCRUDDiagnostico,
    data: {
      codigoConsulta: codigoConsulta,
      operation: "update_consulta",
    },
  }).done(function (resposta) {
    clearFillds();
    setCookie("codigoConsulta", "");
    location.reload();
  });
});

$("#limpar").click(function () {
  setCookie("codigoConsulta", "");
  location.reload();
});

function clearFillds() {
  $("#codigoAnimal").val("");
  $("#codigoDono").val("");
  $("#nomeAnimal").val("");
  $("#nomeDono").val("");
  $("#nomeVeterinario").val("");
  $("#codigoVeterinario").val("");
  $("#codigoEspecialidade").val("");
  $("#dataConsulta").val("");
  $("#horaConsulta").val("");
  $("#codigoConsulta").val("");
}

function setCookie(name, value, duration) {
  var now = new Date();
  var minutes = 30;
  now.setTime(now.getTime() + minutes * 60 * 1000);

  var meuCookie = name + "=" + value + ";";

  document.cookie = meuCookie;
}

function getCookie(name) {
  var cookies = document.cookie;
  var prefix = name + "=";
  var begin = cookies.indexOf("; " + prefix);

  if (begin == -1) {
    begin = cookies.indexOf(prefix);
    if (begin != 0) {
      return null;
    }
  } else {
    begin += 2;
  }
  var end = cookies.indexOf(";", begin);
  if (end == -1) {
    end = cookies.length;
  }
  return unescape(cookies.substring(begin + prefix.length, end));
}
