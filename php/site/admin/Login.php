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
    try {
        if (empty($errors)) {
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
            } else {
                $errors[] = "<li>Login ou senha errado, tente novamente!</li>";
            }
        }
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
}

if (!empty($_GET['logout'])) {
    session_start();
    session_destroy();
}

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

<!-- http://localhost/pweb1_2025_1/php/site/admin/usuario/Login.php -->
<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center mb-4">Login - SIG Blog</h4>
                    <form action="./Login.php" method="post">
                        <div class="md-3">
                            <label for="" class="form-label">Login</label>
                            <input type="text" name="login" value="<?= $data->login ?? '' ?>" class="form-control">
                        </div>
                        <div class="md-3">
                            <label for="" class="form-label">Senha</label>
                            <input type="password" name="senha" value="<?= $data->senha ?? '' ?>" class="form-control">
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-right-to-bracket"></i> Logar
                            </button>
                            <a href="./usuario/UsuarioForm.php" class="btn btn-secondary"><i class="fa-solid fa-user-plus"></i> Cadastrar-se</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

include_once "./footer.php";

?>