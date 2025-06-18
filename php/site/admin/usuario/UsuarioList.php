<?php
include "../db.class.php";
include_once "../header.php";

$db = new db('usuario');

$db->checkLogin();

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
}

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}

?>

<body>
    <div class="container">
        <div class="row">
            <h3>Listagem Usuário</h3>
            <!-- http://localhost/pweb1_2025_1/php/site/admin/UsuarioList.php -->
            <form action="./UsuarioList.php" method="post">

                <div class="row">
                    <div class="col-md-2">
                        <select name="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="cpf">CPF</option>
                            <option value="telefone">Telefone</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="valor" placeholder="pesquisar..." class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                        <a href="./UsuarioForm.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> Cadastrar</a>
                    </div>
                </div>

            </form>
        </div>

        <div class="row mt-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ação</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dados as $item) {
                        echo "
                        <tr>
                            <th scope='row'>$item->id</th>
                            <td>$item->nome</td>
                            <td>$item->cpf</td>
                            <td>$item->telefone</td>
                            <td>$item->email</td>
                            <td>
                                <a class='btn btn-warning' title='Editar' href='./UsuarioForm.php?id=$item->id'><i class='fa-solid fa-pen-to-square'></i></a>
                            </td>
                            <td>
                                <a class='btn btn-danger' title='Excluir'
                                    onclick='return confirm(\"Deseja Excluir?\")'
                                    href='./UsuarioList.php?id=$item->id'><i class='fa-solid fa-trash'></i></a>
                            </td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
        include_once "../footer.php";
        ?>