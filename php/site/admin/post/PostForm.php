<?php
include "../db.class.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<?php

$db = new db('post');

$dbCategoria = new db('categoria');
$categorias = $dbCategoria->all();


$data = null;
$errors = [];
$success = '';

if (!empty($_POST)) { 

    $data = (object) $_POST;

    if(empty(trim($_POST['titulo']))){
        $errors[] = "<li>o titulo é obrigatorio!</li>";
    }
    if(empty(trim($_POST['descricao']))){
        $errors[] = "<li>a descricao é obrigatorio!</li>";
    }
    if(empty(trim($_POST['categoria']))){
        $errors[] = "<li>a categoria é obrigatorio!</li>";
    }
    
    if (empty($errors)){
        try {
            if (empty($_POST['id'])){
                $db->store($_POST);
                $success = "Registro criado com sucesso!";
            }else{
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

    if (empty($_POST['id'])){   
        $db->store($_POST);
    } else {
        $db->update($_POST);   
    }
    header('location:./UsuarioList.php');
}


if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
}

//var_dump($data);

?>

<body>
    <div class="container mt-5">
        <div class="row">

            <?php if(!empty($errors)) { ?>
                <div class="alert alert-danger">
                    <strong>Erro ao Salvar</strong>
                    <ul class="mb-0">  
                        <?php foreach ($errors as $error) { ?>
                            <?= $error ?>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <?php if(!empty($sucess)) { ?>
                <div class="alert alert-success">
                    <li>
                        <?= $success ?>
                    </li>
                </div>
            <?php } ?>

            <h3>Formulário Usuário</h3>
            <!-- http://localhost/pweb1_2025_1/php/site/admin/UsuarioForm.php -->
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">Titulo</label>
                        <input type="text" name="titulo" value="<?= $data->nome ?? '' ?>" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="" class="form-label">Descricao</label>
                        <textarea name="descricao" class="form-control"> <?= $data->descricao ?? '' ?></textareaname>
                        <input type="email" name="descricao" value="<?= $data->email ?? '' ?>"class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">Data Publicacao</label>
                        <input type="text" name="data_publicacao" value="<?= $data->cpf ?? '' ?>"class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Status</label>
                        <select name="status" class="select-control">
                            <option value="publicacao">Publicado</option>
                            <option value="nao_publico">Não Publicado</option>
                        </select>
                        <input type="text" name="status" value="<?= $data->telefone ?? '' ?>"class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="" class="form-label">Status</label>
                        <select name="status" class="select-control">
                            <?php
                            foreach($categorias as $categoria){
                            ?>
                                <option value="<?= $categoria->id ?>">
                                    <?= $categoria->nome ?>
                                </option>
                            <?php
                            }
                            ?> 
                        </select>
                        <input type="text" name="status" value="<?= $data->telefone ?? '' ?>"class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col mt-4">
                        <button type="submit" class="btn btn-primary">
                            <?= !empty($_GET['id']) ? "Editar" : "Salvar"?>
                        </button>
                        <a href="./PostList.php" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>

            </form>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>

</body>

</html>