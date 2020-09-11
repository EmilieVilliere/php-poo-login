<?php
 
require 'config/config.php';
require 'views/partials/header.php'; 

$query = $db->prepare('SELECT * FROM reset_token WHERE token = :token');
$query->execute(['token' => $_GET['token']]);
$token = $query->fetch();

//S'il n'existe pas
if($token) {
    http_response_code(404);
    die('404'); 
}
//S'il est expiré
$now = new DateTime();
$expiredAt = new DateTime($token['expired_at']);

if($now > $expiredAt) {
    http_response_code(404);
    die('404');
}

//S'il existe
if(!empty($_POST)) {
    $password = sanitize($_POST(['password']));
    $cfPassword = sanitize($_POST(['cfPassword']));

    //TODO : faire les vérifications
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //on met à jour le mot de passer user 
    $query = $db->prepare('UPDATE user SET password = :password');
    $query->execute(['password' => $password]);
    //on supprime le token
    $db->query('DELETE FROM reset_token WHERE id = '.$token['id']);

    //on redirige

    redirect('/login.php');
}

?>
 
<div class="container">
    <form action="" method="POST" class="mt-4">
        <label for="password">Nouveau mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">

        <label for="cfPassword">Confirmez</label>
        <input type="password" name="cfPassword" id="cfPassword" class="form-control">

        <button class="btn btn-outline-success mt-3">reset</button>
    </form>
</div>

<?php

require 'views/partials/footer.php';