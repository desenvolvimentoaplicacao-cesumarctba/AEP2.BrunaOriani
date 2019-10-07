<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8">
        <title>AEP 2</title>
    </head>
    <body>
        <pre>
        <?php
            require_once 'pessoa.php';

            $pessoa = new Pessoa('Joao','01/01/2000', '70', '1.90', '08979931956');

            echo $pessoa->consultaCpf();
            echo $pessoa->calculoImc();
            echo $pessoa->calculoIdade();
        ?>  
    </body>
</html>    