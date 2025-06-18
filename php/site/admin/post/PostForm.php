<?php
include "../db.class.php";
include_once "../header.php";

$db = new db('post');

$db->checkLogin();

$dbCategoria = new db('categoria');
$categorias = $dbCategoria->all();

$data = null;
$errors = [];
$success = '';

if (!empty($_POST)) {

    //Sempre preserva os dados do POST para exibição
    $data = (object) $_POST; //converte o vetor para objeto

    //função trim remove espaços em branco do inicio e fim da string, 
    if (empty(trim($_POST['titulo']))) {
        $errors[] = "<li>O titulo é obrigatorio</li>";
    }

    if (empty(trim($_POST['descricao']))) {
        $errors[] = "<li>O descricao é obrigatorio</li>";
    }

    if (empty(trim($_POST['categoria_id']))) {
        $errors[] = "<li>O Categoria é obrigatorio</li>";
    }

    if (empty($errors)) {
        try {
            if (empty($_POST['id'])) {
                $db->store($_POST);
                $success = "Registro criado com sucesso!";
            } else {
                $db->update($_POST);
                $success = "Registro atualizado com sucesso!";
            }
            echo "<script>
                    setTimeout(
                        ()=> window.location.href = 'PostList.php', 1500
                    )
                </script>";
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }

}

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
}

//serve para depurar o codigo, ver o que tem dentro da variavel
//var_dump($data, $_GET['id']);
//para a execução do codigo na linha onde foi colocada
//exit;
?>
<?php if (!empty($errors)) { ?>
    <div class="alert alert-danger">
        <strong>Erro ao salvar</strong>
        <ul class="mb-0">
            <?php foreach ($errors as $error) { ?>
                <?= $error ?>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<?php if (!empty($success)) { ?>
    <div class="alert alert-success">
        <strong>
            <?= $success ?>
        </strong>
    </div>
<?php } ?>

<h3>Formulário Postagem</h3>
<!-- http://localhost/pweb1_2025_1/php/site/admin/UsuarioForm.php -->
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

    <div class="row">
        <div class="col-md-6">
            <label for="" class="form-label">Titulo</label>
            <input type="text" name="titulo" value="<?php echo $data->titulo ?? '' ?>" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select name="categoria_id" class="form-select">
                <?php
                foreach ($categorias as $categoria) {
                    ?>
                    <option value="<?= $categoria->id ?>">
                        <?= $categoria->nome ?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="data_publicacao" class="form-label">Data Publicação</label>
            <input type="date" name="data_publicacao" class="form-control" value="<?= $data->data_publicacao ?? '' ?>"
                class="form-control">
        </div>
        <div class="col-md-6">

            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="publicado">Publicado</option>
                <option value="nao_publico">Não Publicado</option>
            </select>
        </div>

    </div>

    <div class="col-md-12">
        <label for="" class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control"> <?= $data->descricao ?? '' ?></textarea>
    </div>

    <div class="row">
        <div class="col mt-4">
            <button type="submit" class="btn btn-primary">
                <?= !empty($_GET['id']) ? "Editar" : "Salvar" ?>
            </button>
            <a href="./PostList.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

</form>
</div>

<?php
include_once "../footer.php";
?>