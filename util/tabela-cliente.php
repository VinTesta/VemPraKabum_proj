<?php
require_once("../layout/dao-loader.php");

if(isset($_POST["nomecliente"]))
{
    try
    {
        $clienteDao = new ClienteDao(new ConexaoMySql);

        $pesquisaCliente = $clienteDao->buscaCliente($_POST);

        $id_busca = $pesquisaCliente["id_pesquisa"];
        $tamanho_json = count($pesquisaCliente["resultado"]);

        $json_final = json_encode($pesquisaCliente["resultado"], JSON_PRETTY_PRINT);
        $file = fopen('../util/repository/json/resultSearchCliente.json', 'w');
        fwrite($file, $json_final);
        fclose($file);

        if($tamanho_json > 0) {
            ?>
            <input type="hidden" id="id_pesquisa" value="<?= $id_busca ?>">
            <div class="alert alert-success text-center" role="alert">
                <?= $tamanho_json ?> resultado(s) encontrado(s)!
            </div>
            <table class="table table-striped table-hover" id="tabelaCliente">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">RG</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
            </table>
        <?php
        } else {
            ?>
            <div class="alert alert-warning text-center" role="alert">
                Nenhum resultado foi encontrado!
            </div>
            <?php
        }
        ?>

        <script type="text/javascript">
            var table = $('#tabelaCliente').DataTable({
                ajax: {
                    url: "util/repository/json/resultSearchCliente.json",
                    dataSrc: ""
                },
                createdRow: function (row, data, dataIndex) {
                    var formAltera = row.childNodes[5].childNodes[0].childNodes[3].childNodes[1].childNodes[1]
                    
                    var id_pesquisa = $("#id_pesquisa").val();

                    formAltera.childNodes[1].value = dataIndex;
                    formAltera.childNodes[3].value = id_pesquisa;
                },
                autoWidth: false,
                responsive: true,
                order: [[0, 'asc']],
                pageLength: 25,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    info: "Mostrando página _PAGE_ de _PAGES_.",
                    lengthMenu: "Mostrar _MENU_ registros.",
                    search: "Pesquisar:",
                    infoFiltered: "",
                    emptyTable: "Nenhum registro encontrado",
                    searchPlaceholder: "Nome",
                    paginate: {
                        first: "Primeira Página",
                        last: "Última Página",
                        next: "Próxima",
                        previous: "Anterior"
                    },
                    zeroRecords: "Nenhum registro encontrada!",
                    infoEmpty: "Nenhum resultado.",
                    loadingRecords: "Carregando...",
                    processing: "Processando...",
                    select: {
                        rows: {
                            _: "%d registros selecionados.",
                            0: "Nenhum registro selecionado.",
                            1: "1 registro selecionado."
                        }
                    }
                },
                columns: [
                    {//coluna 2
                        data: "nomecliente",
                        orderable: true,
                        searchable: true
                    },
                    {//coluna 2
                        data: "cpf",
                        orderable: true,
                        searchable: true
                    },
                    {//coluna 2
                        data: "rg",
                        orderable: false,
                        searchable: true
                    },
                    {//coluna 2
                        data: "datanascimento",
                        orderable: false,
                        searchable: true
                    },
                    {//coluna 2
                        data: "telefone",
                        orderable: true,
                        searchable: true
                    },
                    {//coluna 8
                        orderable: false,
                        searchable: false,
                        defaultContent: `<div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Opções
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <form action="cadastro-cliente" method="post" class="formAlterarCliente">
                                                        <input type="hidden" name="cont" id="cont">
                                                        <input type="hidden" name="id_pesquisa" id="id_pesquisa">
                                                        <button id="btnAlterarItem" class="dropdown-item">Ver dados</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>`
                    }
                ]
            });
        </script>
        <?php
    }
    catch(Exception $ex)
    {
    
    }
}
?>