<?php
include "./db.class.php";
include_once "./header.php";

$db = new db('usuario');

$db->checkLogin();
?>

<div class="text-center mb-5">
    <h1 class="mb-3">Painel Administrativo</h1>
    <p class="text-muted">Sistema de Gerenciamento de Blogs</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Menu Principal</h5>
            </div>

            <div class="card-body">
                <div class="row g-3">
                    <!-- Posts -->
                    <div class="col-md-6">
                        <div class="d-grid gap-2">
                            <a href="./post/PostList.php" class="btn btn-primary">
                                Gerenciar Posts</a>
                        </div>
                    </div>
                    <!-- Usuario -->
                    <div class="col-md-6">
                        <div class="d-grid gap-2">
                            <a href="./usuario/UsuarioList.php" class="btn btn-primary">
                                Gerenciar Usuários</a>
                        </div>
                    </div>

                    <a href="./Login.php?logout=true" class="btn btn-warning nav-link">Sair</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include './footer.php';
?>