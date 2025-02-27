<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
    }

    require_once __DIR__ . '/../vendor/autoload.php';

    use App\controllers\ClienteController;

    $controller = new ClienteController();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome CDN -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet"> <!-- SweetAlert2 CSS -->
    <script src="./js/script.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
                <img alt="Logo Kabum" loading="lazy" width="158" height="64" decoding="async" data-nimg="1" src="https://static.kabum.com.br/conteudo/icons/logo.svg" style="color: transparent; height: 100%;">
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/login/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Clientes</h1>
        <button type="button" id="btnNovoCliente" class="btn btn-primary">Novo Cliente</button>
        <table class="table table-striped tblClientes">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Telefone</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <div class="modal modal-lg" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="#" id="formularioNovoCliente">
                            <input type="hidden" name="codigo" id="codigo">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                                        <label for="floatingInput">Nome</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Data de nascimento">
                                        <label for="floatingInput">Data nascimento</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="rg" name="rg" placeholder="RG">
                                        <label for="floatingInput">RG</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                                        <label for="floatingInput">CPF</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
                                        <label for="floatingInput">telefone</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-left align-items-center">
                                            <h5>Endereços</h5>
                                            <button type="button" id="btnNovoEndereco" class="btn btn-primary ms-2">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="dvenderecos">
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="endereco[]" class="form-control" placeholder="Endereco">
                                                    <label for="floatingInput">Endereco</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="numero[]" class="form-control" placeholder="Numero">
                                                    <label for="floatingInput">Número</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="bairro[]" class="form-control" placeholder="Bairro">
                                                    <label for="floatingInput">Bairro</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="cidade[]" class="form-control" placeholder="Cidade">
                                                    <label for="floatingInput">Cidade</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="estado[]" class="form-control" placeholder="Estado">
                                                    <label for="floatingInput">Estado</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="complemento[]" class="form-control" placeholder="Estado">
                                                    <label for="floatingInput">Complemento</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnSalvar">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> <!-- SweetAlert2 JS -->
    <script>
        $(document).ready(function() {

            $("#btnNovoCliente").on("click", function() {
                $(".modal").modal("show");
            });

            $("#btnNovoEndereco").on("click", function() {
                novoEndereco();
            });

            $("#btnSalvar").on("click", function() {
                var form = $("#formularioNovoCliente").serialize();

                if (!validaData($("#data_nascimento").val())) {
                    ExibeMensagem('Data de nascimento inválida.');
                    return;
                }

                $.ajax({
                    url: "/cliente/save.php",
                    type: "POST",
                    data: form,
                    dataType: "json",
                    success: function (xRetorno) {
                        $(".modal").modal("hide");
                        limpaModal();
                        carregaClientes();

                        ExibeMensagem(xRetorno.message);
                    },
                    error: function (data) {
                        ExibeMensagem('Ocorreu um erro ao cadastrar o cliente.');

                    }
                });
            });

            carregaClientes();
            reinicializaAcaoBotoes();
        });



        function limpaModal() {
            $("#formularioNovoCliente input").val("");
            $("#dvenderecos").html("");
            novoEndereco();
        }



        function reinicializaAcaoBotoes() {
            $(".btnExcluirCliente").on("click", async function() {

                let resposta = await ExibePergunta('Deseja realmente excluir o cliente?');

                if (!resposta){
                    return;
                }

                var codigo = $(this).attr("codigo");
                $.ajax({
                    url: "/cliente/delete.php",
                    type: "POST",
                    data: {codigo: codigo},
                    success: function (xRetorno) {
                        carregaClientes();
                        ExibeMensagem('Cliente deletado com sucesso!');
                    },
                    error: function (data) {
                        ExibeMensagem('Ocorreu um erro ao deletar o cliente.');
                    }
                });
            });

            $(".btnEditarCliente").on("click", function() {
                var codigo = $(this).attr("codigo");
                $.ajax({
                    url: "/cliente/edit.php",
                    type: "POST",
                    dataType: "json",
                    data: {codigo: codigo},
                    success: function (xRetorno) {
                        $("#codigo").val(xRetorno.codigo);
                        $("#nome").val(xRetorno.nome);
                        $("#data_nascimento").val(xRetorno.data_nascimento);
                        $("#rg").val(xRetorno.rg);
                        $("#cpf").val(xRetorno.cpf);
                        $("#telefone").val(xRetorno.telefone);

                        $("#dvenderecos").html("");

                        if (Array.isArray(xRetorno.enderecos)) {
                            xRetorno.enderecos.forEach(endereco => {
                                var row = $('<div>', { class: 'row' });

                                var colEndereco = $('<div>', { class: 'col-9' }).append(
                                    $('<div>', { class: 'form-floating mb-3' }).append(
                                        $('<input>', { type: 'text', class: 'form-control', name: 'endereco[]', placeholder: 'Endereco', value: endereco.endereco }),
                                        $('<label>', { for: 'floatingInput' }).text('Endereco')
                                    )
                                );

                                var colNumero = $('<div>', { class: 'col-3' }).append(
                                    $('<div>', { class: 'form-floating mb-3' }).append(
                                        $('<input>', { type: 'text', class: 'form-control', name: 'numero[]', placeholder: 'Numero', value: endereco.numero }),
                                        $('<label>', { for: 'floatingInput' }).text('Numero')
                                    )
                                );

                                var colBairro = $('<div>', { class: 'col-4' }).append(
                                    $('<div>', { class: 'form-floating mb-3' }).append(
                                        $('<input>', { type: 'text', class: 'form-control', name: 'bairro[]', placeholder: 'Bairro', value: endereco.bairro }),
                                        $('<label>', { for: 'floatingInput' }).text('Bairro')
                                    )
                                );

                                var colCidade = $('<div>', { class: 'col-4' }).append(
                                    $('<div>', { class: 'form-floating mb-3' }).append(
                                        $('<input>', { type: 'text', class: 'form-control', name: 'cidade[]', placeholder: 'Cidade', value: endereco.cidade }),
                                        $('<label>', { for: 'floatingInput' }).text('Cidade')
                                    )
                                );

                                var colEstado = $('<div>', { class: 'col-4' }).append(
                                    $('<div>', { class: 'form-floating mb-3' }).append(
                                        $('<input>', { type: 'text', class: 'form-control', name: 'estado[]', placeholder: 'Estado', value: endereco.estado }),
                                        $('<label>', { for: 'floatingInput' }).text('Estado')
                                    )
                                );

                                var colComplemento = $('<div>', { class: 'col-12' }).append(
                                    $('<div>', { class: 'form-floating mb-3' }).append(
                                        $('<input>', { type: 'text', class: 'form-control', name: 'complemento[]', placeholder: 'Complemento', value: endereco.complemento }),
                                        $('<label>', { for: 'floatingInput' }).text('Complemento')
                                    )
                                );

                                row.append(colEndereco, colNumero, colBairro, colCidade, colEstado, colComplemento);

                                $('#dvenderecos').append(row);
                            });
                        } else {
                            // Se não houver endereços, adicione um novo endereço vazio
                            novoEndereco();
                        }

                        $(".modal").modal("show");
                    },
                    error: function (data) {
                        ExibeMensagem('Ocorreu um erro ao editar o cliente.');
                    }
                });
            });
        }

        function carregaClientes(){
            $.ajax({
                    url: "/cliente/list.php",
                    type: "GET",
                    success: function (xRetorno) {
                        var clientes = JSON.parse(xRetorno);
                        $(".tblClientes tbody").html("");

                        clientes.forEach(cliente => {
                            let botaoEditar = $('<button>', { type: 'button', class: 'btn btn-warning btnEditarCliente', codigo: cliente.codigo }).append($("<i>", { class: 'fa-solid fa-edit' }));
                            let botaoExcluir = $('<button>', { type: 'button', class: 'btn btn-danger btnExcluirCliente', codigo: cliente.codigo }).append($("<i>", { class: 'fa-solid fa-trash' }));

                            var tr = $("<tr>");
                            tr.append($("<td>").text(cliente.codigo));
                            tr.append($("<td>").text(cliente.nome));
                            tr.append($("<td>").text(formataData(cliente.data_nascimento)));
                            tr.append($("<td>").text(cliente.cpf));
                            tr.append($("<td>").text(cliente.rg));
                            tr.append($("<td>").text(cliente.telefone));
                            tr.append($("<td>").append(botaoEditar));
                            tr.append($("<td>").append(botaoExcluir));
                            $(".tblClientes tbody").append(tr);
                        });
                        reinicializaAcaoBotoes();
                    },
                    error: function (data) {
                        ExibeMensagem('Ocorreu um erro ao carregar os clientes.');
                    }
                });
        }

        function editarCliente(){

        }

        function formataData(data) {
            var data = new Date(data);
            return data.toLocaleDateString();

        }

        function novoEndereco()  {

            $('#dvenderecos').append('<hr>');
            var row = $('<div>', { class: 'row' });

            var colEndereco = $('<div>', { class: 'col-9' }).append(
                $('<div>', { class: 'form-floating mb-3' }).append(
                    $('<input>', { type: 'text', class: 'form-control', name: 'endereco[]', placeholder: 'Endereco' }),
                    $('<label>', { for: 'floatingInput' }).text('Endereco')
                )
            );

            var colNumero = $('<div>', { class: 'col-3' }).append(
                $('<div>', { class: 'form-floating mb-3' }).append(
                    $('<input>', { type: 'text', class: 'form-control', name: 'numero[]', placeholder: 'Numero' }),
                    $('<label>', { for: 'floatingInput' }).text('Numero')
                )
            );

            var colBairro = $('<div>', { class: 'col-4' }).append(
                $('<div>', { class: 'form-floating mb-3' }).append(
                    $('<input>', { type: 'text', class: 'form-control', name: 'bairro[]', placeholder: 'Bairro' }),
                    $('<label>', { for: 'floatingInput' }).text('Bairro')
                )
            );

            var colCidade = $('<div>', { class: 'col-4' }).append(
                $('<div>', { class: 'form-floating mb-3' }).append(
                    $('<input>', { type: 'text', class: 'form-control', name: 'cidade[]', placeholder: 'Cidade' }),
                    $('<label>', { for: 'floatingInput' }).text('Cidade')
                )
            );

            var colEstado = $('<div>', { class: 'col-4' }).append(
                $('<div>', { class: 'form-floating mb-3' }).append(
                    $('<input>', { type: 'text', class: 'form-control', name: 'estado[]', placeholder: 'Estado' }),
                    $('<label>', { for: 'floatingInput' }).text('Estado')
                )
            );

            var colComplemento = $('<div>', { class: 'col-12' }).append(
                $('<div>', { class: 'form-floating mb-3' }).append(
                    $('<input>', { type: 'text', class: 'form-control', name: 'complemento[]', placeholder: 'Estado' }),
                    $('<label>', { for: 'floatingInput' }).text('Estado')
                )
            );

            row.append(colEndereco, colNumero, colBairro, colCidade, colEstado, colComplemento);

            $('#dvenderecos').append(row);
        }

    </script>
</body>
</html>
