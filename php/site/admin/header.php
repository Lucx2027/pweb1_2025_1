<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <?php
    $hiddenPage = ['Login.php', 'UsuarioForm.php'];

    //pega a pagina atual
    $currentPage = basename($_SERVER['PHP_SELF']);

    $showMenu = !in_array($currentPage, $hiddenPage);

    //apenas vai mostrar o menu nas telas que estão logadas no sistema
    if ($showMenu) {
        include_once "../menu.php";
    }

    ?>

    <div class="container mt-5">
        <div class="row">