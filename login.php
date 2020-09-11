<?php

/**
 * afficher le formulaire (email, password)
 * traiter le formulaire : 
 * - vérifier que l'email est présent en BDD
 *   s'il existe : 
 *   - on peut comparer le mdp saisi avec le hash
 *     grâce à la fonction password_verify
 *     - si c'est true, on connecte le user
 *       on démarre la session on ajoute le user dans la session
 *     - si c'est false, on affice un message d'erreur
 *     - s'il n'existe pas (l'email), on affiche un message d'erreur
 * 
 * Dans la navar on affiche le pseudo de l'utilisateur dès qu'il est connecté. 
 *  
 */

require 'config/config.php';
require 'views/partials/header.php'; 

$errors = [];
$email = $password = null;

if(!empty($_POST)) {

    //lorsque le formulaire est soumis 
    //on clear les input 
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    if(empty($email)) {
        $errors['email'] = 'Email non valide';
    }
    
    if(empty($password)) {
        $errors['password'] = 'Mot de passe non valide';
    }

    $users = $db->prepare("SELECT * FROM user WHERE email = ?");

    $users->execute([
        'email' => $email,
    ]);

    if($users->rowCount() == 1) {

        return $users->fetch();
    
    } else {
        
        return false;
    }

    if($users) {
        
        $isValid = password_verify($password, $user['password']);

        if($isValid) {
            $_SESSION['user'] = [
                'pseudo'  => $user['pseudo'],
                'email'  => $user['email'],
            ];
            header('Location: '.$baseUrl);
        } else {
            //si on a une erreur
            $error = "Mot de passe invalide";
        }
    } else {
        //si on a une erreur
        $error = "Mot de passe invalide";
    }

}

?>
 
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
        <input type="email" name="email" id="email" class="form-control">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">

        <button class="btn btn-outline-success mt-3">se connecter</button>
    </form>
</div>

<a href="<?= $baseUrl; ?>/register.php"></a>

<?php

require 'views/partials/footer.php';