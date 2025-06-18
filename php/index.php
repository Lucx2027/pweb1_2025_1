<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $nome = "Lucas";
    $idade = 18;
    echo ("Olá mundo<br> PHP, $nome <br>");

    /*
    crie uma idade faça uma atribuição e imprima na tela se 
    é de maior ou menor de idade.
    */

    if ($idade > 18) {
        echo "De maior <br>";
    } else {
        echo "De menor";
    }
    /*
        02. imprima apenas as notas maiores que 6. 
    */
    $notas = [7, 6, 5, 8, 9];
    for ($i = 0; $i < count($notas); $i++) {
        echo $notas[$i]."<br>";

        if($notas[$i]>6){
            echo $notas[$i]."<br>";
        }
    }
    
     /*
       03. Crie um vetor com 5 alunos e imprima o aluno da posição 0 e 4 
    */
    $nomes = ["Jackson", "John", "Maria", "Chiquinha", "Chaves"];

    echo $nomes[0]. " - ". $nomes[4];
    




    ?>

</body>

</html>