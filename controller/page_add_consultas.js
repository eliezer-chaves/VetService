data_consulta.min = new Date().toISOString().split("T")[0];

function clearFilds() {
  $("#input_animal").val("");
  $("#input_animal_codigo").val("")
  $("#input_dono").val("");
  $("#dono_codigo").val("");
  $("#dono_cpf").val("");
  $("#dono_telefone").val("");
  $("#veterinario_opcao").val("");
  $("#veterinario_codigo").val("");
  $("#data_consulta").val("");
  $("#hora_consulta").val("");
  $("#dataModal").val("");
  $("#horaModal").val("");
  $("#animalNomeModal").val("");
  $("#donoNomeModal").val("");
  $("#veterinarioModal").val("");

}

$(document).ready(function() {
  $.ajax({
    method: "POST",
    url: "../../model/crud_veterinario.php",
    data:{
      operation: "load_dropdown"
    }

  }).done(function(resposta) {
    
    var obj = $.parseJSON(resposta)

    novo_item = ''

    Object.keys(obj).forEach((item) => {
      novo_item += '<option value="' + obj[item].veterinarioNome + '" id="' + obj[item].veterinarioCodigo + '"><button>' + obj[item].veterinarioNome + '</button></option>'
    });
    $('#veterinario_opcao').append(novo_item);

    $("#veterinario_opcao").change(function() {
      var value = $('#veterinario_opcao :selected').attr('id');

      $("#veterinario_codigo").val(value)
    });
  });
});

$("#cadastrar").click(function() {
  var animalCodigo = $("#input_animal_codigo").val();
  var donoCodigo = $("#dono_codigo").val();
  var veterinario_codigo = $('#veterinario_codigo').val();
  var data = $("#data_consulta").val();
  var hora = $("#hora_consulta").val();
  var animalNome = $("#input_animal").val();
  var dono = $("#input_dono").val();
  var veterinario = $('#veterinario_opcao :selected').text()

  $.ajax({
    method: "POST",
    url: "../../model/crud_consulta.php",
    data: {
      animalCodigo: animalCodigo,
      donoCodigo: donoCodigo,
      veterinario_codigo: veterinario_codigo,
      data: data,
      hora: hora,
      animalNome: animalNome,
      dono: dono,
      veterinario: veterinario,
      operation: "create"
    },
  }).done(function(resposta) {
    var obj = $.parseJSON(resposta);
    if (obj.status == "cadastrado") {
      var dia = obj.data.split("-")[0];
      var mes = obj.data.split("-")[1];
      var ano = obj.data.split("-")[2];

      obj.data = ("0" + ano).slice(-2) + '/' + ("0" + mes).slice(-2) + '/' + dia;

      $("#modalConsultaCadastrada").modal("show");
      $("#dataModal").html(obj.data);
      $("#horaModal").html(obj.hora);
      $("#animalNomeModal").html(obj.animal);
      $("#donoNomeModal").html(obj.dono);
      $("#veterinarioModal").html(obj.veterinario);

    }
    if (obj.status == "incomplete") {
      $("#modalAviso").modal("show");
    }
  });
});

$(document).on("click", 'button', function(element) {
  var id = element.currentTarget.id;
  if (id == "btn-consulta-cadastrado-modal") {
    $('#modalConsultaCadastrada').modal('hide');
    clearFilds();
  }
  if (id == "btn-aviso-modal") {
    $('#modalAviso').modal('hide');
  }
  if (id == "btn-ok-modal-exists") {
    $('#modalExists').modal('hide');
  }
});

$(document).ready(function() {
  $("#input_animal").keyup(function() {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "../../model/crud_consulta.php",
        method: "POST",
        data: {
          query: searchText,
          operation: "read_animal_fk"
        }
      }).done(function(resposta) {
        var obj = $.parseJSON(resposta)
        var nova_linha = ""
        $('#resultado').html("");

        Object.keys(obj).forEach((item) => {
          nova_linha += '<button class="list-group-item list-group-item-action " ' +
            'id="donoTelefone' + obj[item].donoTelefone +
            '_donoCPF' + obj[item].donoCPF +
            '_donoCodigo' + obj[item].donoCodigo +
            '_donoNome' + obj[item].donoNome +
            '_animalNome' + obj[item].animalNome +
            '_animalCodigo' + obj[item].animalCodigo +
            '">' + obj[item].animalNome + ' - ' + obj[item].donoNome +
            '</button><span></span>'
        });
        var stringExemplo = nova_linha;
        var resultado = stringExemplo.split("<span></span>");

        $('#resultado').append(resultado);

      });
    } else {
      $('#resultado').html("");
    }

  });

  $(document).on("click", "button", function(element) {
    var id = element.currentTarget.id

    var array = id.split("_")

    if (id.includes("donoCodigo")) {
      $('#resultado').html("");
      var telefone = array[0].replace("donoTelefone", "");
      var cpf = array[1].replace("donoCPF", "");
      var donoCodigo = array[2].replace("donoCodigo", "");
      var donoNome = array[3].replace("donoNome", "");
      var animalNome = array[4].replace("animalNome", "");
      var animalCodigo = array[5].replace("animalCodigo", "");

      $("#input_animal").val(animalNome)
      $("#input_animal_codigo").val(animalCodigo)
      $("#input_dono").val(donoNome)
      $("#dono_codigo").val(donoCodigo)
      $("#dono_cpf").val(cpf)
      $("#dono_telefone").val(telefone)
    }
  });
});