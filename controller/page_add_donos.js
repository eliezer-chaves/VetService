function clearFilds() {
  $("#nome").val("");
  $("#cpf").val("");
  $("#cep").val("");
  $("#rua").val("");
  $("#numero").val("");
  $("#complemento").val("");
  $("#bairro").val("");
  $("#cidade").val("");
  $("#uf").val("");
  $("#telefone").val("");
  $("#donoNome").val("");
  $("#donoExists").val("");
}

$("#cadastrar").click(function () {
  var nome = $("#nome").val();
  var cpf = $("#cpf").val();
  var cep = $("#cep").val();
  var rua = $("#rua").val();
  var numero = $("#numero").val();
  var complemento = $("#complemento").val();
  var bairro = $("#bairro").val();
  var cidade = $("#cidade").val();
  var uf = $("#uf").val();
  var telefone = $("#telefone").val();

  $.ajax({
    method: "POST",
    url: "../../model/crud_dono.php",
    data: {
      nome: nome,
      cep: cep,
      cpf: cpf,
      rua: rua,
      numero: numero,
      complemento: complemento,
      bairro: bairro,
      cidade: cidade,
      uf: uf,
      telefone: telefone,
      operation: "create",
    },
  }).done(function (resposta) {
    var obj = $.parseJSON(resposta);
    var nome = obj.dono;
    if (obj.status == "cadastrado") {
      $("#modalDonoCadastrado").modal("show");
      $("#donoNome").html(nome);
    }
    if (obj.status == "incomplete") {
      $("#modalAviso").modal("show");
    }
    if (obj.status == "exists") {
      $("#modalExists").modal("show");
      $("#donoExists").html(obj.cpf);
      //clearFilds();
    }
  });
});

$(document).on("click", "button", function (element) {
  var id = element.currentTarget.id;
  if (id == "btn-dono-cadastrado-modal") {
    $("#modalDonoCadastrado").modal("hide");
    clearFilds();
  }
  if (id == "btn-aviso-modal") {
    $("#modalAviso").modal("hide");
  }
  if (id == "btn-ok-modal-exists") {
    $("#modalExists").modal("hide");
  }
});

$(document).ready(function () {
  var $seuCampoCpf = $("#cpf");
  $seuCampoCpf.mask("000.000.000-00", {
    reverse: false,
  });
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

//Mask do CEP
$(document).ready(function () {
  $("#cep").mask("99.999-999");
});
//Função para o CEP
function limpa_formulário_cep() {
  // Limpa valores do formulário de cep.
  $("#rua").val("");
  $("#bairro").val("");
  $("#cidade").val("");
  $("#uf").val("");
  $("#numero").val("");
}
$("#cep").blur(function () {
  //Nova variável "cep" somente com dígitos.
  var cep = $(this).val().replace(/\D/g, "");

  //Verifica se campo cep possui valor informado.
  if (cep != "") {
    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if (validacep.test(cep)) {
      //Preenche os campos com "..." enquanto consulta webservice.
      $("#rua").val("...");
      $("#bairro").val("...");
      $("#cidade").val("...");
      $("#uf").val("...");
      $("#ibge").val("...");

      //Consulta o webservice viacep.com.br/
      $.getJSON(
        "https://viacep.com.br/ws/" + cep + "/json/?callback=?",
        function (dados) {
          if (!("erro" in dados)) {
            //Atualiza os campos com os valores da consulta.
            $("#rua").val(dados.logradouro);
            $("#bairro").val(dados.bairro);
            $("#cidade").val(dados.localidade);
            $("#uf").val(dados.uf);
            $("#ibge").val(dados.ibge);
          } //end if.
          else {
            //CEP pesquisado não foi encontrado.
            limpa_formulario_cep();
            alert("CEP não encontrado.");
          }
        }
      );
    } //end if.
    else {
      //cep é inválido.
      limpa_formulario_cep();
      alert("Formato de CEP inválido.");
    }
  } //end if.
  else {
    //cep sem valor, limpa formulário.
    limpa_formulario_cep();
  }
});
