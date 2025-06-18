<?php
include "./db.class.php";

include_once "./header.php";


$db = new db('usuario');
$data = null;
$errors = [];
$success = '';

if (!empty($_POST)) {

    //Sempre preserva os dados do POST para exibição
    $data = (object) $_POST; //converte o vetor para objeto

    //função trim remove espaços em branco do inicio e fim da string, 
    if (empty(trim($_POST['login']))) {
        $errors[] = "<li>O login é obrigatorio</li>";
    }

    if (empty(trim($_POST['senha']))) {
        $errors[] = "<li>O senha é obrigatorio</li>";
    }

    if (empty($errors)) {
        try {
            $result =  $db->login($_POST);

            if ($result !== "error") {

                session_start();

                $_SESSION['login'] = $result->login;
                $_SESSION['nome'] = $result->nome;
                $success = "Logado com sucesso!";

                echo "<script>
                        setTimeout(
                            ()=> window.location.href = 'home.php', 1500
                        )
                        </script>";
            }
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

<h3>Login - SIG Blog</h3>
<!-- http://localhost/pweb1_2025_1/php/site/admin/usuario/Login.php -->
<form action="" method="post">
    <div class="row">
        <div class="col-md-4">
            <label for="" class="form-label">Login</label>
            <input type="text" name="login" value="<?= $data->login ?? '' ?>" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="" class="form-label">Senha</label>
            <input type="password" name="senha" value="<?= $data->senha ?? '' ?>" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col mt-4">
            <button type="submit" class="btn btn-primary">
                Logar
            </button>
            <a href="./index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

</form>


<?php

include_once "./footer.php";

?>