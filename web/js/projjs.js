$(document).ready(() =>
{
    //#region DISPARA FUNÇÕES DE INICIALIZAÇÃO
    verificaAlerta();
    adicionaMascaras();
    //#endregion

    //#region MASKS
    function adicionaMascaras()
    {
        $('.cpf').mask('000.000.000-00', {placeholder: "___.___.___-__"});
        $('.data').mask('00/00/0000', {placeholder: "__/__/____"});
        $('.rg').mask('00.000.000-0', {placeholder: "__.___.___-_"});
        $('.celular').mask('(00)00000-0000', {placeholder: "(__)_____-____"});
        $('.cep').mask('00000-000', {placeholder: "_____-___"});
        $('.numEnd').mask('00000', {placeholder: "_____"});
        $('.uf').mask('AA', {placeholder: "_____"});
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });
    }
    //#endregion

    //#region id = btnLogar
    $(document).on("click", "#btnLogar", (e) => 
    {
        if(validaCampos(".validate-form"))
        {
            mostraMensagem("Campos inválidos! Preencha-os para continuar");
        }
        else
        {
            var campos = {email: $("#email").val(), senha: $("#senha").val()};
            
            login(campos)
        }
    })
    //#endregion

    //#region LOGIN
    function login(campos)
    {
        $.ajax({
            url: "controller/logar-usuario.php",
            type: "POST",
            data: {email: campos['email'], senha: campos['senha'], btnLogar: true},
            success: (res) =>
            {
                var res_json = JSON.parse(res)
                if(res_json.status == 1)
                {
                    window.location.href = "admin";
                    localStorage.setItem("alerta", res_json.mensagem);
                }
                
                mostraMensagem(res_json.mensagem)
            },
            error: (erro) => 
            {
                console.log(erro.responseText);
            }
        })
    }
    //#endregion

    //#region  id = btnPesquisaCliente
    $(document).on("click", "#btnPesquisaCliente", () => 
    {
        pesquisaCliente({
            nomecliente: $("#nomeCliente").val(),
            cpf: $("#cpfCliente").cleanVal(),
            dataNascimento: $("#dataNascimento").val(),
            rg: $("#rgCliente").cleanVal(),
            telefone: $("#telefoneCliente").cleanVal()
        });
        
    })
    //#endregion

    //#region PESQUISACLIENTE

    function pesquisaCliente(campos)
    {
        $("#boxTabelaCliente").html(getLoader());
        $.ajax({
            url: "util/tabela-cliente.php",
            type: "post",
            data: campos,
            success: (res) =>
            {
                $("#boxTabelaCliente").html(res);
                $("#boxTabelaCliente").addClass("p-4");
            },
            error: (erro) => 
            {
                console.log(erro.responseText);
            }
        })
    }
    
    //#endregion

    //#region MOSTRAR MENSAGEM
    function mostraMensagem(msg)
    {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl, [])
        })

        $(".toast-body").html(msg);
        toastList[0].show()
    }
    //#endregion

    //#region VERIFICA MENSAGENS DO SISTEMA
    function verificaAlerta()
    {
        if(localStorage.getItem("alerta") != "")
        {
            mostraMensagem(localStorage.getItem("alerta"));
            localStorage.setItem("alerta", "");
        }
    }
    //#endregion

    //#region LOADER DA PESQUISA
    function getLoader()
    {
        return `<div id="containerSpinner">
                    <div class="shadow p-3 m-2 bg-body rounded" id="boxSpinner">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>`;
    }
    //#endregion

    //#region BOTÃO PARA PULAR PAGINAS CLIENTE
    $(document).on("click", "#btnEnderecoCliente", () => 
    {
        $("#endereco-tab").trigger("click")
    })

    $(document).on("click", "#btnInformacoesBasicasCliente", () => 
    {
        $("#infoBasica-tab").trigger("click")
    })
    //#endregion

    //#region CARREGAR ENDEREÇOS DO CLIENTE
    if($("#bodyCardEndereco").is(":hidden"))
    {
        var cont = $("#cont").val();
        var id_pesquisa = $("#id_pesquisa").val();

        geraCamposEnderecoCliente(cont, id_pesquisa, "#bodyCardEndereco", $("#bodyCardEndereco")[0].children.length);
        adicionaMascaras();     
    }
    
    //#endregion

    //#region BUSCA ENDERECO CEP
    
    $(document).on("focusout", ".cepEndCliente", (e) =>
    {
        buscaEnderecoViaCep(e.target.value, e.target);
    })

    function buscaEnderecoViaCep(cep, component)
    {
        $.ajax({
            url: "http://viacep.com.br/ws/"+cep+"/json/ ",
            type: "get",
            data: {},
            success: (res) => {
                console.log(res);
                var cardBody = component.parentNode.parentNode.parentNode
                cardBody.getElementsByClassName("bairroEndCliente")[0].value = res.bairro
                cardBody.getElementsByClassName("cidadeEndCLiente")[0].value = res.localidade
                cardBody.getElementsByClassName("estadoEndCliente")[0].value = res.uf
                cardBody.getElementsByClassName("logEndCliente")[0].value = res.logradouro
                
                if(res.cep != undefined)
                {
                    cardBody.getElementsByClassName("paisEndCliente")[0].value = "Brasil";
                }
            },
            erro: (error) => 
            {
                console.log(error)
            }
        })
    }
    //#endregion

    //#region GERAR CAMPOS DE ENDEREÇO DO CLIENTE
    function geraCamposEnderecoCliente(cont, id_pesquisa, div, contEnd)
    {
        var data = cont != "" ? {cont, id_pesquisa, opt: 1, contEnd} : {opt: 1, contEnd};

        $.ajax({
            type: "post",
            url: "util/gera-campos.php",
            data: data,
            success: (res) => 
            {
                $(div).append(res);
            },
            erro: (error) =>
            {
                console.log(error);
            }
        })
    }

    $(document).on("click", "#btnAddEndereco", () => 
    {
        geraCamposEnderecoCliente("", "", "#bodyCardEndereco", $("#bodyCardEndereco")[0].children.length);
    })
    //#endregion
 
    //#region REMOVE CAMPOS DE ENDEREÇO
    $(document).on("click", "#btnRemoveEndereco", (e) =>
    {
        var removeid = e.target.dataset.removeid

        removeCardCampos("#"+removeid)
    })
    function removeCardCampos(divFilho)
    {
        $(divFilho).remove();
    }
    //#endregion

    //#region BUTTON = btnSalvarCliente
    $(document).on("click", "#btnSalvarCliente", (e) =>
    {
        e.preventDefault();

        var erro = validaCampos(".force-check")

        $("#contEndereco").val($("#bodyCardEndereco")[0].children.length)

        if($("#contEndereco").val() <= 0)
        {
            mostraMensagem("O cliente precisa ter no mínimo 1 endereço!");
            return false;
        }

        if(erro == true)
        {
            return false;
        }

        $("#formularioCliente").submit();
    })
    //#endregion

    //#region VALIDAÇÃO DE CAMPOS PARÂMETRIZADOS
    
    function validaCampos(property)
    {
        var campos = $(property);
        var erro = false;
        for(var i=0; i < campos.length; i++)
        {
            switch(campos[i].dataset.validate)
            {
                case 'cpf':
                    erro = validaCpf("#"+campos[i].id, erro);
                    break;
                case 'rg':
                    erro = validaRg("#"+campos[i].id, erro);
                    break;
                case 'date':
                    erro = validaData("#"+campos[i].id, erro);
                    break;
                case "tell":
                    erro = validaTelefone("#"+campos[i].id, erro);
                    break;
            }

            if(campos[i].value == "")
            {
                mostraMensagem("Há campos vazis ou invalidos!");
                campos[i].classList.add("invalidValue")
                erro = true;
            }
            else
            {
                campos[i].classList.remove("invalidValue")
            }
        }

        return erro;
    }

    function validaCpf(campo, erro)
    {
        var strCPF = $(campo).cleanVal()
        var Soma;
        var Resto;
        Soma = 0;
        
        var erroFunc = false

        if (strCPF == "00000000000") erroFunc = true;

        for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(9, 10)) )  erroFunc = true;

        Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11) ) ) erroFunc = true;

        if(erroFunc)
        {
            $(campo)[0].classList.add("invalidValue");
            mostraMensagem("CPF inválido!");
            erro = erroFunc
        }
        else
        {
            $(campo)[0].classList.remove("invalidValue")
        }

        return erro;
    }

    function validaRg(campo, erro)
    {
        var strRG = $(campo).cleanVal()
        
        var erroFunc = false

        if (strRG == "000000000" || strRG.length < 9) erroFunc = true;

        if(erroFunc)
        {
            $(campo)[0].classList.add("invalidValue");
            mostraMensagem("RG inválido!");
            erro = erroFunc
        }
        else
        {
            $(campo)[0].classList.remove("invalidValue")
        }

        return erro;
    }

    function validaData(campo, erro)
    {
        var input = $(campo);
        var strData = input.val();
        strData = strData.replace("/", "").replace("/", "");
        var erroFunc = false

        if (strData.length < 8)erroFunc = true;

        if(erroFunc)
        {
            $(campo)[0].classList.add("invalidValue");
            mostraMensagem("Data Inválida!");
            erro = erroFunc
        }
        else
        {
            $(campo)[0].classList.remove("invalidValue")
        }

        return erro;
    }

    function validaTelefone(campo, erro)
    {
        var strTell = $(campo).val();
        strTell = strTell.replace("(", "").replace(")", "").replace("-", "");

        var erroFunc = false
        if (strTell.length < 11) erroFunc = true;

        if(erroFunc)
        {
            $(campo)[0].classList.add("invalidValue");
            mostraMensagem("Telefone Inválido!");
            erro = erroFunc
        }
        else
        {
            $(campo)[0].classList.remove("invalidValue")
        }

        return erro;
    }

    //#endregion

    //#region ECLUIR CLIENTE
    function excluirCliente(data, id_pesquisa)
    {
        $.ajax({
            type: "POST",
            url: "controller/remove-cliente.php",
            data: {cont: data, id_pesquisa},
            success: function (res) {
                mostraMensagem(res);
                $("#btnPesquisaCliente").trigger("click")    
            }
        });
    }
    
    //#endregion

    //#region BTNEXCLUIRCLIENTE
    $(document).on('click', '#tabelaCliente #btnExcluirCliente', function () {
        if(confirm("Confirmar exclusão do registro?"))
        {
            var data = table.row($(this).parents('tr')).index();

            var id_pesquisa = $("#id_pesquisa").val()

            excluirCliente(data, id_pesquisa);
        }
    });
    //#endregion
})