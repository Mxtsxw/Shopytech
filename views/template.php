<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="./static/css/custom.css">

        <title><?=$t?></title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
        <!-- MDB -->
        <link rel="stylesheet" href="<?= ROOT ?>/static/css/mdb.min.css" />
    </head>
    <body class="h-100 d-flex flex-column">
        
        <!-- HEADER -->
        <header>
            <?php require("header.php"); ?>
        </header>
        <!-- GENERATED CONTENT -->
        <main class="container my-4 h-100">
            <?=$content?>
        </main>
        
        <!-- FOOTER -->
        <?php require("footer.php"); ?>   

        <!-- MDB -->
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <!-- Custom scripts -->
        <script type="text/javascript"></script>
    </body>
</html>