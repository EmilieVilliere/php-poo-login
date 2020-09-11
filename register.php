<?php

//Besoin d'un formulaire

require "config/config.php";
require "views/partials/header.php"; 

//Traitement du formulaire 
$errors = [];
$email = $pseudo = null; //initialisation des champs

if(!empty($_POST)) {

    //lorsque le form est soumis :
    foreach($_POST as $field => $value) {

        $$field = sanitize($value); //$email = sanitize($_POST['email]);
    }
    
    //Vérifier les entrées
    if(false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email non valide';
    }

    if(empty($pseudo)) {
        $errors['pseudo'] = 'Pseudo non valide';
    }

    //Mot de passe doit contenir 8 caractères 1 chiffre et un caractère spécial
    if(!preg_match('/(.){8,}/', $password)) {
        $errors['password'] = 'Le mot de passe doit faire 8 caractères minimum';
    }

    if(!preg_match('/[0-9]+/', $password)) {
        $errors['password'] = 'Le mot de passe doit contenir au moins un chiffre';
    }

    if(!preg_match('/[^a-zA-Z0-9]+/', $password)) {
        $errors['password'] = 'Le mot de passe doit contenir au moins un caractère spécial';
    }

    if($password !== $cfPassword) {
        $errors['password'] = 'Les mots de passe ne correspondent pas';
    }

    //Envoyer la data en bdd
    $query = $db->prepare("INSERT INTO user (email, pseudo, password) VALUES (:email, :pseudo, :password)");

    if(empty($errors)) { //si on n'a pas d'erreur alors on ajoute l'user
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $query->execute([
            'email' => $email,
            'pseudo' => $pseudo,
            'password' => $password,
        ]);
    }

    //Redirection 
    header('Location: '.$baseUrl);
   
} ?>

<div class="container">

    <?php if(!empty($errors)) { ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $field => $error) { ?>
            <p><?= $field ?>: <?= $error; ?></p>
            <?php } ?>
        </div>
    <?php } ?>

    <form action="" method="POST" class="mt-4">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="<?= $email; ?>">

        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?= $pseudo; ?>">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">

        <label for="cfPassword">Confirmation</label>
        <input type="password" name="cfPassword" id="cfPassword" class="form-control">

        <button class="btn btn-outline-info mt-3">s'incrire</button>
    </form>
</div>

<?php

require "views/partials/footer.php";