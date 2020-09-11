<?php

/**
 * Système d'authentification en PHP
 * 
 * il nous faudra en 4 étapes :
 * - Inscription - register
 * - Connexion - login 
 * - Mot de passe oublié - forget
 * - Formulaire de reset de mdp - reset
 * 
 * On va devoir stocker les utilisateurs donc il nous faut une table user : 
 * - id
 * - email
 * - password
 * - pseudo
 * 
 * On va stocker les token de reset dans un table reset_token :
 * - id
 * - token
 * - expired_at
 * - user_id
 */