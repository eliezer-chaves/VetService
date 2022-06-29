var inputNome = $("#nome");
var inputCPF = $("#cpf");
var inputCEP = $("#cep");
var inputRua = $("#rua");
var inputNumero = $("#numero");
var inputComplemento = $("#complemento");
var inputBairro = $("#bairro");
var inputCidade = $("#cidade");
var inputUF = $("#uf");
var inputTelefone = $("#telefone");
var inputModalNomeDono = $("#ModalNomeDono");
var inputModalExistsNomeDono = $("#donoExists");
var buttonCadastrar = $("#cadastrar");
var urlCRUDDono = "../../model/crud_dono.php";
var modalDonoCadastrado = $("#modalDonoCadastrado");
var modalAviso = $("#modalAviso");
var modalExists = $("#modalExists");

function clearFilds() {
  inputNome.val("");
  inputCPF.val("");
  inputCEP.val("");
  inputRua.val("");
  inputNumero.val("");
  inputComplemento.val("");
  inputBairro.val("");
  inputCidade.val("");
  inputUF.val("");
  inputTelefone.val("");
  inputModalNomeDono.val("");
  inputModalExistsNomeDono.val("");
}

buttonCadastrar.click(function () {
  var nome = inputNome.val();
  var cpf = inputCPF.val();
  var cep = inputCEP.val();
  var rua = inputRua.val();
  var numero = inputNumero.val();
  var complemento = inputComplemento.val();
  var bairro = inputBairro.val();
  var cidade = inputCidade.val();
  var uf = inputUF.val();
  var telefone = inputTelefone.val();

  $.ajax({
    method: "POST",
    url: urlCRUDDono,
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
      modalDonoCadastrado.modal("show");
      inputModalNomeDono.html(nome);
    }
    if (obj.status == "incomplete") {
      modalAviso.modal("show");
    }
    if (obj.status == "exists") {
      modalExists.modal("show");
      inputModalExistsNomeDono.html(obj.cpf);
    }
  });
});

$(document).on("click", "button", function (element) {
  var id = element.currentTarget.id;
  if (id == "btn-dono-cadastrado-modal") {
    modalDonoCadastrado.modal("hide");
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
  var $seuCampoCpf = inputCPF;
  $seuCampoCpf.mask("000.000.000-00", {
    reverse: false,
  });
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
  inputCEP.mask("99.999-999");
});

inputCEP.blur(function () {
  var cep = inputCEP.val().replace(/\D/g, "");

  if (cep != "") {
    var validacep = /^[0-9]{8}$/;

    if (validacep.test(cep)) {
      inputRua.val("Buscando...");
      inputBairro.val("Buscando...");
      inputCidade.val("Buscando...");
      inputUF.val("Buscando...");

      $.getJSON(
        "https://viacep.com.br/ws/" + cep + "/json/?callback=?",
        function (dados) {
          if (!("erro" in dados)) {
            inputRua.val(dados.logradouro);
            inputBairro.val(dados.bairro);
            inputCidade.val(dados.localidade);
            inputUF.val(dados.uf);
          } else {
            inputCEP.val("");
            inputRua.val("");
            inputBairro.val("");
            inputCidade.val("");
            inputUF.val("");
            alert("CEP não encontrado.");
          }
        }
      );
    } else {
      inputCEP.val("");
      inputRua.val("");
      inputBairro.val("");
      inputCidade.val("");
      inputUF.val("");
      alert("Formato de CEP inválido.");
    }
  } else {
    inputCEP.val("");
    inputRua.val("");
    inputBairro.val("");
    inputCidade.val("");
    inputUF.val("");
  }
});
