<?php
include "../db.class.php";
include_once "../header.php";

$db = new db('post');

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

<h3>Listagem Postagem</h3>
<!-- http://localhost/pweb1_2025_1/php/site/admin/PostList.php -->
<form action="./PostList.php" method="post">

    <div class="row">
        <div class="col-md-2">
            <select name="tipo" class="form-select">
                <option value="titulo">Título</option>
                <option value="status">Status</option>
            </select>
        </div>

        <div class="col-md-6">
            <input type="text" name="valor" placeholder="pesquisar..." class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col mt-4">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="./PostForm.php" class="btn btn-secondary">Cadastrar</a>
        </div>
    </div>

</form>
</div>

<div class="row mt-4">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Data Publicação</th>
                <th scope="col">Status</th>
                <th scope="col">Categoria</th>
                <th scope="col">Ação</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $dbCategoria = new db('categoria');

            foreach ($dados as $item) {

                $data_publicacao = date(
                    'd/m/Y',
                    strtotime($item->data_publicacao)
                );
                $categoria = $dbCategoria->find($item->categoria_id);

                echo "
                        <tr>
                            <th scope='row'>$item->id</th>
                            <td>$item->titulo</td>
                            <td>$data_publicacao</td>
                            <td>$item->status</td>
                            <td>$categoria->nome</td>
                            <td>
                                <a href='./PostForm.php?id=$item->id'>Editar</a>
                            </td>
                            <td>
                                <a 
                                    onclick='return confirm(\"Deseja Excluir?\")'
                                    href='./PostList.php?id=$item->id'>Deletar</a>
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