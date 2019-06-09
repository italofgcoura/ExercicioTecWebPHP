
// início quando a página carregar, irá efetuar estas ações
$(document).ready(function () {


    carrega_Receitas();





    //GRAVAR
    //botão para gravar a receita com a verificação se todos campos estão digitados corretamente
    $('#btnGravarReceita').click(function () {
        var nome = $('#nomeReceita').val();

        var url = $('#urlFotoReceita').val();

        var descricao = $('#descricaoReceita').val();


        //VERIFICAÇÃO SE ALGUM CAMPO NÃO ESTÁ PREENCHIDO
        if (nome == "" || url == "" || descricao == "") {
            alert("FAVOR PREENCHER TODOS OS DADOS!");
        }
        else {
            //AQUI COMEÇA A CONEXÃO COM O SERVIDOR
            $.ajax({
                method: "POST",
                url: "php/servicos.php?servico=inserir",
                data: { nome: nome, url: url, descricao: descricao }
            })
                .done(function (retorno) {
                    if (retorno == 1) {
                        alert("RECEITA CADASTRADA COM SUCESSO!");
                        carrega_Receitas();
                    } else {
                        alert("ERRO AO INSERIR NOVA RECEITA!");
                    }
                });

        }
    });

    //DELETAR
    //botão para deletar uma receita
    $(document).on('click', '#btnExcluirReceita', function () {

        //pega o próximo do card e exclui
        var card = $(this).closest(".card_receita");
        card.remove();
        alert("Receita excluída");

        var id = $(this).attr("data-id");

        $.ajax({
            method: "POST",
            url: "php/servicos.php?servico=deletar&id=" + id,
        })
            .done(function (retorno) {

                if (retorno == "1") {
                    card.fadeOut(500, function () {
                    });
                } else {
                    alert("Erro ao apagar dados no sistema");
                }

            });

    });




    // REMOVER
    //botão para REMOVER votos CASO SEJA PRECISO
    $(document).on('click', '#btnRemoverVotar', function () {

        var valorATual = $(this).attr("data-valor");


        if (valorATual > 0) {
            $(this).attr("data-valor", (valorATual - 1));
            var votosMenos = $(this).parent().children("span").eq(0);
            console.log(votosMenos.html());
        }
        else {
            alert("Receita com ZERO votos.");
        }
    });


    // REMOVER
    //botão para VOTAR votos CASO SEJA PRECISO
    $(document).on('click', '#btnVotar', function () {

        var texto = $(this).parent().children('span').eq(0);
        var id = $(this).attr("data-id");
        var quant = $(this).attr("data-valor");

        var botao = $(this);

        $.ajax({
            method: "POST",
            url: "php/servicos.php?servico=votar&id=" + id,
        })
            .done(function (retorno) {

                if (retorno == "1") {
                    quant++;
                    botao.attr("data-valor", quant);

                    texto.html("" + quant);

                } else {
                    alert("Erro ao adicionar quantidade no sistema");
                }
            });
    });

});
// término das ações quando a página carregar


//LISTAR
//listar receitas
var carrega_Receitas = function () {

    $.ajax({
        method: "POST",
        url: "php/servicos.php?servico=listar",
    })

        .done(function (retorno) {

            if (retorno == "[]") {
                $(".conteudo").html("Receita não encontrada!");
            } else {


                //Limpa o que tem em conteúdo						
                $(".conteudo").html("");

                //Loop para processar o JSON
                $.each(JSON.parse(retorno), function (key, item) {
                    $(".conteudo").append(templatePaginaReceitas(item['id'], item['votos'], item['nome'], item['url'], item['descricao']));
                });

            }
        });
}

var templatePaginaReceitas = function (id, votos, nome, url, descricao) {
    return "" +
        "<div class=\"col-lg-4 col-md-6 col-sm-12 p-3 card_receita\">" +
        "<div class=\"card h-100\"><img class=\"card-img-top img-fluid imagemReceita\"src=" + url + " alt=\"img\">" +
        "<div class=\"card-title tituloReceita\"><span><h7 class=\"card-title\">" + nome + "</h7></span></div >" +
        "<div><p class=\"card-body\">" + descricao + "</p> </div>" +

        "<div class=\"card-footer text-center bg-white\"><button class=\"btn btn-outline-secondary\" id=\"btnVotar\" data-valor='" + votos +
        " 'data-id='" + id + "'>+Votar</button><span data-id='" + id + "' id=\"totalVotos\">" + votos +

        "</span><button class=\"btn btn-outline-danger\" id=\"btnExcluirReceita\" data-id='" + id + "' >EXCLUIR</button>"

}

