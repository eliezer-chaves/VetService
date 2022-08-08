const urlCRUDConsulta = "../../model/crud_consulta.php";
const urlCRUDVeterinario = "../../model/crud_veterinario.php";
$("#consultaExcluido").hide();
$("#consultaErro").hide();

function showAlertSuccessDeletado() {
  $("#consultaExcluido")
    .fadeTo(1000, 500)
    .fadeIn(1000, function () {
      $("#consultaExcluido").fadeOut(1000);
    });
}

function showAlertWarning() {
  $("#consultaErro")
    .fadeTo(3000, 500)
    .fadeIn(3000, function () {
      $("#consultaErro").fadeOut(3000);
    });
}

loadCalendar();

function loadCalendar() {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: "pt-br",
    themeSystem: "bootstrap5",
    //expandRows: true,
    //slotMinTime: '08:00',
    //slotMaxTime: '20:00',
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek,listMonth",
    },
    //default: [1],
    businessHours: [
      // specify an array instead
      {
        daysOfWeek: [1, 2, 3, 4, 5], // Monday, Tuesday, Wednesday
        startTime: "00:00",
        endTime: "23:59",
      },
    ],
    dayHeaderFormat: {
      weekday: "long",
      
    },
    //hiddenDays: [0],
    //weekends: false,
    initialView: "listMonth",
    views: {
      listWeek: {
        buttonText: "Consultas da semana",
      },
      listMonth: {
        buttonText: "Consultas do mês",
      },
    },
    weekNumbers: true,
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    selectable: true,
    nowIndicator: true,

    dayMaxEvents: true, // allow "more" link when too many events
    events: "../../model/load_calendar.php",

    eventClick: function (info) {
      var codigoConsulta = info.event.id;
      var animalCodigo = info.event.extendedProps[0];
      var animal = info.event.extendedProps[1];
      var donoCodigo = info.event.extendedProps[2];
      var dono = info.event.extendedProps[3];
      var veterinarioCodigo = info.event.extendedProps[4];
      var veterinario = info.event.extendedProps[5];
      var especialidadeCodigo = info.event.extendedProps[6];
      var especialidade = info.event.extendedProps[7];
      var data = info.event.extendedProps[8];
      var horaInicio = info.event.extendedProps[9];
      var horaFim = info.event.extendedProps[10];

      fillModal(
        codigoConsulta,
        animalCodigo,
        animal,
        donoCodigo,
        dono,
        veterinarioCodigo,
        veterinario,
        especialidadeCodigo,
        especialidade,
        data,
        horaInicio,
        horaFim
      );

      $("#modalEditarConsulta").modal("show");
    },

    select: function (info) {
      clearFillds();
      var hora = info.start.toLocaleString().substr(11);

      var data = new Date(info.start);
      var time = data.getHours();
      var time = time + 1;
      if (time < 10) {
        time = "0" + time;
      }
      time.toString();
      time = time + ":00:00";

      $("#modalAdd_hora_consulta_fim").val(time);

      $("#modalAdd_DataConsulta").val(info.startStr.substr(0, 10));
      $("#modalAdd_HoraConsulta").val(hora);
      $("#modalAddConsulta").modal("show");
    },
  });
  calendar.render();
}

function fillModal(
  codigoConsulta,
  animalCodigo,
  animal,
  donoCodigo,
  dono,
  veterinarioCodigo,
  veterinario,
  especialidadeCodigo,
  especialidade,
  data,
  horaInicio,
  horaFim
) {
  $("#editarConsultaCodigo").val(codigoConsulta);
  $("#editarAnimalCodigo").val(animalCodigo);
  $("#editarAnimalNome").val(animal);
  $("#editarCodigoDono").val(donoCodigo);
  $("#editarNomeDono").val(dono);
  $("#editarDataConsulta").val(data);
  $("#editarHoraConsulta").val(horaInicio);
  $("#hora_consulta_fim").val(horaFim);
  $("#veterinario_opcao").val(veterinario);
  $("#veterinario_codigo").val(veterinarioCodigo);
  $("#veterinario_especialidade").val(especialidade);
  $("#especialidadeCodigo").val(especialidadeCodigo);
}

function clearFillds() {
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

  $("#modalAdd_AnimalCodigo").val("");
  $("#modalAdd_veterinario_codigo").val("");
  $("#modalAdd_DataConsulta").val("");
  $("#modalAdd_hora_consulta_fim").val("");
  $("#modalAdd_HoraConsulta").val("");
  $("#modalAddAnimalNome").val("");
  $("#modalAdd_NomeDono").val("");
  $("#modalAdd_veterinario_opcao").val("");
  $("#modadlAdd_veterinario_especialidade").val("");
}

//Autocomplete Adicionar
$(document).ready(function () {
  $("#modalAddAnimalNome").keyup(function () {
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
        $("#resultadoAdd").html("");

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

        $("#resultadoAdd").append(resultado);
      });
    } else {
      $("#resultadoAdd").html("");
    }
  });

  $(document).on("click", "button", function (element) {
    var id = element.currentTarget.id;
    var array = id.split("_");

    if (id.includes("donoCodigo")) {
      $("#resultadoAdd").html("");
      var telefone = array[0].replace("donoTelefone", "");
      var cpf = array[1].replace("donoCPF", "");
      var donoCodigo = array[2].replace("donoCodigo", "");
      var donoNome = array[3].replace("donoNome", "");
      var animalNome = array[4].replace("animalNome", "");
      var animalCodigo = array[5].replace("animalCodigo", "");

      $("#modalAddAnimalNome").val(animalNome);
      $("#modalAdd_AnimalCodigo").val(animalCodigo);
      $("#modalAdd_NomeDono").val(donoNome);
      $("#modalAdd_editarCodigoDono").val(donoCodigo);
    }
  });
});

//Autocomplete Editar
$(document).ready(function () {
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
});

//Load Dropdown Editar
$(document).ready(function () {
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
        '" name="' +
        obj[item].veterinarioEspecialidade +
        "-" +
        obj[item].veterinarioEspecialidadeCodigo +
        '"><button>' +
        obj[item].veterinarioNome +
        "</button></option>";
    });
    $("#veterinario_opcao").append(novo_item);

    $("#veterinario_opcao").change(function () {
      var value = $("#veterinario_opcao :selected").attr("id");
      var especialidade = $("#veterinario_opcao :selected").attr("name");
      var especialidadeNome = especialidade.split("-")[0];
      var codigo = especialidade.split("-")[1];

      $("#veterinario_codigo").val(value);
      $("#veterinario_especialidade").val(especialidadeNome);
      $("#especialidadeCodigo").val(codigo);
    });
  });
});

//LoadDropdown Adicionar
$(document).ready(function () {
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
        '" name="' +
        obj[item].veterinarioEspecialidade +
        "-" +
        obj[item].veterinarioEspecialidadeCodigo +
        '"><button>' +
        obj[item].veterinarioNome +
        "</button></option>";
    });
    $("#modalAdd_veterinario_opcao").append(novo_item);

    $("#modalAdd_veterinario_opcao").change(function () {
      var value = $("#modalAdd_veterinario_opcao :selected").attr("id");

      var especialidade = $("#modalAdd_veterinario_opcao :selected").attr(
        "name"
      );
      var especialidadeNome = especialidade.split("-")[0];
      var codigo = especialidade.split("-")[1];

      $("#modalAdd_veterinario_codigo").val(value);
      $("#modadlAdd_veterinario_especialidade").val(especialidadeNome);
      $("#modalAdd_especialidadeCodigo").val(codigo);
    });
  });
});

$(document).on("click", "button", function (element) {
  var id = element.currentTarget.id;
  if (id == "updateConsulta") {
    var codigo = $("#editarConsultaCodigo").val();
    updateConsulta(codigo);
  } else if (id == "createConsulta") {
    createConsulta();
  } else if (id == "deleteConsulta") {
    var codigo = $("#editarConsultaCodigo").val();
    deleteConsulta(codigo);
  } else if (id == "btn-aviso-modal") {
    $("#modalAviso").modal("hide");
    $("#modalAddConsulta").modal("show");
  }
});

function deleteConsulta(codigo) {
  $.ajax({
    method: "POST",
    url: urlCRUDConsulta,
    data: {
      codigo: codigo,
      operation: "delete",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "deletado") {
      showAlertSuccessDeletado();
      loadCalendar();
    } else if (obj.status == "nao-deletado") {
    }
  });
}

function updateConsulta() {
  var animalCodigo = $("#editarAnimalCodigo").val();
  var consultaCodigo = $("#editarConsultaCodigo").val();
  var veterinarioCodigo = $("#veterinario_codigo").val();
  var consultaData = $("#editarDataConsulta").val();
  var consultaHora = $("#editarHoraConsulta").val();
  var consultaHoraFim = $("#hora_consulta_fim").val();
  $.ajax({
    method: "POST",
    url: urlCRUDConsulta,
    data: {
      animalCodigo: animalCodigo,
      consultaCodigo: consultaCodigo,
      veterinarioCodigo: veterinarioCodigo,
      consultaData: consultaData,
      consultaHora: consultaHora,
      consultaHoraFim: consultaHoraFim,
      operation: "update",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "alterado") {
      clearFillds();
      $("#modalEditarConsulta").modal("hide");
      loadCalendar();
    }
  });
}

function createConsulta() {
  var animalCodigo = $("#modalAdd_AnimalCodigo").val();
  var veterinario_codigo = $("#modalAdd_veterinario_codigo").val();
  var data = $("#modalAdd_DataConsulta").val();
  var horaInicio = $("#modalAdd_HoraConsulta").val();
  var horaFim = $("#modalAdd_hora_consulta_fim").val();
  var animalNome = $("#modalAddAnimalNome").val();
  var donoNome = $("#modalAdd_NomeDono").val();
  var veterinario = $("#modalAdd_veterinario_opcao :selected").text();
  var especialidade = $("#modadlAdd_veterinario_especialidade").val();

  $.ajax({
    method: "POST",
    url: urlCRUDConsulta,
    data: {
      animalCodigo: animalCodigo,
      animalNome: animalNome,
      donoNome: donoNome,
      veterinario: veterinario,
      veterinario_codigo: veterinario_codigo,
      especialidade: especialidade,
      data: data,
      horaInicio: horaInicio,
      horaFim: horaFim,
      veterinario_codigo: veterinario_codigo,
      operation: "create",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "cadastrado") {
      clearFillds();
      loadCalendar();
    } else if (obj.status == "incomplete") {
      $("#modalAviso").modal("show");
    }
  });
}
