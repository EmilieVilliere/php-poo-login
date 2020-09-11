<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Lien d'importation librairie Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- lien symbolique vers la typographie GoogleFont -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet">

    <!-- Lien Font Awesome Icon -->
    <script src="https://kit.fontawesome.com/abd58e4b6e.js" crossorigin="anonymous"></script>

    <title><?='Vtc Website - ' . $title ?></title>
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <!-- NavBar Bootstrap -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a href="<?= $baseUrl; ?>" class="title text-white">Authentification</div>
    
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navabarButton" aria-controls="navabarButton" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            <div class="collapse navbar-collapse" id="navabarButton">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= $baseUrl; ?>/register.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl; ?>/login.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl; ?>/forget.php">Renvoi</a>
                    </li>
                    <?php if($user = isLogged()) { ?>
                        <li class="nav-item">
                            <?= $user['pseudo']; ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <!-- End NavBar -->
    </header>

