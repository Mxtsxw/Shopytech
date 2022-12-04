<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $t ?></title>
    </head>
    <body>
        <header>
            <h1><a href="<?= URL ?>">Biscuit blog</a></h1>
        </header>
        <?=$content?>
        <footer>
            <p>Le footer</p>
        </footer>      
    </body>
</html>