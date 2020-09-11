<?php

/**
 * dans un formulaire, entrée de mail
 * verification de celui-ci
 * générer un token en bb lié à l'user_id
 * token = 64 caractères minimum 
 * function php = random_bytes
 * faire expirer celui ci au bout d'un heure
 *
 * ISNERT INTO reset_token(token, expired_at, user_id) values (qdfgpisyht575754d, '2020-09-11 16:30:00', 1)
 */

 
require 'config/config.php';
require 'views/partials/header.php'; 

$email = null;

if(!empty($_POST)) {

    $email = sanitize($_POST['email']);

    if(empty($email)) {
        $errors['email'] = 'Champs vide !';
    }

    $query = $db->prepare("SELECT * FROM user WHERE email = ?");
    $query->execute(['email' => $email,]);
    $users = $query->fetch();

    if($users) { // on génère le token

        $token = bin2hex(random_bytes(32));
        $expiredAt = (new DateTime())->add(new DateInterval('PT1H'));
        $query = $db->prepare('INSERT INTO reset_token (token, expired_at, user_id) VALUES (:token, :expired_at, :user_id)');
        $query->execute([
            'token' => $token,
            'expired_at' => $expiredAt->format('Y-m-d H:i:s'),
            'user_id' => $user['id'],
        ]);
            echo $baseUrl . '/rester.php?token=' . $token;
    } else {
        $error = 'Si le compte existe, le token est envoyé.';
    }
}

?>

<div class="container">
    <form action="" method="POST" class="mt-4">
        <label for="email">Saissez votre email</label>
        <input type="email" name="email" id="email" class="form-control">

        <button class="btn btn-outline-danger mt-3">envoyer</button>
    </form>
</div>

<?php

require 'views/partials/footer.php';