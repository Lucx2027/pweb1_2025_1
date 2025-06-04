<?php
include "../db.class.php";

include_once "../header.php";


$db = new db('usuario');
$dataq = null;
$errors = [];
$sucess = '';

if (!empty($_POST)) { 

    $data = (object) $_POST;

    if(empty(trim($_POST['nome']))){
        $errors[] = "<li>o nome é obrigatorio!</li>";
    }
    if(empty(trim($_POST['email']))){
        $errors[] = "<li>o email é obrigatorio!</li>";
    }
    if(empty(trim($_POST['cpf']))){
        $errors[] = "<li>o cpf é obrigatorio!</li>";
    }
    if(empty(trim($_POST['telefone']))){
        $errors[] = "<li>o telefone é obrigatorio!</li>";
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
                        ()=> window.location.href = 'UsuarioList.php', 1500
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
                        <label for="" class="form-label">Nome</label>
                        <input type="text" name="nome" value="<?= $data->nome ?? '' ?>" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= $data->email ?? '' ?>"class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">CPF</label>
                        <input type="text" name="cpf" value="<?= $data->cpf ?? '' ?>"class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Telefone</label>
                        <input type="text" name="telefone" value="<?= $data->telefone ?? '' ?>"class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col mt-4">
                        <button type="submit" class="btn btn-primary">
                            <?= !empty($_GET['id']) ? "Editar" : "Salvar"?>
                        </button>
                        <a href="./UsuarioList.php" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>

            </form>
    
            <?php

            include_once "../header.php";

            ?>